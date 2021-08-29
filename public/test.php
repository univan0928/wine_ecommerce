<?php
try{
	$conn = mysqli_connect('localhost', 'root', 'Master123!@#', 'wine');
	$result = mysqli_query($conn, "select * from migrations");
	print_r($result);
}
catch(Exception $e){
	print_r($e);
}
