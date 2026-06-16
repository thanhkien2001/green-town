export default function initHeader() {
    const header = document.querySelector('.ldp-header');
    const hamburger = document.getElementById('js-ldp-hamburger');
    const mobileNav = document.getElementById('js-ldp-nav-mobile');
    const scrollTriggers = document.querySelectorAll('.js-scroll-trigger');

    if (!header) return;

    // 1. Mobile Hamburger Toggle
    if (hamburger && mobileNav) {
        hamburger.addEventListener('click', function (e) {
            e.stopPropagation();
            hamburger.classList.toggle('active');
            mobileNav.classList.toggle('active');
        });

        // Click outside to close mobile menu
        document.addEventListener('click', function (e) {
            if (!mobileNav.contains(e.target) && !hamburger.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileNav.classList.remove('active');
            }
        });
    }

    // 2. Sticky Header scroll effect
    window.addEventListener('scroll', function () {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // 3. Smooth Scroll with Header Offset Subtraction
    scrollTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (!href.startsWith('#')) return;

            const targetId = href.slice(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                e.preventDefault();

                // Close mobile nav if open
                if (hamburger && mobileNav) {
                    hamburger.classList.remove('active');
                    mobileNav.classList.remove('active');
                }

                // Calculate header offset height
                const headerHeight = window.innerWidth > 991 ? 80 : 70;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerHeight;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Update URL hash without jumping
                if (history.pushState) {
                    history.pushState(null, null, '#' + targetId);
                } else {
                    location.hash = '#' + targetId;
                }
            }
        });
    });

    // 4. Scroll Spy (Highlight Active Menu Link) using IntersectionObserver
    const menuLinks = document.querySelectorAll('.ldp-menu-link, .ldp-menu-link-mobile');
    const observedSections = [];

    // Luôn theo dõi cả Section Hero để tắt active khi ở banner đầu trang
    const heroSec = document.getElementById('section-hero');
    if (heroSec) {
        observedSections.push(heroSec);
    }

    menuLinks.forEach(function (link) {
        const anchor = link.getAttribute('data-anchor');
        if (anchor && anchor.startsWith('#')) {
            const sec = document.getElementById(anchor.slice(1));
            if (sec && !observedSections.includes(sec)) {
                observedSections.push(sec);
            }
        }
    });

    if (observedSections.length > 0 && 'IntersectionObserver' in window) {
        const spyObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    
                    menuLinks.forEach(function (link) {
                        const anchor = link.getAttribute('data-anchor');
                        if (anchor === '#' + id) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }
            });
        }, {
            // Chỉ nhận diện active khi section cuộn lên sát gần Header (từ 100px cách đỉnh xuống)
            rootMargin: '-100px 0px -80% 0px',
            threshold: 0
        });

        observedSections.forEach(function (sec) {
            spyObserver.observe(sec);
        });
    }

    // Tắt active chủ động khi người dùng cuộn lên sát đỉnh trang
    window.addEventListener('scroll', function () {
        if (window.scrollY < 120) {
            menuLinks.forEach(function (link) {
                link.classList.remove('active');
            });
        }
    });
}
