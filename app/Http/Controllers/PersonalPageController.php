<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class PersonalPageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ask.participation');
        $this->middleware('entrance');
    }

    public static function routes()
    {

        Route::group(['prefix' => 'personal', 'as' => 'personal.'], function () {
            Route::get('/mini', 'PersonalPageController@mini')->name('mini');
            Route::post('/mini', 'PersonalPageController@miniAction')->name('miniAction');
            Route::get('/questions', 'PersonalPageController@questions')->name('questions');
            Route::post('/questions', 'PersonalPageController@questionsAction')->name('questionsAction');

            Route::get('/ppic', 'PersonalPageController@ppic')->name('ppic');
            Route::post('/ppic', 'PersonalPageController@ppicAction')->name('ppicAction');

            Route::get('/cover', 'PersonalPageController@cover')->name('cover');
            Route::post('/cover', 'PersonalPageController@coverAction')->name('coverAction');
            Route::get('/cover/reset', 'PersonalPageController@coverReset')->name('coverReset');

            Route::get('/', function () {
                return redirect()->route('personal.ppic');
            })->name('main');
        });
    }

    public function mini()
    {
        //return redirect()->back()->withErrors(['first'=>'فرصت پاسخ تمام شده است']);
        $user = Auth::user();
        $answers = $user['mini_q'] ? json_decode($user['mini_q'], true) : [];
        return view('pages.personal.mini_question', [
            'questions' => $this->mini_questions(),
            'answers' => $answers
        ]);
    }

    public function miniAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');
        $user->mini_q = json_encode($q);
        $user->save();
        return redirect()->route('landing')->with('success', 'با موفقیت ثبت شد');
    }

    public function questions()
    {
        //return redirect()->back()->withErrors(['first'=>'فرصت پاسخ تمام شده است']);
        $user = Auth::user();
        $answers = $user['questions'] ? json_decode($user['questions'], true) : [];
        return view('pages.personal.question', [
            'questions' => $this->long_questions(),
            'answers' => $answers
        ]);
    }

    public function questionsAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('q');
        $user->questions = json_encode($q);
        $user->save();
        return redirect()->route('landing')->with('success', 'با موفقیت ثبت شد');
    }

    public function ppic()
    {
        $user = Auth::user();
        if ($user['ppic'])
            $ppic = cdn_url() . '/' . $user['ppic'];
        else
            $ppic = "/img/ppic.jpg";
        return view('pages.personal.ppic', [
            'ppic' => $ppic
        ]);
    }

    public function ppicAction(Request $request)
    {
        $user = Auth::user();
        if (!$request->hasFile('ppic'))
            return redirect()->back()->withErrors(['ppic' => 'لطفا یک عکس انتخاب کنید.']);
        Storage::disk('cdn')->makeDirectory('ppic');
        $path = Storage::disk('cdn')
            ->putFileAs('ppic', $request->file('ppic'), $user['id'] . '.jpg');
        $user->ppic = $path;
        $user->save();
        return redirect()->route('landing')->with(['success' => 'با موفقیت بارگذاری شد']);
    }

    public function cover()
    {
        $user = Auth::user();
        $self_cover = $user['cover'] ?: '';
        $covers_text = '';
        $covers = $user->texts()->where('cover', 1)->get();
        foreach ($covers as $c) {
            $covers_text .= $c['content'] . "\n";
        }
        return view('pages.personal.cover', [
            'self_cover' => $self_cover,
            'covers_text' => $covers_text,
            'lines' => $self_cover ? substr_count( $self_cover, "\n" ) : substr_count( $covers_text, "\n" )
        ]);
    }

    public function coverAction(Request $request)
    {
        $user = Auth::user();
        $q = $request->get('cover_words');
        $user->cover = $q;
        $user->save();
        return redirect()->route('landing')->with('success', 'با موفقیت ثبت شد');
    }

    public function coverReset()
    {
        Auth::user()->unset('cover');
        return redirect()->back()->with('success', 'با موفقیت ریست شد');
    }

    public static function mini_questions()
    {
        // 36
        return [
            "پاتوق",
            "یعقوب برقی",
            "آقا یعقوب",
            "روز اول دانشگاه",
            "فارغ التحصیلی",
            "طبقه اساتید",
            "دانشکده کامپیوتر",
            "خیابان ولیعصر",
            "پیچونده شده ترین کلاس",
            "تکه کلام",
            "درس اختیاری",
            "7:45",
            "آز 4.5 تا 7",
            "انتخاب واحد",
            "سایت",
            "کابل LAN",
            "سالن مطالعه",
            "خوابگاه",
            "سه شونزدهم",
            "تمدید",
            "دروس عمومی",
            "سلف",
            "پروژه",
            "حراست",
            "فرجه",
            "تحصن",
            "آز کامپیوتر",
            "بهترین پروژه",
            "بدترین پروژه",
            "در سعید",
            "پلی تکنیک",
            "روز ثبت نام",
            "بزرگترین اشتباه دوران کارشناسیت؟",
            "ردیف آخر",
            "اولین دوست"
        ];
    }

    public static function long_questions()
    {
        // 7
        return [
            "توصیف چهار سال در قالب کلمات و هشتگ",
            "بدترین سوتی ای که دادی چی بود؟",
            "خنده دار ترین خاطره دوران کارشناسیت؟",
            "چی فکر میکردی چی شد؟",
            "آیا میدانستید…",
            "سال 1404 داری چکار میکنی؟",
            "به چه کاری که کردی تو این دوران خیلی افتخار می کنی؟",
        ];
    }
}
