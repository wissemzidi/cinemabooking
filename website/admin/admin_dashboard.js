let cards = document.querySelectorAll(".hero_card");

cards.forEach((card) => {
  card.addEventListener("click", (e) => {
    if (e.target.classList[0] == "hero_card_img") {
      let main = card.querySelector(".hero_card_main");
      collapseAllCards();
      main.toggleAttribute("hidden");
    }
  });
});

function collapseAllCards() {
  let mains = document.querySelectorAll(".hero_card_main");
  mains.forEach((main) => {
    main.setAttribute("hidden", "");
  });
}
