//smeantic ui scripts
const openModal = () => {
    $('.ui.modal').modal('setting','transition', 'horizontal flip').modal('show');
}
    
    $('.ui.dropdown').dropdown();

    

//functions
  document.getElementById("invoicedate").valueAsDate = new Date(); 
function search(cname) { 
    for (let i = 0; i < companys.length; i++) {
        if (cname==companys[i]['cname']) {
            document.getElementById("cusgstno").value=companys[i]['cgstno'];
            document.getElementById("vendorno").value=companys[i]['cvendorno'];
            if (companys[i]['cstate']!='Pondicherry' || companys[i]['cstate']!='PONDICHERRY' || companys[i]['cstate']!='PUDUCHERRY' || companys[i]['cstate']!='Puducherry') {
                document.getElementById("gsttype").value='igst';
                                
            }
            else{
                document.getElementById("gsttype").value='sgst';
            }
        }
        
    }
}

document.getElementById("itemsadded").value=itemsadded;
poi=1;
function adddetails() { 
    itemsadded++;

    for (var i = 1; i <= itemsadded; i++) { 
        if (i<itemsadded) {
            continue;
        }
        else{
            //create element
            row[i]=document.createElement("tr");
            td1[i]=document.createElement("td");
            td2[i]=document.createElement("td");
            td3[i]=document.createElement("td");
            td4[i]=document.createElement("td");
            td5[i]=document.createElement("td");
            td6[i]=document.createElement("td");
            col1[i]=document.createElement("div");
            col2[i]=document.createElement("div");
            col3[i]=document.createElement("div");
            col4[i]=document.createElement("div");
            col5[i]=document.createElement("div");
            itemdetailsinput[i]=document.createElement("textarea");
            quantityinput[i]=document.createElement("input");
            select[i]=document.createElement("select");
            option1[i]=document.createElement("option");
            option2[i]=document.createElement("option");
            option3[i]=document.createElement("option");
            option4[i]=document.createElement("option");
            option5[i]=document.createElement("option");
            rateinput[i]=document.createElement("input");
            amountinput[i]=document.createElement("input");
            hsninput[i]=document.createElement("input");
            
            //define created element
            row[i].id="row"+i;
            col1[i].className="sixteen wide field";
            col1[i].id="col1"+c; c++;
            col2[i].className="sixteen wide field";
            col2[i].id="col2"+c;c++;
            col3[i].className="sixteen wide field";
            col3[i].id="qcol"+c;c++;
            col4[i].className="sixteen wide field";
            col4[i].id="col4"+c;c++;
            col5[i].className="sixteen wide field";
            col5[i].id="cid"+c;c++;
            td1[i].id="td"+k; k++;
            td2[i].id="td"+k; k++; 
            td3[i].id="qid"+k; k++;
            td4[i].id="td"+k; k++;
            td5[i].id="td"+k; k++;
            td6[i].id="std"+k; k++;
            
            itemdetailsinput[i].type="text";
            itemdetailsinput[i].name="item"+i;
            itemdetailsinput[i].placeholder="Enter Item Details";
            itemdetailsinput[i].id="item"+i;
            itemdetailsinput[i].cols="30";
            itemdetailsinput[i].rows="3";
            
            hsninput[i].type="text";
            hsninput[i].name="hsncode"+i;
            hsninput[i].placeholder="Enter HSN code";
            hsninput[i].id="hsncode"+i;
            
            quantityinput[i].type="number";
            quantityinput[i].name="quantity"+i;
            quantityinput[i].placeholder="Enter Quantity";
            quantityinput[i].id="quantity"+i;

            select[i].name="units"+i;
            select[i].className="ui selection dropdown";
            select[i].id="units"+i;
            option1[i].value="";
            option1[i].id="option1"+i;
            option2[i].id="option2"+i;
            option3[i].id="option3"+i;
            option4[i].id="option4"+i
            option5[i].id="option5"+i;
            option2[i].value="KG";
            option3[i].value="Pairs";
            option4[i].value="No.";
            option5[i].value="Tonne";

            rateinput[i].type="text";
            rateinput[i].name="rate"+i;
            rateinput[i].id="rate"+i;
            rateinput[i].placeholder="Enter Rate";
            rateinput[i].addEventListener("keypress", function(event) {
                amountss(event,this.id,this.parentNode.id);
            });
            
            amountinput[i].type="number";
            amountinput[i].name="amount"+i;
            amountinput[i].id="amount"+i;
            amountinput[i].placeholder="Enter Amount";
            //insert created elements
            k-=6;
            c-=5;
            document.getElementById("tablebody").appendChild(row[i]);
            document.getElementById("row"+i).appendChild(td1[i]); 
            document.getElementById("td"+k).appendChild(col1[i]);k++;
            document.getElementById("col1"+c).appendChild(itemdetailsinput[i]);c++;
            document.getElementById("row"+i).appendChild(td2[i]);
            document.getElementById("td"+k).appendChild(col2[i]);k++;
            document.getElementById("col2"+c).appendChild(hsninput[i]);c++;
            document.getElementById("row"+i).appendChild(td3[i]);
            document.getElementById("qid"+k).appendChild(col3[i]);k++;
            document.getElementById("qcol"+c).appendChild(quantityinput[i]);c++;
            document.getElementById("row"+i).appendChild(td4[i]);
            document.getElementById("td"+k).appendChild(select[i]);k++;
            document.getElementById("units"+i).appendChild(option1[i]);
            document.getElementById("units"+i).appendChild(option2[i]);
            document.getElementById("units"+i).appendChild(option3[i]);
            document.getElementById("units"+i).appendChild(option4[i]);
            document.getElementById("units"+i).appendChild(option5[i]);
            document.getElementById("option1"+i).innerText="Select a Unit";
            document.getElementById("option2"+i).innerText="KG (KiloGram)";
            document.getElementById("option3"+i).innerText="Pairs";
            document.getElementById("option4"+i).innerText="No.";
            document.getElementById("option5"+i).innerText="Tonne";
            document.getElementById("row"+i).appendChild(td5[i]);
            document.getElementById("td"+k).appendChild(col4[i]);k++;
            document.getElementById("col4"+c).appendChild(rateinput[i]);c++;
            document.getElementById("row"+i).appendChild(td6[i]);
            document.getElementById("std"+k).appendChild(col5[i]);k++;
            document.getElementById("cid"+c).appendChild(amountinput[i]);c++;;
        }
    }
}

