@include('dashboard.header')
<div class="row">
    <div class="col-md-6">
        <h2>變更密碼</h2>
    </div>
    <div class="col-md-6">
    </div>
</div>

<div id="myForm">
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">序號</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext"  value="{{Auth::guard('admin')->user()->id}}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">帳號</label>
        <div class="col-sm-6">
            <input type="text" readonly class="form-control-plaintext"  value="{{Auth::guard('admin')->user()->username}}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">密碼</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" name="password" value="" placeholder="有需要變更密碼，才輸入您要變更密碼。">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="{{Auth::guard('admin')->user()->email}}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">最新登入時間</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="{{date('Y-m-d H:i:s',Auth::guard('admin')->user()->logindate)}}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-2 col-form-label">帳號註冊時間</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value="{{date('Y-m-d H:i:s',Auth::guard('admin')->user()->registerdate)}}">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="button" class="btn btn-primary" name="Send" onclick="SendClick();">送出</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="/dashboard/Personal.js?v=@php echo time();@endphp"></script>

@include('dashboard.footer')