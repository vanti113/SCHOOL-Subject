const TITLE = document.title;
const input = document.querySelector("#isbn");

function preventInsert() {
  if (TITLE === "Update page") {
    input.readOnly = true;
  } else {
    input.readOnly = false;
  }
}

function init() {
  preventInsert();
}
init();
