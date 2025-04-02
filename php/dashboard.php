<?php 
    include '../be/connect.php';
    include '../php/variables.php';
    include '../be/dashboardbe.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <!-- semantic ui -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <script src= "https://code.jquery.com/jquery-3.1.1.min.js"crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        body{
            background-color: #252526;
            color: white;
            overflow-y: hidden;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="ui grid">
        <div class="two wide column">
            <!--sidebar-->
            <div class="ui vertical labeled icon inverted fixed menu">
                <img class="ui small  image" src="../sources/ae.png" ><br>
                <a class="item"><i class="th large icon"></i> Dashboard </a>
                <a href="./taxinvoice.php" class="item"><i class="file alternate icon"></i>Invoice</a>
                <a href="./dc.html" class="item "><i class="file outline icon"></i>Delivery Challan</a>
                <a href="../php/transaction.php" class="item "><i class="money bill alternate icon"></i>Transactions</a>
                <a href="./reports.html" class="item "><i class="clipboard list icon"></i>Reports</a>
                <a href="./invoice.html" class="item " ><i class="settings icon"></i>Settings </a>
                <a href="./index.html" class="item"> <i class="logout icon"></i> Logout</a>
                <br><br><br><br><br><br><br><br><br></br>
            </div>
        </div>
        <div class="fourteen wide column"> <br>
            <!--DashBoard-->
            <h2 class="ui center aligned container" style="font-family: 'Recharge';font-weight: bold;">DashBoard</h2> <hr> <br>
        </div>
    </div>
</body>
</html>