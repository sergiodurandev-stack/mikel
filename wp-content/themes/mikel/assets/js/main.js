(function() {
    'use strict';

    // mikelData is injected via wp_localize_script:
    // mikelData.pins  — array of map pin objects
    // mikelData.logos — array of logo objects

    // Signal JS is running
    document.documentElement.classList.add('js-ready');

    // ── Parallax Engine ──────────────────────────────────────────────────
    (function() {
        const videoContainer = document.querySelector('.video-container');
        const headingSelectors = ['.intro-heading','.expertise-heading','.about-headline','.impact-heading','.contact-heading'];
        const mapContainer = document.querySelector('.map-container');
        const headingData = headingSelectors.flatMap(sel =>
            [...document.querySelectorAll(sel)].map(el => ({ el, originY: el.getBoundingClientRect().top + window.scrollY }))
        );
        const mapOriginY = mapContainer ? mapContainer.getBoundingClientRect().top + window.scrollY : 0;
        let rafPending = false;
        function applyParallax() {
            const sy = window.scrollY;
            if (videoContainer) {
                const vh = window.innerHeight;
                const raw = sy * 0.5;
                const clamped = Math.min(raw, vh * 0.15);
                videoContainer.style.transform = 'translateY(' + clamped + 'px) scale(1.1)';
            }
            headingData.forEach(({ el, originY }) => {
                const rel = sy - originY + window.innerHeight;
                if (rel > 0) el.style.transform = 'translateY(' + (rel * 0.04) + 'px)';
            });
            if (mapContainer) {
                const rel = sy - mapOriginY + window.innerHeight;
                if (rel > 0) mapContainer.style.transform = 'translateY(' + (rel * 0.02) + 'px) scale(1)';
            }
            rafPending = false;
        }
        window.addEventListener('scroll', function() {
            if (!rafPending) { rafPending = true; requestAnimationFrame(applyParallax); }
        }, { passive: true });
        applyParallax();
    })();

    // ── Custom Cursor ────────────────────────────────────────────────────
    const cursorDot  = document.querySelector('.cursor-dot');
    const cursorGlow = document.querySelector('.cursor-glow');
    if (cursorDot && cursorGlow) {
        let mouseX = 0, mouseY = 0, dotX = 0, dotY = 0, glowX = 0, glowY = 0;
        let lastTrailTime = 0;
        const MAX_TRAILS = 20;
        const trails = [];
        document.addEventListener('mousemove', function(e) {
            mouseX = e.clientX; mouseY = e.clientY;
            cursorDot.style.opacity  = '1';
            cursorGlow.style.opacity = '1';
            createTrail(mouseX, mouseY);
        });
        const lerp = (s, e, f) => s + (e - s) * f;
        function animateCursor() {
            dotX  = lerp(dotX,  mouseX, 0.6);
            dotY  = lerp(dotY,  mouseY, 0.6);
            glowX = lerp(glowX, mouseX, 0.15);
            glowY = lerp(glowY, mouseY, 0.15);
            cursorDot.style.left  = dotX  + 'px';
            cursorDot.style.top   = dotY  + 'px';
            cursorGlow.style.left = glowX + 'px';
            cursorGlow.style.top  = glowY + 'px';
            requestAnimationFrame(animateCursor);
        }
        animateCursor();
        function createTrail(x, y) {
            const now = performance.now();
            if (now - lastTrailTime < 15) return;
            lastTrailTime = now;
            const trail = document.createElement('div');
            trail.classList.add('cursor-trail');
            trail.style.left = x + 'px'; trail.style.top = y + 'px';
            trail.style.opacity = '0.25';
            trail.style.transform = 'translate(-50%, -50%) scale(1)';
            document.body.appendChild(trail);
            trails.push(trail);
            requestAnimationFrame(function() {
                trail.style.transition = 'opacity 2.8s ease-out, transform 2.8s ease-out';
                trail.style.opacity = '0';
                trail.style.transform = 'translate(-50%, -50%) scale(0.3)';
            });
            if (trails.length > MAX_TRAILS) {
                const old = trails.shift();
                if (old.parentNode) old.parentNode.removeChild(old);
            }
            setTimeout(function() {
                if (trail.parentNode) trail.parentNode.removeChild(trail);
                const i = trails.indexOf(trail);
                if (i > -1) trails.splice(i, 1);
            }, 2800);
        }
    }

    // ── Intersection Observer ────────────────────────────────────────────
    const observer = new IntersectionObserver(function(entries, obs) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('intro-section')) {
                    const h = entry.target.querySelector('.intro-heading');
                    const d = entry.target.querySelector('.intro-divider');
                    const p = entry.target.querySelector('.intro-paragraph');
                    if (h) h.classList.add('animate');
                    if (d) d.classList.add('animate');
                    if (p) p.classList.add('animate');
                    obs.unobserve(entry.target);
                }
                if (entry.target.classList.contains('map-section')) {
                    const mc = entry.target.querySelector('.map-container');
                    if (mc) mc.classList.add('animate');
                    entry.target.querySelectorAll('.map-pin').forEach(function(pin) { pin.classList.add('animate'); });
                    obs.unobserve(entry.target);
                }
                if (entry.target.classList.contains('projects-section')) {
                    const lr = entry.target.querySelector('.projects-label-container');
                    const hd = entry.target.querySelector('.projects-heading');
                    if (lr) lr.classList.add('animate');
                    if (hd) hd.classList.add('animate');
                    obs.unobserve(entry.target);
                }
                if (entry.target.classList.contains('about-section')) {
                    ['ab-eyebrow','ab-headline','ab-body','ab-cta','ab-divider','ab-stats'].forEach(function(id) {
                        const el = document.getElementById(id);
                        if (el) el.classList.add('animate');
                    });
                    obs.unobserve(entry.target);
                }
                if (entry.target.id === 'expertise') {
                    const lbl   = entry.target.querySelector('.expertise-label-container');
                    const hd    = entry.target.querySelector('.expertise-heading');
                    const cards = entry.target.querySelectorAll('.exp-card');
                    if (lbl) lbl.classList.add('animate');
                    if (hd)  hd.classList.add('animate');
                    cards.forEach(function(card) { card.classList.add('animate'); });
                    obs.unobserve(entry.target);
                }
            }
        });
    }, { root: null, rootMargin: '0px', threshold: 0.05 });

    ['intro', 'projects', 'world-map', 'about', 'expertise'].forEach(function(id) {
        const el = document.getElementById(id);
        if (el) observer.observe(el);
    });

    // 3s safety fallback — fires only if scroll observer hasn't triggered yet
    setTimeout(function() {
        document.querySelector('.map-container') && document.querySelector('.map-container').classList.add('animate');
        document.querySelectorAll('.map-pin').forEach(function(p) { p.classList.add('animate'); });
        ['.intro-heading','.intro-divider','.intro-paragraph','.projects-label-container','.projects-heading'].forEach(function(sel) {
            const el = document.querySelector(sel);
            if (el) el.classList.add('animate');
        });
        ['ab-eyebrow','ab-headline','ab-body','ab-cta','ab-divider','ab-stats'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) el.classList.add('animate');
        });
        const expLabel = document.getElementById('exp-label');
        const expHead  = document.getElementById('exp-heading');
        if (expLabel) expLabel.classList.add('animate');
        if (expHead)  expHead.classList.add('animate');
        document.querySelectorAll('.exp-card').forEach(function(c) { c.classList.add('animate'); });
    }, 3000);

    // ── Map Pins ─────────────────────────────────────────────────────────
    const projectsData = (typeof window.mikelData !== 'undefined' && window.mikelData.pins) ? window.mikelData.pins : [];
    const mapCtn  = document.getElementById('mapCtn');
    const tooltip = document.getElementById('mapTooltip');
    const ttCat   = document.getElementById('ttCat');
    const ttTitle = document.getElementById('ttTitle');
    const ttTags  = document.getElementById('ttTags');
    const ttDesc  = document.getElementById('ttDesc');
    const ttImage = document.getElementById('ttImage');
    let activeTooltipPin = null;

    if (mapCtn && projectsData.length) {
        projectsData.forEach(function(proj, idx) {
            const pin = document.createElement('div');
            pin.className = 'map-pin ' + proj.pinClass;
            pin.style.left  = proj.x + '%';
            pin.style.top   = proj.y + '%';
            pin.style.transitionDelay = (idx * 0.1) + 's';
            pin.dataset.id  = proj.id;
            pin.addEventListener('click', function(e) {
                e.stopPropagation();
                if (activeTooltipPin === proj.id) { closeTooltip(); return; }
                if (proj.image) {
                    ttImage.innerHTML = '<img src="' + proj.image + '" alt="' + proj.title + '">';
                } else {
                    ttImage.innerHTML = '<span class="tooltip-image-placeholder">Project Image</span>';
                }
                ttCat.textContent   = proj.category;
                ttTitle.textContent = proj.title;
                ttTags.innerHTML    = '<div class="tooltip-tag">' + proj.country + '</div>';
                ttDesc.textContent  = proj.desc;
                if (window.innerWidth > 768) {
                    tooltip.style.left = proj.x + '%';
                    tooltip.style.top  = proj.y + '%';
                }
                tooltip.classList.add('visible');
                activeTooltipPin = proj.id;
            });
            mapCtn.appendChild(pin);
        });
    }

    function closeTooltip() { tooltip.classList.remove('visible'); activeTooltipPin = null; }
    document.addEventListener('click', function(e) {
        if (!tooltip.contains(e.target) && !e.target.classList.contains('map-pin')) closeTooltip();
    });

    // ── Logo Carousel ────────────────────────────────────────────────────
    const logos = (typeof window.mikelData !== 'undefined' && window.mikelData.logos) ? window.mikelData.logos : [];
    const impl  = document.getElementById('impact-logos');
    const nav   = document.getElementById('impact-logos-nav');
    if (impl && logos.length) {
        let PER   = window.innerWidth <= 768 ? 2 : 4;
        let page  = 0;
        const pages = Math.ceil(logos.length / PER);
        function renderLogoPage() {
            const slice = logos.slice(page * PER, page * PER + PER);
            impl.innerHTML = slice.map(function(logo) {
                return logo.src
                    ? '<div class="impact-logo-item has-logo"><img src="' + logo.src + '" alt="' + logo.alt + '"></div>'
                    : '<div class="impact-logo-item"><span>Logo</span></div>';
            }).join('');
            if (logos.length > PER && nav) {
                nav.querySelector('.ic-counter').textContent = (page + 1) + ' / ' + pages;
                nav.querySelector('.ic-prev').disabled = page === 0;
                nav.querySelector('.ic-next').disabled = page === pages - 1;
            }
        }
        if (logos.length > PER && nav) {
            nav.style.display = 'flex';
            nav.querySelector('.ic-prev').addEventListener('click', function() { if (page > 0) { page--; renderLogoPage(); } });
            nav.querySelector('.ic-next').addEventListener('click', function() { if (page < pages - 1) { page++; renderLogoPage(); } });
        }
        renderLogoPage();
    }

    // ── Mobile Nav ───────────────────────────────────────────────────────────
    const hamburger     = document.querySelector('.nav-hamburger');
    const mobileNav     = document.querySelector('.mobile-nav');
    const mobileClose   = document.querySelector('.mobile-nav-close');
    if (hamburger && mobileNav) {
        hamburger.addEventListener('click', function() { mobileNav.classList.add('open'); });
        if (mobileClose) mobileClose.addEventListener('click', function() { mobileNav.classList.remove('open'); });
        mobileNav.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() { mobileNav.classList.remove('open'); });
        });
    }

})();
