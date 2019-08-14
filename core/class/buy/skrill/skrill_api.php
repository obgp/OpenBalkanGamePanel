<?php
/**
 * Skrill payment  gateway.
 * Skrill API by Biju Joseph Tharakan
 *
 * @link http://www.bijujosephtharakan.com
 **/
class Skrillapi {

	/**
     * @var string The version of this gateway
     */
    private static $version = "1.0.0";

	/**
	 * Initializes the request parameter
	 *
	 * @param string $user_email The Skrill username
	 * @param string $secret_word The secret word used in developer settings
 	 * @param string $merchant_id The account id
 	 * @param string $mqi The MQI password
	 */
	public function __construct($user_email, $secret_word=false, $merchant_id=false, $mqi=false) {
		
		//Set authorization parameters user email required for each request
		$this->user_email = $user_email;	
		$this->secret_word = $secret_word;
		$this->merchant_id = $merchant_id ? $merchant_id : '';
		$this->mqi = $mqi ? $mqi : '';

		// The url to send payment requests
		$this->url = "https://www.moneybookers.com/app/payment.pl" ;

		$this->refund_url = "https://www.moneybookers.com/app/refund.pl";	
	}
	/**
	 * Returns the success response
	 *
	 * @return string The response from gateway
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * Returns the error message from the gateway
	 *
	 * @return string The error message
	 */
	 
	public function getError() {
		return $this->error;
	}

	/**
	 * Used for creating the redirection URL for making payments
	 *
	 * @param array $args The parameters to be send to Skrill 
	 * @param string $request_type The type of request charge / refund
	 * @param string $sid The session id
	 *
	 */
	public function prepareRequest($args = false, $request_type = null, $sid = null){	
		
		$url = $this->url;

		//Set parameters for refund
		if($request_type == "refund"){
			$params['action'] = 'prepare';
			$params['email'] = $this->user_email;
			$params['password'] = md5($this->mqi);			
			$url = $this->refund_url;
			$args = array_merge($params,$args);	
		}
		//Used for executing refund request
		if($sid){
			unset($args);
			$args =  array('action' => "refund",'sid'=>$sid);
			$url = $this->refund_url;
		}

		$fields = http_build_query($args);	

		$curl = curl_init($url);	
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);		
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));   
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

		// For refund the response  is an xml string 
		if($request_type == "refund"){
			$this->parseXml(curl_exec($curl),"refund");	
		}
		else{
			$this->response = curl_exec($curl);
			$this->error = curl_error($curl);
		}
		curl_close($curl);		
	}

	/**
	 * Parse the response from gateway
	 *
	 * @param array $fields The post parameters from gateway
	 *
	 * @return boolean true/false 
	 */
	public function validateResponse($fields){		

		// Validate the Skrill signature
		$concatFields = $fields['merchant_id']
			.$fields['transaction_id']
			.strtoupper(md5($this->secret_word))
			.$fields['mb_amount'].$fields['mb_currency']
			.$fields['status'];

		if (strtoupper(md5($concatFields)) == $fields['md5sig'] && $fields['pay_to_email'] == $this->user_email)
			return true;			
		else
			return false;	
	}	
	/**
	 * Validate the parameters from return url
	 *
	 * @param array $fields The get parameters in url	
	 *
	 * @return boolean true/false 
	 */
	public function validateReturnUrl($fields){		

		// Validate the Moneybookers signature
		$concatFields = $this->merchant_id
			.$fields['transaction_id']
			.strtoupper(md5($this->secret_word));

		if (strtoupper(md5($concatFields)) == $fields['msid'])
			return true;			
		else
			return false;	
	}	

	/**
	 * Parse the response from gateway
	 *
	 * @param string $response The xml response 
	 * @param string $type The type of action - refund
	 *
	 */
	public function parseXml($xml,$type){	
		
		$parsed = simplexml_load_string($xml);

		if(isset($parsed)){	
			if(isset($parsed->error)){
				$this->error = $parsed->error->error_msg;				
			}
			if($type == "refund")
				$this->refund_response = json_decode(json_encode($parsed),TRUE);
			else
				$this->response = json_decode(json_encode($parsed),TRUE);				
		}		
	}	
}
?>
