<form action="" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_nbJ0a30U9R4LC9h2S6ub1yg1"
    data-amount="999"
    data-name="Demo Site"
    data-description="Example charge"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto">
  </script>
</form>

<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/tokens");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=4242424242424242&card[exp_month]=12&card[exp_year]=2022&card[cvc]=123");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, "pk_test_nbJ0a30U9R4LC9h2S6ub1yg1" . ":" . "");

$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
$token =json_decode($result)->id;
// generate token end 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=100&currency=usd&description=\"Example&source=".$token);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, "sk_test_tTazZVbL5R80hMgpRNYgcL0K" . ":" . "");

$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

echo $result;	
//confirm payment.


// var_dump($_POST);

if(isset($_POST['stripeToken']))
{
	$token = $_POST['stripeToken'];

	// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/charges");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=50&currency=usd&description=\"Example&source=".$token);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_USERPWD, "sk_test_tTazZVbL5R80hMgpRNYgcL0K" . ":" . "");

	$headers = array();
	$headers[] = "Content-Type: application/x-www-form-urlencoded";
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($ch);
	if (curl_errno($ch)) {
	    echo 'Error:' . curl_error($ch);
	}
	curl_close ($ch);

	echo $result;

}

?>
