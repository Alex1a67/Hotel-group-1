window.addEventListener("scroll", () => {
  const nav = document.querySelector(".nav-wrap");
  if (window.scrollY > 50) {
    nav.style.background = "rgba(6,15,31,0.95)";
  } else {
    nav.style.background = "rgba(6,15,31,0.85)";
  }
});