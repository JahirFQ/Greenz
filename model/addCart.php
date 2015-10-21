<?php
if(session_id()==''){
        session_start(); 
}
clearstatcache();
$totalprice = '';

//unset($_SESSION['product']);

    
if(isset($_POST['title']) && $_POST['title']!="" && $_POST['action']=='true'){
    
$_SESSION['product'][$_POST['title']]= array(
    'title' => $_POST['title'],
    'price' => $_POST['price']
);

}else if(isset($_POST['title']) && $_POST['title']!="" && $_POST['action']=='false'){
   unset($_SESSION['product'][$_POST['title']]); 
}

if(isset($_SESSION['product']) && count($_SESSION['product'])>0){
foreach($_SESSION['product'] as $product){ 
    $totalprice += $product['price']; 
?>
<tr id="tr_<?php echo $product['title']; ?>">
    <td width="50%" style="text-align: left !important;">Kids Moon Colorblock Footed Tights</td>
    <td width="20%">1</td>
    <td width="20%"><?php echo $product['price']; ?></td>
    <td width="10%"><a datatitle="<?php echo $product['title']; ?>" class="delete" href="javascript:void(0);"><img class="delimg" src="images/delete.png"></a></td>
</tr>
<?php } ?>
<tr>
 <td colspan="4">
     <div class="payableamt">Amount Payable: Rs. <?php echo $totalprice; ?></div>
     <input type="hidden" id="totalprice" value="<?php echo $totalprice; ?>">
 </td>
</tr>
<tr>
<td colspan="4">
 <div style="float: right; margin-top: 10px;"><a class="checkout" href="javascript:void(0);"><img  src="images/checkout.jpg"></a></div>
</td>
</tr>
<?php }else{ ?>
<tr>
 <td colspan="4">No Product in cart...</td>
</tr>
<?php } ?>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/main.js"></script>
