var homeButton = document.getElementById('home__button');
var productButton = document.getElementById('product__button');
var contactButton = document.getElementById('contact__button');
var loginButton = document.getElementById('login__button');
var buttonRegister = document.getElementById('button__signOn');
var buttonCancel = document.getElementById('button__cancel');

var buttonProductNavPrevious = document.getElementById('btn-nav__previous');
var buttonProductNavNext = document.getElementById('btn-nav__next');
var ProductNavPosition = 0;

var productVisa = document.getElementById('productVisa');
var productMaster = document.getElementById('productMaster');
var productAccount = document.getElementById('productAccount');

var homeMain = document.getElementById('homeSection');
var productMain = document.getElementById('productSection');
var contactMain = document.getElementById('contactSection');
var loginMain = document.getElementById('loginSection');
var signInBox = document.getElementById('signin')
var signOnBox = document.getElementById('signon');

buttonProductNavNext.addEventListener('click', function () {
    toggleProduct(buttonProductNavNext);
});

buttonProductNavPrevious.addEventListener('click', function () {
    toggleProduct(buttonProductNavPrevious);
});

function toggleProduct(element) {
    if (element == buttonProductNavNext){
        ProductNavPosition++;
    } else {
        ProductNavPosition--;
    }
    if (ProductNavPosition < 0) {
        ProductNavPosition = 2;
    }
    if (ProductNavPosition > 2) {
        ProductNavPosition = 0;
    }
    console.log(ProductNavPosition);
    switch (ProductNavPosition) {
        case 0:
            productVisa.style.display = 'none';
            productMaster.style.display = 'none';
            productAccount.style.display = 'none';
            productAccount.style.display = 'block';
            break;
        case 1:
            productVisa.style.display = 'none';
            productMaster.style.display = 'none';
            productAccount.style.display = 'none';
            productVisa.style.display = 'flex';
            break;
        case 2:
            productVisa.style.display = 'none';
            productMaster.style.display = 'none';
            productAccount.style.display = 'none';
            productMaster.style.display = 'flex';
            break;
    }
}

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
loginButton.addEventListener('click', function () {
    toogle(loginMain);
});

function toogle(element) {
    this.homeMain.style.display = "none";
    this.productMain.style.display = "none";
    this.contactMain.style.display = "none";
    this.loginMain.style.display = "none";
    element.style.display = "block"
}

function toogleSignOn() {
    this.signInBox.style.display = "none";
    this.signOnBox.style.display = "flex";
}

function toogleSignIn() {
    this.signInBox.style.display = "flex";
    this.signOnBox.style.display = "none";
}
