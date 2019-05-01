<?php
if (isset($_POST['submit'])) 
{
$target_dir ="uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if ($uploadOk) 
{
    require "connect.php";
  try
  {
      $connection = new PDO($dsn, $username, $password, $options);
      $firstname= $_POST['firstname'];
      $lastname= $_POST['lastname'];
      $dob=$_POST['dob'];
      $gender=$_POST['gender'];
      $hno=$_POST['hno'];
      $area=$_POST['area'];
      $town=$_POST['town'];
      $pc=$_POST['pc'];
      $state=$_POST['state'];
      $district=$_POST['district'];
	  $hno1=$_POST['hno1'];
      $area1=$_POST['area1'];
      $town1=$_POST['town1'];
      $pc1=$_POST['pc1'];
      $state1= $_POST['state1'];
      $district1=$_POST['district1'];
      $email=$_POST['email'];
      $mobile=$_POST['mobile'];
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

     
      $sql ="insert into VoterDetails(firstname,lastname,dob,gender,hno,area,town,pc,state,district,hno1,area1,town1,pc1,state1,district1,email,mobile,image) values('$firstname','$lastname','$dob','$gender','$hno','$area','$town','$pc','$state','$district','$hno1','$area1','$town1','$pc1','$state1','$district1','$email','$mobile','$target_file')";

      $statement = $connection->prepare($sql);
      $result=$statement->execute();
      if($result){
      echo "New voter is successfully registerered";}
   }
    catch(PDOException $error) {
    echo $error->getMessage();
  }

}
}

