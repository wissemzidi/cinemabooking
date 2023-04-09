// "use strict";

// Const
const emailInput = document.querySelector("#email__input");
const passwordInput = document.querySelector("#password__input");
const submitBtn = document.querySelector("#login__submit__btn");
const form = document.querySelector("#login");

window.addEventListener("keyup", () => {
  if (
    emailInput.classList.contains("valid") &&
    passwordInput.classList.contains("valid")
  ) {
    submitBtn.classList.add("allValid");
    submitBtn.style.backgroundColor = "var(--clr-neutral-200)";
    submitBtn.style.color = "white";
    submitBtn.style.opacity = "1";
    submitBtn.style.cursor = "pointer";
    submitBtn.addEventListener("click", function () {
      activateSpinner();
      document.querySelector(".bg").classList.add("active");
    });
  } else if (
    emailInput.classList.contains("invalid") ||
    passwordInput.classList.contains("invalid")
  ) {
    submitBtn.classList.remove("allValid");
    submitBtn.style.backgroundColor = "transparent";
    submitBtn.style.opacity = ".8";
    submitBtn.style.cursor = "auto";
  }
});

emailInput.addEventListener("keyup", function () {
  if (emailInput.value.length >= 4) {
    emailInput.className = "valid";
  } else {
    emailInput.className = "invalid";
  }
});

passwordInput.addEventListener("keyup", () => {
  if (passwordInput.value.length >= 8) {
    passwordInput.className = "valid";
  } else {
    passwordInput.className = "invalid";
  }
});
