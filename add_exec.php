<?php
	session_start();
	require("session_check.php");
	require("sql_con.php");
	$regno=$_SESSION['name'];
	$status=$_SESSION['status'];
	$club_id=$_SESSION['cid'];
	function randomPassword() 
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) 
		{
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}   
	$password= randomPassword();
	$name1=$_GET['name'];
	$email=$_GET['email'];
	$reg=$_GET['regno'];
	$gender=$_GET['sex'];
	$contact=$_GET['phone'];
	$dob=$_GET['dob'];
	$add=$_GET['add'];
	$department=$_GET['department'];
    $mysql_tb = 'club_'.$club_id.'_members';
     $mysql_tb1=$club_id.'_event_attendance';
      $mysql_tb2=$club_id.'_meeting_attendance';
  $up= mysqli_query($mysqli,"insert into $mysql_tb (name, email, gender, mobno, dob, address, regno, department) values ('$name1', '$email', '$gender', '$contact', '$dob', '$add', '$reg', '$department')") or die("error !Please try again");
$event= mysqli_query($mysqli,"insert into $mysql_tb1 (regno) values ('$reg')") or die("quer");
$meeting= mysqli_query($mysqli,"insert into $mysql_tb2 (regno) values ('$reg')") or die("quer");
$second=mysqli_query($mysqli,"INSERT INTO panel (reg_no,club_id, pass) VALUES ('$reg', '$club_id', '$password') ");
// $insert1=mysql_query("INSERT INTO panel (reg_no,club_id, pass) VALUES ('$reg', '', '$password') ");
  if($up && !$second  &&  $event && $meeting ) 
  {
  	$up1= mysqli_query($mysqli,"DELETE FROM `" . $mysql_tb . "` WHERE regno='$reg'");
  	$up1= mysqli_query($mysqli,"DELETE FROM `" . $mysql_tb1 . "` WHERE regno='$reg'");
    $up1= mysqli_query($mysqli,"DELETE FROM `" . $mysql_tb2 . "` WHERE regno='$reg'");

  } 
if($up && $second && $event && $meeting) 
  {
  	echo"<h4 class='paddl'>Member added successfully !</h4>";

  } 
?>
