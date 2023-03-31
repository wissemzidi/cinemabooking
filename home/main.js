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
  searchBtn.src = "./icons/cancel.png";
  searchBox.focus();
});

searchBtn.addEventListener("click", () => {
  let searchBox = document.getElementById("search-box");
  if (searchBox.hasAttribute("disabled")) {
    searchBtn.src = "./icons/cancel.png";
    searchBox.removeAttribute("hidden");
    searchBox.removeAttribute("disabled");
    searchBox.focus();
  } else {
    searchBox.setAttribute("closing", "");
    setTimeout(() => {
      searchBtn.src = "./icons/search.png";
      searchBox.setAttribute("hidden", "");
      searchBox.setAttribute("disabled", "");
      searchBox.removeAttribute("closing");
    }, 500);
  }
});

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
  showAsideBtn.src = "./icons/cancel.png";
}

function hideAside(aside) {
  console.log("hideAside........");

  aside.style.animation = "hideAside 0.4s ease-out forwards";
  showAsideBtn.src = "./icons/menu.png";
  setTimeout(() => {
    aside.style.animation = "";
    aside.setAttribute("aria-disabled", "true");
    aside.setAttribute("hidden", "");
  }, 400);
}
