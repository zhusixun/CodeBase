<?php

	class Ip
	{	
		/**
		 * 获取客户端真实IP
		 * Get the client's real IP
		 * @return [type] [description]
		 */
		public function get_client_ip()
		{
			$ip = false;
			//$_SERVER['HTTP_CLIENT_IP'] 代理端的IP，可能存在可伪造。
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}

			if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				//$_SERVER['HTTP_X_FORWARDER_FOR'] 用户是在哪个IP使用的代理，可能存在，可以伪造。
				$ips = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
				if($ips){
					array_unshift($ips,$ip);
					$ip = FALSE;
				}

				for($i=0;$i<count($ips);$i++){
					if(!eregi('^(10|172.16|192.168).',$ips['$i'])){
						$ip=$ips[$i];
						break;
					}
				}
			}
			//$_SERVER['REMOTE_ADDR'] 客户端IP，有可能是用户的IP，也可能是代理的IP。
			return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
		}

		/**
		 * 获取服务器真实IP
		 * Get the real IP of the server
		 * @return [type] [description]
		 */
		public function get_server_ip()
		{
			if (isset($_SERVER)){  
				//$_SERVER['SERVER_ADDR'] 获取服务器端IP       
				if($_SERVER['SERVER_ADDR']){            
					$server_ip = $_SERVER['SERVER_ADDR'];         
				}else{         
		 			$server_ip = $_SERVER['LOCAL_ADDR'];         
				}    
		 	}else{        
		 		$server_ip = getenv('SERVER_ADDR');   
		 	}    
		 	return $server_ip; 
		}
	}