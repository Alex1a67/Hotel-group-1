document.addEventListener("DOMContentLoaded", () => {
  const input = document.querySelector("#search, #searchAll");
  if (!input) return;

  input.addEventListener("keyup", () => {
    const val = input.value.toLowerCase();
    document.querySelectorAll("table tr").forEach((row, i) => {
      if (i === 0) return;
      row.style.display = row.innerText.toLowerCase().includes(val)
        ? ""
        : "none";
    });
  });
});