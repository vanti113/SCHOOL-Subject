const bookImage = document.querySelectorAll("img");

function init() {
  bookImage.forEach((list) => {
    const imgUrl = list.outerHTML;
    if (imgUrl === `<img src="noimg.jpg">` || imgUrl === `<img src="">`) {
      list.src =
        "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Noimage.svg/130px-Noimage.svg.png";
    }
  });
}
init();
