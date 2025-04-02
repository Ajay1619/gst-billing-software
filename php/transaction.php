<?php 
    include '../be/connect.php';
    include '../php/variables.php';
    include '../be/transactionbe.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSACTIONS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <script src= "https://code.jquery.com/jquery-3.1.1.min.js"crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    <style>
        body{
            background-color: #252526;
            color: white;
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
                <a href="../php/transaction.php" class="item "><i class="money bill alternate icon"></i>Transactions</a>
                <a href="./dc.html" class="item disabled "><i class="file outline icon"></i>Delivery Challan</a>
                <a href="./reports.html" class="item disabled "><i class="clipboard list icon"></i>Reports</a>
                <a href="./invoice.html" class="item disabled " ><i class="settings icon"></i>Settings </a>
                <a href="./index.html" class="item disabled"> <i class="logout icon"></i> Logout</a>
                <br><br><br><br><br><br><br><br><br></br>
            </div> 
        </div>
        <div class="thirteen wide column"><br>
            <!-- Summary Table -->
            <h2 class="ui center aligned container"  style="font-family: 'Recharge';font-weight: bold;">Transactions</h2> <hr> <br>
            
            <div class="ui right aligned container">
                <form action="" method="post">
                    <select class="ui dropdown" id="year" name="year">
                        <option value="">Select a Year</option>
                        <?php foreach ($datearray as $key => $datearr) { ?>
                            <option value="<?php echo $datearr; ?>"><?php echo $datearr; ?></option>
                            
                        <?php }?>
                    </select>
                    <button style="background-color: #dc1a2e;color:white" name="apply" class="ui button">Apply</button>
                </form>
            </div><br>
            
            <table class="ui celled inverted structured table center aligned">
                <thead>
                    <tr>
                        <th>MONTHS</th>
                        <th>DATES</th>
                        <th>TOTALVALUE</th>
                        <th>GST AMOUNT</th>
                        <th>GRAND TOTAL</th>
                    </tr>
                </thead>
                <tbody >
                        <?php
                        foreach ($uniquecurrentyeartransactionsmonths as $key1 => $uniquecurrentyeartransactionsmonth) { 
                        foreach ($currentyeartransactions as $key => $currentyeartransaction) {
                            if ($uniquecurrentyeartransactionsmonth != date("F", strtotime($currentyeartransaction['invoicedate']))) {
                                continue;
                            }
                        ?>
                                <tr> 
                                    <?php 

                                    ?>
                                        <?php if ($thismonth != $uniquecurrentyeartransactionsmonth || $thismonth==null ) {?>
                                        
                                            
                                            <td rowspan="<?php echo $arrayofcurrentmonthtransactions[$uniquecurrentyeartransactionsmonth]+1; ?>"><h1><?php echo $uniquecurrentyeartransactionsmonth; $thismonth=$uniquecurrentyeartransactionsmonth;?></h1></td>
                                        <?php }?>
                                            <?php 
                                                    if ($uniquecurrentyeartransactionsmonth == date("F", strtotime($currentyeartransaction['invoicedate']))) {?>
                                                    <td>
                                                        <?php  echo $currentyeartransaction['invoicedate'];?>
                                                    </td>
                                            
                                            
                                                    <td>
                                                        <?php  echo $currentyeartransaction['totalvalue'];?>
                                                    </td>
                                            
                                            
                                                    <td>
                                                        <?php  echo $currentyeartransaction['gstamt'];?>
                                                    </td>
                                            
                                            
                                                    <td>
                                                        <?php  echo $currentyeartransaction['grandtotal'];?>
                                                    </td>
                                            <?php }
                                            $currentyeartransaction['totalvalue']=str_replace(",","",$currentyeartransaction['totalvalue']);
                                                $transactiontotalvaluemonth+=$currentyeartransaction['totalvalue'];
                                            $currentyeartransaction['gstamt']=str_replace(",","",$currentyeartransaction['gstamt']);
                                                $transactiongstamtmonth+=$currentyeartransaction['gstamt'];
                                            $currentyeartransaction['grandtotal']=str_replace(",","",$currentyeartransaction['grandtotal']);
                                                $transactiongrandtotalmonth+=$currentyeartransaction['grandtotal'];
                                            ?>
                                    <?php }?>      
                                </tr>
                                <tr style="background-color: #dc1a2e;">
                                    <td></td>
                                    <td><h3>RS.<?php $transactiontotalvaluemonth1=IND_money_format($transactiontotalvaluemonth); echo $transactiontotalvaluemonth1; ?></h3></td>
                                    <td><h3>RS.<?php $transactiongstamtmonth1=IND_money_format($transactiongstamtmonth);echo $transactiongstamtmonth1; ?></h3></td>
                                    <td><h3>RS.<?php $transactiongrandtotalmonth1=IND_money_format($transactiongrandtotalmonth);echo $transactiongrandtotalmonth1; ?></h3></td>
                                </tr>
                        <?php  }?>
                </tbody>
                <tfoot  >
                    <tr>
                        <th></th>
                        <th></th>
                        <th><h3 style="color: #dc1a2e;">RS.<?php $transactiontotalvaluemonth=IND_money_format($transactiontotalvaluemonth);echo $transactiontotalvaluemonth; ?></h3></th>
                        <th><h3 style="color: #dc1a2e;">RS.<?php $transactiongstamtmonth=IND_money_format($transactiongstamtmonth);echo $transactiongstamtmonth; ?></h3></th>
                        <th><h3 style="color: #dc1a2e;">RS.<?php $transactiongrandtotalmonth=IND_money_format($transactiongrandtotalmonth);echo $transactiongrandtotalmonth; ?></h3></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script>
        $('.ui.dropdown').dropdown();
        $('#year').dropdown();
    </script>
</body>
</html>