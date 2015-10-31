<?php

/**
* Template Name: Paypal Request
*/


session_set_cookie_params(0);
session_start();
ob_start();	

/*$payment_mode	 =	"SANDBOX";
$paypalUser		 = "sharad.kolhe-facilitator_api1.gmail.com";
$paypalPassword	 = "LGBWZ77ANP8HRZMK";
$paypalSignature = "AiPC9BjkCyDFQXbSkoZcgqH3hpacAr.VjudkRZkFqLBT8s.fbQk04iZo";
$paypalAppId     = "APP-80W284485P519543T";*/

$payment_mode	 = "LIVE";
$paypalUser		 = "presidenza_api1.europe4you.it";
$paypalPassword	 = "QLPVPN9MHCPCXZPB";
$paypalSignature = "AyLeoE46DhRV9U1l3PkIwXZO.0XJAtorTqZIyyD0aghg6O1BlWa.Cq57";
$paypalAppId     = "APP-9PR06499YH961020T";


define('BASE_PATH','http://www.europe4you.it'); /* This is base path of website */

//$merchant_id     = "sharad.kolhe-facilitator@gmail.com";
$merchant_id     = "presidenza@europe4you.it";

$receiver  = $merchant_id;


$item_amount = 0.1;

	//set POST URL //svcs
	if($payment_mode == 'SANDBOX')
	{
		$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay';
	}
	else
	{
		$url = 'https://svcs.paypal.com/AdaptivePayments/Pay';
	}

	$orderid		 = 'ORD'.rand();
	
	//set POST variables
	$fields = array(
				'actionType'						=> 'PAY',
				'clientDetails.applicationId' 		=> $paypalAppId,
				'clientDetails.ipAddress' 	  		=> $_SERVER['REMOTE_ADDR'],				
				'currencyCode'				  		=> 'EUR',
				'receiverList.receiver(0).amount' 	=> $item_amount,
				'receiverList.receiver(0).email'  	=> $receiver,				
				'requestEnvelope.errorLanguage'	  	=> 'en_US',
				'cancelUrl'						  	=> BASE_PATH.'/paypal-cancel',
				'returnUrl'							=> BASE_PATH.'/paypal-response?orderid='.$orderid,
			    );

	
	
	/* 'returnUrl' => BASE_PATH.'myresponse.php?id='.$id.'&user_id='.$user_id.'&orderid='.$orderid,    */
	

	$fields_string = '';
	//url-ify the data for the POST
	foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');
	
	$headers = array('X-PAYPAL-SECURITY-USERID: '.$paypalUser.'',
					 'X-PAYPAL-SECURITY-PASSWORD: '.$paypalPassword.'',
					 'X-PAYPAL-SECURITY-SIGNATURE: '.$paypalSignature.'',
					 'X-PAYPAL-REQUEST-DATA-FORMAT: NV',
					 'X-PAYPAL-RESPONSE-DATA-FORMAT: NV',
					 'X-PAYPAL-APPLICATION-ID: '.$paypalAppId.'');
	//open connection
	$ch = curl_init();
	
	//set the url, number of POST vars, POST data
	curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	//curl_setopt($ch, CURLOPT_SSLVERSION,2.1);
	
	//execute post
	$res = curl_exec($ch);
	
	$info = curl_errno($ch);
	
	//echo "<pre>";
	//print_r($info);
	
	$err = curl_error($ch);
	
	//close connection
	curl_close($ch);
	
	$res_arr = explode("&",$res);	//echo "<pre>"; print_r($res_arr); exit;
	
    $resp_arr_pay_key  = explode("=",$res_arr[4]); 

    $resp_arr2  = explode("=",$res_arr[1]);
	
	$_SESSION['pay_key'] = $resp_arr_pay_key[1];
	

	/*************** Saving data into order table **************************/


			
	$paypal_pay_key	 = $resp_arr_pay_key[1];
	//$paydate		 = date('Y-m-d H:i:s');

	$_SESSION['orderid'] = $orderid;
	
	/* set sellerid = '$post_by', buyerid = '$user_id',post_id ='$id' */
	/*
	$insert_query = mysql_query("insert into orders (orderid,
											 paykey,
											 paykey_response,
											 amount,
											 sellerid,
											 buyerid,
											 post_id,
											 paydate,
											 status
											 ) values (
											 '$orderid',
											 '$paypal_pay_key',
											 '$res',
											 '$item_amount',
											 '$post_by',
											 '$user_id',
											 '$id',
											 '$paydate',
											 'INITIALIZED'
											 )");

    */
	/*************** Saving Data into order table  **************************/

	
	/********* code to fetch data from paypal response array start  *********/

		$status='noSuccess';

		for($k=0;$k<count($res_arr);$k++){

		$ack = explode("=",$res_arr[$k]); //echo "<pre>"; print_r($ack); echo "</pre>";

			if($ack[1]=='Success'){ $status='Success'; }

			if($ack[0]=='payKey'){ $pay_key = $ack[1]; }

		}

    echo "<pre>";
    print_r($res_arr);  

   /********* code to fetch data from paypal response array end  *********/

	if($status == 'Success'){

		if($payment_mode == 'SANDBOX')
		{
			$redirect_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey='.$pay_key;
		}
		else
		{
			$redirect_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey='.$pay_key;
		}
		
		header('location: '.$redirect_url); 
	}
	else
	{
		 echo "NOT SUCCEED";
	}



?>
