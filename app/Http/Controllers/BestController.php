<?php

namespace App\Http\Controllers;

use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class BestController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ask.participation');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'bests', 'as' => 'bests.'], function () {
            Route::get('/', 'BestController@bests')->name('main');
            Route::post('/', 'BestController@bestsAction')->name('mainAction');

            Route::get('/inst', 'BestController@inst')->name('inst');
            Route::post('/inst', 'BestController@instAction')->name('instAction');

        });
    }

    public function bests()
    {
        //return redirect()->back()->withErrors(['first'=>'فرصت پاسخ تمام شده است']);
        $user = Auth::user();
        $answers = $user['bests_q'] ? json_decode($user['bests_q'], true) : [];
        $users = User::whereIn('_id', $answers)->get()->keyBy('id');
        return view('pages.bests.bests', [
            'titles' => $this->titles(),
            'answers' => $answers,
            'users' => $users,
            'allUsers' => User::where('username','like','92%')->orderBy('username')->get()
        ]);
    }

    public function bestsAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');
        $user->bests_q = json_encode($q);
        $user->save();
        return redirect()->route('landing')->with('success', 'با موفقیت ثبت شد');
    }

    public function inst()
    {
        $user = Auth::user();
        $answers = $user['bests_q_inst'] ? json_decode($user['bests_q_inst'], true) : [];
        $inst = Instructor::whereIn('_id', $answers)->get()->keyBy('id');
        return view('pages.bests.bests-inst', [
            'titles' => $this->instTitles(),
            'answers' => $answers,
            'inst' => $inst,
            'allInst' => Instructor::all()
        ]);
    }

    public function instAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');
        $user->bests_q_inst = json_encode($q);
        $user->save();
        return redirect()->route('landing')->with('success', 'با موفقیت ثبت شد');
    }


    public static function titles()
    {
        // 86
        return [
            2 => "اجتماعی ترین",
            3 => "احساسی ترین",
            4 => "بپیچون ترین",
            5 => "بدشانس ترین",
            6 => "پر حرف ترین",
            7 => "پرکار ترین",
            8 => "تدریس یار ترین",
            9 => "تغییر پیدا کرده ترین",
            10 => "جزوه نویس ترین",
            11 => "جو بده ترین",
            12 => "خسته ترین",
            13 => "خوش خنده ترین",
            14 => "خوش شانس ترین",
            15 => "رک ترین",
            16 => "خوش برخورد ترین",
            17 => "شاخ ترین",
            18 => "شکمو ترین",
            19 => "سم ترین",
            20 => "خجسته ترین",
            21 => "شوخ طبع ترین",
            22 => "کپ زن ترین",
            23 => "کم پیدا ترین",
            24 => "مودب ترین",
            25 => "پر استرس ترین",
            26 => "نمره بگیر ترین",
            27 => "ورزشکار ترین",
            28 => "دوست داشتنی ترین",
            29 => "یعقوب برو ترین",
            30 => "خوش اخلاق ترین",
            31 => "بیخیال ترین",
            32 => "یخ ترین",
            33 => "پایه ترین",
            34 => "خجالتی ترین",
            35 => "مهربون ترین",
            36 => "نرد ترین",
            37 => "با جنبه ترین",
            38 => "با مرام ترین",
            39 => "آنلاین ترین",
            40 => "کم حافظه ترین",
            41 => "هنرمند ترین",
            42 => "تیکه پرون ترین",
            43 => "خوش خواب ترین",
            44 => "جدی ترین",
            45 => "دلسوز ترین",
            46 => "بد امتحان بده ترین",
            47 => "خونسرد ترین",
            48 => "رئیس ترین",
            49 => "آروم ترین",
            50 => "علاف ترین",
            51 => "زود سر کلاس برو ترین",
            52 => "سحرخیز ترین",
            53 => "زود رنج ترین",
            54 => "صدا قشنگ ترین",
            55 => "گیج ترین",
            56 => "مغرور ترین",
            57 => "منطقی ترین",
            58 => "پر انرژی ترین",
            59 => "پیگیر ترین",
            60 => "با جذبه ترین",
            61 => "پر سر و صدا ترین",
            62 => "بی احساس ترین",
            63 => "بی تفاوت ترین",
            64 => "سوال بپرس ترین",
            65 => "تمدید کن ترین",
            66 => "جغدترین",
            67 => "متاخر ترین",
            68 => "سرکلاس بیرون برو ترین",
            69 => "خوش تیپ ترین",
            70 => "تنبل ترین ",
            71 => "کیوت ترین",
            72 => "آویزون استاد ترین",
            73 => "جنتلمن ترین",
            74 => "سیاسی ترین",
            75 => "مسئولیت پذیر ترین",
            76 => "ته نشین ترین",
            77 => "کلاس بپیچون ترین ",
            78 => "کافه برو ترین",
            79 => "غرغرو ترین",
            80 => "ساکت ترین",
            81 => "فیلم بین ترین",
            82 => "کتابخون ترین",
            83 => "کنسل کن ترین",
            84 => "عجیب ترین",
            85 => "پررو ترین",
            86 => "دست و دلباز ترین",
        ];
    }

    public static function instTitles(){
        //34
        return [
            "بهترین ",
            "یخ ترین ",
            "سخت گیر ترین",
            " بی آزار ترین",
            " سم ترین",
            "با حال ترین ",
            "با سواد ترین",
            " خسته ترین ",
            "دوست داشتنی ترین ",
            " زود رنج ترین",
            "تمدید کن ترین",
            "تکلیف بده ترین",
            "ترسناک ترین",
            "با شخصیت ترین",
            "سایکوترین",
            "مریض ترین",
            "تبعیض جنسیتی قائل شو ترین",
            "نمره اضافه بده ترین",
            "کلا به بچه ها توجه نکن ترین",
            "نامفهوم درس بده ترین",
            "پرحرف ترین",
            "دیر ول کن ترین",
            "کوییز بگیر ترین",
            "رو هوا نمره بده ترین",
            "سخت تصحیح کن ترین",
            "صدبار توضیح بده ترین",
            "بد ارائه بده ترین",
            "خاطره سر کلاس تعریف کن ترین",
            "پروژه زن ترین",
            "تی ای اذیت کن ترین",
            "منطقی ترین",
            "خوشتیپ ترین",
            "لوس ترین",
            "غیر قابل پیش بینی ترین",
            "شوخ طبع تری",
            "قانون مدار ترین",
            "متشخص ترین",
            "خوب صحیح کن ترین",
            "باجذبه ترین",
            "خوش اخلاق ترین",
            "آنتایم ترین"
            
        ];
    }
}
