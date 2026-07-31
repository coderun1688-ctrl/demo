@include('header',['WebTitle'  =>  (!empty($WebTitle) ? $WebTitle : ''),'WebDescription'  =>  (!empty($WebDescription) ? $WebDescription : '')])
<div class="heightauto">
    <section class="padding-large">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">個人中心</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row">
                <div class="col-md-2">

                    @include('PersonalMenu')


                </div>
                <div class="col-md-10">


                    <div class="row g-3">
                        <div class="col-sm-2">
                            <label class="visually-hidden">匿名名稱</label>
                            <input type="text" readonly class="form-control-plaintext" value="匿名名稱">
                        </div>
                        <div class="col-sm-4">
                            <label class="visually-hidden">匿名名稱</label>
                            <input type="text" name="username" class="form-control-plaintext" value="{{(isset($member->username) ? $member->username : '---')}}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" name="usernameonSuccess" class="btn btn-success mb-3 d-none" onclick="usernameSendonClick()">送出</button>
                            <button type="button" name="usernameonClick" class="btn btn-primary mb-3" onclick="usernameonClick()">修改</button>
                        </div>
                    </div>


                    <div class="row g-3">
                        <div class="col-sm-2">
                            <label class="visually-hidden">E-mail</label>
                            <input type="text" readonly class="form-control-plaintext" value="E-mail">
                        </div>
                        <div class="col-sm-4">
                            <label class="visually-hidden">E-mail</label>
                            <input type="text" name="email" class="form-control-plaintext" value="{{(isset($member->email) ? $member->email : '---')}}" autocomplete="off" required>
                        </div>
                        <div class="col-auto">
                            <button type="button" name="emailonSuccess" class="btn btn-success mb-3 d-none" onclick="emailSendonClick()">送出</button>
                            <button type="button" name="emailonClick" class="btn btn-primary mb-3" onclick="emailonClick()">修改</button>
                        </div>
                    </div>



                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">登入時間</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext"  value="{{(isset($member->logindate) ? date('Y-m-d H:i:s',$member->logindate) : '未知')}}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2 col-form-label">註冊時間</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext"  value="{{(isset($member->registerdate) ? date('Y-m-d H:i:s',$member->registerdate) : '未知')}}">
                        </div>
                    </div>


                </div>
            </div>


        </div>


    </section>
</div>


<script type="text/javascript" src="/js/PersonalCenter.js?v=@php echo time();@endphp"></script>


@include('footer')