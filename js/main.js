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



//testin - Azemi
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('cardContainer');
    let isMouseDown = false;
    let startX;
    let scrollLeft;

    container.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('mouseleave', () => {
        isMouseDown = false;
    });

    container.addEventListener('mouseup', () => {
        isMouseDown = false;
    });

    container.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 2;
        container.scrollLeft = scrollLeft - walk;
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('Quality');
    let isMouseDown = false;
    let startX;
    let scrollLeft;

    container.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('mouseleave', () => {
        isMouseDown = false;
    });

    container.addEventListener('mouseup', () => {
        isMouseDown = false;
    });

    container.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 2;
        container.scrollLeft = scrollLeft - walk;
    });
});

let i = 0;
let imgArray = ['img/OurDecor1.jpg','img/OurDecor2.jpg','img/OurDecor3.jpg'];

function changeImg(){
    document.getElementById('slideshow').src = imgArray[i];

    if(i< imgArray.length -1){
        i++;
    }
    else{
        i=0;
    }
    setTimeout("changeImg()", 2600);
}
document.addEventListener(onload, changeImg());


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

