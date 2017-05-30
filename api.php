<?php

class BitsoAPIException extends \ErrorException {};


class BitsoAPI
{
	
	protected $key;
	protected $secret;
	protected $url_v2;
	protected $url;
	protected $curl;
	

    function __construct($key, $secret, $url="https://dev.bitso.com/api/v3", $url_v2="https://dev.bitso.com/api/v2", $sslverify=true){
        $this->key = $key;
        $this->secret = $secret;
        $this->url_v2 = $url_v2;
        $this->url = $url;
        $this->curl = curl_init();

        curl_setopt_array($this->curl, array(
            CURLOPT_SSL_VERIFYPEER => $sslverify,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'Bitso PHP API Agent',
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true)
        );
    }

    function __destruct(){
        curl_close($this->curl);
    }


######				  #######
###### PUBLIC QUERIES #######
######				  #######


    function available_books(){
    	$path = $this->url . "/available_books/";
    	curl_setopt($this->curl, CURLOPT_URL, $path);
    	$result = curl_exec($this->curl);

  		  if($result===false)
            throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);
        return $result;
    }

    function ticker($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/ticker/?".$parameters;
    	curl_setopt($this->curl, CURLOPT_URL, $path);
    	$result = curl_exec($this->curl);

  		  if($result===false)
            throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);
        return $result;

    }

    function order_book($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/order_book/?".$parameters;
    	curl_setopt($this->curl, CURLOPT_URL, $path);

    	$result = curl_exec($this->curl);

  		if($result===false)
        	throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);
        return $result;

    }

    function trades($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/trades/?".$parameters;
    	curl_setopt($this->curl, CURLOPT_URL, $path);
   
    	$result = curl_exec($this->curl);

  		if($result===false)
        	throw new BitsoAPIException('CURL error: ' . curl_error($this->curl));

        $result = json_decode($result, true);
        return $result;
    }


######				   #######
###### PRIVATE QUERIES #######
######				   #######


     function account_status(){
    	$path = $this->url . "/account_status/";
    	$RequestPath = "/v3/account_status/";
    	$nonce = round(microtime(true) * 1000);
    	$HTTPMethod = 'GET';
    	#$JSONPayload = json_encode();

    	//create signature
    	$message = $nonce . $HTTPMethod . $path . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		curl_setopt($this->curl, CURLOPT_URL, $path);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($this->curl);

		#print $result;
		return $result;
    }

    function balances(){
		$path = $this->url . "/balances/";
    	$RequestPath = "/v3/balances/";
    	$nonce = round(microtime(true) * 1000);
    	$HTTPMethod = 'GET';
    	#$JSONPayload = json_encode();

    	//create signature
    	$message = $nonce . $HTTPMethod . $path . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		curl_setopt($this->curl, CURLOPT_URL, $path);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($this->curl);

		#print $result;
		return $result;
    }

    function fees(){
		$path = $this->url . "/fees/";
    	$RequestPath = "/v3/fees/";
    	$nonce = round(microtime(true) * 1000);
    	$HTTPMethod = 'GET';
    	#$JSONPayload = json_encode();

    	//create signature
    	$message = $nonce . $HTTPMethod . $path . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		curl_setopt($this->curl, CURLOPT_URL, $path);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($this->curl);

		#print $result;
		return $result;
    }

    function ledger($params){
    	$parameters = http_build_query($params,'','&');
		$path = $this->url . "/balances/";
    	$RequestPath = "/v3/balances/";
    	$nonce = round(microtime(true) * 1000);
    	$HTTPMethod = 'GET';
    	$JSONPayload = json_encode($params);

    	//create signature
    	$message = $nonce . $HTTPMethod . $path . $JSONPayload;
  		$signature = hash_hmac('sha256', $message, $this->secret);

  
  		//build auth header
  		$format = 'Bitso %s:%s:%s';
  		$authHeader =  sprintf($format, $this->key, $nonce, $signature);

  		// Send request
		curl_setopt($this->curl, CURLOPT_URL, $path);
		curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $HTTPMethod);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $JSONPayload);
		curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
		      'Authorization: ' .  $authHeader,
		      'Content-Type: application/json'));
		$result = curl_exec($this->curl);

		#print $result;
		return $result;
    }

    function withdrawals(){

    }
    function fundings(){

    }
    function user_trades(){

    }
    function open_orders(){

    }
    function lookup_order(){

    }
    function cancel_order(){

    }
    function place_order(){

    }
    function funding_destination(){

    }
    function btc_withdrawal(){

    }
    function eth_withdrawal(){

    }
    function ripple_withdrawal(){

    }
    function spei_withdrawal(){

    }

   

}

?>
