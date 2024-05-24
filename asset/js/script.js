// CARROUSEL PAGE ACCUEIL
const slides = document.querySelectorAll(".slide");

// Tableau d'image : [0, 1, 2]
function changeSlide(next = true) {
  const calcNextSlide = next ? 1 : -1;
  const slideActive = document.querySelector(".active");

  if (slideActive) {
    let newIndex = calcNextSlide + [...slides].indexOf(slideActive);

    if (newIndex < 0) newIndex = [...slides].length - 1;
    if (newIndex >= [...slides].length) newIndex = 0;

    if (slides[newIndex]) {
      slides[newIndex].classList.add("active");
      slideActive.classList.remove("active");
    }
  }
}
// AUTOMATISATION DU CARROUSEL (2s)
setInterval(() => {
  changeSlide(true);
}, 2000);
// FIN CARROUSEL PAGE ACCUEIL
//POPUP PAGE ADMIN
function togglePopup(id) {
  let popup = document.querySelector("#popup_admin_overlay" + id);
  popup.classList.toggle("open");
}
//FIN POPUP PAGE ADMIN
