<?php
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
define("OUTLET_UUID","e7a4b60f-c6b2-4a93-9ae6-154bf53bbdd2");
define("POSID","17");
$baseurl = "http://localhost/v9/";
?>
<html>
    <head>
        <title>Sqy! Demo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/style.css" rel="stylesheet">
       
        <link rel="stylesheet" href="css/animate.min.css" />
      <script src="js/jquery-1.11.2.min.js"></script>
       <script >
       
$(function(){
    $("#confirm-btn").click(function(){
        
        var couponval = $("#couponvalue").val();
        
        var outlet_uuid = $("#outlet_uuid").val();
        var pos_id = $("#pos_id").val();
        var bill_amt = $("#totalbill-amt").val();
        var phone_number = $("#mobileNo").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var pincode = $("#pincode").val();
        var flag = validateForm();
     
        //if(name!="" && email!="" && pincode!="" && phone_number!=""){
          if(flag==1){
         $(".loadertext").css('color','#3E85C2');
         $(".loadertext").text('Please wait, we are processing the request......');
         $(".loader").show(); 
          
        if(couponval>0 && couponval!=0){
            
          var coupon = $("#coupon").val();
          
          var adata = JSON.stringify(
                    {"outlet_uuid": $("#outlet_uuid").val(),
                    "pos_id": $("#pos_id").val().trim()
            });
            
        
            
            $.ajax({
                 url : '<?php echo $baseurl; ?>'+'redeemcodes/'+coupon+'/accept',
                 type: 'POST',
                 data : adata,
                 datatype : 'json',
                 success:function(response){
                     console.log(response);
                     if(response.code==0){
                          
                          addpoint(outlet_uuid, pos_id, phone_number, bill_amt);
                          
                     }
                 }
             });
            
            
        }else{
            
            addpoint(outlet_uuid, pos_id, phone_number, bill_amt);
            
        }
        }else{
            return false;
        }
    })
})


function addpoint(outletuuid, posid, mobileNo, billAmt){
   
    var key = 'KEY0102';
    $.ajax({
        url: '<?php echo $baseurl; ?>'+'appmUrl',
        type: 'GET',
        data: 'outlet_uuid='+outletuuid+'&pos_id='+posid+'&mobileNo='+mobileNo+'&bill_amt='+billAmt+'&key='+key,
        success: function(msg){
            if(msg.status==0){
                $.ajax({
                    url: 'model/managesession.php',
                    type:'GET',
                    data: 'action=expsession',
                    success:function(msg){
                        var str = JSON.parse(msg);
                        console.log(str);  
                        if(str.response==0){
                            var thankmsg = '<tr><td colspan="4" style="color:green; font-size: 20px; font-weight: bold; float:left;">Thank you for your order!</td></tr><tr><td colspan="4" style="float:left;">Your order has been placed and is being processed. Thank you!</td></tr>';
                            $(".tabledata").html(thankmsg);
                             var body = $("html, body");
                             body.animate({scrollTop:450}, '500');
                       }
                       
                       $(".loader").hide();
                       $("#mobileNo").val('');
                       $("#name").val('');
                       $("#email").val('');
                       $("#pincode").val('');
                       $("#address").val('');
                       $(".formdiv").hide();
                    }
                })
            }
        }
    });
}


function validateForm(){
    var phone_number = $("#mobileNo").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var pincode = $("#pincode").val();
    var btnum = /^([0-9]{10,15})$/;
    var pnum =  /^([0-9]{6,6})$/;
      var emailRegex = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/);
    var flag=1;
    if(name==""){
        flag=0;
       $("#nameMsg").html('Please enter your name!');
       $('#name').focus();
    }else{
        $("#nameMsg").html('');
       
    }
     if(phone_number==""){
        flag=0;
       $("#mobileNoMsg").html('Please enter your mobile number!');
       $('#mobileNo').focus();
    }else if(!btnum.test(phone_number)){
         flag=0;
        $("#mobileNoMsg").html('Please enter only number!');
        $('#mobileNo').focus();
    }else{
        $("#mobileNoMsg").html('');
    }
    
    if(email==""){
       flag=0;
       $("#emailMsg").html('Please enter your email address!');
       $('#email').focus();
    }else if(!emailRegex.test(email)){
         flag=0;
       $("#emailMsg").html('Please enter your valid email address!');
       $('#email').focus();
    }else{
        $("#emailMsg").html('');
    }
    
    if(pincode==""){
       flag=0;
       $("#pincodeMsg").html('Please enter your pin number!');
       $("#pincode").focus(); 
    }else if(!pnum.test(pincode)){
       flag=0;
       $("#pincodeMsg").html('Please enter only number!');
       $("#pincode").focus(); 
    }else{
       $("#pincodeMsg").html('');
    }
    
    if(flag==1){
        return 1;
    }else{
        return 0;
    }
    
}


