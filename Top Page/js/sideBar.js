const project1 = document.querySelector(".leftBar__project1"),
  project2 = document.querySelector(".leftBar__project2");
const contents1 = document.querySelectorAll(".contents1"),
  contents2 = document.querySelectorAll(".contents2");

const HIDE = "hide";

function handler2() {
  contents2.forEach((list) => {
    list.classList.toggle(HIDE);
  });
}

function handler1() {
  contents1.forEach((list) => {
    list.classList.toggle(HIDE);
  });
}

function init() {
  project1.addEventListener("click", handler1);
  project2.addEventListener("click", handler2);
}
init();
