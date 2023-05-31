const searchBtn = document.getElementById("search-btn");
const showAsideBtn = document.getElementById("aside-btn");

showAsideBtn.addEventListener("click", () => {
  let aside = document.getElementById("aside");
  if (aside.hasAttribute("hidden")) {
    showAside(aside);
  } else {
    hideAside(aside);
  }
});

searchBtn.addEventListener("mouseover", () => {
  let searchBox = document.getElementById("search-box");
  searchBox.removeAttribute("hidden");
  searchBox.removeAttribute("disabled");
  searchBtn.src = "../icons/cancel.png";
  searchBox.focus();
});

let searchButton = document.getElementById("search-button");
searchButton.addEventListener("click", showHide_searchBox);

function showHide_searchBox() {
  let searchBox = document.getElementById("search-box");
  if (searchBox.hasAttribute("disabled")) {
    searchBtn.src = "../icons/cancel.png";
    searchBox.removeAttribute("hidden");
    searchBox.removeAttribute("disabled");
    searchBox.focus();
  } else {
    searchBox.setAttribute("closing", "");
    setTimeout(() => {
      searchBtn.src = "../icons/search.png";
      searchBox.setAttribute("hidden", "");
      searchBox.setAttribute("disabled", "");
      searchBox.removeAttribute("closing");
    }, 500);
  }
}

function changeTheme() {
  let currTheme = window.localStorage.getItem("theme");
  if (currTheme == "") {
    window.localStorage.setItem("theme", "light");
  } else if (currTheme == "dark") {
    console.log("lightning........");
    document.documentElement.setAttribute("data-theme", "light");
    window.localStorage.setItem("theme", "light");
  } else {
    console.log("darking........");
    document.documentElement.setAttribute("data-theme", "dark");
    window.localStorage.setItem("theme", "dark");
  }
}

function showAside(aside) {
  console.log("showingAside........");

  aside.removeAttribute("aria-disabled");
  aside.removeAttribute("hidden");
  showAsideBtn.src = "../icons/cancel.png";
  document.getElementById("aside-search-box").focus();
}

function hideAside(aside) {
  console.log("hideAside........");

  aside.style.animation = "hideAside 0.4s ease-out forwards";
  showAsideBtn.src = "../icons/menu.png";
  setTimeout(() => {
    aside.style.animation = "";
    aside.setAttribute("aria-disabled", "true");
    aside.setAttribute("hidden", "");
  }, 400);
}

let page2Imgs = document.querySelectorAll("#page2-main div");
beginSpacing = 0;
deltaSpace = 10;
beginRotation = 2;
deltaRotation = 2;
page2Imgs.forEach((img) => {
  img.style.transform = `rotateZ(${beginRotation}deg)`;
  img.style.left = `${beginSpacing}px`;
  beginRotation += deltaRotation;
  beginSpacing += deltaSpace;
});

let selectedImgIndex = 0;
setInterval(() => {
  removeSelectedImgs();
  page2Imgs[selectedImgIndex].setAttribute("selected", "");
  selectedImgIndex++;
  if (selectedImgIndex >= page2Imgs.length) {
    selectedImgIndex = 0;
  }
}, 2500);

function removeSelectedImgs() {
  page2Imgs.forEach((img) => {
    img.removeAttribute("selected");
  });
}

page2Height = page2Imgs[selectedImgIndex].getBoundingClientRect().height + 30;
document.getElementById("page2-main").style.minHeight = `${page2Height}px`;
