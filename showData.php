<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "dbcon.php";
$stocks = [];
$arr = [];
$sql = "SELECT `stockname`, `date`, `price` FROM `stock_price`";
$result = $mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    array_push($arr, $row);
    array_push($stocks, $row["stockname"]);
}
// var_dump($arr);
// die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results || Stocks</title>
    <link rel="stylesheet" href="css/showData.css">
</head>

<body>
    <h2>Results:</h2>
    <div class="head-container">
        <label for="stocks">Select Stock : </label>
        <div class="select-dropdown">
            <select id="stocks">
                <option value="">--Select--</option>
                <?php
                foreach ($stocks as $stock) {
                    echo '<option value="' . $stock . '">' . $stock . '</option>';
                }
                ?>
            </select>
        </div>
        <?php
        foreach ($arr as $data) {
            echo "<input type='hidden' id='" . $data["stockname"] . "date' value='" . $data["date"] . "'>";
            echo "<input type='hidden' id='" . $data["stockname"] . "price' value='" . $data["price"] . "'>";
        }
        ?>
    </div>
    <div class="body-container">
        <div id="emptyBox">
            <h1>
                Select Stock To Check Results.
            </h1>
        </div>
        <div id="dataBox" style="display: none; width:100%">
            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <div>
                <div class="maxProfit">
                    <div><label for="maxProfit">Max Profit</label><input type="text" id="maxProfit" readonly></div>
                </div>
                <div class="devition">
                    <div><label for="devition">Standard Deviation</label><input type="text" id="devition" readonly></div>
                </div>
                <div class="mean">
                    <div><label for="mean">Mean Stock Price</label><input type="text" id="mean" readonly></div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/lib/jquery-3.6.0.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="js/showData.js"></script>

</html>