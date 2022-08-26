<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css\index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <form class="form" action="readData.php" method="post" enctype="multipart/form-data">
            <div class="file-upload-wrapper" data-text="Select your file!">
                <input class="file-upload-field" type="file" name="fileupload" id="fileupload" required accept=".csv">
            </div> 
            <div class="btn-container">
                <button id="button" class="btn" type="submit" data-loaREadding-text="<i class='fas fa-circle-notch fa-spin'></i>">Read CSV</button>
            </div>
        </form>
    </div>
</body>
<script src="js/lib/jquery-3.6.0.min.js"></script>
<script src="js/index.js"></script>
</html>