function amountss(event,aid,paid) {
    if (event.key === "Enter") {
    paid1=document.getElementById(paid).parentNode.parentNode.id;
    qid=document.getElementById(paid1).children[2].children[0].children[0].id;
    amid=document.getElementById(paid1).children[5].children[0].children[0].id;
    qty = document.getElementById(qid).value;
    rat=document.getElementById(aid).value;
    amount=qty*rat; 
    document.getElementById(amid).value = amount;

        totalvalue+=amount; 
    document.getElementById("totvalue").innerHTML = totalvalue;
    
    gst=document.getElementById("gsttype").value;  
    gstpercentage= document.getElementById("gstpercentage").value;
    
    if (gst=='sgst') {
        sgstpercentage= gstpercentage/2; 
    }
    igst=(totalvalue*gstpercentage)/100;
    cgst=(totalvalue*sgstpercentage)/100; 
    sgst=(totalvalue*sgstpercentage)/100; 
    if (gst=='igst') {
        document.getElementById("igstper").innerHTML=gstpercentage;
        document.getElementById("sgstper").innerHTML=sgstpercentage;
        document.getElementById("cgstper").innerHTML=sgstpercentage;
        document.getElementById("igst").innerHTML=igst;
        document.getElementById("cgst").innerHTML=0;
        document.getElementById("sgst").innerHTML=0;
        subtotal=totalvalue+igst;
        adjustedamount=Math.round(subtotal);
        document.getElementById("subtotal").innerHTML=subtotal;
        document.getElementById("adjustment").value=adjustedamount;
        document.getElementById("grandtot").innerHTML=adjustedamount;


    }
    if (gst=='sgst') {
        document.getElementById("sgstper").innerHTML=sgstpercentage;
        document.getElementById("cgstper").innerHTML=sgstpercentage;
        document.getElementById("igstper").innerHTML="0";
        document.getElementById("cgst").innerHTML=cgst;
        document.getElementById("sgst").innerHTML=sgst;
        document.getElementById("igst").innerHTML=0;
        subtotal=totalvalue+igst;
        adjustedamount=Math.round(subtotal);

        document.getElementById("subtotal").innerHTML=subtotal;
        document.getElementById("adjustment").value=adjustedamount;
        document.getElementById("grandtot").innerHTML=adjustedamount;



    }
    
    var amountinwords = numberToWords(adjustedamount);
    var subamountinwords = numberToWords(totalvalue);
    document.getElementById("amtwords").innerHTML=amountinwords;
    document.getElementById("subamtwords").innerHTML=subamountinwords;
    event.preventDefault();
    }
    
}
function fun_gstpercentage(value) {
    gst=document.getElementById("gsttype").value;  
    gstpercentage= document.getElementById("gstpercentage").value;
    if (gst=='sgst') {
        sgstpercentage= gstpercentage/2;
    }
    igst=(totalvalue*gstpercentage)/100;
    cgst=(totalvalue*sgstpercentage)/100; 
    sgst=(totalvalue*sgstpercentage)/100; 
    if (gst=='igst') {
        document.getElementById("igstper").innerHTML=gstpercentage;
        document.getElementById("sgstper").innerHTML=sgstpercentage;
        document.getElementById("cgstper").innerHTML=sgstpercentage;
        document.getElementById("igst").innerHTML=igst;
        document.getElementById("cgst").innerHTML=0;
        document.getElementById("sgst").innerHTML=0;
        subtotal=totalvalue+igst;
        adjustedamount=Math.round(subtotal);
        document.getElementById("subtotal").innerHTML=subtotal;
        document.getElementById("adjustment").value=adjustedamount;
        document.getElementById("grandtot").innerHTML=adjustedamount;


    }
    if (gst=='sgst') {
        document.getElementById("sgstper").innerHTML=sgstpercentage;
        document.getElementById("cgstper").innerHTML=sgstpercentage;
        document.getElementById("igstper").innerHTML="0";
        document.getElementById("cgst").innerHTML=cgst;
        document.getElementById("sgst").innerHTML=sgst;
        document.getElementById("igst").innerHTML=0;
        subtotal=totalvalue+igst;
        adjustedamount=Math.round(subtotal);

        document.getElementById("subtotal").innerHTML=subtotal;
        document.getElementById("adjustment").value=adjustedamount;
        document.getElementById("grandtot").innerHTML=adjustedamount;



    }
    
    var amountinwords = numberToWords(adjustedamount);
    var subamountinwords = numberToWords(totalvalue);
    document.getElementById("amtwords").innerHTML=amountinwords;
    document.getElementById("subamtwords").innerHTML=subamountinwords;

}


