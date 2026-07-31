@include('dashboard.header')

<div class="row">
    <div class="col-md-6">
        <h2>系統屬性</h2>
    </div>
    <div class="col-md-6">

    </div>
</div>


<ul class="nav nav-pills mb-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="Basic-tab" data-bs-toggle="tab" data-bs-target="#Basic-tab-pane" type="button" role="tab" aria-controls="Basic-tab-pane" aria-selected="true">基本配置</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="Verify-tab" data-bs-toggle="tab" data-bs-target="#Verify-tab-pane" type="button" role="tab" aria-controls="Verify-tab-pane" aria-selected="false">驗證機制</button>
    </li>
</ul>

<div id="myForm">

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade heightauto show active" id="Basic-tab-pane" role="tabpanel" aria-labelledby="Basic-tab" tabindex="0">
                <br>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">網站名稱</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="Steeing[WebTitle]" value="{{(isset($managdb['WebTitle']) && $managdb['WebTitle']  ? $managdb['WebTitle'] : "")}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">網站描述</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="Steeing[WebDescription]" rows="3">{{(isset($managdb['WebDescription']) && $managdb['WebDescription']  ? $managdb['WebDescription']  : "")}}</textarea>

                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">網站 Logo</label>
                    <div class="col-sm-10">


                        <img id="imagePreview" src="{{(isset($managdb['WebLogoFile']) && $managdb['WebLogoFile']  ? $managdb['WebLogoFile'] : "")}}" alt="圖片預覽" onerror="this.onerror=null; this.src='/image/errorlogo.png';" style="max-width: 143px;" >


                        <input type="file"  name="WebLogoFile" accept="image/*">

                        <div class="form-text">
                                Logo 圖檔 143x48，檔案大小不得超過 1 MB。
                        </div>

                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">系統開關</label>
                    <div class="col-sm-10">

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="Steeing[WebHome]" value="1" {{(isset($managdb['WebHome']) && $managdb['WebHome']  ? "checked" : "")}}>
                            <label class="form-check-label" for="switchCheckChecked">關閉前端</label>
                        </div>

                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">動作</label>
                    <div class="col-sm-10">


                        <div class="form-check form-check-inline form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="Steeing[CheckDefault]" value="1" {{(isset($managdb['CheckDefault']) && $managdb['CheckDefault'] == 1  ? "checked" : "")}}>
                            <label class="form-check-label" for="switchCheckDefault">顯示訊息</label>
                        </div>
                        <div class="form-check form-check-inline form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="Steeing[CheckDefault]" value="2" {{(isset($managdb['CheckDefault']) && $managdb['CheckDefault'] == 2  ? "checked" : "")}}>
                            <label class="form-check-label" for="switchCheckChecked">顯示 500 錯誤訊息</label>
                        </div>


                    </div>
                </div>

                <div class="mb-3 row">
                    <label  class="col-sm-2 col-form-label">訊息</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="Steeing[content]" rows="6">{{(isset($managdb['content']) ? $managdb['content'] : "")}}</textarea>
                    </div>
                </div>

        </div>
        <div class="tab-pane fade heightauto" id="Verify-tab-pane" role="tabpanel" aria-labelledby="Verify-tab" tabindex="0">


            <div class="mb-3 row">
                <label  class="col-sm-2 col-form-label">驗證動作</label>
                <div class="col-sm-10">


                    <div class="form-check form-check-inline form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Steeing[reCAPTCHAV3regCheck]" value="1" {{(isset($managdb['reCAPTCHAV3regCheck']) && $managdb['reCAPTCHAV3regCheck'] == 1  ? "checked" : "")}}>
                        <label class="form-check-label" >註冊會員使用 reCAPTCHAv3 強化安全</label>
                    </div>

                    <div class="form-check form-check-inline form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Steeing[reCAPTCHAV3loginCheck]" value="1" {{(isset($managdb['reCAPTCHAV3loginCheck']) && $managdb['reCAPTCHAV3loginCheck'] == 1  ? "checked" : "")}}>
                        <label class="form-check-label" >登入會員使用 reCAPTCHAv3 強化安全</label>
                    </div>
                    <br>

                    <div class="form-check form-check-inline form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Steeing[reCAPTCHAV3ForgotPasswordCheck]" value="1" {{(isset($managdb['reCAPTCHAV3ForgotPasswordCheck']) && $managdb['reCAPTCHAV3ForgotPasswordCheck'] == 1  ? "checked" : "")}}>
                        <label class="form-check-label" >找回密碼使用 reCAPTCHAv3 強化安全</label>
                    </div>


                    <div class="form-check form-check-inline form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Steeing[reCAPTCHAV3ContactUsCheck]" value="1" {{(isset($managdb['reCAPTCHAV3ContactUsCheck']) && $managdb['reCAPTCHAV3ContactUsCheck'] == 1  ? "checked" : "")}}>
                        <label class="form-check-label" >連絡我們使用 reCAPTCHAv3 強化安全</label>
                    </div>


                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-text">
                        請先到 reCAPTCHAv3 取得 SITEKEY 及 SECRET，開啓 .env 檔案在 RECAPTCHAV3_SITEKEY/RECAPTCHAV3_SECRET 輸入SITEKEY 及 SECRET。<br>
                        <a href="https://www.google.com/recaptcha/" target="_blank">reCAPTCHAv3</a>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label  class="col-sm-2 col-form-label">註冊強制驗證E-mail</label>
                <div class="col-sm-10">


                    <div class="form-check form-check-inline form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Steeing[EmailCheck]" value="1" {{(isset($managdb['EmailCheck']) && $managdb['EmailCheck'] == 1  ? "checked" : "")}}>
                        <label class="form-check-label" >驗證 E-mail 才能登入</label>
                    </div>

                    <div class="form-text">
                        開啓 .env 檔案在 MAIL_HOST、MAIL_PORT、MAIL_USERNAME、MAIL_PASSWORD、MAIL_ENCRYPTION、MAIL_FROM_ADDRESS 設定。
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="button" class="btn btn-primary" name="Send" onclick="SendClick();">送出</button>
        </div>
    </div>

</div>

<script type="text/javascript" src="/dashboard/SystemSteeing.js?v=@php echo time();@endphp"></script>

@include('dashboard.footer')