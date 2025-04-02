<?php 

$sql4="SELECT * FROM company ";
$result2=$conn->query($sql4);$k=0;
while ($row=$result2->fetchArray(SQLITE3_ASSOC)) {
    $companys[$k]=$row;
    $companynames[$k]=$row['cname'];$k++;
}$k=0;
$sql5="SELECT * FROM invoice ";
        $result3=$conn->query($sql5);
        while ($row=$result3->fetchArray(SQLITE3_ASSOC)) {
            $invoice[$k]=$row;$k++;
        }$k=0;
        
        foreach ($invoice as $key => $value) {
            if ($value['invoiceno']!=null) {
                $previousinvoiceno=$value['invoiceno'];
            }
            if ($value['qno']!=null) {
                $previousqno=$value['qno'];
            }
            if ($value['dcno']!=null) {
                $previousdcno=$value['dcno'];
            }
            
            
            
        }

$companyname="{title:'".implode("'},{title:'",$companynames)."'}";

    if (isset($_POST['geninvoice'])) {
        $itemsadded=$_POST['itemsadded'];
        $invoiceno=$_POST['invoiceno'];
        $vendorno=$_POST['vendorno'];
        $challanno=$_POST['challanno'];
        $orderno=$_POST['orderno'];
        $output=$_POST['output'];
        $gstpercentage=$_POST['gstpercentagevalue'];
        $quno=$_POST['quno'];
        $dcno=$_POST['dcno'];
        $cusgstno=$_POST['cusgstno'];
        $vehicleno=$_POST['vehicleno'];
        $invoicedate=$_POST['invoicedate'];
        $challandate=$_POST['challandate'];
        $orderdate=$_POST['orderdate'];
        $dcdate=$_POST['dcdate'];
        $qtitle=$_POST['qtitle'];
        $cname=$_POST['cname'];
        $gsttype=$_POST['gsttype'];
        $adjustment=$_POST['adjustment']; 
        $amtwords=$_POST['amtwords'];
        $subamtwords=$_POST['subamtwords'];
        $totalvalue=$_POST['totalvalue']; 
        $cgst=$_POST['cgst'];
        $sgst=$_POST['sgst'];
        $igst=$_POST['igst'];
        $subtotal=$_POST['subtotal'];
        $grandtot=$_POST['grandtot'];
        $items=json_decode($_POST['items']) ;
        $hsncodes=json_decode($_POST['hsncodes']) ;
        $quantitys=json_decode($_POST['quantitys']) ;
        $units=json_decode($_POST['units']) ;
        $rates=json_decode($_POST['rates']) ;
        $amounts=json_decode($_POST['amounts']) ;

        if ($gsttype=='sgst') {
            $gstamt=$cgst+$sgst;
            $gstamt=$gstamt;
        }
        else {
            $gstamt=$igst;
            $gstamt=$gstamt;
        }

        $item=implode("~",$items);
        $hsncode=implode(",",$hsncodes);
        $quantity=implode(",",$quantitys);
        $unit=implode(",",$units);
        $rate=implode(",",$rates);
        $amount=implode("~",$amounts);

        foreach ($invoice as $key => $in) {
            if ($in['invoiceno'] ==$invoiceno) {
                $flag++;
            }
        }

        if ($invoiceno!=null ) {
            if ($flag!=0) {
            $sql6="UPDATE invoice SET invoiceno='$invoiceno',vendorno='$vendorno',challanno='$challanno',orderno='$orderno',dcno='$dcno',qno='$quno',customergstno='$cusgstno',
                vehicleno='$vehicleno',invoicedate='$invoicedate',challandate='$challandate',orderdate='$orderdate',dcdate='$dcdate',qtitle='$qtitle',companyname='$cname',itemname='$item',
                hsncode='$hsncode',quantity='$quantity',units='$unit',rate='$rate',amounts='$amount',totalvalue='$totalvalue',gsttype='$gsttype',sgst='$sgst',cgst='$cgst',igst='$igst',
                subtotal='$subtotal',adjustment='$adjustment',grandtotal='$grandtot',subamtinwords='$subamtwords',amtinwords='$amtwords',gstpercentage='$gstpercentage',output='$output',gstamt='$gstamt'
                WHERE invoiceno='$invoiceno'";

                $conn->exec($sql6);
        }
        else {
            $sql="INSERT INTO invoice(invoiceno,vendorno,challanno,orderno,dcno,qno,customergstno,vehicleno,invoicedate,challandate,orderdate,dcdate,qtitle,companyname,itemname,hsncode,quantity,
                units,rate,amounts,totalvalue,gsttype,sgst,cgst,igst,subtotal,adjustment,grandtotal,amtinwords,subamtinwords,output,gstpercentage,gstamt)
                VALUES('$invoiceno','$vendorno','$challanno','$orderno','$dcno','$quno','$cusgstno','$vehicleno','$invoicedate','$challandate','$orderdate','$dcdate','$qtitle','$cname','$item',
                '$hsncode','$quantity','$unit','$rate','$amount','$totalvalue','$gsttype','$sgst','$cgst','$igst','$subtotal','$adjustment','$grandtot','$amtwords','$subamtwords','$output','$gstpercentage','$gstamt')";
            $conn->exec($sql);
        }
        }
        elseif ($qno!=null) {
            if ($flag!=0) {
            $sql6="UPDATE invoice SET invoiceno='$invoiceno',vendorno='$vendorno',challanno='$challanno',orderno='$orderno',dcno='$dcno',qno='$quno',customergstno='$cusgstno',
                vehicleno='$vehicleno',invoicedate='$invoicedate',challandate='$challandate',orderdate='$orderdate',dcdate='$dcdate',qtitle='$qtitle',companyname='$cname',itemname='$item',
                hsncode='$hsncode',quantity='$quantity',units='$unit',rate='$rate',amounts='$amount',totalvalue='$totalvalue',gsttype='$gsttype',sgst='$sgst',cgst='$cgst',igst='$igst',
                subtotal='$subtotal',adjustment='$adjustment',grandtotal='$grandtot',subamtinwords='$subamtwords',amtinwords='$amtwords',gstpercentage='$gstpercentage',output='$output',gstamt='$gstamt'
                WHERE qno='$qno'";

                $conn->exec($sql6);
        }
        else {
            $sql="INSERT INTO invoice(invoiceno,vendorno,challanno,orderno,dcno,qno,customergstno,vehicleno,invoicedate,challandate,orderdate,dcdate,qtitle,companyname,itemname,hsncode,quantity,
                units,rate,amounts,totalvalue,gsttype,sgst,cgst,igst,subtotal,adjustment,grandtotal,amtinwords,subamtinwords,output,gstpercentage,gstamt)
                VALUES('$invoiceno','$vendorno','$challanno','$orderno','$dcno','$quno','$cusgstno','$vehicleno','$invoicedate','$challandate','$orderdate','$dcdate','$qtitle','$cname','$item',
                '$hsncode','$quantity','$unit','$rate','$amount','$totalvalue','$gsttype','$sgst','$cgst','$igst','$subtotal','$adjustment','$grandtot','$amtwords','$subamtwords','$output','$gstpercentage','$gstamt')";
            $conn->exec($sql);
        }
        }
        elseif ($dcno!=null) {
            if ($flag!=0) {
            $sql6="UPDATE invoice SET invoiceno='$invoiceno',vendorno='$vendorno',challanno='$challanno',orderno='$orderno',dcno='$dcno',qno='$quno',customergstno='$cusgstno',
                vehicleno='$vehicleno',invoicedate='$invoicedate',challandate='$challandate',orderdate='$orderdate',dcdate='$dcdate',qtitle='$qtitle',companyname='$cname',itemname='$item',
                hsncode='$hsncode',quantity='$quantity',units='$unit',rate='$rate',amounts='$amount',totalvalue='$totalvalue',gsttype='$gsttype',sgst='$sgst',cgst='$cgst',igst='$igst',
                subtotal='$subtotal',adjustment='$adjustment',grandtotal='$grandtot',subamtinwords='$subamtwords',amtinwords='$amtwords',gstpercentage='$gstpercentage',output='$output',gstamt='$gstamt'
                WHERE dcno='$dcno'";

                $conn->exec($sql6);
        }
        else {
            $sql="INSERT INTO invoice(invoiceno,vendorno,challanno,orderno,dcno,qno,customergstno,vehicleno,invoicedate,challandate,orderdate,dcdate,qtitle,companyname,itemname,hsncode,quantity,
                units,rate,amounts,totalvalue,gsttype,sgst,cgst,igst,subtotal,adjustment,grandtotal,amtinwords,subamtinwords,output,gstpercentage,gstamt)
                VALUES('$invoiceno','$vendorno','$challanno','$orderno','$dcno','$quno','$cusgstno','$vehicleno','$invoicedate','$challandate','$orderdate','$dcdate','$qtitle','$cname','$item',
                '$hsncode','$quantity','$unit','$rate','$amount','$totalvalue','$gsttype','$sgst','$cgst','$igst','$subtotal','$adjustment','$grandtot','$amtwords','$subamtwords','$output','$gstpercentage','$gstamt')";
            $conn->exec($sql);
        }
        }
        

        $sql1="SELECT * FROM invoice WHERE invoiceno = '$invoiceno'";
        $result=$conn->query($sql1);
        while ($row=$result->fetchArray(SQLITE3_ASSOC)) {
            $invoices[$k]=$row;$k++;
        }$k=0;
        
    }
    if (isset($_POST['csave'])) {
        $coname=$_POST['coname'];
        $csalutation=$_POST['csalutation'];
        $cgstno=$_POST['cgstno'];
        $cvendorno=$_POST['cvendorno'];
        $caddress=$_POST['cadd'];
        $cstreet=$_POST['cstreet'];
        $carea=$_POST['carea'];
        $cdistrict=$_POST['cdistrict'];
        $cstate=$_POST['cstate'];
        $cphnno=$_POST['cphnno'];
        $cemail=$_POST['cemail'];
        $cpincode=$_POST['cpincode'];

        $sql3="INSERT INTO company(cname,csalutation,cvendorno,cphnno,cdistrict,cstate,cgstno,cemail,caddress,carea,cpincode) VALUES('$coname','$csalutation','$cvendorno','$cphnno','$cdistrict','$cstate','$cgstno','$cemail','$caddress','$carea','$cpincode')";
        $conn->exec($sql3);
    }

    
?>