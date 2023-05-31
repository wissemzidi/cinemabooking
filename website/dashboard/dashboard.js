const showAside = document.querySelector("#show-full-aside");
const sideBarText = document.querySelectorAll(".hide-600");
const nav = document.querySelector("nav");

showAside.addEventListener("click", () => {
  if (showAside.getAttribute("data-active") === "true") {
    showAside.setAttribute("data-active", false);
    sideBarText.forEach((ele) => {
      ele.style.animation = "fadeOut ease-out 0.3s";
    });
    setTimeout(() => {
      sideBarText.forEach((ele) => {
        ele.style.display = "none";
      });
    }, 200);
  } else {
    showAside.setAttribute("data-active", true);
    sideBarText.forEach((ele) => {
      ele.style.display = "block";
      ele.style.animation = "fadeIn ease-out 0.2s";
    });
  }
});

//
const toggleSwitch = document.querySelectorAll(".toggle-switch");
const toggleInput = document.querySelectorAll(".toggle-input");

toggleSwitch.forEach((ele) => {
  ele.addEventListener("click", () => {
    ele.previousElementSibling.toggleAttribute("checked");
  });
});
