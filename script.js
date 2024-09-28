const hamburger = document.querySelector('#toggle-btn');

hamburger.addEventListener('#click',function(){
    document.querySelector("#sidebar").classList.toggle("expand");
});
var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
};