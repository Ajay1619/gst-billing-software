<?php 

$sql2="SELECT * FROM invoice ";
$result1=$conn->query($sql2);
while ($row=$result1->fetchArray(SQLITE3_ASSOC)) {
    $transactions[$k]=$row;$k++;
}$k=0;


foreach ($transactions as $key => $value) {
    $transactionsdates[$key]=date("d-m-Y", strtotime($value['invoicedate']));
    
}


if (isset($_POST['apply'])) {
    $currentyeartransactions=array();
    $currentyeartransactionsmonths=array();
    $uniquecurrentyeartransactionsmonths=array();
    $countofcurrentmonthtransactions=0;
    $arrayofcurrentmonthtransactions=array();
    $uniquecurrentyeartransactionsmonthss=array();
    $datearray=array();

    $countofuniquetransactions=0;
    $transactiontotalvaluemonth=0;
    $transactiongstamtmonth=0;
    $transactiongrandtotalmonth=0;
    $thismonth="";
    $firstmonth="";
    $lastdate="";
    $k=0;
    $yr=0;
    $filterdate=$_POST['year'];
    foreach ($transactions as $key => $transaction) {
        if (date("Y", strtotime($transaction['invoicedate']))==$filterdate) {
            $currentyeartransactions[$yr]=$transaction;
            $currentyeartransactionsmonths[$yr]=date("F", strtotime($transaction['invoicedate']));
            $yr++;
        }
        $datearray[$key]=date("Y", strtotime($transaction['invoicedate']));
    }
    $datearray=array_unique($datearray);
    $uniquecurrentyeartransactionsmonthss=array_unique($currentyeartransactionsmonths);
$countofcurrentmonthtransactions=count($uniquecurrentyeartransactionsmonthss);
$arrayofcurrentmonthtransactions=array_count_values($currentyeartransactionsmonths);
foreach ($uniquecurrentyeartransactionsmonthss as $key => $uniquecurrentyeartransactionsmonth) {
    $uniquecurrentyeartransactionsmonths[$k]=$uniquecurrentyeartransactionsmonth;$k++;
}
}
if (!isset($_POST['apply'])) {
    $currentyeartransactions=array();
    $currentyeartransactionsmonths=array();
    $uniquecurrentyeartransactionsmonths=array();
    $countofcurrentmonthtransactions=0;
    $arrayofcurrentmonthtransactions=array();
    $uniquecurrentyeartransactionsmonthss=array();
    $datearray=array();

    $countofuniquetransactions=0;
    $transactiontotalvaluemonth=0;
    $transactiongstamtmonth=0;
    $transactiongrandtotalmonth=0;
    $thismonth="";
    $firstmonth="";
    $lastdate="";
    $k=0;
    $yr=0;
    foreach ($transactions as $key => $transaction) {
        if (date("Y", strtotime($transaction['invoicedate']))==date("Y")) {
            $currentyeartransactions[$yr]=$transaction;
            $currentyeartransactionsmonths[$yr]=date("F", strtotime($transaction['invoicedate']));
            $yr++;
        }
        $datearray[$key]=date("Y", strtotime($transaction['invoicedate']));
    }
    $datearray=array_unique($datearray);
    $uniquecurrentyeartransactionsmonthss=array_unique($currentyeartransactionsmonths);
$countofcurrentmonthtransactions=count($uniquecurrentyeartransactionsmonthss);
$arrayofcurrentmonthtransactions=array_count_values($currentyeartransactionsmonths);
foreach ($uniquecurrentyeartransactionsmonthss as $key => $uniquecurrentyeartransactionsmonth) {
    $uniquecurrentyeartransactionsmonths[$k]=$uniquecurrentyeartransactionsmonth;$k++;
}
}
function IND_money_format($number){
    $decimal = (string)($number - floor($number));
    $money = floor($number);
    $length = strlen($money);
    $delimiter = '';
    $money = strrev($money);

    for($i=0;$i<$length;$i++){
        if(( $i==3 || ($i>3 && ($i-1)%2==0) )&& $i!=$length){
            $delimiter .=',';
        }
        $delimiter .=$money[$i];
    }

    $result = strrev($delimiter);
    $decimal = preg_replace("/0\./i", ".", $decimal);
    $decimal = substr($decimal, 0, 3);

    if ($decimal != '0') {
        $result .= $decimal;
    } else {
        $result .= '.00';
    }

    return $result;
}
?>