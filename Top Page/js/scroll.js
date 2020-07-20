const pjBtn2 = document.querySelectorAll(".contents");
const subject = document.querySelectorAll(".text");
const docu = document.querySelector(".rightContents");

const endOfPage = docu.offsetHeight;

function handler(event) {
  const id = event.target.id;
  const target = `docu${id}`;

  subject.forEach((list) => {
    const subId = list.id;
    if (subId === target) {
      const coord = list.offsetTop;
      window.scrollTo(0, coord);
    }
  });
}

function init() {
  pjBtn2.forEach((list) => {
    list.addEventListener("click", handler);
  });
  window.scrollTo(0, endOfPage);
}
init();
