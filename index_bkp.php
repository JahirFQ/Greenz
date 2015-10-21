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
define("OUTLET_UUID","cb61fd0e-de93-4000-9aa1-00d0b5bd345e");
define("POSID","2436740");
$baseurl = "http://localhost/v9/";
?>
<html>
    <head>
        <title>Sqy! Cart</title>
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
        
        if(name!="" && email!="" && pincode!="" && phone_number!=""){
           
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
                    success: function(msg){
                        var str = JSON.parse(msg);
                        console.log(str);  
                       if(str.response==0){
                          //alert('jahir alam');
                          var thankmsg = '<tr><td colspan="4" style="color:green;"><b style="font-weight:bold;">Thank you</b> your order placed successfully!</td></tr>';
                          $(".tabledata").html(thankmsg);
                          $(".formdiv").hide();
                           $(".tabledata").focus();
                      }
                       $(".loader").hide();
                       $("#mobileNo").val('');
                       $("#name").val('');
                       $("#email").val('');
                       $("#pincode").val('');
                       $("#address").val('');
                       $(".formdiv").hide();
                       var body = $("html, body");
                        body.animate({scrollTop:450}, '500');
                    }
                })
            }
        }
    });
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
                       <a dataprice="2499" datatitle="1"  class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
               
                     <div class="product3">
                        <a dataprice="3999" datatitle="2" class="alink addcart" href="javascript:void(0);">GET IT</a>
                     </div>
                    
                
                </div>
                
                <div class="product-main">
                
                    <div class="product">
                         <a dataprice="1200" datatitle="3" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a dataprice="1200" datatitle="4" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a dataprice="1200" datatitle="5" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
               
                <div class="product-main">
                
                    <div class="product">
                         <a dataprice="1200" datatitle="6" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a dataprice="1200" datatitle="7" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a dataprice="1200" datatitle="8" class="alink addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
       
       <div class="product-main">
           <div class="product4">&nbsp;</div>
       </div>
       
       
                 <div class="product-main">
                
                    <div class="product">
                         <a dataprice="1200" datatitle="9" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product1">
                         <a dataprice="1200" datatitle="10" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product2">
                         <a dataprice="1200" datatitle="11" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                
                </div>
       
                  <div class="product-main" >
                
                    <div class="product">
                         <a dataprice="1200" datatitle="12" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
                    </div>
                    <div class="product3">
                         <a dataprice="4999" datatitle="13" class="alink2 addcart" href="javascript:void(0);">GET IT</a>
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
                            <input type="text" name="name" id="name" class="form-control inputtext" required="">
                        </div>
                        <div>
                             <lable>Mobile Number:</lable><br>
                             <input type="number" min="0" max="9999999999" maxlength="10" name="mobileNo" id="mobileNo" class="form-control inputtext" required="">
                        </div>
                        <div>
                             <lable>Email ID:</lable><br>
                            <input type="email" name="email" id="email" class="form-control inputtext" required="">
                        </div>
                        <div>
                             <lable>Shipping Address:</lable><br>
                             <textarea name="address" id="address" class="form-control textarea" required=""></textarea>
                        </div>
                        <div>
                             <lable>Pin Code:</lable><br>
                             <input type="number" name="pincode" id="pincode"   min="0" max="999999" maxlength="6" class="form-control inputtext" required="">
                        </div >
                            <div class="applydiv">
                                <input type="checkbox" value="1" id="applydiv" name="applySqyCode"  checked="checked"/>
	                         <label for="applydiv"></label>
                                 
                            </div>
                        <div>&nbsp;Apply Coupon Code</div>
                        
                        <div><input type="text" id="coupon" name="coupon" maxlength="7" class="form-control" style="background: #fff url(images/sqy-input.jpg) no-repeat 0px 0px; text-indent: 65px; margin-left: -15px;" > 
                            <a id="validatecoupon" href="javascript:void(0);">Validate</a></div>
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
