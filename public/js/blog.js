const burger = document.querySelector('.burger');
console.log(burger)
    /* on déclenche l'évenement au click */
if (burger !== null)
    burger.addEventListener('click', () => {

        console.log('click')

        burger.classList.toggle('active');
        console.log('burger ouvert')
    });