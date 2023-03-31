let currTheme = window.localStorage.getItem("theme");
if (currTheme == "") {
  window.localStorage.setItem("theme", "light");
} else if (currTheme == "dark") {
  document.documentElement.setAttribute("data-theme", "dark");
} else {
  document.documentElement.setAttribute("data-theme", "light");
}
