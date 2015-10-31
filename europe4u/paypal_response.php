<?php

/**
* Template Name: Paypal Response
*/

session_set_cookie_params(0);
session_start();

/*
	$payment_mode	 =	"SANDBOX";
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

	//$orderid = isset($_REQUEST['orderid'])?$_REQUEST['orderid']:'';

	//if($orderid ==''){ echo "ORDER ID IS BLANK";  exit;  }	

	
	if($_SESSION['pay_key']==''){ echo "PAY KEY IS BLANK SESSION VALUE IS EMPTY REFERENCE ERROR LINE 20,47"; exit; }else {
	
	$paykey = $_SESSION['pay_key'];

	}
	


	//set POST URL //svcs
	if( $payment_mode == 'SANDBOX')
	{
		$url = 'https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails';
	}
	else
	{
		$url = 'https://svcs.paypal.com/AdaptivePayments/PaymentDetails';
	}

	/****** Fetching PayKey from database table start *******/
	
	/*

	$order_query_res = mysql_query("select * from orders WHERE orderid='$orderid' ");
	$orderArrayData  = mysql_fetch_array($order_query_res);
	
	if($orderArrayData['paykey']==''){ echo "PAY KEY FROM DATABASE IS BLANK"; exit;  }
	
	$user_id = $orderArrayData['buyerid'];

	if($user_id==''){ echo "Logged in User Id seems empty it may Session issue reference line no. 74"; exit; }else{ $_SESSION['arlignton_user_id'] = $user_id; }
	
	$id = $orderArrayData['post_id'];

	if($id==''){ echo "POST ID IS BLANK. ERROR ON LINE NO 78 "; exit;  }

   */

	/****** Fetching Paykey from Databse table end  ********/
	

	//set POST variables
	$fields = array(
				'payKey'							=> $paykey,
				'requestEnvelope.errorLanguage' 	=> 'en_US',
			    );
	
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
	
	curl_close($ch);
	
	
	$res_arr = explode("&",$res);  
	//echo "<pre>"; print_r($res_arr);
	

	/********* code to fetch data from paypal response array start  *********/

	$status='NOTCOMPLETED';

	for($k=0;$k<count($res_arr);$k++){

		$ack = explode("=",$res_arr[$k]);   // echo "<pre>"; print_r($ack); echo "</pre>";

		if($ack[1]=='COMPLETED'){ $status='COMPLETED'; }

	}


    /********** code to fetch data from paypal response array end  **********/
	

	if($status=='COMPLETED')
	{
			//echo "completed"; exit;
			global $current_user;

			$u = new WP_User( $current_user->ID );
			print_r($u);
			echo "hi".$_SESSION['item_id'];
			if($_SESSION['item_id']==871)
			{
			    $u->remove_role( 'subscriber' );
                // Add role
                $u->add_role( 'associate-pmi' ); 
                wp_redirect( get_site_url().'/#sectione6', 302 ); exit; 
			}
			if($_SESSION['item_id']==869)
            { 
                // Remove role
                $u->remove_role( 'subscriber' );
                // Add role
                $u->add_role( 'associate-noprofit' ); 
                wp_redirect( get_site_url().'/#sectione6', 302); exit; 
            }
			
            unset($_SESSION['item_id']);
            unset($_SESSION['item_name']);
			//$post_by	= get_userid_from_postid($id);
			$paykey 	= explode("=",$res_arr[20]);
			//insert record into orders table
			//$orderid = 'ORD'.rand();
			$paydate = date('Y-m-d H:i:s');
			
			/*
			$insert_query=mysql_query("insert into orders (orderid,
                                                     paykey,
													 amount,
													 sellerid,
													 buyerid,
													 post_id,
													 paypal_response,
													 paydate,
													 status
													 ) values (
													 '$orderid',
													 '$paykey[1]',
													 '$amount',
													 '$post_by', 
													 '$user_id',
													 '$id',
													 '$res',
													 '$paydate',
													 'INITIALIZED'
													 )");
			*/


			//$orderid  = $_SESSION['orderid'];

			//$update_query = "update orders set paypal_response = '$res',status='COMPLETED' where orderid='$orderid' ";
			
			//$update = mysql_query($update_query);

			
		   
	
		
			
	
	}else{
	
			echo "NOT completed"; exit; 
				
			$post_by	= get_userid_from_postid($id);
			$paykey 	= explode("=",$res_arr[20]);
			//insert record into orders table
			$orderid = 'ORD'.rand();
			$paydate = date('Y-m-d H:i:s');

            /*
			$insert_query=mysql_query("insert into orders (orderid,
													 paykey,
													 amount,
													 sellerid,
													 buyerid,
													 post_id,
													 paypal_response,
													 paydate,
													 status
													 ) values (
													 '$orderid',
													 '$paykey[1]',
													 '$amount',
													 '$post_by', 
													 '$user_id',
													 '$id',
													 '$res',
													 '$paydate',
													 'NOTCOMPLETED'
													 )");
												*/ 

			//$orderid  = $_SESSION['orderid'];

			//$update_query = "update orders set paypal_response = '$res',status='NOTCOMPLETED' where orderid='$orderid' ";

			//$update = mysql_query($update_query);

	       
		    //echo "<pre>"; print_r($res_arr); exit;
	
	}
	
	
?>