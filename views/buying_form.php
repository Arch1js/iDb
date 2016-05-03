<?php
//Paypal API
$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypal_id = 'a.dobrajs-facilitator@gmail.com'; //Seller Email
?>
<div ng-controller="CheckoutCtrl">
  <form id="customer-form"> <!-- Customer information input form -->
    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="control-group">
        <label class="control-label" for="name">First Name</label>
        <div class="controls">
          <input type="text" class="form-control" placeholder="John" ng-model="name" name="name" id="name">
        </div>
      </div>
    <div class="control-group">
      <label class="control-label" for="last">Last Name</label>
      <div class="controls">
        <input type="text" class="form-control" placeholder="Doe" ng-model="lastName" name="last" id="last">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="address">Address</label>
      <div class="controls">
        <input type="text" class="form-control" placeholder="Address" ng-model="address" name="address" id="address">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="email">Email</label>
      <div class="controls">
        <input type="email" class="form-control" placeholder="test@example.com" ng-model="email" name="email" id="email">
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-6 col-xs-12">
    <div class="control-group">
      <label class="control-label" for="card">Credit Card number</label>
      <div class="controls">
        <input type="text" class="form-control" id="cardNumber" maxlength="16" size="18" autocomplete='off' ng-model="cardNo" name="card" id="card">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="month">Expiry date</label>
      <div class="controls">
        <input type="text" class="form-control" placeholder="MM" maxlength="2" size="2" autocomplete='off' ng-model="month" name="month" id="month">
        <br>
        <input type="text" class="form-control" placeholder="YY" maxlength="2" size="2" autocomplete='off' ng-model="year" name="year" id="year">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="cvv">CVV</label>
      <div class="controls">
        <input type="text" class="form-control" placeholder="CVV" maxlength="3" size="3" autocomplete='off' ng-model="cvv" name="cvv" id="cvv">
      </div>
    </div>
	  <div class="control-group"> <!-- Submit Button -->
      <div class="form-actions">
        <button type="submit" id="submit" class="btn btn-primary" data-target="#myModal"><i class="fa fa-cart-arrow-down"></i>Place Order</button>
      </div>
	  </div>
  </div>
</form>
<div class="col-md-4 col-xs-12"> <!-- Paypal checkout container -->
  <h2>Or use checkout with PayPal!</h2>
    <div id="paypal">
      <form action="<?php echo $paypal_url; ?>" method="post">
        <!-- Identify the business id to collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="{{ data.make}} {{ data.model}}">
        <input type="hidden" name="amount" value="{{ data.price}}">
        <input type="hidden" name="currency_code" value="GBP">
        <!-- Confirm and cancel URLs -->
        <input type='hidden' name='cancel_return' value='http://localhost/views/cancel.php'>
		    <input type='hidden' name='return' value='http://localhost/views/confirmedPage.html'>
        <!-- Display the payment button. -->
        <input type="image" name="submit" width="180" height="60"
        src="../Asets/paypal.png" alt="PayPal - The safer, easier way to pay online">
      </form>
    </div>
    <div class="modal_container"> <!-- Buy confirmation modal popup -->
      <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <img width="100px" height="40px" alt="Brand" src="../Asets/Logo.svg"><!-- Logo -->
            </div>
            <div class="modal-body">
              <h4>Buy this car?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo(); sendEmail()">Yes</button> <!-- Add customer information to database and send confirmation email -->
              <!-- <button type="button" class="btn btn-success" data-dismiss="modal" ng-click="addCustomerInfo()">Yes</button> -->
              <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End of modal container -->
  </div><!-- End of paypal container -->
</div><!-- End of contents container -->
