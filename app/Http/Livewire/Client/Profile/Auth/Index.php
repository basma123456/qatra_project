<?php

namespace App\Http\Livewire\Client\Profile\Auth;

use App\Models\User;
use App\Helpers\Sender;
use App\Helpers\Wati;
use Livewire\Component;

class Index extends Component
{

    public $new_donor = false, $otp_modal = false, $sendOTP = "", $sendOTPExpirate = "";
    public $mobile = "", $name = "", $email = "", $otp = "", $mobileWithCode = "";
    public $authError = "", $otpError = "";
    public $authMessage = "", $show_auth =  true, $otp_status =  true;
    public $type;

    protected $listeners = ['login', 'register'];

    public $testMobiles = [
        "966597767751",
        "966567296308",
        "966561611117",
        "966540265614",
        "201011700412",
        "201112185974",
    ];

    protected function rules()
    {
        if ($this->new_donor) {
            return [
                'mobile' => 'required',
                'name' => 'required|string|min:3',
                'email' => 'nullable|email|string|unique:users',
            ];
        } else {
            return [
                'mobile' => 'required',
            ];
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updateNewDonor($val)
    {
        $this->emptymessage();
        $this->mobile = "";
        $this->name   = "";
        $this->email  = "";
        $this->otp    = "";
        $this->new_donor = $val;
    }


    public function login($mobileCode)
    {
        $this->validate();
        $this->emptymessage();
        $mobile = str_replace("+", "", $mobileCode);

        $donor = User::where('mobile', $mobile)->get()->first();
        if ($donor == null) {
            $this->authError = __('This number is not registered with us');
            return;
        }
        if ($this->otp_status) {
            // generate otp
            if (in_array($mobile, $this->testMobiles)) {
                $this->sendOTP = "1234";
            } else {
                $this->sendOTP = rand(1000, 9999);
                if (substr($mobile, 0, 3) == "996") {
                    // Send OTP in SMS
                    $sender = new Sender();
                    $sender->sendOTP($mobile, $this->sendOTP);
                } else {
                    // Send OTP in Whatsapp
                    $wati = new Wati();
                    $wati->sendotp($mobile,  $this->sendOTP);
                }
            }

            // update donor otp
            $donor->otp = $this->sendOTP;
            $this->sendOTPExpirate = time() + 600;
            // $donor->expiration = time() + 600;
            $donor->save();
            $this->otp = "";
            $this->otp_modal = true;
        } else {
            $this->LoginWithOutOtp($mobile);
        }
        $this->mobileWithCode = $mobile;

    }


    public function register($mobileCode){
        $this->validate();
        $this->emptymessage();
        $mobile = str_replace("+", "", $mobileCode);

        $donor = User::where('mobile', $mobile)->get()->first();
        if($donor != null){
            return $this->authError = __('This number is already exist');
        }
        if($this->otp_status){
            // generate otp
            if(in_array($mobile, $this->testMobiles)){
                $this->sendOTP = "1234";
            }
            else{
                $this->sendOTP = rand(1000, 9999);
                if (substr($mobile, 0, 3) == "996") {
                    // Send OTP in SMS
                    $sender = new Sender();
                    $sender->sendOTP($mobile, $this->sendOTP);
                } else {
                    // Send OTP in Whatsapp
                    $wati = new Wati();
                    $wati->sendotp($mobile,  $this->sendOTP);
                }
            }

            $this->sendOTPExpirate = time() + 600;
            // Send OTP in SMS
            $this->otp = "";
            $this->otp_modal = true;

        }else{
            $this->LoginWithOutOtp($mobile);
        }
        $this->mobileWithCode = $mobile;
    }

    public function LoginWithOutOtp($mobile)
    {
        if (!$this->new_donor) {
            $donor = User::where('mobile', $mobile)->get()->first();
            if ($donor->first() == null) {
                return $this->authError =  __('This number is already exist');
            }
        } else {
            $donor = User::create([
                'name' => $this->name,
                'mobile' => $mobile,
                'email' => $this->email,
            ]);
        }
        auth()->login($donor);
        $this->updateCart();
        $this->authMessage = __("You Loggin Sucessfully");
        $this->otp_modal = false;
        $this->emit('authUpdated');
        $this->emit('updateAuth');
    }


    public function checkOTP()
    {
        $this->emptymessage();

        if ($this->otp == "") {
            return $this->otpError = __('OTP is required');
        }

        if (!$this->new_donor) {
            $donor = User::where('mobile', $this->mobileWithCode)->get()->first();
            // if (@$donor->expiration < time()) {
            //     return $this->otpError = __('The OTP is expired');
            // }
            if ($this->sendOTPExpirate < time()) {
                return $this->otpError = __('The OTP is expired');
            }
            if (@$this->otp !=  $donor->otp) {
                return $this->otpError = __('The OTP is wrong');
            }
            if ($donor->first() == null) {
                $this->otp_modal = false;
                return $this->authError = __('This number is not registered with us');
            }
        } else {
            if ($this->sendOTPExpirate < time()) {
                return $this->otpError = __('The OTP is expired');
            }
            if ($this->sendOTP != $this->otp) {
                return $this->otpError = __('The OTP is wrong');
            }
            $donor = User::create([
                'name' => $this->name,
                'mobile' => $this->mobileWithCode,
                'email' => $this->email,
            ]);
        }
        auth()->login($donor);
        $this->authMessage = __("You Loggin Sucessfully");
        $this->otp_modal = false;
        // $this->updateCart();
        $this->emit('authUpdated');
        $this->emit('updateAuth');
    }

    public function closeModalOTP()
    {
        $this->otp_modal = false;
    }

    public function emptymessage()
    {
        $this->authError = "";
        $this->otpError = "";
        $this->authMessage = "";
    }

    // public function updateCart()
    // {
    //     $cart = new DatabaseCart();
    //     $cart->updateDonor();
    // }

    public function render()
    {
        return view('livewire.client.profile.auth.index');
    }
}
