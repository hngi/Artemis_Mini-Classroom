<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "mini-classroom";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }


function classrecord($class_name,$class_description,$teachers_id)
{
$dbconnections=Opencon();
$sql = "INSERT INTO classes (class_name, class_desc,teacher_id)
VALUES ('$class_name','$class_description','$teachers_id')";

if ($dbconnections->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $dbconnections->error;
}

$dbconnections->close();
}

classrecord("gold", "excel", 17);


/*

class classRoom;
	
function courseRegister();

}
import table from tablefile;
let course =tablename.create(course, function ());

writeMsg(); // call the function
}
{
	if (error)
}

?>*/