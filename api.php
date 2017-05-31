<?php

class BitsoAPIException extends \ErrorException {};


class BitsoAPI
{
	
	protected $key;
	protected $secret;
	protected $url_v2;
	protected $url;
	protected $curl;
	

    function __construct($key, $secret, $url="https://dev.bitso.com/api/v3", $url_v2="https://dev.bitso.com/api/v2"){
        $this->key = $key;
        $this->secret = $secret;
        $this->url_v2 = $url_v2;
        $this->url = $url;

    }


######				  #######
###### PUBLIC QUERIES #######
######				  #######


    function available_books(){
    	$path = $this->url . "/available_books/";
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen

    	$result = curl_exec($ch);

  		  if($result===false)
            throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);

        curl_close($ch);
		return $result;
    }

    function ticker($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/ticker/?".$parameters;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen
    	
    	$result = curl_exec($ch);

  		  if($result===false)
            throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);

        curl_close($ch);
		return $result;

    }

    function order_book($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/order_book/?".$parameters;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen

    	$result = curl_exec($ch);

  		if($result===false)
        	throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);

        curl_close($ch);
		return $result;

    }

    function trades($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/trades/?".$parameters;
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen
    	
    	$result = curl_exec($ch);

        $result = json_decode($result, true);

        curl_close($ch);
		return $result;
    }


######				   #######
###### PRIVATE QUERIES #######
######				   #######


    
    function account_status(){
    	#NO PARAMETERS
    	$path = $this->url . "/account_status/";
    	$RequestPath = "/api/v3/account_status/";
    	$nonce = round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
    }

    function balances(){
    	#NO PARAMETERS
		$path = $this->url . "/balance/";
    	$RequestPath = "/api/v3/balance/";
    	$nonce = round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		return $result;
    }

    function fees(){
    	#NO PARAMETERS
		$path = $this->url . "/fees/";
    	$RequestPath = "/api/v3/fees/";
    	$nonce = round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);


  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return $result;
    }

    function ledger($params){
    	#ONLY TAKES QUERY PARAMETER, HAS THESE OPTIONS
    	#GET https://api.bitso.com/v3/ledger/
		#GET https://api.bitso.com/v3/ledger/trades/
		#GET https://api.bitso.com/v3/ledger/fees/
		#GET https://api.bitso.com/v3/ledger/fundings/
		#GET https://api.bitso.com/v3/ledger/withdrawals/

    	$parameters = http_build_query($params,'','&');
		$path = $this->url . "/ledger/?".$parameters;
    	$RequestPath = "/api/v3/ledger/?".$parameters;
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'GET';
    	#$JSONPayload = json_encode($params);
    	$JSONPayload = ''; 

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);
    	
    }

    function withdrawals(){
    	#ONLY TAKES QUERY PARAMETERS, Has these options
    	#GET https://api.bitso.com/v3/withdrawals/
		#GET https://api.bitso.com/v3/withdrawals/wid/
		#GET https://api.bitso.com/v3/withdrawals/wid-wid-wid/

    	$parameters = http_build_query($params,'','&');
		$path = $this->url . "/withdrawals/?".$parameters;
    	$RequestPath = "/api/v3/withdrawals/?".$parameters;
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
    }

    function fundings($params){
    	#TAKES QUERY PARAMETER AND FID
    	#GET https://api.bitso.com/v3/fundings/
		#GET https://api.bitso.com/v3/fundings/fid/
		#GET https://api.bitso.com/v3/fundings/fid-fid-fid/

    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/fundings/?".$parameters;
    	$RequestPath = "/api/v3/fundings/?".$parameters;
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
    }

    function user_trades($params){
    	#ONLY TAKES QUERY PARAMETER
    	#GET https://api.bitso.com/v3/user_trades/
    	#GET https://api.bitso.com/v3/user_trades/tid/
    	#GET https://api.bitso.com/v3/user_trades/tid-tid-tid/

    	$parameters = http_build_query($params,'','&');
		$path = $this->url . "/user_trades/?".$parameters;
    	$RequestPath = "/api/v3/user_trades/?".$parameters;
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
    }

    function open_orders($params){
    	#ONLY TAKES QUERY PARAMETER
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/open_orders/?".$parameters;
    	$RequestPath = "/api/v3/open_orders/?".$parameters;
    	$nonce = (int)round(microtime(true)*1000000);
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;

    }

    function lookup_order($params){
		#NO PARAMETERS has options 
		#GET https://api.bitso.com/v3/orders/<oid>/
		#GET https://api.bitso.com/v3/orders/<oid>-<oid>-<oid>/

    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/orders/";
    	$RequestPath = "/api/v3/orders/";
    	$nonce = (int)round(microtime(true)*1000000);
    	$HTTPMethod = 'GET';
    	$JSONPayload = '';

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
  		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($ch);

		curl_close($ch);
		return $result;
    }
    function cancel_order($params){

    }

    function place_order($params){
    	#ONLY TAKES BODY PARAMETERS
		$path = $this->url . "/orders/";
    	$RequestPath = "/api/v3/orders/";
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'POST';
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);
    }
    function funding_destination(){

    }

    function btc_withdrawal($params){
		#ONLY TAKES BODY PARAMETERS
		$path = $this->url . "/bitcoin_withdrawal/";

    	$RequestPath = "/api/v3/bitcoin_withdrawal/";
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'POST';	
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);
    }

    function eth_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
    	$path = $this->url . "/ether_withdrawal/";

    	$RequestPath = "/api/v3/ether_withdrawal/";
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'POST';
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);

    }
    function ripple_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
		$path = $this->url . "/ripple_withdrawal/";
    	$RequestPath = "/api/v3/ripple_withdrawal/";
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'POST';
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);

    }
    function spei_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
    	$path = $this->url . "/spei_withdrawal/";

    	$RequestPath = "/api/v3/spei_withdrawal/";
    	$nonce = (int)round(microtime(true));
    	$HTTPMethod = 'POST';
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $RequestPath . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));

		$result = curl_exec($ch);

		#print $result;
		return json_decode($result);
    }

   

}

?>
