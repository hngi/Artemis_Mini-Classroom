function myStudents(class_id){
  let modal = document.querySelector('#enroled-students-modal-window')
  
  if (class_id == "") {
      // document.getElementById("modal-content").innerHTML = "";
      return;
  } else {
      if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
      } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        console.log(this.status)
          if (this.readyState == 4 && this.status == 200) {
            let response = this.response
            enroledStudents(response, modal)
          
          }
      };
      xmlhttp.open("GET","./functions/list_students.php?class_id="+class_id,true);
      xmlhttp.send();
  }
  
}


function enroledStudents(response, modal){
  let students = ''
  let my_students = document.querySelector('.my-students')
  let parser = new DOMParser()
  let xmlDoc = parser.parseFromString(response,"text/html");
  let student = xmlDoc.getElementsByTagName('LI')
  for(let i = 0; i<student.length; i++){
  
    students += student[i].childNodes[0].nodeValue + "<br>"
  }
  my_students.innerHTML = students
  modal.style.display = 'block'
}


function closeModal(){
  let modal = document.querySelector('#enroled-students-modal-window')
  modal.style.display='none'
}