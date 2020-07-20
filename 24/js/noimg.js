const img = document.querySelectorAll("img");
const errors = {
  error1: '<img src="noimg.jpg">',
  error2: '<img src="">',
};

function init() {
  img.forEach((list) => {
    const temp = list.outerHTML;

    if (temp === errors.error1 || temp === errors.error2) {
      list.src =
        "https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Noimage.svg/130px-Noimage.svg.png";
    }
  });
}
init();
