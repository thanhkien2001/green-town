/* =============================================================
   KIA Landing Page — JavaScript
   ============================================================= */

import initScrollReveal from './landing/scroll-reveal.js';
import initSmoothScroll from './landing/smooth-scroll.js';
import initContactForm from './landing/contact-form.js';
import initSection6Swiper from './landing/section6-swiper.js';
import initSection11Swiper from './landing/section11-swiper.js';
import initSection12Swiper from './landing/section12-swiper.js';
import initSection13Form from './landing/section13-form.js';

document.addEventListener('DOMContentLoaded', function () {
    initScrollReveal();
    initSmoothScroll();
    initContactForm();
    initSection6Swiper();
    initSection11Swiper();
    initSection12Swiper();
    initSection13Form();
});
