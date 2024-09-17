//---Ouvrir et fermer le menu
const slide = document.querySelector('.slider');
const slider = document.querySelector('.retracted');
const triangle = document.querySelector('.triangle');

const openSlide = () => {
    slider.classList.toggle('opened');
    triangle.classList.toggle('upside');
}

slide.addEventListener('click', openSlide);
