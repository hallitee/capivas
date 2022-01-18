<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User;
use App\Slider;
use App\Series;
use App\Season; 
use App\Episodes;
use App\Movies;
use App\HomeSection;
use App\Sports;
use App\Pages;
use App\RecentlyWatched;
use App\Language;
use App\Genres;
use App\Settings;
use App\SportsCategory;
use App\SubscriptionPlan;
use App\Transactions;
use App\SettingsAndroidApp;
use App\TvCategory;
use App\LiveTV;
use App\Player;


use App\PasswordReset;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use URL;
use Illuminate\Support\Facades\Password;

require(base_path() . '/public/stripe-php/init.php'); 

class VasApiController extends MainAPIController
{
      
    public function index(Request $req)
    {   
            $res = "";
            $serviceCode = $req->input('serviceCode');
            $sessionId = $req->input('sessionId');
            $phone = $req->input('phoneNumber');
            $text = $req->input('text');
            $cur= getcong('currency_code')[0];
            $plan = SubscriptionPlan::where('status', 1)->where('plan_vas', 'YES')->where('vas_code', '!=', NULL)->orderby('vas_code', 'asc')->get();
                $half = $plan->count()/2;
            $lim = 5;
            if($text=="" || $text=='0'){
                if($half>=$lim){
                    $plan = $plan->take($half);
                }
                $res = "CON Capivas Streaming Plans \n";
                foreach($plan as $k=>$p){
                    $k+=1;
                    $price = (int)$p->plan_price;
                    $res.="$p->vas_code $cur".$price." for $p->plan_name"."\n";

                }
                if($half>=$lim){
                    $res.="\n 99 for more options";
                }
            }
            else if($text=="99"){
                if($half>=$lim){
                    $plan = $plan->skip($half);
                }
                $res = "CON Capivas Streaming Plans \n";
                foreach($plan as $k=>$p){
                    $k+=1;
                    $price = (int)$p->plan_price;
                    $res.="$p->vas_code $cur".$price." for $p->plan_name"."\n";
                }
                if($half>=$lim){
                    $res.="\n 0 back to Main menu";
                }
            }
            else{
                $plan = SubscriptionPlan::where('vas_code', $text)->first();
                $price = (int)$plan->plan_price;
                $res = "END $cur$price for ".$plan->plan_name." activated successfully \n";
                $res.=" for  $phone";

               
                
                $plan_info = $plan;
                $plan_id = $plan->id;
                $plan_name=$plan_info->plan_name;
                $plan_days=$plan_info->plan_days;
                $plan_amount=$plan_info->plan_price;

                $currency_code=getcong('currency_code')?getcong('currency_code'):'USD';

               // $user_id=Auth::user()->id;

                $phone = str_replace('+', '', $phone);
                if(count(str_split($phone))>11){
                   $phone = str_replace('234', '', $phone); 
                }
                
                //echo $phone;
                $user = User::where('phone', 'LIKE', "%".$phone."%")->first();
                if($user==null){
                    if(count(str_split($phone))==11){
                        $phone = substr($phone, 1);
                        $user = User::where('phone', 'LIKE', "%".$phone."%")->first();
                    }
                }

                $user->plan_id = $plan->id;                    
                $user->start_date = strtotime(date('m/d/Y'));             
                $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));
                
                $user->paystack_payment_id = $phone;
                $user->plan_amount = $plan_amount;
                //$user->subscription_status = 0;
                $user->save();


                $payment_trans = new Transactions;

                $payment_trans->user_id = $user->id;
                $payment_trans->email = $user->email;
                $payment_trans->plan_id = $plan_id;
                $payment_trans->gateway = 'VAS';
                $payment_trans->payment_amount = $plan_amount;
                $payment_trans->payment_id = $phone;
                $payment_trans->date = strtotime(date('m/d/Y H:i:s'));                    
                $payment_trans->save();

                //Session::flash('plan_id',Session::get('plan_id'));
                
                 //Subscription Create Email
                $user_full_name=$user->name;

                $data_email = array(
                    'name' => $user_full_name
                     );    

             if(getenv("MAIL_USERNAME"))
            {
                \Mail::send('emails.subscription_created', $data_email, function($message) use ($user,$user_full_name){
                    $message->to($user->email, $user_full_name)
                        ->from(getcong('site_email'), getcong('site_name')) 
                        ->subject('Subscription Created');
                });
            }
            

            }
           

            return response($res, 200)
    ->header('Content-Type', 'text/plain');
         
    }

}
