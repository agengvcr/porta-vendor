<?php
namespace webcarrent\Libs;

use webcarrent\Libs\Signature;
use Log;
class BptrFile{
	const base_urlClient = 'http://localhost/bataviarentvendor/trunk/public/image?';
	const base_urlVendor = 'http://localhost/bataviarentvendor/trunk/public/image?';

	public static function generateUrl($params,$type = 'vendor'){
		ksort($params); 
		//params string 
		$paramString = null;
		//params key
		$paramsKey = null;
		//index
		$index = 0;
		// separator
		$separator = '';

		$nounce = time();
		
		foreach($params as $key=>$param){
			$paramsKey = $separator.$key.'='.$param;
			$paramString .= $paramsKey;
			$separator = '&';
		}

		$sign = Signature::sign($params);

		if($type == 'vendor'){
			return self::base_urlVendor.$paramString.'&sign='.$sign;
		}elseif ($type == 'client') {
			return self::base_urlClient.$paramString.'&sign='.$sign;
		}else {
			return false;
		}
	}

}
?>