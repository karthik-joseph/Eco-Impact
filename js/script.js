document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector("#home");
  const footer = document.querySelector("footer");
  const navLinks = document.querySelectorAll("a.section-link");

  // Intersection Observer to toggle sticky header visibility
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          header.classList.remove("sticky");
        } else {
          header.classList.add("sticky");
        }
      });
    },
    {
      root: null,
      threshold: 0,
    }
  );

  observer.observe(footer);

  // Add click event to nav links to set active class
  function setActiveLink() {
    const currentPath = window.location.pathname;

    navLinks.forEach((link) => {
      const linkPath = new URL(link.href).pathname;
      if (linkPath === currentPath) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  }
  setActiveLink();
});
