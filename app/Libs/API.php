<?php
namespace App\Libs;

use App\Exceptions\NoResponseException;
use App\Exceptions\TokenExpiredException;
use Ixudra\Curl\Facades\Curl;
use App\Libs\Helper;
use App\Http\Controllers\HomeController;

class API{

    public static function curl($path,$data,$method){
        // $baseUrl =  'https://api.bptr.co.id:9491/v1';
        $testUrl =  'http://localhost:7001/v1';

        $response = Curl::to($testUrl .'/'. $path)
            ->withHeader('Authorization: Bearer ' . session()->get(GlobalVar::TOKEN_LABEL))
            ->withData($data)
            ->asJson()
            ->withOption('SSL_VERIFYPEER',0)
            ->withOption('SSL_VERIFYHOST',0)
            ->$method();

        if($response == null) {
            throw new NoResponseException();
        }else if( isset($response)  && isset($response->message) && $response->message == 'token has expired'){ // refresh token
            // return self::refreshToken($path,$data,$method);
        }
        else if( isset($response)  && isset($response->message)  && $response->message == 'token is invalid') {
            throw new TokenExpiredException();
        }

        return $response;
    }

    public static function refreshToken($oldPath,$oldData,$oldMethod){
        $testUrl =  'http://localhost:7001/v1';
        $result = Curl::to($testUrl .'/auth/token/refresh')
            ->withData(
                array(
                    'refresh_token' => session()->get(GlobalVar::TOKEN_REFRESH),
                )
            )
            ->asJson()
            ->withOption('SSL_VERIFYPEER',0)
            ->withOption('SSL_VERIFYHOST',0)
            ->post();
        
        if($result == null) {
            throw new NoResponseException();
        }else if( isset($response)  && isset($response->message) && $response->message == 'token is invalid') {
            throw new TokenExpiredException();
        }else{
            session()->put(GlobalVar::USERID,$result->data->vendor->id);
            session()->put(GlobalVar::USER_NAME,$result->data->vendor->username);
            session()->put(GlobalVar::WORKSHOP, $result->data->vendor->type == 'workshop' ? '1' : '0');
            session()->put(GlobalVar::EXPEDITION, $result->data->vendor->type == 'expedition' ? '1' : '0');
            session()->put(GlobalVar::TOKEN_LABEL,$result->data->access_token);
            session()->put(GlobalVar::TOKEN_REFRESH,$result->data->refresh_token);
            session()->put(GlobalVar::NAME,$result->data->vendor->name);
        }  

        return self::curl($oldPath,$oldData,$oldMethod);
    }

    public static function curlGetDownload($path,$data,$method,$extension,$filename){
        $baseUrl =  'http://localhost/webcarrent/dev/src/public/api';
        $result = null;
        // $baseUrl =  'https://192.168.90.6/prod/api/vendor';
        //$baseUrl =  'https://36.67.59.59:8481/dev/api/vendor';

        $response = Curl::to($baseUrl .'/'. $path)
            ->withHeader('Authorization: Bearer ' . session()->get(GlobalVar::TOKEN_LABEL))
            ->withData($data)
            ->withOption('SSL_VERIFYPEER',0)
            ->withOption('SSL_VERIFYHOST',0)
            ->withContentType('application/pdf')
            ->get();
        
        if($response == null) {
            throw new NoResponseException();
        }
        else if( isset($response) && isset($response->status) && $response->status == 'Token is Invalid') {
            throw new TokenExpiredException();
        }else{
             $result =Helper::createFile($response,$extension,$filename.'.'.$extension);
        }

        return $result;
    }
    public static function curlGetFile($path,$data,$method){
        $baseUrl =  'https://36.67.59.59:8481/dev/api';

        $response = Curl::to($baseUrl.'/'.$path)
            ->withHeader('Authorization: Bearer ' . session()->get(GlobalVar::TOKEN_LABEL))
            ->withData($data)
            ->asJson()
            ->withOption('SSL_VERIFYPEER',0)
            ->withOption('SSL_VERIFYHOST',0)
            ->$method();

        if($response == null) {
            throw new NoResponseException();
        }
        else if( isset($response) && isset($response->status) && $response->status == 'Token is Invalid') {
            throw new TokenExpiredException();
        }

        return $response;
    }
}
