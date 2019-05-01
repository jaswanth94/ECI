<?php

if (isset($_POST['submit'])) {
  require "connect.php";
  

  try {
      
      $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
FROM VoterDetails
WHERE firstname=:firstname && lastname=:lastname && dob=:dob && district=:district";
$firstname   = $_POST['firstname'];
$lastname    = $_POST['lastname'];
$dob         = $_POST['dob'];
$district    = $_POST['district'];
$statement = $connection->prepare($sql);
$statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$statement->bindParam(':dob', $dob, PDO::PARAM_STR);
$statement->bindParam(':district', $district, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();
}catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require  "templates/header.php"; ?>

<!DOCTYPE html>
<html>
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
<div class="container">
<form method="post">
    	<label for="firstname">First Name : </label>
    	<input type="text" id="firstname" name="firstname"><br>
    	<label for="lastname">Last Name : </label>
    	<input type="text" id="lastname" name="lastname"><br>
    	<label for="dob">Date of Birth : </label>
    	<input type="text" id="dob" name="dob"><br>
        <label for="district">District : </label>
        <input type="text" id="district" name="district"><br>
        <input type="submit" name="submit" value="Search">
    </form>
<a href="index.php">Back to home</a>
</body>
</div>
</html>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}
th {
  height: 35px;
}
th, td {
  padding: 8px;
  text-align: left;
}
table, td, th {
  border-bottom: 2px solid black;
}
tr:nth-child(even) {background-color: #f2f2f2;}
</style>
</head>
<body>
<form method="get" action="download.php"
<div style="overflow-x:auto;">   
    <table>
      <thead>
<tr>
  <th>Voter ID</th>
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
  <th>Image</th>
  <th> </th>
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
<td><?php echo $row["image"]; ?></td>
<td>
    <form action="download.php" method="get">
<input type="hidden" name="firstname" value="<?php echo $row["firstname"]; ?>">
<input type="hidden" name="lastname" value="<?php echo $row["lastname"]; ?>">
<input type="hidden" name="gender" value="<?php echo $row["gender"]; ?>">
<input type="hidden" name="dob" value="<?php echo $row["dob"]; ?>">
<input type="submit" name="submit" value="Print Voter ID">
</td>
</form>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    No results found for <?php echo $_POST['firstname']; ?>
  <?php }
} ?>
</div>
</form>
</body>
</html>

    <?php include "templates/footer.php"; ?>
