/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 var Strinbaseurl = "http://localhost/v9/";
$(function(){
    $(".addcart").click(function(){
        var title = $(this).attr('datatitle');
        var price = $(this).attr('dataprice');
         $(".loadertext").css('color','#3E85C2');
         $(".loadertext").text('Please wait, we are processing the request......');
         $(".loader").show(); 
        $.ajax({
            url: 'model/addCart.php',
            data: {title:title,price:price,action:'true'},
            type: 'POST',
            success:function(response){
                //alert(response);
               $(".tabledata").html(response);
               $(".loader").hide();  
               $(".formdiv").hide();
            }
            
        })
    });
    
  
  
  $(".delete").click(function(){
      var title = $(this).attr('datatitle');
      var anim = 'fadeOutLeft';
       $(".loadertext").css('color','#3E85C2');
       $(".loadertext").text('Please wait, we are processing the request......');
       $(".loader").show(); 
      $.ajax({
          url: 'model/addCart.php',
          data: {title:title,action:'false'},
          type: 'POST',
          success: function(response){
              testAnim(anim,title);
             
             $(".loader").hide(); 
             $(".formdiv").hide();
          }
      })
  })
  
  
})



  function testAnim(x,y) {
    $('#tr_'+y).removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
      $("#tr_"+y).remove();
      location.reload();
    });
  };

  
 $(function(){
    $(".checkout").click(function(){
        var totalamt = $("#totalprice").val();
        $(".totalamt").html('<div >Total Bill Amount:</div><div>Rs. '+totalamt+'</div>');
        $(".finaltotalamt").html('<div>Final Amount Payable:</div><div>Rs. '+totalamt+'</div>');
        $("#totalbill-amt").val(parseInt(totalamt));
        $(".formdiv").show();
    }) 
})


$(function(){
    $("#validatecoupon").click(function(){
        
        var coupon = $("#coupon").val();
        $.ajax({
                crossOrigin: true,
                url: Strinbaseurl+'redeemcodes/'+coupon,
                type: 'GET',
                data: '',
                datatype: 'jsonp',
               success: function(msg){
                   if(msg.status==0 && msg.type!='error'){
                        var totalamt = $("#totalprice").val();
                        $(".discount").show();
                        $(".discount").html('<div>Sqy! Discount:</div><div>Rs. '+parseInt(msg.redeemed_amt)+'</div>');
                        $("#couponvalue").val(parseInt(msg.redeemed_amt));
                        var remainingamt = parseInt(totalamt)-parseInt(msg.redeemed_amt); 
                        $("#totalbill-amt").val(parseInt(remainingamt));
                        $(".finaltotalamt").html('<div>Final Amount Payable:</div><div>Rs. '+remainingamt+'</div>');
                        
                   }else{
                        alert('Redemtion code not valid or expire!');
                        $("#couponvalue").val(0);
                        $(".discount").hide();
                        
                   }
               }
    })
})
})