function adjustments() {
    grandtotal=document.getElementById("adjustment").value;
    document.getElementById("grandtot").innerHTML=grandtotal;
    
    var amountinwords = numberToWords(grandtotal);
    document.getElementById("amtwords").innerHTML=amountinwords;
    
    
}
function numberToWords(number) {
    var words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
    var tensWords = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    var hundredWords = "Hundred";
    var thousandWords = "Thousand";
    var lakhWords = "Lakh";
    var croreWords = "Crore";
    if (number < 0) {
        return "Negative " + numberToWords(Math.abs(number));
    } else if (number < 10) {
        return words[number];
    } else if (number < 100) {
        var tensDigit = Math.floor(number / 10);
        var onesDigit = number % 10;
        var result = tensWords[tensDigit];
        if (onesDigit > 0) {
            result += " " + words[onesDigit];
        }
        return result;
    } else if (number < 1000) {
        var hundredsDigit = Math.floor(number / 100);
        var remainder = number % 100;
        var result = words[hundredsDigit] + " " + hundredWords;
        if (remainder > 0) {
            result += " And " + numberToWords(remainder);
        }
        return result;
    } else if (number < 100000) {
        var thousandsDigit = Math.floor(number / 1000);
        var remainder = number % 1000;
        var result = numberToWords(thousandsDigit) + " " + thousandWords;
        if (remainder > 0) {
            result += " " + numberToWords(remainder);
        }
        return result;
    } else if (number < 10000000) {
        var lakhsDigit = Math.floor(number / 100000);
        var remainder = number % 100000;
        var result = numberToWords(lakhsDigit) + " " + lakhWords;
        if (remainder > 0) {
            result += " " + numberToWords(remainder);
        }
        return result;
    } else {
        var croresDigit = Math.floor(number / 10000000);
        var remainder = number % 10000000;
        var result = numberToWords(croresDigit) + " " + croreWords;
        if (remainder > 0) {
            result += " " + numberToWords(remainder);
        }
        return result;
    }
}
    


