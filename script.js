//---Ouvrir et fermer le menu
const slide = document.querySelector('.slider');
const slider = document.querySelector('.retracted');
const triangle = document.querySelector('.triangle');

const openSlide = () => {
    slider.classList.toggle('opened');
    triangle.classList.toggle('upside');
}

slide.addEventListener('click', openSlide);



const deleteBtn = document.querySelectorAll('.delete');


const confirmIt = (art_id, art_nom) => {
    let url = window.location.pathname;
    let cible = url.slice(10);
    console.log(cible);
    if (window.confirm(`Voulez-vous supprimer l'élément: ${art_nom} ?`)){
        window.location.href=`.${cible}?delete=${art_id}`
    }
};


