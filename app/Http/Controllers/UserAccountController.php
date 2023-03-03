<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\RepositoryAPI\UserAccountRepository;
use Validator;
use App\Libs\Helper;

class UserAccountController extends Controller
{
    public function index()
    {

        return view('layouts.login');
    }

    public function getLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('post/create')
                ->withErrors(trans('messages.errorInvalidLogin'))
                ->withInput();
        }

        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember') ? 1 : 0;
        
        $result = UserAccountRepository::getToken($username,$password,$remember);
       
        
        if(isset($result) && isset($result->message) && $result->message != "invalid credential"){
            $request->session()->put(\App\Libs\GlobalVar::USER_ID,$result->data->user->id);
            $request->session()->put(\App\Libs\GlobalVar::USER_NAME,$result->data->user->username);
            $request->session()->put(\App\Libs\GlobalVar::CLIENT_LOCATION_ID,$result->data->user->client_location_id == 0 ? null : $result->data->user->client_location_id);
            $request->session()->put(\App\Libs\GlobalVar::CLIENT_ID,$result->data->user->client_id == 0 ? null : $result->data->user->client_id);
            $request->session()->put(\App\Libs\GlobalVar::TOKEN_LABEL,$result->data->access_token);
            $request->session()->put(\App\Libs\GlobalVar::NAME,$result->data->user->client_name);
            $request->session()->put(\App\Libs\GlobalVar::CLIENT_LOCATION_NAME,$result->data->user->client_location_name);
            $request->session()->put(\App\Libs\GlobalVar::CONTRACT_OR,$result->data->user->permission->contract_or);
            $request->session()->put(\App\Libs\GlobalVar::CONTRACT_PRICE,$result->data->user->permission->contract_price);
            $request->session()->put(\App\Libs\GlobalVar::RECEIPT_OR,$result->data->user->permission->receipt_or);
            $request->session()->put(\App\Libs\GlobalVar::CALLCENTER_FEEDBACK,$result->data->user->permission->callcenter_feedback);
            $request->session()->put(\App\Libs\GlobalVar::ROLE,$result->data->user->role);
            $request->session()->put(\App\Libs\GlobalVar::RECEIPT_MENU,$result->data->user->permission->receipt);
            $request->session()->put(\App\Libs\GlobalVar::TAXRECEIPT_MENU,$result->data->user->permission->tax_receipt);
            $request->session()->put(\App\Libs\GlobalVar::INVOICE_MENU,$result->data->user->permission->invoice);
            $request->session()->put(\App\Libs\GlobalVar::GPS_HISTORY,$result->data->user->permission->gps_history);


            return redirect()->action('HomeController@index');
        }else{
            return redirect()->action('UserAccountController@index')
                ->withErrors(trans('messages.errorInvalidLogin'))
                ->withInput();
        }

        return $result;
    }
    
    public function getLogout(Request $request){
        $request->session()->flush();
        Auth::logout();

        return redirect()->action('UserAccountController@index');
    }

    public function getProfil(Request $request){
        $data = UserAccountRepository::getMyDetail();

    }

    public function changePassword(Request $request){

        return view('userAccount.changePassword');
    }

    public function postChangePassword(Request $request){
        $rules = array(
            'currentPassword' => 'required|max:800',
            'newPassword' => 'required|max:800',
            'confirmPassword' => 'required|max:800|same:newPassword'
        );

        // Validates.
        $inputs = $request->all();
        $validator = Validator::make($inputs, $rules);

        // Validation fails?
        if ($validator->fails()){
            return redirect()->action('UserAccountController@changePassword')
                ->withErrors($validator);
        }

        $filter = new \stdClass();
        $filter->currentPassword = $request->input('currentPassword');
        $filter->newPassword = $request->input('newPassword');
        $filter->confirmPassword = $request->input('confirmPassword');

        $result = UserAccountRepository::postChangePassword($filter);

        if($result->success == false){
            $request->session()->flush();
            return redirect()->action('UserAccountController@index')->with('error',$result->message);
        }else{
            return redirect()->action('UserAccountController@changePassword')->with('successMessage' ,'Password has been saved successfully.') ;
        }
    }

    public function getGanalyticUserId(){
        return Helper::googleAnalyticUserId();
    }
}
