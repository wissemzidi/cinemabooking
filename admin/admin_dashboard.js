let cards = document.querySelectorAll(".hero_card");

cards.forEach((card) => {
  card.addEventListener("click", (e) => {
    console.log(e.target.classList[0]);
    if (e.target.classList[0] == "hero_card_img") {
      let header = card.querySelector(".hero_card_preview");
      let main = card.querySelector(".hero_card_main");
      if (header.hasAttribute("hidden")) {
        main.setAttribute("hidden", "");
      } else {
        main.removeAttribute("hidden");
      }
    }
  });
});

function collapseAllCards() {
  let mains = document.querySelectorAll(".hero_card_main");
  mains.forEach((main) => {
    main.setAttribute("hidden", "");
  });
}
