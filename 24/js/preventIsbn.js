const TITLE = document.title;
const input = document.querySelector("#isbn");
const GREY = "inputColor";

function preventInsert() {
  if (TITLE === "Update page") {
    input.readOnly = true;
    input.classList.add(GREY);
  } else {
    input.readOnly = false;
    input.classList.remove(GREY);
  }
}

function init() {
  preventInsert();
}
init();
