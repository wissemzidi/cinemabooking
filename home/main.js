const searchBtn = document.getElementById("search-btn");

searchBtn.addEventListener("mouseover", (e) => {
  let searchBox = document.getElementById("search-box");
  searchBox.removeAttribute("hidden");
  searchBox.removeAttribute("disabled");
  searchBtn.src = "./icons/cancel.png";
  searchBox.focus();
});

searchBtn.addEventListener("click", (e) => {
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
