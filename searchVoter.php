<?php

if (isset($_POST['submit'])) {
  require "connect.php";
  

  try {
      
      $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
FROM VoterDetails
WHERE firstname=:firstname && dob=:dob && gender=:gender && district=:district && state=:state";
$firstname   = $_POST['firstname'];
$dob         = $_POST['dob'];
$gender      = $_POST['gender'];
$district    = $_POST['district'];
$state       = $_POST['state'];
$statement = $connection->prepare($sql);
$statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$statement->bindParam(':dob', $dob, PDO::PARAM_STR);
$statement->bindParam(':gender', $gender, PDO::PARAM_STR);
$statement->bindParam(':district', $district, PDO::PARAM_STR);
$statement->bindParam(':state', $state, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();
}catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require  "header.php"; ?>
<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Date Of Birth</th>
  <th>Gender</th>
  <th>House No.</th>
  <th>Area</th>
  <th>Town</th>
  <th>Pin Code</th>
  <th>District</th>
  <th>State</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo $row["voterId"]; ?></td>
<td><?php echo $row["firstname"]; ?></td>
<td><?php echo $row["lastname"]; ?></td>
<td><?php echo $row["dob"]; ?></td>
<td><?php echo $row["gender"]; ?></td>
<td><?php echo $row["hno"]; ?></td>
<td><?php echo $row["area"]; ?> </td>
<td><?php echo $row["town"]; ?> </td>
<td><?php echo $row["pc"]; ?> </td>
<td><?php echo $row["district"]; ?> </td>
<td><?php echo $row["state"]; ?> </td>

      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    No results found for <?php echo $_POST['firstname']; ?>
  <?php }
} ?>
<form method="post">
    	<label for="firstname">First Name : </label>
    	<input type="text" id="firstname" name="firstname"><br>
    	<label for="lastname">Last Name : </label>
    	<input type="text" id="lastname" name="lastname"><br>
    	<label for="dob">Date of Birth : </label>
    	<input type="text" id="dob" name="dob"><br>
        <label for="gender">Gender : </label>
    	<input type="text" id="gender" name="gender"><br>
    	<label for="district">District : </label>
        <input type="text" id="district" name="district"><br>
        <label for="state">State : </label>
        <input type="text" id="state" name="state"><br>
        <input type="submit" name="submit" value="Search">
    </form>
<a href="index.php">Back to home</a>

    <?php include "footer.php"; ?>
