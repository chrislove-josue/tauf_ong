import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initMobileNav();
    initDropdowns();
    initSlider();
    initCounters();
    initReveal();
    initAccordions();
    initCookies();
    initBackToTop();
    initEditors();
    initConfirm();
    initImagePreview();
    initAdminSidebar();
    initTestimonialSlider();
});

function initTestimonialSlider() {
    document.querySelectorAll('[data-testimonial-slider]').forEach((slider) => {
        const track = slider.querySelector('.no-scrollbar');
        if (!track) return;
        const slides = [...track.children];
        const dots = [...slider.querySelectorAll('[data-testimonial-dot]')];
        if (slides.length < 2) return;

        let current = 0;
        let timer = null;
        let scrollTimeout;

        const slideLeft = (index) =>
            slides[index].getBoundingClientRect().left - track.getBoundingClientRect().left + track.scrollLeft;

        const updateDots = () => {
            dots.forEach((dot, i) => {
                dot.classList.toggle('is-active', i === current);
                dot.setAttribute('aria-current', i === current ? 'true' : 'false');
            });
        };

        const goTo = (index) => {
            current = ((index % slides.length) + slides.length) % slides.length;
            track.scrollTo({ left: slideLeft(current), behavior: 'smooth' });
            updateDots();
        };

        const start = () => {
            stop();
            timer = setInterval(() => goTo(current + 1), 6000);
        };

        const stop = () => {
            if (timer) clearInterval(timer);
            timer = null;
        };

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                goTo(i);
                start();
            });
        });

        track.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                const index = Math.round(track.scrollLeft / slides[0].getBoundingClientRect().width);
                if (index !== current && index >= 0 && index < slides.length) {
                    current = index;
                    updateDots();
                }
            }, 80);
        }, { passive: true });

        slider.addEventListener('mouseenter', stop);
        slider.addEventListener('mouseleave', start);

        updateDots();
        start();
    });
}

function initHeader() {
    const header = document.querySelector('[data-header]');
    if (!header) return;
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 20);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

function initMobileNav() {
    document.querySelectorAll('[data-mobile-toggle]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const target = document.querySelector(btn.dataset.mobileToggle);
            target?.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        });
    });
}

function initDropdowns() {
    document.querySelectorAll('[data-dropdown]').forEach((wrap) => {
        const trigger = wrap.querySelector('[data-dropdown-trigger]');
        const menu = wrap.querySelector('[data-dropdown-menu]');
        if (!trigger || !menu) return;
        trigger.addEventListener('click', (e) => {
            e.preventDefault();
            menu.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!wrap.contains(e.target)) menu.classList.add('hidden');
        });
    });
}

function initSlider() {
    document.querySelectorAll('[data-slider]').forEach((slider) => {
        const slides = [...slider.querySelectorAll('[data-slide]')];
        if (slides.length < 2) return;
        let index = 0;
        const show = (i) => {
            slides.forEach((s, k) => s.classList.toggle('opacity-0', k !== i));
            slides.forEach((s, k) => s.classList.toggle('pointer-events-none', k !== i));
        };
        show(0);
        setInterval(() => {
            index = (index + 1) % slides.length;
            show(index);
        }, 6000);
    });
}

function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');
    if (!counters.length) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const target = parseFloat(el.dataset.counter);
            const duration = 1500;
            const start = performance.now();
            const step = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const value = Math.floor(progress * target);
                el.textContent = value.toLocaleString('fr-FR');
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = target.toLocaleString('fr-FR');
            };
            requestAnimationFrame(step);
            observer.unobserve(el);
        });
    }, { threshold: 0.4 });
    counters.forEach((c) => observer.observe(c));
}

function initReveal() {
    const items = document.querySelectorAll('.reveal');
    if (!items.length) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    items.forEach((i) => observer.observe(i));
}

function initAccordions() {
    document.querySelectorAll('[data-accordion-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const body = trigger.nextElementSibling;
            body?.classList.toggle('open');
            trigger.querySelector('[data-accordion-icon]')?.classList.toggle('rotate-180');
        });
    });
}

function initCookies() {
    const banner = document.querySelector('[data-cookie-banner]');
    if (!banner) return;
    if (localStorage.getItem('tauf_cookie_ok')) {
        banner.remove();
        return;
    }
    banner.classList.remove('hidden');
    banner.querySelector('[data-cookie-accept]')?.addEventListener('click', () => {
        localStorage.setItem('tauf_cookie_ok', '1');
        banner.remove();
    });
}

function initBackToTop() {
    const btn = document.querySelector('[data-back-to-top]');
    if (!btn) return;
    window.addEventListener('scroll', () => {
        btn.classList.toggle('opacity-0', window.scrollY < 400);
        btn.classList.toggle('pointer-events-none', window.scrollY < 400);
    }, { passive: true });
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

function initEditors() {
    document.querySelectorAll('[data-editor]').forEach((el) => {
        const input = document.querySelector(el.dataset.editor);
        if (!input) return;
        const quill = new Quill(el, {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ header: [2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['blockquote', 'link'],
                    [{ align: [] }],
                    ['clean'],
                ],
            },
        });
        if (input.value) quill.clipboard.dangerouslyPasteHTML(input.value);
        quill.on('text-change', () => {
            const html = quill.root.innerHTML;
            input.value = html === '<p><br></p>' ? '' : html;
        });
    });
}

function initConfirm() {
    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (!window.confirm(form.dataset.confirm)) e.preventDefault();
        });
    });
}

function initImagePreview() {
    document.querySelectorAll('[data-image-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const preview = document.querySelector(input.dataset.imageInput);
            if (preview && input.files?.[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('hidden');
            }
        });
    });
}

function initAdminSidebar() {
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.querySelector('[data-sidebar-overlay]');
    if (!sidebar) return;

    const open = () => {
        sidebar.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
    };
    const close = () => {
        sidebar.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
    };

    document.querySelectorAll('[data-sidebar-toggle]').forEach((btn) => {
        btn.addEventListener('click', () => {
            sidebar.classList.contains('-translate-x-full') ? open() : close();
        });
    });
    overlay?.addEventListener('click', close);
}
