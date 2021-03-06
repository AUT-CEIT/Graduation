@extends('layouts.app')

@push('styles')
<style>
    body {
        background: url('/img/5.jpg') no-repeat fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
    <div class="wrapper home">
        <div class="header header-filter">
            <div class="container">

                <div class="row sharing-area text-center">
                    <h3 class="brand">{{'ورودی‌های ۹۲ دانشکده کامپیوتر'}}</h3>
                    <a href="{{route('content.article')}}?for=1" class="btn btn-raised btn-facebook sharrre">
                        {{'ارسال متن برای صفحه دوستان'}}
                    </a>
                    <a href="{{route('bests.main')}}" class="btn btn-raised btn-google-plus sharrre">
                        {{'ترین ها'}}
                    </a>
                    {{--<a href="{{route('content.article')}}?cover=1" class="btn btn-raised btn-primary sharrre">--}}
                        {{--{{'نوشتن کاور برای دوستان'}}--}}
                    {{--</a>--}}
                    <a href="{{route('bests.inst')}}" class="btn btn-raised btn-warning sharrre">
                        {{'ترین اساتید'}}
                    </a>
                    <a href="{{route('personal.main')}}" class="btn btn-raised btn-primary sharrre">
                        {{'صفحه شخصی'}}
                    </a>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="description">
                            <a href="https://tikio.io/grad92" class="btn btn-raised btn-warning sharrre">
                                {{'ثبت نام نهایی در جشن'}}
                            </a>
                            <h3>{{'سلام'}}</h3>
                            <h4>{{'سال نوتون مبارک'}}</h4>

                            <p>{{'این بخش ها رو باید پر کنید تا در صفحه شخصیتون توی مجله فارغ التحصیلی قرار بگیره. پس لطفا با دقت و کامل پر کنید تا صفحتون خالی نمونه.'}}</p>
                            <p>{{'صفحه شخصی از چند تا بخش تشکیل میشه که یه سری رو شما پر می کنید. یه سری رو هم دیگران واستون پر می کنن. در آخرم خودتون تصمیم میگیرید کدوم مطالب تو صفحاتتون باشه. قسمتی که واسه دیگران باید پر کنید هنوز آماده نیست ولی اونایی که خودتون باید پر کنید آمادست و از 4 بخش تشکیل شده:'}}</p>
                            <ul>
                                <li>{{'سوالات کوتاه پاسخ که به 18 تا حداقل باید پاسخ بدید'}}</li>
                                <li>{{' سوالات بلند که به 3 تا حداقل باید پاسخ بدید'}}</li>
                                <li>{{'یه عکسی که دوست دارید تو صفحتون باشه مثل یک سلفی خاطره انگیز و ...'}}</li>
                                <li>{{' توصیف چهار سال دانشجوییتون در قالب کلمات و هشتگ های پراکنده ( تا می تونید بنویسید)'}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row sharing-area text-center">
                    <a href="{{route('content.writers')}}" id="twitter" class="btn btn-raised btn-twitter sharrre">
                        {{'کی چقد واسه شما نوشته'}}
                    </a>

                    <a href="{{route('content.articles')}}" id="twitter" class="btn btn-raised btn-google-plus sharrre">
                        {{'متن های نوشته شده برای من'}}
                    </a>
                    <a href="{{route('personal.cover')}}" class="btn btn-raised btn-facebook sharrre">
                        {{'انتخاب کلمه کاور از بین نوشته شده ها برای صفحه'}}
                    </a>
                </div>
                <div class="row sharing-area text-center">
                   @if(Auth::user()->isAdmin('secret'))
                        <a href="{{route('secret.home')}}" class="btn btn-raised btn-default sharrre">
                            {{'اسپایز'}}
                        </a>
                   @endif
                   @if(Auth::user()->isAdmin('journal'))
                        <a href="{{route('journal.home')}}" class="btn btn-raised btn-primary sharrre">
                            {{'تحریریه'}}
                        </a>
                   @endif
                   @if(Auth::user()->isAdmin('admin'))
                        <a href="{{route('admin.home')}}" class="btn btn-raised btn-warning sharrre">
                            {{'پنل ادمین سیاه'}}
                        </a>
                   @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('.soon').click(function () {
            toastr.info('به زودی')
        })
    })
</script>
@endpush