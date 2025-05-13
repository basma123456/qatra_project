<?php

namespace App\Http\Controllers;

use App\Models\Marketer;
use App\Models\Message;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $marketer = null;
        $code = null;
        if ($request->aff) {
            $code = $request->aff;
            $marketer = Marketer::where('affiliate_code', $code)->first();
            if ($marketer) {
                Cookie::queue('marketer_id', $marketer->id, 21600);
            }
        }
        $sliders = Slider::where("status", 1)->get();
        return view("front.home", compact("sliders", "code"));
    }

    public function account()
    {
        return view('account');
    }

    public function mosques()
    {
        return view('mosques');
    }

    public function products()
    {
        return view('products');
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function order_history()
    {
        return view('order_history');
    }

    public function notification()
    {
        return view('notification');
    }

    public function setting()
    {
        return view('setting');
    }

    public function payment()
    {
        return view('payment');
    }

    public function order_success()
    {
        return view('order-success');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function otp()
    {
        return view('otp');
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function tracking()
    {
        return view('tracking');
    }

    public function about()
    {
        return view('about');
    }

    public function faq()
    {
        return view('faq');
    }

    public function lang()
    {
        return view('lang');
    }

    public function aboutus()
    {
        return view('aboutus');
    }

    public function contactus()
    {
        return view('contactus');
    }

    public function contactus_submit(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'mobile' => 'required|digits_between:10,16',
                'email' => 'required|email|nullable',
                'subject' => 'required',
                'text' => 'required',
            ],
            [],
            [
                'subject' => 'موضوع الرسالة',
                'text' => 'تفاصيل الرسالة',
            ]
        );
        $row = $request->all();
        // return $row;
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $device_family = "Unknown";

        $row['ip'] = $request->ip();
        $device_family = "Unknown";
        if ($agent->isDesktop()) $device_family = "Desktop";
        if ($agent->isMobile()) $device_family = "Mobile";
        if ($agent->isTablet()) $device_family = "Tablet";
        if ($agent->isRobot()) $device_family = "Robot";

        $row['device_family'] = $device_family;
        $row['device_model'] = $agent->device();
        $row['browser_family'] = $browser;
        $row['browser_version'] = $agent->version($browser);
        $row['platform_family'] = $platform;
        $row['platform_version'] = $agent->version($platform);

        Message::create($row);
        return redirect()->route("contactus")->with("success", "تم إستلام رسالتك بنجاح");
    }

    public function terms()
    {
        return view('terms');
    }

    public function policy()
    {
        return view('policy');
    }

    public function forgot2()
    {
        return view('forgot2');
    }

    //     function ddd(){
    //         $html = <<<EOF
    // <select class="advSearchDDL chosen-rtl" id="ddlDistrict" data-placeholder="الرجاء الإنتظار" selectedindex="0" style="display: none;"><option id="الكل">الكل</option><option id="10200006001">حي العدل</option><option id="10200006050">حي اجياد</option><option id="10200006045">حي الاندلس</option><option id="10200006057">حي البحيرات</option><option id="10200006027">حي البيبان</option><option id="10200006063">حي البيعة</option><option id="10200006065">حي التروية</option><option id="10200006013">حي التقوى</option><option id="10200006047">حي التنعيم</option><option id="10200006018">حي التيسير</option><option id="10200006023">حي الجامعة</option><option id="10200006006">حي الجميزة</option><option id="10200006028">حي الحجون</option><option id="10200006016">حي الحرم</option><option id="10200006073">حي الحطيم</option><option id="10200006051">حي الحمراء وام الجود</option><option id="10200006011">حي الخالدية</option><option id="10200006041">حي الخضراء</option><option id="10200006004">حي الخنساء</option><option id="10200006040">حي الراشدية</option><option id="10200006009">حي الرصيفة</option><option id="10200006054">حي الروابي</option><option id="10200006002">حي الروضة</option><option id="10200006048">حي الزاهر</option><option id="10200006025">حي الزهراء</option><option id="10200006067">حي السلام</option><option id="10200006056">حي السلامة</option><option id="10200006005">حي السليمانية</option><option id="10200006030">حي الشبيكة</option><option id="10200006066">حي الشرائع</option><option id="10200006059">حي الشهداء</option><option id="10200006034">حي الشوقية</option><option id="10200006072">حي الصفا</option><option id="10200006026">حي الضيافة</option><option id="10200006029">حي الطندباوي</option><option id="10200006053">حي العتيبية</option><option id="10200006022">حي العزيزية</option><option id="10200006061">حي العسيلة</option><option id="10200006043">حي العكيشية</option><option id="10200006055">حي العمرة الجديدة</option><option id="10200006038">حي العوالي</option><option id="10200006070">حي الفتح</option><option id="10200006015">حي القرارة والنقا</option><option id="10200006033">حي الكعكية</option><option id="10200006068">حي الكوثر</option><option id="10200006021">حي المرسلات</option><option id="10200006012">حي المسفلة</option><option id="10200006020">حي المشاعر</option><option id="10200006003">حي المعابدة</option><option id="10200006064">حي المغمس</option><option id="10200006069">حي المقام</option><option id="10200006042">حي الملك فهد</option><option id="10200006032">حي المنصور</option><option id="10200006052">حي النزهة</option><option id="10200006024">حي النسيم</option><option id="10200006058">حي النوارية</option><option id="10200006035">حي الهجرة</option><option id="10200006031">حي الهجلة</option><option id="10200006008">حي الهنداوية</option><option id="10200006036">حي بطحاء قريش</option><option id="10200006007">حي جبل النور</option><option id="10200006010">حي جرهم</option><option id="10200006019">حي جرول</option><option id="10200006062">حي جعرانة</option><option id="10200006017">حي حارة الباب والشامية</option><option id="10200006046">حي ريع زاخر</option><option id="10200006037">حي شرائع المجاهدين</option><option id="10200006049">حي شعب عامر وشعب علي</option><option id="10200006014">حي كدي</option><option id="10200006071">حي معاد</option><option id="10200006060">حي وادي جليل</option><option id="10200006044">حي ولي العهد</option></select>
    // EOF;
    //         echo strip_tags($html);
    //     }
}