function geninvoices() { 
    invoicetotalvalue=document.getElementById("totvalue").innerHTML;
    invoicecgst=document.getElementById("cgst").innerHTML;
    invoicesgst=document.getElementById("sgst").innerHTML;
    invoiceigst=document.getElementById("igst").innerHTML;
    invoicesubtotal=document.getElementById("subtotal").innerHTML;
    invoicegrandtot=document.getElementById("grandtot").innerHTML;
    gstpercentagevalue=document.getElementById("gstpercentage").value;
    
    document.getElementById("invoicetotalvalue").value=invoicetotalvalue;
    document.getElementById("invoicecgst").value=invoicecgst;
    document.getElementById("invoicesgst").value=invoicesgst;
    document.getElementById("invoiceigst").value=invoiceigst;
    document.getElementById("invoicesubtotal").value=invoicesubtotal;
    document.getElementById("invoicegrandtot").value=invoicegrandtot;
    var l=0;
    for (var i = 1; i <= itemsadded; i++) {
        items[l]=document.getElementById("item"+i).value;
        hsncodes[l]=document.getElementById("hsncode"+i).value;
        quantitys[l]=document.getElementById("quantity"+i).value;
        unit[l]=document.getElementById("units"+i).value;
        rates[l]=document.getElementById("rate"+i).value;
        amounts[l]=document.getElementById("amount"+i).value;
        l++;
        
    }
    var JSONstr = JSON.stringify(items);
    var JSONstr1 = JSON.stringify(hsncodes);
    var JSONstr2 = JSON.stringify(quantitys);
    var JSONstr3 = JSON.stringify(unit);
    var JSONstr4 = JSON.stringify(rates);
    var JSONstr5 = JSON.stringify(amounts);
    document.getElementById("items").value=JSONstr;
    document.getElementById("hsncodes").value=JSONstr1;
    document.getElementById("quantitys").value=JSONstr2;
    document.getElementById("units").value=JSONstr3;
    document.getElementById("rates").value=JSONstr4;
    document.getElementById("amounts").value=JSONstr5;
    document.getElementById("gstpercentagevalue").value=gstpercentagevalue;
}

