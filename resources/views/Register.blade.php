@include('header',['WebTitle'  =>  (!empty($WebTitle) ? $WebTitle : ''),'WebDescription'  =>  (!empty($WebDescription) ? $WebDescription : '')])
@if (env('RECAPTCHAV3_SITEKEY')  && $SystemSteeing['reCAPTCHAV3regCheck'] == 1)
    {!! RecaptchaV3::initJs() !!}
@endif
<div class="heightauto">
<section class="padding-large">
    <div class="container">

        <div class="row align-items-start" style="padding-bottom: 50px;">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">註冊</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div id="myForm" class="child">
            @if (env('RECAPTCHAV3_SITEKEY') && $SystemSteeing['reCAPTCHAV3regCheck'] == 1)
                {!! RecaptchaV3::field('Register') !!}
            @endif
                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label"><div class="floatright fs-6">E-mail</div></label>
                    <div class="col-sm-10 position-relative">
                            <input type="email" class="form-control form-control-lg valid" name="email" value="coderun1688@gmail.com" placeholder="" autocomplete="off" required>
                            <div class="invalid-feedback fs-6">
                                請輸入正確E-mail格式
                            </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label"><div class="floatright fs-6">密碼</div></label>
                    <div class="col-sm-10 position-relative">
                            <input type="password" class="form-control form-control-lg" name="password" value="Cody123456" placeholder="" autocomplete="off" required>
                            <div class="invalid-feedback fs-6">
                                請輸入正確密碼格式，包含 1 個大小寫英文字母、1 個數字、密碼長度至少 6 碼開始以上
                            </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="TermsUse" value="1" checked  required>
                            <label class="form-check-label" >
                                遵守會員使用條款
                            </label>
                            <div class="invalid-feedback">
                                請選擇遵守會員使用條款
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="d-grid gap-2">
                                <button type="button" class="btn btn-success btn-lg" name="Send" onclick="SendClick();">送出</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <a href="/Login"> 已經有帳號，請登入。</a>
                    </div>
                </div>

        </div>
    </div>






</section>
</div>
<script type="text/javascript" src="/js/Register.js"></script>
@include('footer')