const bar = document.querySelector(".BAR");
const sideBar = document.querySelector(".sideBar"),
  bookTable = document.querySelector(".bookTable");

const HIDE = "hide",
  STRETCH = "stretch",
  TURN = "turn";

function handler() {
  if (sideBar.classList.contains(HIDE)) {
    sideBar.classList.remove(HIDE);
    bookTable.classList.remove(STRETCH);
    bar.classList.remove(TURN);
  } else {
    sideBar.classList.add(HIDE);
    bookTable.classList.add(STRETCH);
    bar.classList.add(TURN);
  }
}

function init() {
  bar.addEventListener("click", handler);
}

init();
