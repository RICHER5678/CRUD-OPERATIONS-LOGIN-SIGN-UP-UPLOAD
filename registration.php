<?php
// create a table studentdetails   
CREATE TABLE  studentdetails 
(
  id int(11) NOT NULL AUTO_INCREMENT,
  name char(50) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(50) NOT NULL,
  mobile bigint(20) NOT NULL,
  gender enum('m','f') NOT NULL,
  hobbies varchar(100) NOT NULL,
  dob date NOT NULL,
  address text NOT NULL,
  profilePic varchar(255) NOT NULL,
  registrationDate datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email);
)


?>

<?php
//connectivity
$con=mysql_connect("localhost","root","") or die("not connected");
//select database
mysql_select_db("student",$con);

extract($_POST);
if(isset($save))
{
//for date of birt get one by one and concatente
$dob=$yy."-".$mm."--".$dd;
//hobbies retrieve in an array format change array into string 
$h=implode(",",$hobb);
$img=$_FILES['pic']['name'];

//To check user already exists or not
$sql=mysql_query("select email from studentdetails where email='$e'");
$return=mysql_num_rows($sql);
//if $return returns true value it means user's email already exists
if($return)
{
$msg="<font color='red'>".ucfirst($e)."already exists choose another email</font>";
}
else
{
$query="insert into studentdetails values('','$n','$e','$p','$m','$g','$h','$dob','$add','$img',now())";
mysql_query($query);
$msg= "<font color='blue'>Your data saved</font>";
}
}
?>

<!DOCTYPE html>
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registration Form</title>
<style>
input,textarea{width:200px}
input[type=radio],input[type=checkbox]{width:10px}
input[type=submit],input[type=reset]{width:100px}
</style>
</head>

<body>
<form method="post" enctype="multipart/form-data">
<table width="393" border="1">
 <tr>
 	<td colspan="2"><?php echo @$msg; ?></td>
 </tr>
  <tr>
    <td width="159">Enter your Name</td>
    <td width="218">
	<input type="text" placeholder="your first name"  name="n" pattern="[a-z A-Z]*" required /></td>
  </tr>
  <tr>
    <td>Enter your Email</td>
    <td><input type="email" name="e"/></td>
  </tr>
  <tr>
    <td>Enter your Password</td>
    <td><input type="password" name="p"/></td>
  </tr>
  <tr>
    <td>Enter your Address</td>
    <td><textarea name="add"></textarea></td>
  </tr>
  <tr>
    <td>Enter your Mobile</td>
    <td><input type="text" pattern="[0-9]*" name="m" /></td>
  </tr>
  <tr>
    <td height="23">Select your Gender</td>
    <td>
	Male<input type="radio" name="g" value="m"/>
	Female<input type="radio" name="g" value="f"/>
	</td>
  </tr>
  <tr>
    <td>Choose your Hobbies</td>
    <td>
		Cricket<input type="checkbox" value="cricket" name="hobb[]"/>
		Singing<input type="checkbox" value="singing" name="hobb[]"/>
		Dancing<input type="checkbox" value="dancing" name="hobb[]"/>
	</td>
  </tr>
  <tr>
    <td>Choose your Profile Pic </td>
    <td><input type="file" name="pic"/></td>
  </tr>
  <tr>
    <td>Select your DOB</td>
    <td>
		<select name="mm">
			<option value="">Month</option>
			<?php 
			for($i=1;$i<=12;$i++)
			{
			echo "<option value='$i'>".$i."</option>";
			}
			?>
		</select>
		<select name="dd">
			<option value="">Date</option>
			<?php 
			for($i=1;$i<=31;$i++)
			{
			echo "<option value='$i'>".$i."</option>";
			}
			?>
		</select>
		<select name="yy">
			<option value="">Year</option>
			<?php 
			for($i=1900;$i<=2015;$i++)
			{
			echo "<option value='$i'>".$i."</option>";
			}
			?>
		</select>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	<input type="submit" name="save" value="Register Me"/>
	<input type="reset" value="Reset"/>
	</td>
  </tr>
</table>
</form>
</body>
</html>