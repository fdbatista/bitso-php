<?php
namespace API;

class bitso
{
	
	protected $key;
	protected $secret;
	protected $url;
	protected $curl;
	

    function __construct($key, $secret, $url="https://dev.bitso.com/api/v3"){
        $this->key = $key;
        $this->secret = $secret;
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

  		 
      curl_close($ch);
		  return json_decode($result);
    }

    function ticker($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/ticker/?".$parameters;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen
    	
    	$result = curl_exec($ch);
      curl_close($ch);
		  return json_decode($result);

    }

    function order_book($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/order_book/?".$parameters;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen

    	$result = curl_exec($ch);
      curl_close($ch);
		  return json_decode($result);

    }

    function trades($params){
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/trades/?".$parameters;
		  $ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $path);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); // Do not send to screen
    	
      $result = curl_exec($ch);
      curl_close($ch);
		  return json_decode($result);
    }


######				   #######
###### PRIVATE QUERIES #######
######				   #######

    
    function account_status(){
    	#NO PARAMETERS
    	$path = $this->url . "/account_status/";
    	$RequestPath = "/api/v3/account_status/";
    	$nonce = round(microtime(true)*1000);
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
  		return json_decode($result);
    }

    function balances(){
    	#NO PARAMETERS
		  $path = $this->url . "/balance/";
    	$RequestPath = "/api/v3/balance/";
    	$nonce = round(microtime(true)*1000);
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

  		return json_decode($result);
    }

    function fees(){
    	#NO PARAMETERS
		$path = $this->url . "/fees/";
    	$RequestPath = "/api/v3/fees/";
    	$nonce = round(microtime(true)*1000);
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
  		return json_decode($result);
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
    	$nonce = round(microtime(true)*1000);
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

    function withdrawals($params, $ids=[]){
    	#ONLY TAKES QUERY PARAMETERS, Has these options
    	#GET https://api.bitso.com/v3/withdrawals/
		  #GET https://api.bitso.com/v3/withdrawals/wid/
		  #GET https://api.bitso.com/v3/withdrawals/wid-wid-wid/
		  $id_nums = implode('', $ids);
    	$parameters = http_build_query($params,'','&');
		  $path = $this->url . "/withdrawals/".$id_nums."/?".$parameters;
    	$RequestPath = "/api/v3/withdrawals/".$id_nums."/?".$parameters;
  
    	$nonce = round(microtime(true)*1000);
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
		  return json_decode($result);
    }

    function fundings($params,$ids=[]){
    	#TAKES QUERY PARAMETER AND FID
    	#GET https://api.bitso.com/v3/fundings/
		  #GET https://api.bitso.com/v3/fundings/fid/
		  #GET https://api.bitso.com/v3/fundings/fid-fid-fid/
		  $id_nums = implode('', $ids);
    	$parameters = http_build_query($params,'','&');
		  $path = $this->url . "/fundings/".$id_nums."/?".$parameters;
    	$RequestPath = "/api/v3/fundings/".$id_nums."/?".$parameters;
    	$nonce = round(microtime(true)*1000);
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
		  return json_decode($result);
    }

    function user_trades($params, $ids=[]){
    	#ONLY TAKES QUERY PARAMETER
    	#GET https://api.bitso.com/v3/user_trades/
    	#GET https://api.bitso.com/v3/user_trades/tid/
    	#GET https://api.bitso.com/v3/user_trades/tid-tid-tid/

    	$id_nums = implode('', $ids);
    	$parameters = http_build_query($params,'','&');
		  $path = $this->url . "/user_trades/".$id_nums."/?".$parameters;
    	$RequestPath = "/api/v3/user_trades/".$id_nums."/?".$parameters;
    	$nonce = round(microtime(true)*1000);
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
  		return json_decode($result);
    }

    function open_orders($params){
    	#ONLY TAKES QUERY PARAMETER
    	$parameters = http_build_query($params,'','&');
    	$path = $this->url . "/open_orders/?".$parameters;
    	$RequestPath = "/api/v3/open_orders/?".$parameters;
    	$nonce = round(microtime(true)*1000);
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
		  return json_decode($result);
    }

    function lookup_order($ids){
		#NO QUERY OR BODY PARAMETERS has options 
		#GET https://api.bitso.com/v3/orders/<oid>/
		#GET https://api.bitso.com/v3/orders/<oid>-<oid>-<oid>/

    	$parameters = implode('', $ids);
   
    	$path = $this->url . "/orders/".$parameters;
    	$RequestPath = "/api/v3/orders/".$parameters;
    	$nonce = round(microtime(true)*1000);
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
		  return json_decode($result);
    }

    function cancel_order($ids){
    	#NO QUERY OR BODY PARAMETERS, has options
    	#DELETE https://api.bitso.com/v3/orders/<oid>/
		  #DELETE https://api.bitso.com/v3/orders/<oid>-<oid>-<oid>/
		  #DELETE https://api.bitso.com/v3/orders/all/
  		if ($ids = 'all') {
  			$parameters = 'all';
  		} else {
  		    $parameters = implode('', $params);
  		}

    	$path = $this->url . "/orders/".$parameters;
    	$RequestPath = "/api/v3/orders/".$parameters;
    	$nonce = round(microtime(true)*1000);
    	$HTTPMethod = 'DELETE';
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
  		return json_decode($result);
    }

    function place_order($params){
    	#ONLY TAKES BODY PARAMETERS

		  $path = $this->url . "/orders/";
    	$RequestPath = "/api/v3/orders/";
    	$nonce = round(microtime(true)*1000);
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

    function funding_destination($params){
    	#ONLY TAKES QUERY PARAMETER
		  $parameters = http_build_query($params,'','&');
    	$path = $this->url . "/funding_destination/?".$parameters;
    	$RequestPath = "/api/v3/funding_destination/?".$parameters;
    	$nonce = round(microtime(true)*1000);
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
  		return json_decode($result);
    }

    function btc_withdrawal($params){
  		#ONLY TAKES BODY PARAMETERS
  		$path = $this->url . "/bitcoin_withdrawal/";

    	$RequestPath = "/api/v3/bitcoin_withdrawal/";
    	$nonce = round(microtime(true)*1000);
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

  		return json_decode($result);
    }

    function eth_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
    	$path = $this->url . "/ether_withdrawal/";

    	$RequestPath = "/api/v3/ether_withdrawal/";
    	$nonce = round(microtime(true)*1000);
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

  		return json_decode($result);

    }
    function ripple_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
		  $path = $this->url . "/ripple_withdrawal/";
    	$RequestPath = "/api/v3/ripple_withdrawal/";
    	$nonce = round(microtime(true)*1000);
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

  		return json_decode($result);

    }
    function spei_withdrawal($params){
    	#ONLY TAKES BODY PARAMETERS
    	$path = $this->url . "/spei_withdrawal/";

    	$RequestPath = "/api/v3/spei_withdrawal/";
    	$nonce = round(microtime(true)*1000);
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

  		return json_decode($result);
    }

}

?>
