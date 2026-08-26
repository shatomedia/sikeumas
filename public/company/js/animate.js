document.addEventListener("DOMContentLoaded", function () {
    // Scroll-reveal
    var revealEls = document.querySelectorAll(".reveal");
    if ("IntersectionObserver" in window && revealEls.length) {
        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("in-view");
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.15 }
        );
        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        revealEls.forEach(function (el) {
            el.classList.add("in-view");
        });
    }

    // Animated number counters (data-target="10000" data-suffix="+")
    var counters = document.querySelectorAll("[data-counter]");
    if (counters.length) {
        var counterObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    counterObserver.unobserve(entry.target);
                    var el = entry.target;
                    var target = parseInt(el.getAttribute("data-counter"), 10) || 0;
                    var suffix = el.getAttribute("data-suffix") || "";
                    var duration = 1400;
                    var start = performance.now();
                    function tick(now) {
                        var progress = Math.min((now - start) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3);
                        var value = Math.floor(eased * target);
                        el.textContent = value.toLocaleString("id-ID") + suffix;
                        if (progress < 1) requestAnimationFrame(tick);
                    }
                    requestAnimationFrame(tick);
                });
            },
            { threshold: 0.4 }
        );
        counters.forEach(function (el) {
            counterObserver.observe(el);
        });
    }

    // Hero slideshow (auto-rotate + dot navigation)
    var slideshow = document.getElementById("hero-slideshow");
    if (slideshow) {
        var slides = slideshow.querySelectorAll(".hero-slide");
        var dots = slideshow.querySelectorAll(".hero-dot");
        var current = 0;
        var slideTimer;

        function goToSlide(index) {
            slides[current].classList.remove("active");
            dots[current].classList.remove("active");
            current = index;
            slides[current].classList.add("active");
            dots[current].classList.add("active");
        }

        function nextSlide() {
            goToSlide((current + 1) % slides.length);
        }

        function startAutoplay() {
            slideTimer = setInterval(nextSlide, 4000);
        }

        function stopAutoplay() {
            clearInterval(slideTimer);
        }

        dots.forEach(function (dot, index) {
            dot.addEventListener("click", function () {
                stopAutoplay();
                goToSlide(index);
                startAutoplay();
            });
        });

        slideshow.addEventListener("mouseenter", stopAutoplay);
        slideshow.addEventListener("mouseleave", startAutoplay);

        startAutoplay();
    }

    // Live clock badge on the hero image
    var clockEl = document.getElementById("hero-live-clock-time");
    if (clockEl) {
        function updateClock() {
            var now = new Date();
            var h = String(now.getHours()).padStart(2, "0");
            var m = String(now.getMinutes()).padStart(2, "0");
            var s = String(now.getSeconds()).padStart(2, "0");
            clockEl.textContent = h + ":" + m + ":" + s;
        }
        updateClock();
        setInterval(updateClock, 1000);
    }
});
