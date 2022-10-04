<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use SoapClient;
use App\Domain;
use App\Port;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{


    private $MerchantID;
    private $Amount;
    private $Description;
    private $CallbackURL;
    private $Email;
    private $ZarinGate;
    private $SandBox;

    public function __construct($amount, $orderId = null)
    {
        $getHost = request()->getHost();
        if ($getHost == 'localhost' or $getHost == 'ishopsazfa.ir') {
            $shop = '2';
        } else {
            $domain = Domain::where('domain', $getHost)->first();
            if (empty($domain->id)) {
                $getHost2 = request()->getSchemeAndHttpHost();
                $domain = Domain::where('domain', $getHost2)->first();
                if (empty($domain->id)) {
                    dd('دامنه به درستی تنظیم نشده است.بدون http و www هم وارد نمایید');
                }
            }
            $shop = $domain->shop_id;
        }
        //test
//        $domain = Domain::where('shop_id', $shop)->first();

        if(empty($domain)){
            dd('هنوز دامنه درگاه پرداختی برای این فروشگاه تعریف نشده است');
        }
        $ports = Port::where('shop_id',$shop)->where('domain_id',$domain->id)->first();
        if(empty($ports)){
            dd('هنوز درگاه پرداختی برای این فروشگاه تعریف نشده است');
        }

        $domainName = $domain->domain;
        $goodUrl = str_replace('http://', '', $domainName);
        $goodUrl = str_replace('www.', '', $goodUrl);
        $goodUrl = str_replace('https://', '', $goodUrl);
        $this->MerchantID = $ports->str1;//'2800ae30-a72a-4a72-b5cf-4e803fd79a57'; //Required
        $this->Amount = $amount; //Amount will be based on Toman - Required
        $this->Description = $ports->description;//'فروشگاه اینترنتی چرلو'; // Required
        $this->CallbackURL = 'http://'.$goodUrl.'/payment-verify/' . $orderId; // Required
//        $this->CallbackURL = 'http://localhost:8000/payment-verify/' . $orderId; // Required
        $this->Email =  Auth::user()->email;
        $this->ZarinGate = true;
        $this->SandBox = false;
    }

    public function doPayment()
    {
        $zp = new Zarinpal();
        $result = $zp->request($this->MerchantID, $this->Amount, $this->Description, $this->Email, $this->Mobile, $this->CallbackURL, $this->SandBox, $this->ZarinGate);
        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success and redirect to pay


            $zp->redirect($result["StartPay"]);
        } else {
            // error

            return $result["Status"] . '=' . $result["Message"];
        }
    }

    public function verifyPayment($authority, $status)
    {
        $zp = new Zarinpal();

        if($status == 'OK'){
            $name =Auth::user()->name.' '.Auth::user()->last_name;
            $message = 'سفارشی با مبلغ'.$this->Amount.' توسط '.$name.' با موفقیت انجام شد ';
            $mobile = array();
            array_push($mobile,'09335281548');
            array_push($mobile,'09124042222');
            array_push($mobile,'09378075037');
            array_push($mobile,'09981200442');
//            $this->send_sms($mobile,$message);//send sms
            //message to user
            $mobile2 = array();
            array_push($mobile2,Auth::user()->phone);
$message2 = 'همراه عزیز با تشکر از خرید شما
سفارش شما با موفقیت ثبت شد.
میتوانید از قسمت سفارشات وضعیت سفارش خود را مشاهده فرمایید.
چرلو
CHERLLO';
//            $this->send_sms($mobile2,$message2);//send sms

        }
        $result = $zp->verify($this->MerchantID, $this->Amount, $this->SandBox, $this->ZarinGate);
        return $result;
    }
    public function send_sms($mobile,$text)
    {

        // your sms.ir panel configuration
        $APIKey = "3af5d11e52492cff108bd11e";
        $SecretKey = "Salione842";
        $LineNumber = "30004523123456";
        $APIURL = "https://ws.sms.ir/";

        // your mobile numbers
        $MobileNumbers = $mobile;
//        $MobileNumbers = $mobile;

        // your text messages
        $Messages = array($text);

        // sending date
        @$SendDateTime = date("Y-m-d")."T".date("H:i:s");

        $SmsIR_SendMessage = new \App\SmsIR_SendMessage($APIKey, $SecretKey, $LineNumber, $APIURL);
        $SendMessage = $SmsIR_SendMessage->sendMessage($MobileNumbers, $Messages, $SendDateTime);

    }

}