function fun_search(event,no) {
    if (event.key === "Enter") {
        for (let a = 0; a < transactions.length; a++) {
            if (transactions[a]['invoiceno']==no || transactions[a]['dcno']==no || transactions[a]['qno']==no) { 
                document.getElementById("invoiceno").value=transactions[a]['invoiceno'];
                document.getElementById("invoicedate").value=transactions[a]['invoicedate'];
                document.getElementById("vendorno").value=transactions[a]['vendorno'];
                document.getElementById("challanno").value=transactions[a]['challanno'];
                document.getElementById("vehicleno").value=transactions[a]['vehicleno'];
                document.getElementById("challandate").value=transactions[a]['challandate'];
                document.getElementById("cname").value=transactions[a]['companyname'];
                document.getElementById("orderno").value=transactions[a]['orderno'];
                document.getElementById("dcno").value=transactions[a]['dcno'];
                document.getElementById("quno").value=transactions[a]['qno'];
                document.getElementById("cusgstno").value=transactions[a]['customergstno'];
                document.getElementById("orderdate").value=transactions[a]['orderdate'];
                document.getElementById("dcdate").value=transactions[a]['dcdate'];
                document.getElementById("qudate").value=transactions[a]['qdate'];
                document.getElementById("qtitle").value=transactions[a]['qtitle'];
                document.getElementById("totvalue").innerHTML=transactions[a]['totalvalue'];
                document.getElementById("sgst").innerHTML=transactions[a]['sgst'];
                document.getElementById("cgst").innerHTML=transactions[a]['cgst'];
                document.getElementById("igst").innerHTML=transactions[a]['igst'];
                document.getElementById("subtotal").innerHTML=transactions[a]['subtotal'];
                document.getElementById("adjustment").value=transactions[a]['adjustment'];
                document.getElementById("grandtot").innerHTML=transactions[a]['grandtotal'];
                document.getElementById("amtwords").value=transactions[a]['amtinwords'];
                document.getElementById("subamtwords").value=transactions[a]['subamtinwords'];
                document.getElementById("gsttype").value=transactions[a]['gsttype'];
                if (transactions[a]['gsttype']=='igst') {
                    document.getElementById("igstper").innerHTML=transactions[a]['gstpercentage'];
                    document.getElementById("sgstper").innerHTML="0";
                    document.getElementById("cgstper").innerHTML="0";
            
            
                }
                if (transactions[a]['gsttype']=='sgst') {
                    document.getElementById("sgstper").innerHTML=transactions[a]['gstpercentage']/2;
                    document.getElementById("cgstper").innerHTML=transactions[a]['gstpercentage']/2;
                    document.getElementById("igstper").innerHTML="0";
            
            
            
                }
                if (transactions[a]['gstpercentage']==12) {
                    document.getElementById("gstpercentage").innerHTML="<option disabled value='Select a Percentage'>Select a Percentage</option><option id='gst12' value='12' selected>12%</option><option id='gst18' value='18' >18%</option>";
                }
                else{
                    document.getElementById("gstpercentage").innerHTML="<option disabled value='Select a Percentage'>Select a Percentage</option><option id='gst12' value='12'>12%</option><option id='gst18' value='18' selected>18%</option>";
                }
                
                invoiceitemnames=transactions[a]['itemname'].split("~");
                invoicequantity=transactions[a]['quantity'].split(",");
                invoiceunits=transactions[a]['units'].split(",");
                invoicerates=transactions[a]['rate'].split(",");
                invoiceamounts=transactions[a]['amounts'].split("~");
                invoicehsncodes=transactions[a]['hsncode'].split(",");
                invoiceitemsno=invoiceitemnames.length;
                document.getElementById("item1").value=invoiceitemnames[0];
                document.getElementById("hsncode1").value=invoicehsncodes[0];
                document.getElementById("quantity1").value=invoicequantity[0];
                document.getElementById("rate1").value=invoicerates[0];
                document.getElementById("amount1").value=invoiceamounts[0];
                if (invoiceunits[0]=='KG') {
                    document.getElementById("units1").innerHTML="<option id='option1' value=''>Select a Unit</option><option id='option2' selected value='KG'>KG (KiloGram)</option><option id='option3' value='Pairs'>Pairs</option><option id='option4' value='No.'>No.</option><option id='option5' value='Tonne'>Tonne</option>";
                }
                else if (invoiceunits[0]=='Pairs') {
                    document.getElementById("units1").innerHTML="<option id='option1' value=''>Select a Unit</option><option id='option2' value='KG'>KG (KiloGram)</option><option id='option3' selected value='Pairs'>Pairs</option><option id='option4' value='No.'>No.</option><option id='option5' value='Tonne'>Tonne</option>";
                }
                else if (invoiceunits[0]=='No.') {
                    document.getElementById("units1").innerHTML="<option id='option1' value=''>Select a Unit</option><option id='option2' value='KG'>KG (KiloGram)</option><option id='option3' value='Pairs'>Pairs</option><option id='option4' selected value='No.'>No.</option><option id='option5' value='Tonne'>Tonne</option>";
                }
                else if (invoiceunits[0]=='Tonne') {
                    document.getElementById("units1").innerHTML="<option id='option1' value=''>Select a Unit</option><option id='option2' value='KG'>KG (KiloGram)</option><option id='option3' value='Pairs'>Pairs</option><option id='option4' value='No.'>No.</option><option id='option5' selected value='Tonne'>Tonne</option>";
                }
                var k=2;
                var c=2;
                var j=1;
    for (var i = 2; i <= invoiceitemsno; i++) { 
            //create element
            row[i]=document.createElement("tr");
            td1[i]=document.createElement("td");
            td2[i]=document.createElement("td");
            td3[i]=document.createElement("td");
            td4[i]=document.createElement("td");
            td5[i]=document.createElement("td");
            td6[i]=document.createElement("td");
            col1[i]=document.createElement("div");
            col2[i]=document.createElement("div");
            col3[i]=document.createElement("div");
            col4[i]=document.createElement("div");
            col5[i]=document.createElement("div");
            itemdetailsinput[i]=document.createElement("textarea");
            quantityinput[i]=document.createElement("input");
            select[i]=document.createElement("select");
            option1[i]=document.createElement("option");
            option2[i]=document.createElement("option");
            option3[i]=document.createElement("option");
            option4[i]=document.createElement("option");
            option5[i]=document.createElement("option");
            rateinput[i]=document.createElement("input");
            amountinput[i]=document.createElement("input");
            hsninput[i]=document.createElement("input");

            //define created element
            row[i].id="row"+i;
            col1[i].className="sixteen wide field";
            col1[i].id="col1"+c; c++;
            col2[i].className="sixteen wide field";
            col2[i].id="col2"+c;c++;
            col3[i].className="sixteen wide field";
            col3[i].id="qcol"+c;c++;
            col4[i].className="sixteen wide field";
            col4[i].id="col4"+c;c++;
            col5[i].className="sixteen wide field";
            col5[i].id="cid"+c;c++;
            td1[i].id="td"+k; k++;
            td2[i].id="td"+k; k++; 
            td3[i].id="qid"+k; k++;
            td4[i].id="td"+k; k++;
            td5[i].id="td"+k; k++;
            td6[i].id="std"+k; k++;

            itemdetailsinput[i].type="text";
            itemdetailsinput[i].name="item"+i;
            itemdetailsinput[i].placeholder="Enter Item Details";
            itemdetailsinput[i].id="item"+i;
            itemdetailsinput[i].cols="30";
            itemdetailsinput[i].rows="3";
            itemdetailsinput[i].value=invoiceitemnames[j];
            
            hsninput[i].type="text";
            hsninput[i].name="hsncode"+i;
            hsninput[i].placeholder="Enter HSN code";
            hsninput[i].id="hsncode"+i;
            if (invoicehsncodes[j]!=null) {
                hsninput[i].value=invoicehsncodes[j];
            }else{
                hsninput[i].value="";
            }
            

            quantityinput[i].type="number";
            quantityinput[i].name="quantity"+i;
            quantityinput[i].placeholder="Enter Quantity";
            quantityinput[i].id="quantity"+i;
            if (invoicequantity[j]!=null) {
                quantityinput[i].value=invoicequantity[j];
            }else{
                quantityinput[i].value="";
            }

            select[i].name="units"+i;
            select[i].className="ui selection dropdown";
            select[i].id="units"+i;
            option1[i].value="";
            option1[i].id="option1"+i;
            option2[i].id="option2"+i;
            option3[i].id="option3"+i;
            option4[i].id="option4"+i
            option5[i].id="option5"+i;
            option2[i].value="KG";
            option3[i].value="Pairs";
            option4[i].value="No.";
            option5[i].value="Tonne";
            
            rateinput[i].type="text";
            rateinput[i].name="rate"+i;
            rateinput[i].id="rate"+i;
            rateinput[i].placeholder="Enter Rate";
            rateinput[i].value=invoicerates[j];
            rateinput[i].addEventListener("keypress", function(event) {
                amountss(event,this.id,this.parentNode.id);
            });
            
            amountinput[i].type="number";
            amountinput[i].name="amount"+i;
            amountinput[i].id="amount"+i;
            amountinput[i].placeholder="Enter Amount";
            amountinput[i].value=invoiceamounts[j];
            if (invoiceamounts[j]!=null) {
                amountinput[i].value=invoiceamounts[j];
            }else{
                amountinput[i].value="";
            }
            //insert created elements
            k-=6;
            c-=5; ;
            document.getElementById("tablebody").appendChild(row[i]);
            document.getElementById("row"+i).appendChild(td1[i]); 
            document.getElementById("td"+k).appendChild(col1[i]);k++;
            document.getElementById("col1"+c).appendChild(itemdetailsinput[i]);c++;
            document.getElementById("row"+i).appendChild(td2[i]);
            document.getElementById("td"+k).appendChild(col2[i]);k++;
            document.getElementById("col2"+c).appendChild(hsninput[i]);c++;
            document.getElementById("row"+i).appendChild(td3[i]);
            document.getElementById("qid"+k).appendChild(col3[i]);k++;
            document.getElementById("qcol"+c).appendChild(quantityinput[i]);c++;
            document.getElementById("row"+i).appendChild(td4[i]);
            document.getElementById("td"+k).appendChild(select[i]);k++;
            if (invoiceunits[i-1]=='KG') {
                option2[i].setAttribute("selected", true);
                document.getElementById("units"+i).appendChild(option1[i]);
                document.getElementById("units"+i).appendChild(option2[i]);
                document.getElementById("units"+i).appendChild(option3[i]);
                document.getElementById("units"+i).appendChild(option4[i]);
                document.getElementById("units"+i).appendChild(option5[i]);
            }
            else if (invoiceunits[i-1]=='Pairs') {
                option3[i].setAttribute("selected", true);
                document.getElementById("units"+i).appendChild(option1[i]);
                document.getElementById("units"+i).appendChild(option2[i]);
                document.getElementById("units"+i).appendChild(option3[i]);
                document.getElementById("units"+i).appendChild(option4[i]);
                document.getElementById("units"+i).appendChild(option5[i]);
            }
            else if (invoiceunits[i-1]=='No.') {
                option4[i].setAttribute("selected", true);
                document.getElementById("units"+i).appendChild(option1[i]);
                document.getElementById("units"+i).appendChild(option2[i]);
                document.getElementById("units"+i).appendChild(option3[i]);
                document.getElementById("units"+i).appendChild(option4[i]);
                document.getElementById("units"+i).appendChild(option5[i]);
            }
            else{
                option5[i].setAttribute("selected", true);
                document.getElementById("units"+i).appendChild(option1[i]);
                document.getElementById("units"+i).appendChild(option2[i]);
                document.getElementById("units"+i).appendChild(option3[i]);
                document.getElementById("units"+i).appendChild(option4[i]);
                document.getElementById("units"+i).appendChild(option5[i]);
            }
            document.getElementById("option1"+i).innerText="Select a Unit";
            document.getElementById("option2"+i).innerText="KG (KiloGram)";
            document.getElementById("option3"+i).innerText="Pairs";
            document.getElementById("option4"+i).innerText="No.";
            document.getElementById("option5"+i).innerText="Tonne";
            
            document.getElementById("row"+i).appendChild(td5[i]);
            document.getElementById("td"+k).appendChild(col4[i]);k++;
            document.getElementById("col4"+c).appendChild(rateinput[i]);c++;
            document.getElementById("row"+i).appendChild(td6[i]);
            document.getElementById("std"+k).appendChild(col5[i]);k++;
            document.getElementById("cid"+c).appendChild(amountinput[i]);c++;j++;
        }
    }
            
        }
        event.preventDefault();
        
    }
}


