<?php

// *******************************Authentication Using simple PHP*******************************
// $connect = mysqli_connect("localhost", "root", "", "adminpanel") or die("Connection Failed");
// if (isset($_REQUEST['save'])) {
// 	$username = $_REQUEST['username'];
// 	$password = $_REQUEST['userpass'];
// 	$query = "select * from login where username = '$username' and password = '$password'";
// 	$result = mysqli_query($connect, $query);
// 	$count = mysqli_num_rows($result);
// 	if ($count > 0) {
// 		header("Location: pagesummary.php");
// 	} else {
// 		echo "Login Failed";
// 	}
// }

// **************************Authentication using Classes and function************************** 
include("classFunction.php");
$ob = new adminPanel();
if (isset($_REQUEST['save'])) {
	$ob->auth();
}

?>



<html>

<head>
	<title>Admin panel</title>
	<link rel="stylesheet" href="css/mybootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/color.css">
	<style>
	</style>
</head>

<body>

	<header class="col-md-12">
		<div class="container">
			<div class="col-md-3">
				<image src="images/logo.png" style="margin:15px 0px 5px 0px; float:left">
			</div>
			<div class="col-md-9"></div>
		</div>
	</header>
	<div class="col-md-12" style="background:#1C5978">
		<div class="container">
			<div class="col-md-3">
				<p style="color:white; font-weight:bold; font-family:arial; font-size:12px; margin:7px 0px; float:left; letter-spacing:1; word-spacing:3"><?php echo date('l, d-m-y') ?></p>
			</div>
		</div>
	</div>
	<div class="col-md-12" style="height:70%; min-height:200px">
		<div class="container">
			<form method="post">
				<table class="table" style="width:150px; margin:40px auto">
					<tr>
						<td></td>
						<td style="color:#1C5978; font-weight:bold; text-align:center">Login</td>
					</tr>
					<tr>
						<td class="login-table-text">Username</td>
						<td><input type="text" name="username" class="login-table-input" required></td>
					</tr>
					<tr style="border:none">
						<td class="login-table-text">Password</td>
						<td><input type="password" name="userpass" class="login-table-input" style="font-size:30px;height:25px" required></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" style="margin-left:60px; padding:2px 15px" value="Login" name="save"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<footer style="clear:both">
		<div class="footer-line col-md-12"></div>
	</footer>
</body>

</html>