document.addEventListener('DOMContentLoaded', function () {
    // Efek Interaktif pada Header
    const header = document.querySelector('.dashboard-header');
    if (header) {
        header.addEventListener('mousemove', function (e) {
            const rect = header.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            header.style.background = `radial-gradient(circle at ${x}px ${y}px, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2))`;
        });

        header.addEventListener('mouseleave', function () {
            header.style.background = 'rgba(255, 255, 255, 0.2)';
        });
    }

    // Efek Parallax pada Decorative Circles
    const circles = document.querySelectorAll('.decorative-circle');
    window.addEventListener('mousemove', function (e) {
        circles.forEach(circle => {
            const speed = circle.getAttribute('data-speed') || 0.05;
            const x = (window.innerWidth - e.pageX * speed) / 100;
            const y = (window.innerHeight - e.pageY * speed) / 100;
            circle.style.transform = `translate(${x}px, ${y}px)`;
        });
    });
});