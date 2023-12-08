document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.header');
    const contentBelowHeader = document.querySelector('.content-below-header');
    let isScrolling = false;

    // Funksioni qe e bon update padding te klases .content-below-header
    function updateContentPadding() {
        const newPaddingTop = header.offsetHeight;

        
        if (window.scrollY > 50 && !header.classList.contains('header-smaller')) {
            header.classList.add('header-smaller');
        } else if (window.scrollY <= 50 && header.classList.contains('header-smaller')) {
            header.classList.remove('header-smaller');
        }

        // Vendoset padding-top i .content-below-header duhet mar parasysh "height" te header
        contentBelowHeader.style.paddingTop = `${newPaddingTop}px`;
    }

    // Thirret funksioni kur faqja behet reload ose kur faqja (window) behet "resized".
    window.addEventListener('load', updateContentPadding);
    window.addEventListener('resize', updateContentPadding);

    // Event listener per scroll event tu e perdor requestAnimationFrame = testing phase
    window.addEventListener('scroll', function () {
        if (!isScrolling) {
            window.requestAnimationFrame(function () {
                updateContentPadding();
                isScrolling = false;
            });
            isScrolling = true;
        }
    });

});




    // Test per slide
const moreButton = document.getElementById('more-button');
const morePanel = document.getElementById('more-panel');
const closeButton = document.getElementById('close-button');

moreButton.addEventListener('click', function () {
    morePanel.style.right = '0';
});

closeButton.addEventListener('click', function () {
    morePanel.style.right = '-350px';
});

// Test per scroll on click
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
    });
});

// Test per login form
function openLoginForm() {
    var modal = document.getElementById('loginModal');
    modal.style.display = 'block';
}

function closeLoginForm() {
    var modal = document.getElementById('loginModal');
    modal.style.display = 'none';
}

// Funksioni qe e mbyll popup-in nese useri klikon jasht formes
window.onclick = function (event) {
    var modal = document.getElementById('loginModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

// Finksioni qe e shfaq register formen
function showRegisterForm() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');

    // Hide the login form
    loginForm.style.display = 'none';

    // Show the register form
    registerForm.style.display = 'block';
}

// Funksioni qe e mbyll register formen edhe e shfaq login formen
function closeRegisterForm() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');

    // Mbyllet register forma
    registerForm.style.display = 'none';

    // Shfaqet login forma
    loginForm.style.display = 'block';
}
//SLIDESHOW TEST

var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1
    }
    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 2000); // Ndryshimi i slide 
}


//Per reservation popup
function toggleReservationForm() {
    var popup = document.getElementById("reservationPopup");
    popup.style.display = (popup.style.display === "none" || popup.style.display === "") ? "block" : "none";
}

