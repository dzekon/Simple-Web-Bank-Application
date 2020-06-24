var homeButton = document.getElementById('home__button');
var productButton = document.getElementById('product__button');
var contactButton = document.getElementById('contact__button');
var helpButton = document.getElementById('help__button');
var loginButton = document.getElementById('login__button');
// var registerButton = document.getElementById('register__button');
var buttonRegister = document.getElementById('button__signOn');
var buttonCancel = document.getElementById('button__cancel');

var homeMain = document.getElementById('div_1');
var productMain = document.getElementById('div_2');
var contactMain = document.getElementById('div_3');
var helpMain = document.getElementById('div_4');
var loginMain = document.getElementById('div_5');
var signInBox = document.getElementById('signin')
var signOnBox = document.getElementById('signon');

if (signInBox != null){
buttonRegister.addEventListener('click', function () {
    toogleSignOn();
})
}
if (signOnBox != null){
buttonCancel.addEventListener('click', function () {
    toogleSignIn();
})
}

homeButton.addEventListener('click', function () {
    toogle(homeMain);
});
productButton.addEventListener('click', function () {
    toogle(productMain);
});
contactButton.addEventListener('click', function () {
    toogle(contactMain);
});
helpButton.addEventListener('click', function () {
    toogle(helpMain);
});
loginButton.addEventListener('click', function () {
    toogle(loginMain);
});
// registerButton.addEventListener('click', function () {
//     toogle(loginMain);
// });

function toogle(element) {
    this.homeMain.style.display = "none";
    this.productMain.style.display = "none";
    this.contactMain.style.display = "none";
    this.helpMain.style.display = "none";
    this.loginMain.style.display = "none";
    element.style.display = "block"
}

function toogleSignOn() {
    this.signInBox.style.display = "none";
    this.signOnBox.style.display = "block";
}

function toogleSignIn() {
    this.signInBox.style.display = "flex";
    this.signOnBox.style.display = "none";
}