?>
<?php require "templates/header.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <script type='text/javascript' src='validations.js'></script>
</head>
<style>
body {
  font-family: Arial;
}
input[type=text], select {
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[list=state], select {
  width: 70%;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 70%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
div.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

input[type=submit]:hover {
  background-color: #45a049;
</style>
<body>
<?php require "templates/footer.php"; ?>
<div class="container">
    <form method="post" action="" id="form" onsubmit="return validate_all('results');" enctype="multipart/form-data">
    <p style="color: red;">Note :Fields marked with asterisk (*) are mandatory</p>
   <h1 style="background-color:rgb(186, 205, 250);
  outline-color: red;
  border-radius: 15px;
  padding: 15px 2px 30px 10px;
  width: 1200px;
  height: 15px;
  font-size: 25px;">Application for Inclusion of Name in Electoral Roll for First time Voter</h2>
    	<label for="firstname">First Name:*</label>
        <input type="text" name="firstname" id="firstname" maxlength="25" required><br>
    	<label for="lastname" style="font-size: 14px;line-height: 1.8">Last Name:</label>
    	<input type="text" name="lastname" id="lastname" maxlength="25" required><br>
    	<label for="dob">Date of Birth (in DD/MM/YYYY format):</label>
    	<input type="text" name="dob" id="dob"><br>
    	<label for="gender">Gender of Applicant:</label>
    	<input type="text" name="gender" id="gender"><br>
    	<h1 style="background-color:rgb(186, 205, 250);
  outline-color: red;
  border-radius: 15px;
  padding: 15px 2px 30px 10px;
  width: 1200px;
  height: 15px;
  font-size: 25px;">Current address where applicant is ordinarily resident</h1>
    	<label for="hno"> House No:</label>
    	<input type="text" name="hno" id=" hno "required><br>
        <label type="area">street/Area/Locality:</label>
        <input type="text" name="area" id="area"required><br>
        <label for="town">Town/Village:</label>
    	<input type="text" name="town" id="town" required><br>
        <label for="pc">Pin Code:</label>
    	<input type="text" name="pc" id="pc" required><br>
        <label for="state">State/UT:</label>
    	<input type="text" list="state" name="state">
  <datalist id="state">
<option value="Andaman and Nicobar Islands">
<option value="Andhra Pradesh">
<option value="Arunachal Pradesh">
<option value="Assam">
<option value="Bihar">
<option value="Chandigarh">
<option value="Chhattisgarh">
<option value="Dadra and Nagar Haveli">
<option value="Daman and Diu">
<option value="Delhi">
<option value="Goa">
<option value="Gujarat">
<option value="Haryana">
<option value="Himachal Pradesh">
<option value="Jammu and Kashmir">
<option value="Jharkhand">
<option value="Karnataka">
<option value="Kerala">
<option value="Lakshadweep">
<option value="Madhya Pradesh"> 
<option value="Maharashtra">
<option value="Manipur">
<option value="Meghalaya">
<option value="Mizoram">
<option value="Nagaland">
<option value="Orissa">
<option value="Pondicherry">
<option value="Punjab">
<option value="Rajasthan">
<option value="Sikkim">
<option value="Tamil Nadu"> 
<option value="Telangana"> 
<option value="Tripura">
<option value="Uttaranchal">
<option value="Uttar Pradesh"> 
<option value="West Bengal"> 
  </datalist><br>
        <label for="district">District:</label>
    	<input type="text" name="district" id="district" required><br>
        <h1 style="background-color:rgb(186, 205, 250);
  outline-color: red;
  border-radius: 15px;
padding: 15px 2px 30px 10px;
  width: 1200px;
  height: 15px;
  font-size: 25px;">Permanant address of applicant</h1>
    	<label for="hno1"> House No:</label>
    	<input type="text" name="hno1" id=" hno1"required><br>
        <label for="area1">Street/Area/Locality:</label>
    	<input type="text" name="area1" id="area1" required><br>
        <label for="town1">Town/Village:</label>
    	<input type="text" name="town1" id="town1" required><br>
        <label for="pc1">Pin Code:</label>
    	<input type="text" name="pc1" id="pc1" required><br>
        <label for="state1">State/UT:</label>
    	<input type="text" list="state1" name="state1">
  <datalist id="state1">
<option value="Andaman and Nicobar Islands">
<option value="Andhra Pradesh">
<option value="Arunachal Pradesh">
<option value="Assam">
<option value="Bihar">
<option value="Chandigarh">
<option value="Chhattisgarh">
<option value="Dadra and Nagar Haveli">
<option value="Daman and Diu">
<option value="Delhi">
<option value="Goa">
<option value="Gujarat">
<option value="Haryana">
<option value="Himachal Pradesh">
<option value="Jammu and Kashmir">
<option value="Jharkhand">
<option value="Karnataka">
<option value="Kerala">
<option value="Lakshadweep">
<option value="Madhya Pradesh"> 
<option value="Maharashtra">
<option value="Manipur">
<option value="Meghalaya">
<option value="Mizoram">
<option value="Nagaland">
<option value="Orissa">
<option value="Pondicherry">
<option value="Punjab">
<option value="Rajasthan">
<option value="Sikkim">
<option value="Tamil Nadu"> 
<option value="Telangana"> 
<option value="Tripura">
<option value="Uttaranchal">
<option value="Uttar Pradesh"> 
<option value="West Bengal"> 
  </datalist><br>
        <label for="district1">District:</label>
    	<input type="text" name="district1" id="district1" required><br>
    	<! Draw a line here>
        <label for="email">Email id (optional):</label>
    	<input type="text" name="email" id="email"><br>
        <label for="mobile">Mobile No. (optional):</label>
    	<input type="text" name="mobile" id="mobile"><br> 
        <p style="background-color:rgb(186, 205, 250);
  outline-color: red;
  border-radius: 15px;
padding: 15px 2px 30px 10px;
  width: 1200px;
  height: 15px;
  font-size: 25px;"> Upload Supporting Document (Supported formats .jpg,.png,.jpeg)(max. 2MB)</p>
    	 	Select image to upload:
      	<input type="file" name="fileToUpload" id="fileToUpload"><br>
        <p style="background-color:rgb(186, 205, 250);
  outline-color: red;
  border-radius: 15px;
padding: 15px 2px 30px 10px;
  width: 1200px;
  height: 15px;
  font-size: 25px;"> Declaration</p>
        <input type="checkbox" name="declare" value="declare"> I hereby declare that to the best of knowledge and belief My name has not already been included in the electoral roll for this or any other assembly/ parliamentary constituency<br>
        <input type="submit" name="submit" value="Register"><br>
        <h3 id="results"></h3>
</form>
</div>
</body>
</html>
 <a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>
