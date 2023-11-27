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

// Test per slide
document.addEventListener('DOMContentLoaded', function () {
    const moreButton = document.getElementById('more-button');
    const morePanel = document.getElementById('more-panel');
    const closeButton = document.getElementById('close-button');

    moreButton.addEventListener('click', function () {
        morePanel.style.right = '0';
    });

    closeButton.addEventListener('click', function () {
        morePanel.style.right = '-350px';
    });
});
