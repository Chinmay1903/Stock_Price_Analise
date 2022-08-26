$("#stocks").change(function () {
    $("div#emptyBox").hide();
    $("div#dataBox").show();
    var stockname = $("select#stocks option:checked").val();
    var dateData = $("#" + stockname + "date").val();
    var priceData = $("#" + stockname + "price").val();
    var dates = JSON.parse(dateData);
    var prices = JSON.parse(priceData);
    var graphdata = [];
    for (let i = 0; i < dates.length; i++) {
        var temp = {"y" : parseInt(prices[i]), "label" : dates[i]};
        graphdata.push(temp);
    }

    var chart = new CanvasJS.Chart("chartContainer", {
        title: {
            text: "Prices of " + stockname
        },
        axisY: {
            title: "Price"
        },
        axisX: {
            title: "Date"
        },
        data: [{
            type: "line",
            dataPoints: graphdata
        }]
    });
    chart.render();

    $("input#maxProfit").val(maxProfit(prices)) ;
    $("input#devition").val(standardDeviation(prices).toFixed(2));
    $("input#mean").val(mean(prices).toFixed(2));
});



var maxProfit = function (prices) {
    var minprice = Number.MAX_VALUE;
    var maxprofit = 0;
    var purchase_date = -1, sell_date = -1;
    for (let i = 0; i < prices.length; i++) {
        if (prices[i] < minprice)
            minprice = prices[i];
        else if (prices[i] - minprice > maxprofit)
            maxprofit = prices[i] - minprice;
        sell_date = i;
    }
    if (sell_date < 0) purchase_date = -1;
    return maxprofit;
};

const standardDeviation = (arr, usePopulation = false) => {
    const mean = arr.reduce((acc, val) => acc + val, 0) / arr.length;
    return Math.sqrt(
        arr.reduce((acc, val) => acc.concat((val - mean) ** 2), []).reduce((acc, val) => acc + val, 0) /
        (arr.length - (usePopulation ? 0 : 1))
    );
};

const mean = (arr) => {
    let total = 0;

    for (let i = 0; i < arr.length; i++) {
        total += arr[i];
    }

    return total / arr.length;
};
