<?php

/*
* @Author           : Prabaharan.S
* @Created Date     : 11/10/2019
* @Version          : 0.1
* @Description      : login auth api controller for web pages 
* Controller Name   : Rabbitmq.php
*/


defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/core/API_Controller.php';
use \PhpAmqpLib\Wire\AMQPTable;
use PhpAmqpLib\Connection\AMQPConnection;
class Rabbitmq extends API_Controller {
	public $sms_count = 1;
	public $get_type;
	public $messagedata;
	/**
     * Rabbitmq constructor.
    */
    public function __construct ()
    {
        parent::__construct ();
		$this->output->set_content_type('application/json');
		$this->sms_count = 1;
    }
	
    /**
     * @OA\Post(
     *     path="/api/queue_push",
     *     tags={"queue"},
     *     summary="queue push",
     *     operationId="queue_push",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="type",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="page",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="limit",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
	/**
     * Rabbitmq API
     * 
     * @link : api/login
     * @method : POST
     */
    public function queue_push_post() {

        $arr_immediate_send = $arr_publish_on_date_send = $params = array();

        $type = $this->post('type', true);
        $page = $this->post('page', true);
        $limit = $this->post('limit', true);
        
        if(!$type) {
        	$this->response (['status' => 'error','response'=>'Please pass the parameters correctly.'] , API_Controller::HTTP_OK
			);
        }

        $get_logs = $this->_get_logs($type, $page, $limit);



        $from = RABBIT_FROM_MAIL;
        $cc_mail = RABBIT_CC_MAIL;
		//$config_device_token = $this->config->item('send_not');
        if($type == 'sms') {
        	$this->queue_name = SMS_QUEUE;
        	$params['exchange'] = SMS_EXCHANGE;
            $type_log_id='sms_log_id';
        } else if($type == 'mail') {
        	$this->queue_name = EMAIL_QUEUE;
        	$params['exchange'] = EMAIL_EXCHANGE;
            $type_log_id='mail_log_id';
        } else if($type == 'notification') {
        	$this->queue_name = PUSH_QUEUE;
        	$params['exchange'] = PUSH_EXCHANGE;
            $type_log_id='notifi_log_id';
        }
        $params['routing'] = RABBIT_ROUTING;
        $permanent = true; //$delivery_mode = 2; # make message persistent,  (delivery_mode/permanent) both are same (https://www.cloudamqp.com/blog/2017-12-29-part1-rabbitmq-best-practice.html)
        if($get_logs) {
        	$get_logs = $get_logs['data'];
        	foreach($get_logs as $k=>$v) {
        		$publish_date = $v['publish_date'];
        		$first_name = $v['first_name'];
        		$middle_name = $v['middle_name'];
        		$last_name = $v['last_name'];
        		$email_id = $v['email_id'];
        		$per_email_id = $v['per_email_id'];
        		$mobile_no = $v['mobile_no'];
        		$immediate_send = $v['immediate_send'];
        		$publish_str_time = strtotime($publish_date);
                $log_id=$v[$type_log_id];
        		$arr1 = array();
        		if($type == 'mail') {
        			$arr1['from'] = $from;
		        	$arr1['to'] = $email_id;
		        	$arr1['headers'] = "From: ".$from . "\r\n" ."CC: ".$cc_mail;
                    $subject = $v['subject'];
                    $message = $v['mail_cont'];
                    $arr1['title'] = $subject;
                    $arr1['content'] = $message;
		        } 
		        if($type == 'sms') {
		        	$arr1['mobile_no'] = $mobile_no;
		        	$subject = $v['title'];
        			$message = $v['sms_cont'];
        			$arr1['title'] = $subject;
                    $arr1['content'] = $message;
		        }
		        if($type == 'notification') {
					$device_id = $v['device_id'];
					$device_token = $v['device_token'];
					//$device_token = $config_device_token['android_device_token'];
					$device_type_id = $v['device_type_id'];
					$title = $v['title'];
					$notifi_cont = $v['notifi_cont'];
			        $arr1['device_id'] = $device_id;
			        $arr1['device_token'] = $device_token;
			        $arr1['device_type_id'] = $device_type_id;
			        $arr1['title'] = $title;
			        $arr1['notifi_cont'] = $notifi_cont;
					$arr1['immediate_send'] = $immediate_send;
		        }						        				
                $arr1['log_id']=$log_id;
                $arr1['publish_time']=$publish_str_time;
        		if($immediate_send == 'f') {
        			if(count($arr1) > 0) {
				        $params['x-delayed-type'] = RABBIT_DEALYED_TYPE;
				        $params['x-delay'] = $publish_str_time;
				        $pushResponse[] = $this->rabbitmq_client->push($this->queue_name, json_encode($arr1), $permanent, $params);
			        }
        		} else {
        			array_push($arr_immediate_send, $arr1);						
        		}
        	}
        }
        
        /*$arr1['from'] = 'prabaharan.srm@gmail.com';
        $arr1['to'] = 'prabaharans@mailinator.com';
        $arr1['subject'] = 'mail through the RabbitMQ';
        $arr1['message'] = 'test mail through the RabbitMQ';
        $arr1['headers'] = "From: prabaharan.srm@gmail.com" . "\r\n" ."CC: prabaharansv@mailinator.com";
        array_push($arr, $arr1);
        $arr2['from'] = 'prabaharan.srm@gmail.com';
        $arr2['to'] = 'prabaharan.s.v@mailinator.com';
        $arr2['subject'] = 'mail through the RabbitMQ';
        $arr2['message'] = 'test mail through the RabbitMQ';
        $arr2['headers'] = "From: prabaharan.srm@gmail.com" . "\r\n" ."CC: prabaharansvk@mailinator.com";
        array_push($arr, $arr2);*/

        if(count($arr_immediate_send) > 0) {
        	// $params['immediate'] = true;
        	$arr = $arr_immediate_send;
        	$pushResponse[] = $this->rabbitmq_client->push($this->queue_name, json_encode($arr), $permanent, $params);

        }	

        if($pushResponse) {
            $update_processed = $this->_processed_log($this->queue_name,$pushResponse , 'processed');
            $this->response (['status'=>'true','response'=>$pushResponse], API_Controller::HTTP_OK);
        	$this->response (['status'=>'true','response'=>$pushResponse,'queue'=>$this->queue_name], API_Controller::HTTP_OK);	
        } else {
        	$this->response (['status' => 'error','response'=>$pushErrResponse,'queue'=>$this->queue_name] , API_Controller::HTTP_OK
			);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/queue_pull",
     *     tags={"queue"},
     *     summary="queue pull",
     *     operationId="queue_pull",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="type",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function queue_pull_post() {
        // echo 'test';die;
        // $this->response (['status'=>'true','response'=>true], API_Controller::HTTP_OK);
        // $this->rabbitmq_client->pull('hello_queue', true, array($this, '_process_mail'));
        $this->get_type = $type = $this->post('type', true);
        if($type == 'sms') {
        	$this->queue_name = SMS_QUEUE;
        } else if($type == 'mail') {
        	$this->queue_name = EMAIL_QUEUE;
        } else if($type == 'notification') {
        	$this->queue_name = PUSH_QUEUE;
        }
        $pullResponse = $this->rabbitmq_client->pull($this->queue_name, true, array($this, '_process'));

        // $pullResponse = $this->rabbitmq_client->pull(EMAIL_QUEUE, true, 'Rabbitmq::_process_mail');

        if($pullResponse) {
        	$this->response (['status'=>'true','response'=>$pullResponse], API_Controller::HTTP_OK);	
        } else {
        	$this->response (['status' => 'error','response'=>$pullErrResponse] , API_Controller::HTTP_OK
			);
        }
    }

    public function _process(PhpAmqpLib\Message\AMQPMessage $message) { 

    	$arr = array();

    	if($message) {
            $msg = $message->body;

            $headers = $message->get('application_headers');
		    $nativeData = $headers->getNativeData();

            // $arr['message'] = json_decode(json_encode($message), true);
            /* delayed detail fetch in nativeData */
            // $arr['nativeData'] = $nativeData;
            if($msg) {
                $arr_msg = json_decode($msg, true);
                $check_type = false;
                if($this->get_type == 'sms') {
                	$check_type = $arr_msg['mobile_no'];
                } else if($this->get_type == 'mail') {
                	$check_type = $arr_msg['from'];
                } else if($this->get_type == 'notification') {
                	$check_type = $arr_msg['device_token'];
                }
                if($check_type != '') {
                	$arr['arr_msg'] = $arr_msg;
                	$arr['arr_msg']['nativeData'] = $nativeData;
                	$arr['arr_msg']['get_type'] = $this->get_type;
					list($get_type, $delayFlag, $r, $is_send) = $this->_process_array($arr_msg);
                    $arr['is_send'] = $is_send;
					// $arr['delayFlag'] = $delayFlag;
                	$arr['r'] = $r;
                	if($this->get_type == 'sms') {
                		$arr['sms_count'] = $this->sms_count;
                	}
                	// $arr['get_type'] = $get_type;
                } else {
                	foreach($arr_msg as $k=>$v) {
                		$arr['arr_msg'][$k] = $v;
                		list($get_type, $delayFlag, $r, $is_send) = $this->_process_array($v);
                		$arr['is_send'][$k] = $is_send;
                		// $arr['delayFlag'][$k] = $delayFlag;
                		$arr['r'][$k] = $r;
                		if($this->get_type == 'sms') {
                			$arr['sms_count'][$k] = $this->sms_count;
                		}
                		// $arr['get_type'][$k] = $get_type;
                	}
                }
                if((!is_array($arr['is_send']) && $arr['is_send'] == true) || (is_array($arr['is_send']) && !in_array(false, $arr['is_send']))) {
                	// if(isset($message->delivery_info['delivery_tag'])) {
	        		/* Release a message */
		        		$this->rabbitmq_client->unlock($message);	
		        	// }	
                }
            } else {
            	$arr['msg_empty'] = true;
            }
            return $arr;
        }
    }

    public function _process_array($arr_msg) {
        $get_type = $this->get_type;
        if($get_type == 'sms') {
        	$mobile = $arr_msg['mobile_no'];
            $this->queue_name = SMS_QUEUE;
        } else if($get_type == 'mail') {
        	$from = $arr_msg['from'];
        	$to = $arr_msg['to'];
            $this->queue_name = EMAIL_QUEUE;
        } else if($get_type == 'notification') {
        	$device_token = $arr_msg['device_token'];
            $this->queue_name = PUSH_QUEUE;
        }
        
        $subject = $arr_msg['title'];
		$notifi_cont = $arr_msg['notifi_cont'];
        $content = $arr_msg['content'];
        $headers = $arr_msg['headers'];
        $nativeData = $arr_msg['nativeData'];
        $log_id=$arr_msg['log_id'];
        $delayFlag = false;
        if(isset($nativeData['x-delay'])) {
        	if($nativeData['x-delay']) {
        		$x_delay = $nativeData['x-delay'];
        		if($x_delay <= strtotime(date('Y-m-d'))) {
        			$delayFlag = false;	
        		} else {
        			$delayFlag = true;
        		}
        	}	
        }	
        $r = false;
        if(!$delayFlag) {
        	if($get_type == 'sms') {
        		// if($this->sms_count == 1) {
        			$r = $this->send_sms_post($mobile, $content);
        		// }
        		$this->sms_count++;	
        	} else if($get_type == 'mail') {                
                $r = $this->_send_mail($to, $subject, $content, $headers);
        	} else if($get_type == 'notification') {
				$r = $this->_send_notification($device_token,$subject,$notifi_cont);
        	}
        	// $r = 1;
        }
        if($get_type == 'sms') {
        	if($r['status'] == 'success') {
        		$is_send = true;	
        		$update_sent = $this->_sent_log($this->queue_name,$log_id,'sent');
        	} else {
        		$is_send = false;	
        	}
        } elseif($get_type == 'mail') {
        	if($r == 1) {
	            $update_sent = $this->_sent_log($this->queue_name,$log_id,'sent');
	        	$is_send = true;
	        } else {
	        	$is_send = false;
	        }	
        }else{
			if($r['success'] == 1){
	            $update_sent = $this->_sent_log($this->queue_name,$log_id,'sent');
	        	$is_send = true;				
			}	else {
	        	$is_send = false;
	        }	
		}
        // return array('get_type'=>$get_type, 'delayFlag'=>$delayFlag, 'response'=>$r, 'is_send'=>$is_send);
        return array($get_type, $delayFlag, $r, $is_send);
    }

    protected function _get_logs($type = 'sms', $page = false, $limit = false , $log_id = false)
    {
        $user_data = $this->_RESTConfig([
            'methods' => ['GET'],
            'requireAuthorization' => true,
        ]);
        
        if($type == 'sms') {
        	$schema_table_name = SCHEMA_LOGINFO.'.'.LOGINFO_SMS_LOG;
        	$pk_col_name = 'sms_log_id';
        	$sent_col_name = 'sent';
    	}
    	if($type == 'mail') {
    		$schema_table_name = SCHEMA_LOGINFO.'.'.LOGINFO_MAIL_LOG;
    		$pk_col_name = 'mail_log_id';
    		$sent_col_name = 'sent';
    	}
    	if($type == 'notification') {
    		$schema_table_name = SCHEMA_LOGINFO.'.'.LOGINFO_NOTIFICATION_LOG;
    		$pk_col_name = 'notifi_log_id';
    		$sent_col_name = 'sent';
    	}

        $function_name = $this->get_function_name(__FUNCTION__);
        $cond = array();
        if($log_id) {
        	$cond[$schema_table_name.'.'.$pk_col_name] = $log_id;
        }
        $cond[$schema_table_name.'.processed'] = 'f';
        $cond[$schema_table_name.'.'.$sent_col_name] = 'f';

        $params = array();
        $params['function_name'] = $function_name;
        $params['page'] = $page;
        $params['limit'] = $limit;
        $params['cond'] = $cond;
        $params['get_type'] = $type;
        $params['action'] = 'user_login';
        $params['returnresponse']= TRUE;
        $params = $this->_set_log_params($params);
        return $this->_select_table($params);
    }

    /*public function queue_purge_post() {
        $this->rabbitmq_client->purge('hello_queue');
    }

    public function queue_delete_post() {
        $this->rabbitmq_client->delete('hello_queue');
    }*/

    // public function send_sms_post($phone, $message) {
    public function send_sms_post($phone, $message) {
    	$is_send = false;
    	$config_send_sms = $this->config->item('send_sms');
    	$mode = RABBIT_SMS_LIVE ? 'prod' :'stage';
    	$apiKey = $config_send_sms[$mode]['api_key'];
		// $secretKey = $config_send_sms[$mode]['secret_key'];
		$sender_id = $config_send_sms[$mode]['sender_id'];
		/* get sender id */
		/*$url=$config_send_sms['create_sender_id_url'];
		$data = array();
		$data['apikey'] = $apiKey;
		$data['secret'] = $secretKey;
		$data['usetype'] = $mode;
        $sender_id = $this->call_external_api($url,'GET',$data);*/

        /* send sms */
        /*if($sender_id) {
        	$url=$config_send_sms['send_campaign_url'];
			$data = array();
			$data['apikey'] = $apiKey;
			$data['secret'] = $secretKey;
			$data['usetype'] = $mode;
			$data['phone'] = $phone;
			$data['senderid'] = $sender_id;
			$data['message'] = $message;
	        $is_send = $this->call_external_api($url,'POST',$data);
        }*/
        if($sender_id) {
        	$url=$config_send_sms['send_campaign_url'];
			$data = array();
			$data['apikey'] = $apiKey;
			// $data['apikey'] = $apiKey;
			 $data['numbers'] = $phone;
			//$data['numbers'] = RABBIT_CC_SMS_NUMBER;
			$data['sender'] = $sender_id;
			$data['message'] = $phone.' - '.$message;
	        $is_send = $this->call_external_api($url,'POST',$data);
            /*echo "<pre>";
            print_r($is_send);
            die;*/
        }
        return $is_send;
    }
	
	/*public function _send_notification($android_device_token,$title,$message){
    	$is_send = false;
    	$config_send_not = $this->config->item('send_not');
		$mode = RABBIT_NOT_LIVE ? 'prod' :'stage';
		$authorization = $config_send_not[$mode]['authorization'];
		$url = $config_send_not['not_url'];
		$data = array();
		$data['authorization'] = $authorization;
		$data['android_device_token'] = $android_device_token;
		$data['title'] = $title;
		$data['message'] = $message; 
		$jsonObject = array(
			"to"=>$android_device_token,
			"notification"=>
			array(
			"title"=>$title,
			"body"=>$message
			)
		);

		// Headers Need To Be Send
		$headers = array(
		'Authorization: key=AAAAe_OAec0:APA91bGCkkAdRD2pZgIsIFlN4WQbkNa2zkdsAGlYUhsZxY9WeBroSemvqZ9zLJWXEDt5TnQ0fdC1omy-uLxeDTJLDo_FQT4H3wEbdxvRxh1i8Ht4GZpSD-aNFx3Sr9f5FzUoajntN3ie', // FIREBASE_API_KEY_FOR_ANDROID_NOTIFICATION
		'Content-Type: application/json'
		);

		// Open Curl Connection
		$ch = curl_init();
		// Set The Url
		curl_setopt( $ch,CURLOPT_URL, $url );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		// Disabling SSL Certificate Support Temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $jsonObject ) );
		// Execute Post
		$result = curl_exec($ch);
		print_r($result);
		exit;
		/* if($result === false){
		die('Curl failed:' .curl_errno($ch));
		}
		// Close Connection
		curl_close( $ch );
		// Return JSON Response
		return json_decode($result,true); 
    }	*/
	
	public function _send_notification($android_device_token,$title,$message){
    	$is_send = false;
    	$config_send_not = $this->config->item('send_not');
		$mode = RABBIT_NOT_LIVE ? 'prod' :'stage';
		$authorization = $config_send_not[$mode]['authorization'];
		$url = $config_send_not['not_url'];
	
		$data['notification'] = json_encode(
			array(
				"to"=>$android_device_token,
				"notification"=>
				array(
				"title"=>$title,
				"body"=>$message
				),
				"priority"=>"high"
			)
		);
	
		// Headers Need To Be Send
		$data['headers']['authorization'] = $config_send_not['authorization'];
		$data['headers']['content-type'] =  $config_send_not['content_type'];		
		$is_json = true;
		$is_send = $this->call_external_api($url,'POST',$data,$is_json);
		return $is_send;
    }	

    public function _processed_log($queue_name , $pushresponse , $columns)
    {
        if($queue_name == EMAIL_QUEUE)
        {
            for($i=0;$i<count($pushresponse);$i++)
            {
                $log_id = $pushresponse[$i]['msg']['log_id'];
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_MAIL_LOG;
                $log_id_col='mail_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
            }
        }

        if($queue_name == SMS_QUEUE)
        {
            for($i=0;$i<count($pushresponse);$i++)
            {
                $log_id = $pushresponse[$i]['msg']['log_id'];
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_SMS_LOG;
                $log_id_col='sms_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
            }
        }

        if($queue_name == PUSH_QUEUE)
        {
            for($i=0;$i<count($pushresponse);$i++)
            {
                $log_id = $pushresponse[$i]['msg']['log_id'];
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_NOTIFICATION_LOG;
                $log_id_col='notifi_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
            }
        }
       
    }

    public function update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col)
    {
        $table_prefix = '';
        $_PUT[$table.'.'.$columns]='1';
        $put_array[$columns] = '1';
        $put_array['id'] = $log_id;
        $id_col = $log_id_col;
        $this->_common_update($table,$table_prefix,false,$columns,$put_array,$id_col);
    }

    public function _send_mail($to, $subject, $content, $headers)
    {
        $this->load->library('email');
        $this->email->from(RABBIT_FROM_MAIL, "Admin Team");
        $this->email->to($to);
        //$this->email->to(RABBIT_TO_MAIL);
        $this->email->cc(RABBIT_CC_MAIL);
        $this->email->subject($subject);
        $this->email->message($content);
        if ($this->email->send())
          {
            return 1;
          }
          else
          {
                return 0;
          }
       
    }

    public function _sent_log($queue_name , $log_id , $columns)
    {
        
        if($queue_name == EMAIL_QUEUE)
        {
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_MAIL_LOG;
                $log_id_col='mail_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
        }

        if($queue_name == SMS_QUEUE)
        {
                //$log_id = $response['log_id'];
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_SMS_LOG;
                $log_id_col='sms_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
        }

        if($queue_name == PUSH_QUEUE)
        {
                //$log_id = $response['log_id'];
                $table_schema = SCHEMA_LOGINFO;
                $table = $table_schema.'.'.LOGINFO_NOTIFICATION_LOG;
                $log_id_col='notifi_log_id';
                $this->update_processed_sent($table,$table_schema,$log_id,$columns,$log_id_col);
        }
       
    }
	
	/**
     * Rabbitmq API for Reject The Message
     * 
     * @link : api/queue_reject
     * @method : POST
     */	

	public function processed(PhpAmqpLib\Message\AMQPMessage $message){
		$data['result'] = json_decode($message->body,true);
		if($data['result'][0]['log_id']== $this->logid && $data['result'][0]['immediate_send']=='t'){
			$data['already_sent'] = "You cant reject the message because the message has been already sent";
		}elseif($data['result']['log_id'] == $this->logid){
			$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);		
		}	
		$data['delivery_tag'] = $message->delivery_info['delivery_tag'];			
		return $data; 
	}
	
	public function queue_reject_post() {
		$this->get_type = $type = $this->post('type', true);
        if($type == 'sms') {
        	$this->queue_name = SMS_QUEUE;
        } else if($type == 'mail') {
        	$this->queue_name = EMAIL_QUEUE;
        } else if($type == 'notification') {
        	$this->queue_name = PUSH_QUEUE;
        }
		//$this->logid= '12';
		$this->logid= $this->post('logid', true);

		// echo "hello";
		$response = $this->rabbitmq_client->getConsume($this->queue_name,array($this,'processed'));
		echo json_encode($response);
	}

}


