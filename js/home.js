document.addEventListener("DOMContentLoaded", function () {
    const animatedElements = document.querySelectorAll('.animate-content');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__fadeInUp');
                // Stop observing after animation applied (optional)
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1 // Trigger when 10% of element is visible
    });

    animatedElements.forEach(el => {
        observer.observe(el);
    });
});
