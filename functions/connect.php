<?php
	function con_str()
	{
		$c = mysqli_connect("localhost","root","","artemis");
		return $c;
	}
?>