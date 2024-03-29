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
document.addEventListener('DOMContentLoaded', function () {
    changeImg();
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



//Validimi i Register form
function validimi(){
    var nameRegex = /^[A-Za-z\s]+$/;
    var nameInput = document.getElementById('firstName').value;
    var nameError = document.getElementById('nameError');
    nameError.innerHTML = '';

    if(!nameRegex.test(nameInput)){
        nameError.innerHTML = 'Error: Name must start with a capital letter';
    }

    var lastnameRegex = /^[A-Za-z\s]+$/;
    var lastnameInput = document.getElementById('lastName').value;
    var lastnameError = document.getElementById('lastnameError');
    lastnameError.innerHTML = '';

    if(!lastnameRegex.test(lastnameInput)){
        lastnameError.innerHTML = 'Error: Name must start with a capital letter';
    }

    var emailRegex = /[a-zA-Z.-_\s@]+@+[a-z\s@]+\.+[a-z\s@]{2,3}$/;
    var emailInput = document.getElementById('email').value;
    var emailError = document.getElementById('emailError');
    emailError.innerHTML = ''

    if(!emailRegex.test(emailInput)){
        emailError.innerHTML = 'Error: Forma e email eshte invalide';
    }

    var passwordInput = document.getElementById('registerPassword').value;
    var passwordError = document.getElementById('passwordError');
    passwordError.innerHTML = ''

    if(passwordInput.length < 6){
        passwordError.innerHTML = 'Password must contains more than 6 characters';
    }

    var confirmpasswordInput = document.getElementById('confirmPassword').value;
    var confirmpasswordError = document.getElementById('confirmpasswordError');
    confirmpasswordError.innerHTML = ''

    if(passwordInput !== confirmpasswordInput){
        confirmpasswordError.innerHTML = 'Password do not match!';
    }

}
function performRegister(){
    validimi();
}

//Validimi per log in form
function validateLoginForm() {
    var usernameRegex = /^[a-zA-Z][a-zA-Z0-9]{3,15}$/; 
    //Pershkrimi i Regex:
    //^[a-zA-Z]: Follon me nje shkronje (qofte e madhe ose e vogel).
    //[a-zA-Z0-9]{3,15}$: Vazhdon me 3 deri ne 15 shkronja (te mdhaja ose te vogla) ose numra.
    var usernameInput = document.getElementById('username').value;
    
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,24}$/;
    //Pershkrimi i Regex:
    //^(?=.*[a-z]): Passwordi duhet te permbaj te pakten 1 shkronje te vogel
    //(?=.*[A-Z]): Passwordi duhet te permbaj te pakten 1 shkronje te madhe
    //(?=.*\d): Passwordi duhet te permbaj te pakten 1 numer
    //(?=.*[!@#$%^&*]): Passwordi duhet te permbaj te pakten 1 "special character" (!@#$%^&*)
    //[A-Za-z\d!@#$%^&*]{8,24}$: Passwordi duhet te permbaje 8 deri ne 24 karaktere (shkronja te vogla, shkronja te mdhaja, numra ose "special characters".
    var passwordInput = document.getElementById('password').value;

    var usernameError = document.getElementById('usernameError');
    var passwordError = document.getElementById('passwordError');

    // Error mesazhet
    usernameError.innerHTML = '';
    passwordError.innerHTML = '';

    // Per username
    if (!usernameRegex.test(usernameInput)) {
        usernameError.innerHTML = 'Error: Invalid username';
    }

    // Per password
    if (!passwordRegex.test(passwordInput)) {
        passwordError.innerHTML = 'Error: Invalid password';
    }
}

// Event listener qe e "aktivizon" validimin e username edhe password kur te klikohet buttoni.
document.getElementById('loginButton').addEventListener('click', validateLoginForm);
