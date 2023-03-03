<?php
namespace App\Http\RepositoryAPI;
use Session;
use App\Libs\API;

class UserAccountRepository {
    public static function getToken($username,$password,$remember){
        $result = API::curl(
            'auth/token/get',
            array(
                'username' => $username,
                'password' => $password,
                'remember' => isset($remember) ? 1 : 0
            ),
            'post'
        );
        
        return $result->success == true ? $result : $result->message;
	}

    public static function postChangePassword($filter){
        $result = API::curl(
            'auth/change-password',
            array(
                'current_password' => $filter->currentPassword,
                'new_password' => $filter->newPassword,
                'confirm_password' => $filter->confirmPassword,
            ),
            'post'
        );

        return $result;
    }

    public static function refreshToken(){
        $result = API::refreshToken();

        return $result;
    }

    // public static function getMyDetail(){

    //     $result = API::curl(
    //         'user/me',
    //         array(
    //         ),
    //         'get');

    //     return $result;
    // }
}
?>
