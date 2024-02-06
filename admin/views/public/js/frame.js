let btn=document.querySelector('#btn');
let navbar=document.querySelector('.nav-bar');
let bodyContainer=document.querySelector('body-container')

btn.onclick = function() {
    navbar.classList.toggle('active');
    bodyContainer.classList.toggle('active');

};


let userOptionBtn = document.querySelector("#userOptionBtn");
let blockUserOption = document.querySelector("#block__userOption");

userOptionBtn.onclick = function() {
    blockUserOption.classList.toggle('active_userOption');

}
