let searchForm = document.querySelector('.searchform');

document.querySelector('#search').onclick = () =>{
    searchForm.classList.toggle('active');
    cart.classList.remove('active');
}

let cart = document.querySelector('.shopingCart');

document.querySelector('#cart-btn').onclick = () =>{
    searchForm.classList.remove('active');
    cart.classList.toggle('active');
}