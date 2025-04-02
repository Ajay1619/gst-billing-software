<?php 
    include '../be/connect.php';
    include '../php/variables.php';
    include '../be/taxinvoicebe.php';
    include '../be/transactionbe.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>

    <!-- semantic ui -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
    <script src= "https://code.jquery.com/jquery-3.1.1.min.js"crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
    

    <link rel="stylesheet" href="../css/taxinvoicecss.css">
    
   <style>
    
body{
    background-color: #252526;
    color: white;
    overflow-y: hidden;
    overflow-x: hidden;   
}
#bills{
    overflow-y: auto;
    overflow-x: auto;
}
    #qpdf {
    font-family: 'Eras ITC';
    font-weight: bold;
    color: black;
    
}


body{
	font-family: 'Roboto', sans-serif;
}



.flag {
    display: inline-block;
    background: #dc1a2e;
    padding: 3px 40px;
    text-transform: uppercase;
    color: white;
    position: relative;
    
}
.flags{
	/* display: grid;
    place-items: center;
    width:50%; */
}

.triangle-left {
    width: 0;
    height: 0;
    border-top: 25px solid transparent;
    border-right: 25px solid white;
    border-bottom: 25px solid transparent;
    position: absolute;
    right: 0;
    top: 0;
}

.triangle-right {
    width: 0;
    height: 0;
    border-top: 25px solid transparent;
    border-left: 25px solid white;
    border-bottom: 25px solid transparent;
    position: absolute;
    left: 0;
    top: 0;
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
    
        <div class="ten wide column" id="invoice"> <br>
            <!--Tax invoice--> 
            <h3 class="ui center aligned container">Tax Invoice</h3> <hr> <br>
            <form class="ui form" action="./taxinvoice.php" method="post">
            <div class="ui grid" >
                    <div class="four wide column">
                        <div class="thirteen wide field">
                        <label id="labels" >Invoice Number</label>
                            <input type="text" id="invoiceno" name="invoiceno" placeholder="Enter Invoice Number" value="<?php echo $previousinvoiceno+1; ?>" onkeypress="fun_search(event,this.value)">
                        </div>
                        
                        <div class="thirteen wide field" style="margin-top: 15%;">
                            <label id="labels" >Vendor Number</label>
                            <input type="text" id="vendorno" name="vendorno" placeholder="Enter Vendor Number">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                            <label id="labels" >Challan Number</label>
                            <input type="text" id="challanno" name="challanno" placeholder="Enter Challan Number">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                        <label id="labels" >Quotation Number</label>
                            <input type="text" id="quno" name="quno" placeholder="Enter Quotation Number" value="<?php echo $previousqno+1; ?>" onkeypress="fun_search(event,this.value)">
                        </div>
                        
                    </div>
                    <div class="four wide column">
                        <div class="thirteen wide field" >
                            <label id="labels" >Invoice Date</label>
                            <input type="date" id="invoicedate" name="invoicedate" >
                        </div>
                        
                        
                        <div class="thirteen wide field" style="margin-top: 15%;">
                            <label id="labels" >Vehicle Number</label>
                            <input type="text" id="vehicleno" name="vehicleno" placeholder="Enter Vehicle Number">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                            <label id="labels" >Challan Date</label>
                            <input type="date" id="challandate" name="challandate" >
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                            <label id="labels" >Quotation Date</label>
                            <input type="date" id="qudate" name="qudate" placeholder="Enter Quotation Date">
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui search thirteen wide field" style="margin-top: 10%;" id="csearch">
                            <div class="ui icon input">
                                <input class="prompt" id="cname" type="text" placeholder="Enter Company Name" name="cname">
                            </div>
                            <div class="results"></div>
                            <div style="margin-left: 7%;" onclick="openModal()" id="addcompany"><span><i class="user plus icon" onclick=""></i></span>Add Company Details</div>
                        </div>
                        <div class="thirteen wide field" >
                            <label id="labels" >Order No</label>
                            <input type="text" id="orderno" name="orderno" placeholder="Enter Order Number">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                        <label id="labels" >DC Number</label>
                            <input type="text" id="dcno" name="dcno" placeholder="Enter DC Number" value="<?php echo $previousdcno+1; ?>" onkeypress="fun_search(event,this.value)">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                        <label id="labels" >Quotation Title</label>
                            <input type="text" id="qtitle" name="qtitle" placeholder="Enter Quotation Title" >
                        </div>
                        
                    </div>
                    <div class="four wide column">
                        <div class="thirteen wide field" >
                        <label id="labels" >Customer GST NO</label>
                            <input type="text" id="cusgstno" name="cusgstno" placeholder="Enter Customer GST NO">
                        </div>
                        <div class="thirteen wide field" style="margin-top: 15%;">
                            <label id="labels">Order Date</label>
                            <input type="date" id="orderdate" name="orderdate" >
                        </div>
                        <div class="thirteen wide field" style="margin-top: 7%;">
                            <label id="labels" >DC Date</label>
                            <input type="date" id="dcdate" name="dcdate" placeholder="Enter DC Date">
                        </div>
                        

                    </div>
                </div><br>
                <div id="invoicetable">
                <table class="ui celled center aligned inverted table" >
                    <thead>
                        <tr><th class="four wide">Item Details</th>
                        <th>HSN Code</th>
                        <th>Quantity</th>
                        <th class="four wide">Units</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr></thead>
                    <tbody id="tablebody"> 
                        <tr id="row">
                            <td>
                                <div class="sixteen wide field" >
                                    <textarea type="text" name="item1" placeholder="Enter Item Details" id="item1" cols="30" rows="3"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="sixteen wide field" >
                                    <input type="text" name="hsncode1" placeholder="Enter HSN code" id="hsncode1">
                                </div>
                            </td>
                            <td id="qid">
                                <div class="sixteen wide field" id="qcol">
                                    <input type="number" name="quantity1" placeholder="Enter Quantity" id="quantity1"> 
                                </div>
                            </td>
                            <td id="td">
                                <div class="" id="selectdiv1">
                                    <select name="units1" id="units1" class="ui selection dropdown ">
                                        <option id="option1" value="">Select a Unit</option>
                                        <option id="option2" value="KG">KG (KiloGram)</option>
                                        <option id="option3" value="Pairs">Pairs</option>
                                        <option id="option3" value="Piece">Piece</option>
                                        <option id="option4" value="No.">No.</option>
                                        <option id="option5" value="Tonne">Tonne</option>
                                    </select>
                                </div>
                            </td>
                            <td id="rateid">
                                <div class="sixteen wide field" id="col">
                                    <input type="text" name="rate1" placeholder="Enter Rate" id="rate1" onkeypress="amountss(event,this.id,this.parentNode.id)">
                                </div>
                            </td>
                            <td id="std">
                                <div class="sixteen wide field" id="cid">
                                    <input type="number" name="amount1" placeholder="Enter Amount" id="amount1">
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><span id="adddetails" onclick="adddetails()">Add Another Item <i class="cart plus icon"></i></span></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                

            

        </div>
        <!-- Bills -->
        <div class=" four wide column" > <br>
            <h3 class="ui center aligned container" >Bill</h3> <hr> <br>
            <div id="bills" >
            <br>
                <div><h4>Total Value&emsp;&emsp;&nbsp;&nbsp;: &emsp;&emsp;Rs.<span id="totvalue">0</span></h4></div> <br>
                <div class="ui grid">
                    <div class="seven wide column"style="margin-top: 3%;">
                        <h4>Gst percentage :</h4>
                    </div>
                    <div class="three wide column">
                    <div >
                        <select class="ui selection dropdown"  name="gstpercentage" type="hidden" id="gstpercentage" onchange="fun_gstpercentage(this.value)">
                        
                            <option disabled value="Select a Percentage">Select a Percentage</option>
                            <option id="gst12" value="12">12%</option>
                            <option id="gst18" value="18" selected>18%</option>
                        </select>
                        </div>
                    </div>
                </div> 
            <div class="ui grid">
                    <div class="seven wide column"style="margin-top: 3%;">
                        <h4>Select GST</h4>
                    </div>
                    <div class="two wide column">
                        <div class="ui input">
                            <input type="text"  name="gsttype" id="gsttype" placeholder="GST TYPE" >
                        </div>
                    </div>
                </div> <br>
                <div><h4>S GST( <span id="sgstper">0</span>% ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &emsp;&emsp;Rs.<span id="sgst">0</span> </h4></div> <br>
                <div><h4>C GST( <span id="cgstper">0</span>% ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &emsp;&emsp;Rs.<span id="cgst">0</span> </h4></div><br>
                <div><h4>I GST( <span id="igstper">0</span>% ) &nbsp;&nbsp;&nbsp;&nbsp;&emsp; : &emsp;&emsp;Rs.<span id="igst">0</span> </h4></div> <br>
                <div><h4>Sub Total&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp; : &emsp;&emsp;Rs.<span id="subtotal">0</span> </h4></div> <br>

                <div class="ui grid">
                    <div class="six wide column"style="margin-top: 3%;">
                        <h4>Adjustments</h4>
                    </div>
                    <div class="three wide column">
                        <div class="ui inverted input focus">
                            <input type="text" name="adjustment" placeholder="Adjusted Amount" id="adjustment" oninput="adjustments()">
                        </div>
                    </div>
                </div> 
            
            <br> <hr> <br>
            <div id="billsc">
                <div><h4> &emsp;&emsp;Grand Total &emsp;&nbsp;&nbsp;: &emsp;&emsp;Rs.<spa id="grandtot">0</span> </h4></div> <br>
                
                <div >
                    <label id="labels" style="padding-left:10%"><b>Sub Total Amount in words</b></label>
                    <div class="ui field" style="text-align: center;">
                        <textarea type="text" name="subamtwords" placeholder="Sub Total Amount in words" id="subamtwords" cols="40" rows="2"></textarea>
                    </div>
                </div> 
                <div >
                    <label id="labels" style="padding-left:10%"><b>Grand Total Amount in words</b></label>
                    <div class="ui field" style="text-align: center;">
                        <textarea type="text" name="amtwords" placeholder="Grand Total Amount in words" id="amtwords" cols="40" rows="2"></textarea>
                    </div>
                </div> 
                <div class="ui grid" style="margin-top: 1%;">
                    <div class="six wide column"style="margin-top: 3%;">
                        <h4>Generate:</h4>
                    </div>
                    <div class="three wide column">
                        <div class="ui  selection dropdown">
                            <input name="output" type="hidden" id="output">
                            <i class="dropdown icon"></i>
                            <div class="default text">Invoices</div>
                            <div class="menu">
                                <div class="item" data-value="tax invoice">Tax Invoice</div>
                                <div class="item" data-value="delivery challan">Delivery Challan</div>
                                <div class="item" data-value="quotation">Quotation</div>
                                <div class="item" data-value="all">All</div>
                            </div>
                        </div>
                    </div>
                </div>  <br>

                <input type="hidden" name="itemsadded" id="itemsadded">
                <input type="hidden" name="totalvalue" id="invoicetotalvalue">
                <input type="hidden" name="cgst" id="invoicecgst">
                <input type="hidden" name="sgst" id="invoicesgst">
                <input type="hidden" name="igst" id="invoiceigst">
                <input type="hidden" name="subtotal" id="invoicesubtotal">
                <input type="hidden" name="grandtot" id="invoicegrandtot">
                <input type="hidden" name="items" id="items">
                <input type="hidden" name="hsncodes" id="hsncodes">
                <input type="hidden" name="quantitys" id="quantitys">
                <input type="hidden" name="units" id="units">
                <input type="hidden" name="rates" id="rates">
                <input type="hidden" name="amounts" id="amounts">
                <input type="hidden" name="gstpercentagevalue" id="gstpercentagevalue">
                <div class="ui two buttons">
                    <button class="ui animated fade button"  name="geninvoice" onclick="geninvoices()">
                        <div class="visible content">Generate Invoice</div>
                            <div class="hidden content">
                                <i class="file alternate icon"></i>
                            </div>
                    </button>
                    <button class="ui animated fade button"  name="cancel">
                        <div class="visible content">Cancel</div>
                            <div class="hidden content">
                                <i class="thumbs down icon"></i>
                            </div>
                    </button>
                </div>
            </div>
        </div></div>
    </form>
    
    </div>
<!-- customer details modal-->

    <div class="ui container">
        <div class="ui modal"><div class="header">Company Details</div><br><br>
            <form class="ui fluid form" method="POST">
                <div class="ui centered grid">
                <div class="six wide column">
                    <div class="ui field ">
                    <label class="ui left aligned container">Company Name</label>
                    <input type="text" name="coname" placeholder="Enter Company/Cutomer Name">
                    </div>
                    <div class="ui field">
                    <label>Salutation</label>
                    <select class="ui fluid search dropdown" name="csalutation">
                        <option value="">Select Salutation</option>
                        <option value="Messrs.">Messrs</option>
                        <option value="MR.">MR</option>
                        <option value="MRS.">MRS</option>
                    </select>
                    </div>
                    <div class="ui field ">
                        <label class="ui left aligned container">GST No</label>
                        <input type="text" name="cgstno" placeholder="Enter GST No">
                    </div>
                    <div class="ui field ">
                        <label class="ui left aligned container">Vendor No</label>
                        <input type="text" name="cvendorno" placeholder="Enter GST No">
                    </div>
                    <div class="ui field ">
                    <label class="ui left aligned container">Billing Address</label>
                    <input type="text" name="cadd" placeholder="Enter Address">
                    </div>
                    <div class="ui field ">
                    <label class="ui left aligned container">Street</label>
                    <input type="text" name="cstreet" placeholder="Enter Street">
                    </div>
                    <div class="ui field ">
                    <label class="ui left aligned container">Area</label>
                    <input type="text" name="carea" placeholder="Enter Address">
                    </div>
                    <div class="ui field">
                    <label>District</label>
                    <select class="ui fluid search dropdown" name="cdistrict">
                        <option value="">Select District</option>
                        <option value="PUDUCHERRY">Puducherry</option>
                        <option value="CUDDALORE">Cuddalore</option>
                        <option value="VILLUPURAM">Villupuram</option>
                    </select>
                    </div>
                    <div class="ui field">
                    <label>State</label>
                    <select class="ui fluid search dropdown" name="cstate">
                        <option value="">Select State</option>
                        <option disabled style="background-color:#aaa; color:#fff">Union Territories</option>
                        <option value="ANDAMAN AND NICOBAR ISLANDS">Andaman and Nicobar Islands</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                        <option value="Daman and Diu">Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Lakshadeep">Lakshadeep</option>
                        <option value="PONDICHERRY">Pondicherry</option>
                        <option value="Andra Pradesh">Andra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madya Pradesh">Madya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Orissa">Orissa</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="TAMIL NADU">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttaranchal">Uttaranchal</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="West Bengal">West Bengal</option>
                    
                    </select>
                    </div>
                    <div class="ui field ">
                        <label class="ui left aligned container">Pincode</label>
                        <input type="number" name="cpincode" placeholder="Enter Pincode">
                    </div>
                    <div class="ui field ">
                        <label class="ui left aligned container">Phone No</label>
                        <input type="number" name="cphnno" placeholder="Enter Phone No">
                    </div>
                    <div class="ui field ">
                        <label class="ui left aligned container">Email Id</label>
                        <input type="email" name="cemail" placeholder="Enter Email Id">
                    </div><br>
                </div>
            </div>
            
            <div class="actions" style="margin-left: 37%;">
                <div class="ui negative cancel button">
                    Cancel
                </div>
                <button class="ui positive ok button" name="csave">
                    Save
                </button>
            </div>
            </form>
        </div>

    <!-- tax invoice -->
    <?php 
        if (isset($_POST['geninvoice'])) {
            foreach ($companys as $key2 => $company) {
                if ($cname==$company['cname']) {
                    $invoicecompany[0]=$company;
                }
            }
            foreach ($invoices as $key => $invoice) { 
                $tableitemnames=explode("~",$invoice['itemname']); 
                $tablehsncodes=explode(",",$invoice['hsncode']);
                $tablequantity=explode(",",$invoice['quantity']);
                $tableunits=explode(",",$invoice['units']);
                $tablerates=explode(",",$invoice['rate']);
                $tableamounts=explode("~",$invoice['amounts']);
                $tableadjustment=$invoice['adjustment']-$invoice['subtotal'];
                $formatadjustment=IND_money_format($tableadjustment);
            ?>
            
            
    <div id="taxinvoice" style="margin-top: 30%;">
        
        <div id="pdf">
            <div id="details">
                <img src="../sources/topinvoicedesign.png" alt="" id="top"> <span id="todaydate"><?php echo date("d-m-Y", strtotime($invoice['invoicedate'])); ?></span>
                <span id="taxinvoiceno"><?php echo $invoice['invoiceno']; ?></span>
        <div class="ui grid">
            <div class="eight wide column">
                <div style="margin-left: 10%;"> 
                    <p style="color: #dc1a2e;"><?php echo $invoicecompany[0]['csalutation']; ?></p>
                    <p ><?php echo $invoicecompany[0]['cname']; ?> <br>
                <?php if ($invoicecompany[0]['caddress']!=null) {?>    <?php echo $invoicecompany[0]['caddress']; ?>  <br> <?php }?>
                <?php if ($invoicecompany[0]['cstreet']!=null) {?>    <?php echo $invoicecompany[0]['cstreet']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['carea']!=null) {?>    <?php echo $invoicecompany[0]['carea']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['cdistrict']!=null) {?>    <?php echo $invoicecompany[0]['cdistrict']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cstate']!=null) {?>    <?php echo $invoicecompany[0]['cstate']."-".$invoicecompany[0]['cpincode']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cgstno']!=null) {?> <span >GSTIN  : <span><?php echo $invoicecompany[0]['cgstno'] ?></span></span></p><?php }?>
    
                        
                </div>
            </div>
    
            <div class="eight wide column">
                <div class="ui grid" >
                    <div class="nine wide column " style="margin-top: 12%;">
                        <div>
                            
                            <p >Vendor No &nbsp;: <span><?php echo $invoice['vendorno'] ?></span></p>
                            <p >Order No &emsp;: <span><?php echo $invoice['orderno'] ?></span></p>
                            <p >Challan No : <span><?php echo $invoice['challanno'] ?></span></p>
                            <p >Dc No &emsp;&emsp;&nbsp;&nbsp;: <span><?php echo $invoice['dcno'] ?></span></p>
                        </div>
                    </div>
                    <div class="six wide column " style="margin-top: 16%;"><br>
                        <div >
                            <p style="padding-right: 3%;">Date : <span><?php
                            if ($invoice['orderdate']!=null) {
                                echo date(date("d-m-Y", strtotime($invoice['orderdate'])));
                            }
                            ?></span></p>
                            <p style="padding-right: 3%;">Date : <span><?php 
                            if ($invoice['challandate']!=null) {
                                echo date(date("d-m-Y", strtotime($invoice['challandate'])));
                            }
                            ?></span></p>
                            <p style="padding-right: 3%;">Date : <span><?php
                            if ($invoice['dcdate']!=null) {
                                echo date(date("d-m-Y", strtotime($invoice['dcdate'])));
                            }
                            ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="fifteen wide column" style="margin-left: 3%;">
                <div id="items">
                    <table class=" celled striped center aligned" width="100%" id="table">
                        <thead>
                        <tr><th style="background-color: #dc1a2e;color: white;width:5%">S.NO</th>
                        <th style="background-color: #dc1a2e;color: white; width:35%" >Particulars</th>
                        <th style="background-color: #dc1a2e;color: white;width:15%">HSN Code</th>
                        <th style="background-color: #dc1a2e;color: white;width:10%">Quantity</th>
                        <th style="background-color: #dc1a2e;color: white;width:7%">Unit</th>
                        <th style="background-color: #dc1a2e;color: white;width:12%">Rate</th>
                        <th style="background-color: #dc1a2e;color: white;width:14%">Amount</th>
                        </tr></thead>
                                <tbody >    
                                <?php foreach ($tableitemnames as $key => $tableitemname) { ?>
                                    <tr >
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Name"><?php echo $slno; $slno++; ?></td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Age"><?php echo $tableitemname; ?></td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablehsncodes[$key]; ?></td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablequantity[$key]; ?></9</td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tableunits[$key]; ?></td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php $tablerates[$key]=IND_money_format($tablerates[$key]); echo $tablerates[$key]; ?></td>
                                        <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php $tableamounts[$key]=IND_money_format($tableamounts[$key]); echo $tableamounts[$key]; ?></td>
                                    </tr>
                                <?php  } ?>
                            
                            
                        </tbody>
                        
                    </table>
                </div> 
            </div>
            </div>
        
        
    </div>
    
    </div>
        <div id="authority" >
        <div class="ui grid">
        
                    <div class="nine wide column" style="margin-left: 3%;">
                            <div style="border-style: solid none solid solid;border-width:2px;border-color:#dc1a2e;font-weight: bold;width:650px;height:260px;padding-left:3%;padding-top:3%">
                                    
                        <h3 style="color: #dc1a2e;font-family: 'Eras ITC';">Amount In Words</h3>
                        <p><?php echo $invoice['amtinwords']." Only"; ?></p>
                                </div>
                    </div>
                    <div class="six wide column" >
                    <table style="color:black;font-weight:bold;">
                <tbody>
                    <tr>
                        <td style="padding:1%;text-align:center">
                            <p style="font-weight: bold;">  Total Value <span style="float: right"></span></p>
                        </td>
                        <td style="padding:1%;text-align:right;width:5%;">
                            <p style="font-size:x-large;"><?php $invoice['totalvalue']=IND_money_format($invoice['totalvalue']); echo $invoice['totalvalue']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:1%;text-align:center">
                        <p style="font-weight: bold;">S GST (
                            <?php  if ($invoice['sgst']!=0) {
                                        echo $gstpercentage/2;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>%) <span style="float: right"></span> </p>
                        </td>
                        <td style="padding:1%;text-align:right;">
                                <p style="font-size:x-large;"><?php $invoice['sgst']=IND_money_format($invoice['sgst']); echo $invoice['sgst']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:1%;text-align:center">
                        <p style="font-weight: bold;">C GST (
                            <?php  
                                    if ($invoice['cgst']!=0) {
                                        echo $gstpercentage/2;
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>%)<span style="float: right"></span></p> 
                        </td>
                        <td style="padding:1%;text-align:right;">
                            <p style="font-size:x-large;"><?php $invoice['cgst']=IND_money_format($invoice['cgst']); echo $invoice['cgst']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:1%;text-align:center">
                        <p style="font-weight: bold;">I GST (
                            <?php  
                                    if ($invoice['igst']!=0) {
                                        echo "18";
                                    }
                                    else {
                                        echo 0;
                                    }
                                ?>%)<span style="float: right"></span></p>
                        </td>
                        <td style="padding:1%;text-align:right;">
                        <p style="font-size:x-large;"><?php $invoice['igst']=IND_money_format($invoice['igst']); echo $invoice['igst']; ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:1%;text-align:center">
                            <p style="font-weight: bold;">Adjustment(-)<span style="float: right"></span> </p>
                        </td>
                        <td style="padding:1%;text-align:right;">
                            <p style="font-size:x-large;"><?php  echo $formatadjustment; ?></p>
                        </td>
                    </tr>
                    <tr> 
                        <td style="padding:1%;text-align:center">
                        <p style="font-weight: bold;">Grand Total <span style="float: right"></span> </p>
                        </td>
                        <td style="padding:1%;text-align:right;">
                        <p style="font-size:x-large;"><?php $invoice['grandtotal']=IND_money_format($invoice['grandtotal']); echo $invoice['grandtotal']; ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
            <hr style="border-top: 2px solid black;"> <br>
            <div class="ui grid" >
                <div class="seven wide column" style="margin-left: 5%;">
                <h3 style="color: #dc1a2e;font-family: 'Eras ITC';font-weight: bold;"><b>Bank Details</b> </h3>
                        <p>Bank/AC No : INDUSIND BANK/259791661299</p>
                        <p>Branch/Ifsc : NATESAN NAGAR/INDB0001598</p>
                </div>
                <div class="eight wide column" >
                    <div >
                        <p style="padding-left:48%;">For <span style="font-family: 'Recharge';font-weight: bold;"> Ajeeth Engineering</span></p> 
                                <img src="../sources/aesignature.png" width="50%" style="margin-left: 50%;" alt="">
                        <p style="padding-left:55%;">Proprietor's Signature</p>
                    </div>
                </div>
            </div>
            <img src="../sources/bottominvoicedesign.png" id="bottom" alt="">
            </div>
        </div> 
        

        <!-- quotation -->
            
            
    <div id="quotation" style="margin-top: 30%;">
        
        <div id="qpdf">
            <div id="details">
                 <img src="../sources/topdesignquotation.png" alt="" id="top"> <span id="qdate"><?php echo date("d-m-Y", strtotime($invoice['qdate'])); ?></span> 
                <span id="qno"><?php echo $invoice['qno']; ?></span>
        <div class="ui grid">
            <div class="eight wide column">
                <div style="margin-left: 10%;"> 
                    <p style="color: #dc1a2e;"><?php echo $invoicecompany[0]['csalutation']; ?></p>
                    <p ><?php echo $invoicecompany[0]['cname']; ?> <br>
                <?php if ($invoicecompany[0]['caddress']!=null) {?>    <?php echo $invoicecompany[0]['caddress']; ?>  <br> <?php }?>
                <?php if ($invoicecompany[0]['cstreet']!=null) {?>    <?php echo $invoicecompany[0]['cstreet']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['carea']!=null) {?>    <?php echo $invoicecompany[0]['carea']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['cdistrict']!=null) {?>    <?php echo $invoicecompany[0]['cdistrict']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cstate']!=null) {?>    <?php echo $invoicecompany[0]['cstate']."-".$invoicecompany[0]['cpincode']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cgstno']!=null) {?> <span >GSTIN  : <span><?php echo $invoicecompany[0]['cgstno'] ?></span></span></p><?php }?>
    
                        
                </div>
            </div>
        </div><br>
        <div class="ui grid">
            <div class="fifteen wide column  " style="margin-left: 3%;">
                <div id="items">
                    <!-- <div style="text-align: center;"><h1 ><?php echo $invoice['qtitle'] ?></h1></div> -->
                        <div class="flags ui center aligned container">
                            <div class="flag">
                                <h2>ABCD EFGH IJKL MNOP QRST UVWXYZ</h2>
                                <div class="triangle-left"></div>
                                <div class="triangle-right"></div>
                            </div>
                        </div>
                            <br><br><br>
                    <table class=" celled striped center aligned" width="100%" id="table">
                        <thead>
                        <tr><th style="background-color: #dc1a2e;color: white;width:5%">S.NO</th>
                        <th style="background-color: #dc1a2e;color: white; width:35%" >Particulars</th>
                        <th style="background-color: #dc1a2e;color: white;width:15%">HSN Code</th>
                        <th style="background-color: #dc1a2e;color: white;width:10%">Quantity</th>
                        <th style="background-color: #dc1a2e;color: white;width:7%">Unit</th>
                        <th style="background-color: #dc1a2e;color: white;width:12%">Rate</th>
                        <th style="background-color: #dc1a2e;color: white;width:14%">Amount</th>
                        </tr></thead>
                        <tbody >
                            <?php foreach ($tableitemnames as $key => $tableitemname) { ?>
                                <tr >
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Name"><?php echo $slno; $slno++; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Age"><?php echo $tableitemname; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablehsncodes[$key]; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablequantity[$key]; ?></9</td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tableunits[$key]; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php  echo $tablerates[$key]; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tableamounts[$key]; ?></td>
                                </tr>
                            <?php  } ?>
                            
                            
                        </tbody>
                        
                    </table>
                </div> 
            </div>
            </div>
        
        
    </div>
    
    </div>
        <div id="qauthority" >
        <div class="ui grid">
        
                    <div class="nine wide column" style="margin-left: 3%;">
                            <div style="border-style: solid none solid solid;border-width:2px;border-color:#dc1a2e;font-weight: bold;width:650px;height:116px;padding-left:3%;padding-top:3%">
                                    
                        <h3 style="color: #dc1a2e;font-family: 'Eras ITC';">Amount In Words</h3>
                        <p><?php echo $invoice['subamtinwords']." Only"; ?></p>
                                </div>
                    </div>
                    <div class="six wide column" >
                    <table style="color:black;font-weight:bold;">
                <tbody>
                    <tr>
                        <td style="padding:10%;text-align:center">
                            <p style="font-weight: bold;">  Grand Total <span style="float: right"></span></p>
                        </td>
                        <td style="padding:10%;text-align:right;width:5%;">
                            <p style="font-size:x-large;">
                            <?php 
                            //$invoice['totalvalue']=IND_money_format($invoice['totalvalue']); 
                            echo $invoice['totalvalue']; 
                            ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
            <hr style="border-top: 2px solid black;"> <br>
            <div class="ui grid" >
                <div class="seven wide column" style="margin-left: 5%;">
                <h3 style="color: #dc1a2e;font-family: 'Eras ITC';font-weight: bold;"><b>Bank Details</b> </h3>
                        <p>Bank/AC No : INDUSIND BANK/259791661299</p>
                        <p>Branch/Ifsc : NATESAN NAGAR/INDB0001598</p>
                </div>
                <div class="eight wide column" >
                    <div >
                        <p style="padding-left:48%;">For <span style="font-family: 'Recharge';font-weight: bold;"> Ajeeth Engineering</span></p> 
                                <img src="../sources/aesignature.png" width="50%" style="margin-left: 50%;" alt="">
                        <p style="padding-left:55%;">Proprietor's Signature</p>
                    </div>
                </div>
            </div>
            <img src="../sources/bottominvoicedesign.png" id="bottom" alt="">
            </div>
        </div> 
    <!-- pdfmake  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 
    <script>
        //quotation
        
            function qExport() {
                // pdfmake
                var watermark={
    image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOkAAAC8CAYAAACddImnAAAACXBIWXMAAAsTAAALEwEAmpwYAAAK3GlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuMTY0NzUzLCAyMDIxLzAyLzE1LTExOjUyOjEzICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIiB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6ODY4ZTBiZmQtOGJmYi1hMzQyLWIzZTktOGM3NTUxMTU4NzRmIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiB0aWZmOk9yaWVudGF0aW9uPSIxIiB0aWZmOlhSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6WVJlc29sdXRpb249IjcyMDAwMC8xMDAwMCIgdGlmZjpSZXNvbHV0aW9uVW5pdD0iMiIgZXhpZjpDb2xvclNwYWNlPSI2NTUzNSIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjY3OSIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjQxOSI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBpbWFnZS9qcGVnIHRvIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmM4ZTYzZDRmLTAwODktZTA0Yy05YTEwLTQyZWFkYTEzMTY3OCIgc3RFdnQ6d2hlbj0iMjAyMy0wOS0yOFQyMDowMzoxNCswNTozMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjMgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo0ODUyODYzMy0wMTQ5LTJiNGQtOTdiYS0zNjczYzRlNjZlM2UiIHN0RXZ0OndoZW49IjIwMjMtMDktMjhUMjA6NDg6NDgrMDU6MzAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi4zIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY29udmVydGVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJmcm9tIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AgdG8gaW1hZ2UvcG5nIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJkZXJpdmVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJjb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDIwOjQ4OjQ4KzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ4NTI4NjMzLTAxNDktMmI0ZC05N2JhLTM2NzNjNGU2NmUzZSIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjMyMTVkZmJiLWUxODAtYWE0Yi1hODMxLWM3NzlhMThm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', // Set the image URL or base64 encoded image data
    opacity: 0.1, // Set the opacity of the watermark (0-1)
    fit: [200, 200], // Set the size of the watermark
    absolutePosition: { x: 200, y: 360 }
}
                html2canvas(document.getElementById('qpdf'), {
                    
                    onrendered: function(canvas1) {
                    // Do something with the first canvas element
                        var data = canvas1.toDataURL();
                    // Get the second canvas element
                        html2canvas(document.getElementById('qauthority'), {
                            onrendered: function(canvas2) {
                            // Do something with the second canvas element
                                var data2 = canvas2.toDataURL();
                                    var docDefinition = {
                                        pageOrientation: 'portrait',
                                        width: 595.28,
                                        height: 841.89,
                                        pageMargins: [0, 0, 0, 0],
                                        content: [
                                            {
                                            image: data,
                                            width: 595.28
                                        },
                                            {
                                            margin: [0, 0, 0, 0],
                                            image: data2,
                                            width: 595.28,
                                            absolutePosition: { y: 659}
                                        },
                                    ],
                                    background:[watermark]
                                    };
                                pdfMake.createPdf(docDefinition).download("<?php echo "Quotation/".$invoice['qno']."/".date("d/m/Y", strtotime($invoice['qdate'])).$invoice['companyname'] ?>.pdf");
                            }
                        });
                    }
                });
            }
        </script>
        <script>

            
        
            function Export() {
                // pdfmake
                var watermark={
    image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOkAAAC8CAYAAACddImnAAAACXBIWXMAAAsTAAALEwEAmpwYAAAK3GlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuMTY0NzUzLCAyMDIxLzAyLzE1LTExOjUyOjEzICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIiB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6ODY4ZTBiZmQtOGJmYi1hMzQyLWIzZTktOGM3NTUxMTU4NzRmIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiB0aWZmOk9yaWVudGF0aW9uPSIxIiB0aWZmOlhSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6WVJlc29sdXRpb249IjcyMDAwMC8xMDAwMCIgdGlmZjpSZXNvbHV0aW9uVW5pdD0iMiIgZXhpZjpDb2xvclNwYWNlPSI2NTUzNSIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjY3OSIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjQxOSI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBpbWFnZS9qcGVnIHRvIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmM4ZTYzZDRmLTAwODktZTA0Yy05YTEwLTQyZWFkYTEzMTY3OCIgc3RFdnQ6d2hlbj0iMjAyMy0wOS0yOFQyMDowMzoxNCswNTozMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjMgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo0ODUyODYzMy0wMTQ5LTJiNGQtOTdiYS0zNjczYzRlNjZlM2UiIHN0RXZ0OndoZW49IjIwMjMtMDktMjhUMjA6NDg6NDgrMDU6MzAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi4zIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY29udmVydGVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJmcm9tIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AgdG8gaW1hZ2UvcG5nIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJkZXJpdmVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJjb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDIwOjQ4OjQ4KzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ4NTI4NjMzLTAxNDktMmI0ZC05N2JhLTM2NzNjNGU2NmUzZSIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjMyMTVkZmJiLWUxODAtYWE0Yi1hODMxLWM3NzlhMThm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', // Set the image URL or base64 encoded image data
    opacity: 0.1, // Set the opacity of the watermark (0-1)
    fit: [200, 200], // Set the size of the watermark
    absolutePosition: { x: 200, y: 360 }
}
                html2canvas(document.getElementById('pdf'), {
                    
                    onrendered: function(canvas1) {
                    // Do something with the first canvas element
                        var data = canvas1.toDataURL();
                    // Get the second canvas element
                        html2canvas(document.getElementById('authority'), {
                            onrendered: function(canvas2) {
                            // Do something with the second canvas element
                                var data2 = canvas2.toDataURL();
                                    var docDefinition = {
                                        pageOrientation: 'portrait',
                                        width: 595.28,
                                        height: 841.89,
                                        pageMargins: [0, 0, 0, 0],
                                        content: [
                                            {
                                            image: data,
                                            width: 595.28
                                        },
                                            {
                                            margin: [0, 0, 0, 0],
                                            image: data2,
                                            width: 595.28,
                                            absolutePosition: { y: 583}
                                        },
                                    ],
                                    background:[watermark]
                                    };
                                pdfMake.createPdf(docDefinition).download("<?php echo "TaxInvoice/".$invoice['invoiceno']."/".date("d/m/Y", strtotime($invoice['invoicedate'])).$invoice['companyname'] ?>.pdf");
                            }
                        });
                    }
                });
            }
        </script>
        <!-- DELIVERY CHALLAN -->
        
        
    <div id="deliverychallan" style="margin-top: 30%;">
        
        <div id="dcpdf">
            <div id="details">
                <img src="../sources/topdcdesign.png" alt="" id="top"> <span id="dctodaydate"><?php echo date("d-m-Y", strtotime($invoice['dcdate'])); ?></span>
                <span id="dcinvoiceno"><?php echo $invoice['dcno']; ?></span>
        <div class="ui grid">
            <div class="eight wide column">
                <div style="margin-left: 10%;"> 
                <p style="color: #dc1a2e;"><?php echo $invoicecompany[0]['csalutation']; ?></p>
                <p ><?php echo $invoicecompany[0]['cname']; ?> <br>
                <?php if ($invoicecompany[0]['caddress']!=null) {?>    <?php echo $invoicecompany[0]['caddress']; ?>  <br> <?php }?>
                <?php if ($invoicecompany[0]['cstreet']!=null) {?>    <?php echo $invoicecompany[0]['cstreet']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['carea']!=null) {?>    <?php echo $invoicecompany[0]['carea']; ?>  <br><?php }?>
                <?php if ($invoicecompany[0]['cdistrict']!=null) {?>    <?php echo $invoicecompany[0]['cdistrict']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cstate']!=null) {?>    <?php echo $invoicecompany[0]['cstate']."-".$invoicecompany[0]['cpincode']; ?> <br><?php }?>
                <?php if ($invoicecompany[0]['cgstno']!=null) {?> <span >GSTIN  : <span><?php echo $invoicecompany[0]['cgstno'] ?></span></span></p><?php }?>
    
                        
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui grid" >
                    <div class="eight wide column" style="margin-top: 12%;">
                        <div>
                            
                            <p >Vendor No &nbsp;: <span><?php 
                            echo $invoice['vendorno'] ?></span></p>
                            <p >Order No &emsp;: <span><?php echo $invoice['orderno'] ?></span></p>
                            <p >Challan No : <span><?php echo $invoice['challanno'] ?></span></p>
                            <p >Vehicle No : <span><?php echo $invoice['vehicleno'] ?></span></p>
                        </div>
                    </div>
                    <div class="seven wide column" style="margin-top: 15%;"><br>
                        <div >
                            <p style="padding-right: 3%;">Date : <span><?php 
                            
                            if ($invoice['orderdate']!=null) {
                                echo date(date("d-m-Y", strtotime($invoice['orderdate']))); 
                            }
                            ?></span></p>
                            <p style="padding-right: 3%;">Date : <span><?php 
                            if ($invoice['orderdate']!=null) {
                                echo date(date("d-m-Y", strtotime($invoice['challandate'])));
                            }
                            ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui grid">
            <div class="fifteen wide column" style="margin-left: 3%;">
                <div id="items">
                    <table class=" celled  striped center aligned " id="table" width="100%">
                        <thead>
                        <tr><th style="background-color: #dc1a2e;color: white;width:5%;">S.NO</th>
                        <th style="background-color: #dc1a2e;color: white;width:35%" >Particulars</th>
                        <th style="background-color: #dc1a2e;color: white;">HSN Code</th>
                        <th style="background-color: #dc1a2e;color: white;">Quantity</th>
                        <th style="background-color: #dc1a2e;color: white;">Unit</th>
                        </tr></thead>
                        <tbody >
                            <?php $slno=1; foreach ($tableitemnames as $key => $tableitemname) { ?>
                                <tr  >
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Name"><?php echo $slno; $slno++; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Age"><?php echo $tableitemname; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablehsncodes[$key]; ?></td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tablequantity[$key]; ?></9</td>
                                    <td id="tabletd" style="text-align:center;padding: 1%;color:black" data-label="Job"><?php echo $tableunits[$key]; ?></td>
                                </tr>
                            <?php  } ?>
                            
                            
                        </tbody>
                        
                    </table>
                </div> 
            </div>
            </div>
        
        
    </div>
    
    </div>
    
        <div id="dcauthority" >
            <div class="ui grid" >
                <div class="six wide column"></div>
                <div class="nine wide column" >
                    <div >
                        <p style="padding-left:55%;">For <span style="font-family: 'Recharge';font-weight: bold;"> Ajeeth Engineering</span></p><img src="../sources/aesignature.png" width="50%" style="margin-left: 50%;" alt="">
                        <p style="padding-left:60%;">Proprietor's Signature</p>
                    </div>
                </div>
            </div>
            <img src="../sources/bottominvoicedesign.png" id="bottom" alt="">
            </div>
        </div> 
        
    <!-- pdfmake  -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> 
        <script>
            
        
            function dcExport() {
                // pdfmake
                var watermark={
    image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOkAAAC8CAYAAACddImnAAAACXBIWXMAAAsTAAALEwEAmpwYAAAK3GlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNi4wLWMwMDYgNzkuMTY0NzUzLCAyMDIxLzAyLzE1LTExOjUyOjEzICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIiB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAyMy0wOS0yOFQyMDo0ODo0OCswNTozMCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiB4bXBNTTpEb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6ODY4ZTBiZmQtOGJmYi1hMzQyLWIzZTktOGM3NTUxMTU4NzRmIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InhtcC5kaWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiB0aWZmOk9yaWVudGF0aW9uPSIxIiB0aWZmOlhSZXNvbHV0aW9uPSI3MjAwMDAvMTAwMDAiIHRpZmY6WVJlc29sdXRpb249IjcyMDAwMC8xMDAwMCIgdGlmZjpSZXNvbHV0aW9uVW5pdD0iMiIgZXhpZjpDb2xvclNwYWNlPSI2NTUzNSIgZXhpZjpQaXhlbFhEaW1lbnNpb249IjY3OSIgZXhpZjpQaXhlbFlEaW1lbnNpb249IjQxOSI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZjM4NGRmM2ItOGY5Zi05ZDQ3LWJiYjAtNDhlZDc3NDBhYWE0IiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDE4OjU0OjMxKzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNvbnZlcnRlZCIgc3RFdnQ6cGFyYW1ldGVycz0iZnJvbSBpbWFnZS9qcGVnIHRvIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOmM4ZTYzZDRmLTAwODktZTA0Yy05YTEwLTQyZWFkYTEzMTY3OCIgc3RFdnQ6d2hlbj0iMjAyMy0wOS0yOFQyMDowMzoxNCswNTozMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIyLjMgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo0ODUyODYzMy0wMTQ5LTJiNGQtOTdiYS0zNjczYzRlNjZlM2UiIHN0RXZ0OndoZW49IjIwMjMtMDktMjhUMjA6NDg6NDgrMDU6MzAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMi4zIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0iY29udmVydGVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJmcm9tIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AgdG8gaW1hZ2UvcG5nIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJkZXJpdmVkIiBzdEV2dDpwYXJhbWV0ZXJzPSJjb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZyIvPiA8cmRmOmxpIHN0RXZ0OmFjdGlvbj0ic2F2ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZTY1OWExNzMtOTYwYy04NzQ4LTlkNGYtZGFlNGM2Y2UxMzcyIiBzdEV2dDp3aGVuPSIyMDIzLTA5LTI4VDIwOjQ4OjQ4KzA1OjMwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjIuMyAoV2luZG93cykiIHN0RXZ0OmNoYW5nZWQ9Ii8iLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ4NTI4NjMzLTAxNDktMmI0ZC05N2JhLTM2NzNjNGU2NmUzZSIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjMyMTVkZmJiLWUxODAtYWE0Yi1hODMxLWM3NzlhMThm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', // Set the image URL or base64 encoded image data
    opacity: 0.1, // Set the opacity of the watermark (0-1)
    fit: [200, 200], // Set the size of the watermark
    absolutePosition: { x: 200, y: 360 }
}
                html2canvas(document.getElementById('dcpdf'), {
                    useCORS: true,
                    onrendered: function(canvas1) {
                    // Do something with the first canvas element
                        var data = canvas1.toDataURL();
                    // Get the second canvas element
                        html2canvas(document.getElementById('dcauthority'), {
                            useCORS: true,
                            onrendered: function(canvas2) {
                            // Do something with the second canvas element
                                var data2 = canvas2.toDataURL();
                                    var docDefinition = {
                                        pageOrientation: 'portrait',
                                        width: 595.28,
                                        height: 841.89,
                                        pageMargins: [0, 0, 0, 0],
                                        content: [
                                            {
                                            image: data,
                                            width: 595.28
                                        },
                                            {
                                            margin: [0, 0, 0, 0],
                                            image: data2,
                                            width: 595.28,
                                            absolutePosition: { y: 735}
                                        },
                                    ],
                                    background:[watermark]
                                    };
                                pdfMake.createPdf(docDefinition).download("<?php echo "Delivery Challan/".$invoice['dcno']."/".date("d/m/Y", strtotime($invoice['dcdate'])).$invoice['companyname'] ?>.pdf");
                            }
                        });
                    }
                });
            }
        </script>
        <?php }    
    }
        ?>
        <?php if ($output=="all" || $output=="tax invoice") {?>
                <script>
                    Export();
                </script>
                <?php }?>

                <?php if ($output=="all" || $output=="quotation") {?>
                <script>
                    qExport();
                </script>
                <?php }?>

                <?php if ($output=="all" || $output=="delivery challan") { ?>
                <script>
                    dcExport();
                </script>
                <?php }?>
<script src="../js/scriptvariables.js"></script>
    <script src="../js/taxinvoicescript.js"></script>

    <script>
        transactions=<?php echo json_encode($transactions);  ?>;
        companyname=[<?php echo $companyname; ?>];
        companys=<?php echo json_encode($companys);  ?>;
        $('#csearch').search({source: companyname,
            onSelect: function(result, response) {
                
                    $('#csearch').search('hide results');
                    search(result.title);
                }
        });
    </script>
</body>
</html>