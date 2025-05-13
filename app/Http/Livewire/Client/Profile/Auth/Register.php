<?php

namespace App\Http\Livewire\Client\Profile\Auth;

use App\Helpers\Sender;
use App\Helpers\Wati;
use App\Models\User;
use Livewire\Component;

class Register extends Component
{

    public $mobile = "", $name = "", $email = "";
    public $otpError = "", $authMessage = "", $authError = "", $otp_modal = "";
    public $sendOTPExpirate = "", $otp, $sendOTP = "", $mobileWithCode = "";
    public $otp_status =  true;

    protected $listeners = ['register'];

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
        return [
            'mobile' => 'required',
            'name' => 'required|string|min:3',
            'email' => 'nullable|email|string',
        ];
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
    }


    public function register($mobileCode)
    {
        $this->validate();
        $this->emptymessage();

        $mobile = str_replace("+", "", $mobileCode);
        $donor = User::where('mobile', $mobile)->get()->first();
        if ($donor != null) {
            return $this->authError = __('This number is already exist');
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

            $this->sendOTPExpirate = time() + 600;
            // Send OTP in SMS 
            $this->otp = "";
            $this->otp_modal = true;
        } else {
            $this->LoginWithOutOtp($mobile);
        }
        $this->mobileWithCode = $mobile;
    }

    public function LoginWithOutOtp($mobile)
    {

        $donor = User::create([
            'name' => $this->name,
            'mobile' => $mobile,
            'email' => $this->email,
        ]);

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
        auth()->login($donor);
        $this->authMessage = __("You Loggin Sucessfully");
        $this->otp_modal = false;
        // $this->updateCart();
        $this->emit('authUpdated');
        $this->emit('updateAuth');
        return redirect()->route('client.profile.index');

    }


    public function emptymessage()
    {
        $this->authError = "";
        $this->otpError = "";
        $this->authMessage = "";
    }

    public function closeModalOTP()
    {
        $this->otp_modal = false;
    }

    public function render()
    {
        return view('livewire.client.profile.auth.register');
    }
}
