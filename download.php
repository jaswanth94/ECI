<?php
if (isset($_GET['submit']))
{
  require "fpdf/fpdf.php";
  require "connect.php";
  try {
      
      $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
FROM VoterDetails
WHERE firstname=:firstname && lastname=:lastname && dob=:dob && gender=:gender";
$firstname=$_GET['firstname'];
$lastname=$_GET['lastname'];
$dob=$_GET['dob'];
$gender=$_GET['gender'];
$statement = $connection->prepare($sql);
$statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
$statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
$statement->bindParam(':dob', $dob, PDO::PARAM_STR);
$statement->bindParam(':gender', $gender, PDO::PARAM_STR);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$dob1=$row['dob'];
$image=$row['image'];
$voterid=$row['voterId'];
$pdf = new FPDF('P', 'pt', 'Letter');
   // Add a new page to the document
   $pdf->AddPage();
   $pdf->SetFont("Arial","I",14);
   $pdf->Image('https://i.imgur.com/DEGI4P5.jpg',20,20);
   $pdf->Image('https://i.ibb.co/7XBN7nx/BC.gif',200,230,90,50);
   $pdf->Image($image ,30,130);
   $pdf->Cell(0,300," ",0,1);
   $pdf->Cell(0,40,"Voter ID : $voterid",0,1);
   $pdf->Cell(0,40,"First Name : $firstname",0,1);
   $pdf->Cell(0,40,"Last Name : $lastname",0,1);
   $pdf->Cell(0,40,"DOB :$dob",0,1);
   $pdf->Cell(0,40,"Gender :$gender",0,1);
   $pdf->Image('https://i.ibb.co/fDDGnF3/ec43.jpg',20,550,350,100);
   $pdf->Output();
}

catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
