// Mobile menu toggle
const mobileBtn = document.getElementById("mobile-menu-btn");
const mobileMenu = document.getElementById("mobile-menu");
if (mobileBtn && mobileMenu) {
  mobileBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    const icon = mobileBtn.querySelector(".material-symbols-outlined");
    if (icon) icon.textContent = mobileMenu.classList.contains("hidden") ? "menu" : "close";
  });
  mobileMenu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.add("hidden");
      const icon = mobileBtn.querySelector(".material-symbols-outlined");
      if (icon) icon.textContent = "menu";
    });
  });
}

// Navbar scroll shadow
window.addEventListener("scroll", () => {
  const nav = document.querySelector("nav");
  if (nav) nav.classList.toggle("shadow-xl", window.scrollY > 50);
});

// Scroll-reveal animation
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("opacity-100", "translate-y-0");
      entry.target.classList.remove("opacity-0", "translate-y-8");
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll("section").forEach((section) => {
  section.classList.add("transition-all", "duration-700", "opacity-0", "translate-y-8");
  revealObserver.observe(section);
});

// Prototype form handler (no backend yet)
document.querySelectorAll("form[data-demo-form]").forEach((form) => {
  form.addEventListener("submit", (event) => {
    event.preventDefault();
    const status = form.querySelector("[role='status']");
    if (status) {
      status.textContent = "Thank you. This prototype captured your request locally; connect it to your CRM or email service before launch.";
      status.classList.remove("hidden");
    }
    form.reset();
  });
});
