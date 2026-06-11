export default function initScrollReveal() {
    const elements = document.querySelectorAll('.js-reveal');
    if (!elements.length) return;

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    elements.forEach(function (el) {
        observer.observe(el);
    });
}