</script>
       
      
    </head>
    <body>
        <div class="loader" style="display: none; ">
        <div class="loadertext">Please wait, we are processing the request.</div>
       </div>
      <!-------start header-----------> 
        <div class="header"></div>
      <!-------end header----------->   
      <!------start mainarea-------->
        <div class="main_area">
      <!--------start left area----->          
        <div class="main_left"></div>
     <!---------end left area------>       
            
      <!------start mid area------>      
            <div class="main_mid">
               
       <!---product list---------->         
           <div class="product-main">
                
                    <div class="product">
                       <a style="margin-top: 232px;margin-right: 11px;" dataprice="2499" datatitle="1"  class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
               
                     <div class="product3">
                        <a style="margin-top: 232px;" dataprice="3999" datatitle="2" class="alink addcart" href="javascript:void(0);">GET IT</a>
                     </div>
                    
                
                </div>
                
                <div class="product-main">
                
                    <div class="product">
                         <a style="margin-right: 12px;" dataprice="1200" datatitle="3" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a style="margin-right: 10px;" dataprice="1200" datatitle="4" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a style="margin-right: 8px;" dataprice="1200" datatitle="5" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
               
                <div class="product-main">
                
                    <div class="product">
                         <a style="margin-top: 243px; margin-right: 12px;" dataprice="1200" datatitle="6" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a style="margin-top: 243px; margin-right: 10px;" dataprice="1200" datatitle="7" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a style="margin-top: 243px; margin-right: 8px;" dataprice="1200" datatitle="8" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
       
       <div class="product-main">
           <div class="product4">&nbsp;</div>
       </div>
       
       
                 <div class="product-main">
                
                    <div class="product">
                         <a style="margin-top: 231px; margin-right: 12px;" dataprice="1200" datatitle="9" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a style="margin-top: 231px; margin-right: 10px;" dataprice="1200" datatitle="10" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a style="margin-top: 231px; margin-right: 8px;" dataprice="1200" datatitle="11" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
       
                  <div class="product-main" >
                
                    <div class="product">
                         <a style="margin-top: 237px; margin-right: 12px;" dataprice="1200" datatitle="12" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product3">
                         <a style="margin-top: 237px; margin-right: 2px;" dataprice="4999" datatitle="13" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
                
            </div>
            
            
    <!-----------start main right--------->        
            
            <div class="main_right">
               <!-------cart area-------> 
                <div>
                    <h2>You Shopping Cart</h2>
                    <div class="cartlist" style="margin-left: 15px;">
                        <table width="100%" class="tablehead">
                         <tr>
                            <th width="50%">ITEM</th>
                            <th width="20%">QTY</th>
                            <th width="20%">AMOUNT</th>
                            <th width="10%">ACTION</th>
                         </tr>
                        </table>
                        <table width="100%" class="tabledata">
                       
                         <?php include_once("model/addCart.php"); ?>
                         
                    </table>
                    </div>
                   <div style="border:1px dotted #ccc;"></div>
                </div>
                <!----------end cart area------->
                
                <div>
                    <div class="formdiv" style="display: none;">
                        <form name="formcheckout" class="formcheckout" action="javascript:void(0);">
                        <div>
                            <lable>Name:</lable><br>
                            <input type="text" name="name" id="name" class="form-control inputtext" >
                            <span class="error" id="nameMsg"></span>
                        </div>
                        <div>
                             <lable>Mobile Number:</lable><br>
                             <input type="text" min="0" max="9999999999" maxlength="10" name="mobileNo" id="mobileNo" class="form-control inputtext" >
                             <span class="error" id="mobileNoMsg"></span>
                        </div>
                        <div>
                             <lable>Email ID:</lable><br>
                            <input type="text" name="email" id="email" class="form-control inputtext" >
                             <span class="error" id="emailMsg"></span>
                        </div>
                        <div>
                             <lable>Shipping Address:</lable><br>
                             <textarea name="address" id="address" class="form-control textarea" ></textarea>
                             <span class="error" id="addressMsg"></span>
                        </div>
                        <div>
                             <lable>Pin Code:</lable><br>
                             <input type="text" name="pincode" id="pincode"   min="0" max="999999" maxlength="6" class="form-control inputtext" >
                             <span class="error" id="pincodeMsg"></span>
                        </div >
                            <div class="applydiv">
                                <input type="checkbox" value="1" id="applydiv" name="applySqyCode"  checked="checked"/>
	                         <label for="applydiv"></label>
                                 
                            </div>
                        <div>&nbsp;Apply Coupon Code</div>
                        
                        <div>
                            <!--<input type="text" id="coupon" name="coupon" maxlength="7" class="form-control" style="background: #fff url(images/sqy-input.jpg) no-repeat 0px 0px; text-indent: 65px; margin-left: -15px;" >--> 
                            <input type="text" id="coupon" name="coupon" maxlength="7" class="form-control coupontext"  >
                            <a id="validatecoupon" href="javascript:void(0);">Validate</a>
                            <span class="error" id="couponMsg"></span>
                        </div>
                        <div class="totalamt">
                            
                            
                        </div>
                        <div class="discount" style="display: none;" >
                            
                            
                        </div>
                        <div class="finaltotalamt" >
                            
                           
                        </div>
                        
                         <div class="applydiv">
                                <input type="checkbox" value="1" id="codid" name="cod"  checked="checked"/>
	                        <label for="codid"></label>
                                 
                        </div>
                        
                        <div>&nbsp;Cash On delivery</div>
                        <div>
                            <!--<a href=""> <img src="images/confirm_btn.jpg"></a>-->
                            <input type="hidden" id="couponvalue" value="0">
                            <input type="hidden" id="totalbill-amt" value="0">
                            <input type="hidden" id="outlet_uuid" value="f3fb30af-2aad-4b76-bd66-31c67230a1aa">
                            <input type="hidden" id="pos_id" value="15">
                            <input id="confirm-btn" type="image" src="images/confirm_btn.jpg" border="0" alt="Submit" />
                       </div>
                    </form>
                    </div>
                </div>
            </div>
            

        </div>
            
        
        <div class="footer">
           
        </div>
        
        
    </body>
</html>
