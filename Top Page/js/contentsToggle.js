const toggle = document.querySelectorAll(".text__subTitle__content__title");
const SHOW = "show";

function init() {
  toggle.forEach((list) => {
    list.addEventListener("click", function () {
      const panel = this.nextElementSibling;
      panel.classList.toggle(SHOW);
    });
  });
}
init();
