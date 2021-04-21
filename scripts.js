
//Script per aprire la modifica le varibili utente
var modifyIsOpen = false;
var normalView = document.getElementById("userDisplay");
var modifyView = document.getElementById("userModify");

function OpenModify() {
    if(modifyIsOpen){
        //chiudi schermata di modifica
        modifyView.setAttribute('style', 'display:none !important');
        modifyIsOpen = false;

        //apri schermata di base
        normalView.setAttribute('style', 'display:block !important');

    }else{
        //chiudi schermata di base
        normalView.setAttribute('style', 'display:none !important');

        //apri schermata di modifica
        modifyView.setAttribute('style', 'display:block !important');
        modifyIsOpen = true;
    }
}

//Script per login e registrazione
var LoginIsOpened = true;
var LoginForm = document.getElementById("LoginForm");
var RegisterForm = document.getElementById("RegisterForm");
var LoginButton = document.getElementById("LoginButton");
var RegisterButton = document.getElementById("RegisterButton");

function OpenLogin() {
    if (LoginIsOpened) {
        console.log("Login Form gia' aperto");
    } else {
        //chiude Register form
        RegisterForm.setAttribute('style', 'display:none !important');
        RegisterButton.setAttribute('style', 'background-color: #E1E1E1;');

        //apre Login form
        LoginForm.setAttribute('style', 'display:block !important');
        LoginButton.setAttribute('style', 'background-color: white;');

        console.log("Login Form aperto");
        LoginIsOpened = true;
    }
}

function OpenRegister() {
    if (LoginIsOpened) {
        //apre Login form
        LoginForm.setAttribute('style', 'display:none !important');
        LoginButton.setAttribute('style', 'background-color: #E1E1E1;');

        //chiude Register form
        RegisterForm.setAttribute('style', 'display:block !important');
        RegisterButton.setAttribute('style', 'background-color: white;');

        console.log("Login Form chiuso");
        LoginIsOpened = false;
    } else {
        console.log("Register Form gia' aperto");
    }
}


var opened = false;

//apre e chiude la finestra di login
function Form() {
    console.log("Form activated");
    if (opened) {
        document.getElementById("LoginWindow").style.display = "none";
        opened = false
    } else {
        document.getElementById("LoginWindow").style.display = "block";
        opened = true
    }
}

//blocca lo scroll quando viene aperta la finestra di login
window.onscroll = function () {
    if (opened) {
        window.scrollTo(0, 0);
    }
};

function atc(verso, containerID) {
    //console.log("Button clicked\nverso: " + verso + "\ncontainer: " + containerID);
    var container = document.getElementById(containerID);
    sideScroll(container, verso, 100, 1500, 1500);
}

function sideScroll(element, direction, speed, distance, step) {
    //console.log("sideScroll entered\nelement: " + element + "\ndirection: " + direction + "\nspeed: " + speed + "\ndistance: " + distance + "\nstep: " + step);
    scrollAmount = 0;
    var slideTimer = setInterval(function () {
        if (direction == 'LT') {
            element.scrollLeft -= step;
        } else {
            element.scrollLeft += step;
        }
        scrollAmount += step;
        if (scrollAmount >= distance) {
            window.clearInterval(slideTimer);
        }
    }, speed);
}
