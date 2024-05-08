import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.mjs';

var menu = ['Slide1', 'Slide2']
var mySwiper = new Swiper ('.swiper-container', {
    speed: 300,
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});