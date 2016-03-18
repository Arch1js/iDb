<?php
//Set useful variables for paypal form
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'a.dobrajs-facilitator@gmail.com'; //Business Email

?>
<div ng-controller="CheckoutCtrl">
<div id="input_form">
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">First Name</label>
    <input type="text" class="form-control" placeholder="John" ng-model="name">
  </div>
</form>
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputEmail2">Last Name</label>
    <input type="text" class="form-control" placeholder="Doe" ng-model="lastName">
  </div>
</form>
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputEmail2">Address</label>
    <input type="text" class="form-control" placeholder="Address" ng-model="address">
  </div>
</form>
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputEmail2">Email</label>
    <input type="email" class="form-control" placeholder="test@example.com" ng-model="email">
  </div>
</form>
<form class="form-inline">
<div class="form-group">
    <label for="cardNumber">Credit Card number</label>
        <input type="text" class="form-control" id="cardNumber" maxlength="16" size="18" autocomplete='off' ng-model="cardNo">
</div>
</form>
<form class="form-inline">
<div class="form-group">
    <label>Expiry date</label>
        <input type="text" class="form-control" placeholder="MM" maxlength="2" size="2" autocomplete='off' ng-model="month">
        <input type="text" class="form-control" placeholder="YY" maxlength="2" size="2" autocomplete='off' ng-model="year">
</div>
<div class="form-group">
    <label>CVV</label>
        <input type="text" class="form-control" placeholder="CVV" maxlength="3" size="3" autocomplete='off' ng-model="cvv">
</div>
</form>
	<div class="form-group"> <!-- Submit Button -->
		<!--<button type="submit" class="btn btn-primary" ng-click="addCustomerInfo()"><i class="fa fa-cart-arrow-down"></i>
 Place Order</button>-->
        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-cart-arrow-down"></i>
 Place Order</button>
	</div>
</div>
    <h2>Or use checkout with PayPal!</h2>
        <div id="paypal">
            <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="{{ data.make}} {{ data.model}}">
        <input type="hidden" name="amount" value="{{ data.price}}">
        <input type="hidden" name="currency_code" value="GBP">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='http://localhost/views/cancel.php'>
		<input type='hidden' name='return' value='http://localhost/views/confirmedPage.html'>

        
        <!-- Display the payment button. -->
        <input type="image" name="submit" width="180" height="60"
        src="http://yoga-in-india.com/wp-content/uploads/2016/01/paypal.png" alt="PayPal - The safer, easier way to pay online">
        
    
    </form>
        </div>
<div class="modal_container">
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                <img width="100px" height="40px" alt="Brand" src="../Asets/Logo.svg"><!-- Logo -->
        </div>
        <div class="modal-body">
          <h4>Buy this car?</h4>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo(); sendEmail()">Yes</button>-->
        <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo()">Yes</button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        </div>
      </div>   
    </div>
  </div>
</div>
</div>