const searchWord1 = document.querySelector("#word1"),
  searchWord2 = document.querySelector("#word2"),
  searchTag = document.querySelector(".bookTable__search");

const VANISH = "vanish";

function handler() {
  const word1 = searchWord1.innerText,
    word2 = searchWord2.innerText;
  if (word1 === "" && word2 === "") {
    searchTag.classList.add(VANISH);
  } else {
    searchTag.classList.remove(VANISH);
  }
}

function init() {
  handler();
}
init();
