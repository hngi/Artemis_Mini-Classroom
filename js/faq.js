

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active1");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

document.getElementById("getting-started").style.borderBottom= "3px solid rgb(255, 0, 0)";


document.getElementById("teachers").addEventListener("click", function(){
    document.getElementById("teacher-faq").style.display= "block";
    document.getElementById("getting-started-faq").style.display= "none";
    document.getElementById("student-faq").style.display= "none";
    document.getElementById("getting-started").style.borderBottom= "none";
    document.getElementById("students").style.borderBottom= "none";
    document.getElementById("teachers").style.borderBottom= "3px solid rgb(255, 0, 0)";
})

document.getElementById("students").addEventListener("click", function(){
    document.getElementById("student-faq").style.display= "block";
    document.getElementById("getting-started-faq").style.display= "none";
    document.getElementById("teacher-faq").style.display= "none";
    document.getElementById("teachers").style.borderBottom= "none";
    document.getElementById("getting-started").style.borderBottom= "none";
    document.getElementById("students").style.borderBottom= "3px solid rgb(255, 0, 0)";
})

document.getElementById("getting-started").addEventListener("click", function(){
    document.getElementById("student-faq").style.display= "none";
    document.getElementById("getting-started-faq").style.display= "block";
    document.getElementById("teacher-faq").style.display= "none";
    document.getElementById("teachers").style.borderBottom= "none";
    document.getElementById("getting-started").style.borderBottom= "3px solid rgb(255, 0, 0)";
    document.getElementById("students").style.borderBottom= "none";
})