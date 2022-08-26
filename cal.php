<?php
function maxProfit($dateData, $priceData)
{
    $minprice = PHP_INT_MAX;
    $maxprofit = 0;
    $purchase_date = -1;
    $sell_date = -1;

    for ($i = 0; $i < count($priceData); $i++) {
        if ($priceData[$i] < $minprice) {
            $minprice = $priceData[$i];
            $purchase_date = $i;
        } else if ($priceData[$i] - $minprice > $maxprofit) {

            $maxprofit = $priceData[$i] - $minprice;
            $sell_date = $i;
        }
    }

    if ($sell_date < 0) $purchase_date = -1;
    echo $purchase_date . " " . $sell_date;

    return $maxprofit;
}
function mean($arr)
{
    $len = count($arr);
    $mean = array_sum($arr) / $len;
    return $mean;
}

function std_deviation($arr)
{
    $len = count($arr);
    $var = 0.0;
    $avg = array_sum($arr) / $len;
    foreach ($arr as $i) {
        $var += pow(($i - $avg), 2);
    }
    return (float)sqrt($var / $len);
}

// function maxProfit($arr){
//   $maxProfit = 0;
//   for ($i=0; $i < count($arr)-1; $i++) { 
//     for ($j=$i+1; $j < count($arr)-1; $j++) { 
//       $profit = $arr[$j] - $arr[$i];
//       if ($profit > $maxProfit)
//       $maxProfit = $profit;
//     }
//   }
//   return $maxProfit;
// }