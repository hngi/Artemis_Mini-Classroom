const navIcon = document.querySelector("#arrow")
const navMenu = document.querySelector("#nav-menu")
const dash = document.querySelector(".dash-profile")

var showNav;
navIcon.addEventListener('click', () => {
    if (showNav) {
        navMenu.style.display = "none";
        // dash.style.right = "121px"
        showNav = false;
    } else {
        navMenu.style.display = "block"
            // dash.style.right = "95px"
        showNav = true;
    }

})
var showSB = true;


function showMenu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}




const moduleToggler = document.querySelectorAll("#modules > li span")
const moduleContent = document.querySelectorAll("#modules > ul")
console.log(moduleToggler)
console.log(moduleContent)
Array.from(moduleToggler).forEach((item)=>{
    item.addEventListener('click', (e)=>{
        moduleContent.classList.toggle('.displayed')
        console.log(item.classList)
    });
})