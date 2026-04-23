document.addEventListener("DOMContentLoaded", () => {
  const MONTHS = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  const today = new Date();
  today.setHours(0, 0, 0, 0);

  let baseMonth = today.getMonth();
  let baseYear = today.getFullYear();

  let startDate = null;
  let endDate = null;
  let picking = false;

  let adults = 2;
  let children = 0;
  let selRoom = "F";

  const dateField = document.getElementById("dateField");
  const guestField = document.getElementById("guestField");
  const calDropdown = document.getElementById("calDropdown");
  const guestDropdown = document.getElementById("guestDropdown");
  const dateVal = document.getElementById("dateVal");
  const guestVal = document.getElementById("guestVal");
  const calSummary = document.getElementById("calSummary");

  const prevMonthBtn = document.getElementById("prevMonthBtn");
  const nextMonthBtn = document.getElementById("nextMonthBtn");
  const clearDatesBtn = document.getElementById("clearDatesBtn");
  const applyDatesBtn = document.getElementById("applyDatesBtn");
  const guestConfirmBtn = document.getElementById("guestConfirmBtn");
  const searchBtn = document.getElementById("searchBtn");

  const adVal = document.getElementById("adVal");
  const chVal = document.getElementById("chVal");
  const adMinus = document.getElementById("adMinus");
  const chMinus = document.getElementById("chMinus");

  function fmt(date) {
    return `${date.getDate()} ${MONTHS[date.getMonth()].slice(0, 3)} ${date.getFullYear()}`;
  }

  function updateSummary() {
    if (!startDate) {
      calSummary.innerHTML = "Select check-in date";
      return;
    }

    if (!endDate) {
      calSummary.innerHTML = `<strong>${fmt(startDate)}</strong> &rarr; Select check-out`;
      return;
    }

    const nights = Math.round((endDate - startDate) / 86400000);
    calSummary.innerHTML =
      `<strong>${fmt(startDate)}</strong> &rarr; <strong>${fmt(endDate)}</strong> &nbsp;&#183;&nbsp; ${nights} Night${nights > 1 ? "s" : ""}`;
  }

  function renderCal() {
    [0, 1].forEach((offset) => {
      const current = new Date(baseYear, baseMonth + offset, 1);
      const month = current.getMonth();
      const year = current.getFullYear();

      document.getElementById(`ml${offset}`).textContent = `${MONTHS[month]} ${year}`;

      const grid = document.getElementById(`cg${offset}`);
      grid.innerHTML = "";

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement("div");
        empty.className = "cal-day empty";
        grid.appendChild(empty);
      }

      for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(year, month, day);
        date.setHours(0, 0, 0, 0);

        const cell = document.createElement("div");
        cell.className = "cal-day";
        cell.textContent = day;

        if (date < today) {
          cell.classList.add("past");
        } else {
          if (date.toDateString() === today.toDateString()) {
            cell.classList.add("today");
          }

          const isStart = startDate && date.toDateString() === startDate.toDateString();
          const isEnd = endDate && date.toDateString() === endDate.toDateString();
          const inRange = startDate && endDate && date > startDate && date < endDate;

          if (isStart) {
            cell.classList.add("start");
            if (!endDate) cell.classList.add("only");
          }

          if (isEnd) {
            cell.classList.add("end");
            if (!startDate) cell.classList.add("only");
          }

          if (isStart && isEnd) {
            cell.classList.remove("start", "end");
            cell.classList.add("start", "end", "only");
          }

          if (inRange) {
            cell.classList.add("in-range");
          }

          cell.addEventListener("click", () => pickDay(date));
        }

        grid.appendChild(cell);
      }
    });

    updateSummary();
  }

  function pickDay(date) {
    if (!startDate || (startDate && endDate)) {
      startDate = date;
      endDate = null;
      picking = true;
    } else if (picking && date > startDate) {
      endDate = date;
      picking = false;
    } else {
      startDate = date;
      endDate = null;
      picking = true;
    }

    renderCal();
  }

  function shiftMonth(dir) {
    const nextBase = new Date(baseYear, baseMonth + dir, 1);
    baseMonth = nextBase.getMonth();
    baseYear = nextBase.getFullYear();
    renderCal();
  }

  function clearDates() {
    startDate = null;
    endDate = null;
    picking = false;

    renderCal();
    dateVal.textContent = "Select your dates";
    dateVal.className = "sb-val ph";
  }

  function applyDates() {
    if (startDate && endDate) {
      const nights = Math.round((endDate - startDate) / 86400000);
      dateVal.innerHTML =
        `${fmt(startDate)} &nbsp;&rarr;&nbsp; ${fmt(endDate)} <span class="nights-pill">${nights}N</span>`;
      dateVal.className = "sb-val";
    }

    calDropdown.classList.remove("open");
  }

  function cntChange(type, dir) {
    if (type === "ad") {
      adults = Math.max(1, Math.min(10, adults + dir));
      adVal.textContent = adults;
      adMinus.disabled = adults <= 1;
    } else {
      children = Math.max(0, Math.min(6, children + dir));
      chVal.textContent = children;
      chMinus.disabled = children <= 0;
    }
  }

  function pickRoom(room) {
    selRoom = room;

    ["Y", "F", "W"].forEach((item) => {
      const el = document.getElementById(`rt-${item}`);
      el.classList.toggle("sel", item === room);
    });
  }

  function applyGuest() {
    const names = {
      Y: "Y Room",
      F: "F Room",
      W: "W Suite"
    };

    const total = adults + children;
    guestVal.textContent = `${total} Guest${total > 1 ? "s" : ""} • ${names[selRoom]}`;
    guestVal.className = "sb-val";
    guestDropdown.classList.remove("open");
  }

  function doSearch() {
    if (!startDate || !endDate) {
      alert("Please select your check-in and check-out dates.");
      return;
    }

    const nights = Math.round((endDate - startDate) / 86400000);

    const names = {
      Y: "Y Room (Smart Standard)",
      F: "F Room (Executive)",
      W: "W Suite (World Class)"
    };

    alert(
      `Searching…\n\n` +
      `Room: ${names[selRoom]}\n` +
      `Check-In: ${fmt(startDate)}\n` +
      `Check-Out: ${fmt(endDate)} (${nights} nights)\n` +
      `Guests: ${adults} Adult(s), ${children} Child(ren)`
    );
  }

  function toggleCal(event) {
    event.stopPropagation();
    guestDropdown.classList.remove("open");
    calDropdown.classList.toggle("open");
    renderCal();
  }

  function toggleGuest(event) {
    event.stopPropagation();
    calDropdown.classList.remove("open");
    guestDropdown.classList.toggle("open");
  }

  dateField.addEventListener("click", toggleCal);
  guestField.addEventListener("click", toggleGuest);

  calDropdown.addEventListener("click", (event) => event.stopPropagation());
  guestDropdown.addEventListener("click", (event) => event.stopPropagation());

  prevMonthBtn.addEventListener("click", (event) => {
    event.stopPropagation();
    shiftMonth(-1);
  });

  nextMonthBtn.addEventListener("click", (event) => {
    event.stopPropagation();
    shiftMonth(1);
  });

  clearDatesBtn.addEventListener("click", (event) => {
    event.stopPropagation();
    clearDates();
  });

  applyDatesBtn.addEventListener("click", (event) => {
    event.stopPropagation();
    applyDates();
  });

  guestConfirmBtn.addEventListener("click", (event) => {
    event.stopPropagation();
    applyGuest();
  });

  searchBtn.addEventListener("click", doSearch);

  document.querySelectorAll(".cnt-btn[data-type]").forEach((button) => {
    button.addEventListener("click", (event) => {
      event.stopPropagation();
      cntChange(button.dataset.type, Number(button.dataset.dir));
    });
  });

  document.querySelectorAll(".rt-card[data-room]").forEach((card) => {
    card.addEventListener("click", (event) => {
      event.stopPropagation();
      pickRoom(card.dataset.room);
    });
  });

  document.addEventListener("click", () => {
    calDropdown.classList.remove("open");
    guestDropdown.classList.remove("open");
  });

  renderCal();
});