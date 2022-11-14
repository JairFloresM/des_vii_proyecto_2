const select = document.querySelector("select[name='filtro']");



select.addEventListener('change', e => {
    console.log(select.value)
})