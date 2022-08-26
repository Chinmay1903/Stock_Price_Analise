<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "dbcon.php";

$target_dir = "uploads/";
$target_file = $_FILES["fileupload"];
// $_POST["submit"];
// if(isset($_POST["submit"])) {
if (isset($_FILES["fileupload"])) {
  //Store file in directory "upload"
  move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir . $_FILES["fileupload"]["name"]);
  // echo "Stored in: " . $target_dir . $_FILES["fileupload"]["name"] . "<br />";
}
// }
// print_r($target_file);
// die;
$file = fopen($target_dir . $_FILES["fileupload"]["name"], "r");
$arrdata = [];
$i = 1;
// Fetching data from csv file row by row
while (($data = fgetcsv($file)) !== false) {
  if ($i > 1) {
    array_push($arrdata, (array)$data);
    // var_dump($arrdata);
    // echo "<br>";
    $sql = "SELECT `id`, `date`, `price` FROM `stock_price` WHERE `stockname` = '$data[2]'";
    $result = $mysqli->query($sql);
    // var_dump($result);
    // echo "<br>";
    if ($result->num_rows != 0) {
      $dateData = [];
      $priceData = [];
      $temp = $result->fetch_assoc();
      // echo $temp["date"];
      $dateData = json_decode($temp["date"]);
      array_push($dateData, $data[1]);
      // var_dump($dateData);
      // echo $temp["price"];
      $priceData = json_decode($temp["price"]);
      array_push($priceData, $data[3]);
      $id = $temp["id"];
      $sql = "UPDATE `stock_price` SET `date`='" . json_encode($dateData) . "',`price`='" . json_encode($priceData) . "' WHERE `id`=$id";
      // echo $sql;
      if ($mysqli->query($sql) === TRUE) {
        // echo "Record Updated successfully<br>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      $dateData = [];
      $priceData = [];
      array_push($dateData, $data[1]);
      array_push($priceData, $data[3]);
      // var_dump($priceData);
      $sql = "INSERT INTO stock_price (stockname, date, price) VALUES ('" . $data[2] . "', '" . json_encode($dateData) . "', '" . json_encode($priceData) . "')";
      // echo $sql;
      if ($mysqli->query($sql) === TRUE) {
        // echo "New record created successfully<br>";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
  $i++;
}
fclose($file);
$url = "http://localhost/assessment_project/showData.php";
echo '<script type="text/javascript">location.href = "' . $url . '";</script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loading Page</title>
  <link rel="stylesheet" href="css/readData.css">
</head>

<body>
  <div class="large-indicator">
    <div></div>
    <div></div>
    <div></div>
  </div>
</body>

</html>