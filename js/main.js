document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50 && !header.classList.contains('header-smaller')) {
            header.classList.add('header-smaller');
        } else if (window.scrollY <= 50 && header.classList.contains('header-smaller')) {
            header.classList.remove('header-smaller');
        }
    });
});