<?php
namespace App\Libs;


class Signature{
	const signKey = 'BA2F91142614565C2A521FE3E5493';
	const nounce = 200; // 15 minutes

	public static function sign($params){ // varible params berbentuk array
		//params yang di sort
		ksort($params); 
		//params string 
		$paramString = null;
		//params key
		$paramsKey = null;
		//index
		$index = 0;
		// separator
		$separator = '';
		
		foreach($params as $key=>$param){
			if($key == 'sign') continue;
			$paramsKey = $separator.$key.'='.$param;
			$paramString .= $paramsKey;
			$separator = '&';
		}
		// hashing sha256 yang bakal jadi sign
		$sign = hash('sha256', self::signKey.$paramString);

		return $sign;
	}

	public static function validate($params){ //bentuknya array
		$result = array(
				'success' => false,
				'timeOut' => null);
		ksort($params);

		$paramString = null;

		$paramKey = null;

		$nounce = null;
		$separator = '';
		foreach($params as $key=>$value){
			if($key == 'sign'){
				$signFrom = $value;
				continue;
			} 
			if($key == 'nounce'){
				$nounce = intVal($value);				
			} 
			$paramsKey = $separator.$key.'='.$value;
			$paramString .=$paramsKey;
			$separator = '&';
		}
		
		$sign = self::sign($params);		
		if($signFrom == $sign){
			$result['success'] = true;
			if(time() - $nounce >=self::nounce){
				$result['timeOut'] = 'Time Out';
				return $result;
			}
			return $result;
		}else{
			return false;
		}
	}
}
?>