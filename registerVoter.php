<?php

if (isset($_POST['submit'])) {
  require "connect.php";
  

  try {
      
      $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "firstname"   => $_POST['firstname'],
      "lastname"    => $_POST['lastname'],
      "dob"         => $_POST['dob'],
      "gender"      => $_POST['gender'],
      "hno"         => $_POST['hno'],
      "area"        => $_POST['area'],
      "town"        => $_POST['town'],
      "pc"          => $_POST['pc'],
      "state"       => $_POST['state'],
      "district"    => $_POST['district'],
	  "hno1"        => $_POST['hno1'],
      "area1"       => $_POST['area1'],
      "town1"       => $_POST['town1'],
      "pc1"         => $_POST['pc1'],
      "state1"      => $_POST['state1'],
      "district1"   => $_POST['district1'],
	  "email"       => $_POST['email'],
      "mobile"      => $_POST['mobile']
);

    $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "VoterDetails",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
            );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
     }
  catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
   <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

<form method="post">
        <h1 style="background-color:rgb(186, 205, 250);">Application for Inclusion of Name in Electoral Roll for First time Voter</h2>
    	<label for="firstname">First Name:</label>
    	<input type="text" name="firstname" id="firstname" required><br>
    	<label for="lastname">Last Name:</label>
    	<input type="text" name="lastname" id="lastname" required><br>
    	<label for="dob">Date of Birth (in DD/MM/YYYY format)(if known):</label>
    	<input type="text" name="dob" id="dob"><br>
    	<label for="gender">Gender of Applicant:</label>
    	<input type="text" name="gender" id="gender"><br>
    	<h1 style="background-color:rgb(186, 205, 250);">Current address where applicant is ordinarily resident</h1>
    	<label for="hno"> House No:</label>
    	<input type="text" name="hno" id=" hno "required><br>
        <label for="area">Street/Area/Locality:</label>
    	<input type="text" name="area" id="area" required><br>
        <label for="town">Town/Village:</label>
    	<input type="text" name="town" id="town" required><br>
        <label for="pc">Pin Code:</label>
    	<input type="text" name="pc" id="pc" required><br>
        <label for="state">State/UT:</label>
    	<input type="text" name="state" id="state" required><br>
        <label for="district">District:</label>
    	<input type="text" name="district" id="district" required><br>
        <h1 style="background-color:rgb(186, 205, 250);">Permanant address of applicant</h1>
    	<label for="hno1"> House No:</label>
    	<input type="text" name="hno1" id=" hno1"required><br>
        <label for="area1">Street/Area/Locality:</label>
    	<input type="text" name="area1" id="area1" required><br>
        <label for="town1">Town/Village:</label>
    	<input type="text" name="town1" id="town1" required><br>
        <label for="pc1">Pin Code:</label>
    	<input type="text" name="pc1" id="pc1" required><br>
        <label for="state1">State/UT:</label>
    	<input type="text" name="state1" id="state1" required><br>
        <label for="district1">District:</label>
    	<input type="text" name="district1" id="district1" required><br>
    	<! Draw a line here>
        <label for="email">Email id (optional):</label>
    	<input type="text" name="email" id="email"><br>
        <label for="mobile">Mobile No. (optional):</label>
    	<input type="text" name="mobile" id="mobile"><br>
        <p> Declaration</p>
        <input type="checkbox" name="vehicle1" value="Bike"> I hereby declare that to the best of knowledge and belief My name has not already been included in the electoral roll for this or any other assembly/ parliamentary constituency<br>
        <input type="submit" name="submit" value="Register">
</form>

    	<p> Upload your photograph</p>
<form action="upload.php" method="post" enctype="multipart/form-data">
    	Select image to upload:
      	<input type="file" name="fileToUpload" id="fileToUpload"><br>
    	<input type="submit" value="Upload Image" name="submit">
</form>


        <a href="index.php">Back to home</a>

    <?php require "footer.php"; ?>
