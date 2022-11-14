const actividades = document.querySelectorAll('.fa-chevron-up');
actividades.forEach(acti => {
    acti.addEventListener('click', (e) => {
        acti.parentNode.parentNode.parentNode.children[1].classList.toggle('card_ocultar')
        acti.classList.toggle('arrow-move');
    })
})

