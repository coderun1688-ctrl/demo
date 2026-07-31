@include('dashboard.header')

<div class="row">
    <div class="col-md-2">
        <h2>新增管理員</h2>
    </div>
    <div class="col-md-2">
        <a href="{{ url()->previous() }}" class="btn btn-secondary" >返回上一頁</a>
    </div>
    <div class="col-md-4">

    </div>
</div>


<div id="myForm">

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">權限等級</label>
        <div class="col-sm-10">
            @foreach ($AdminPermissionlist as $key=>$value)

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="groups" value="{{$key}}">
                    <label class="form-check-label" >{{$value}}</label>
                </div>

            @endforeach
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">帳號</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" value="">
            <div class="invalid-feedback">
                請輸入帳號
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="">
            <div class="invalid-feedback">
                請輸入正確 E-mail 格式
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label  class="col-sm-2 col-form-label">密碼</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" value="">
            <div class="invalid-feedback">
                請輸入正確密碼格式，包含 1 個大小寫英文字母、1 個數字、密碼長度至少 6 碼開始以上
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="button" class="btn btn-primary" name="Send" onclick="SendAddClick();">送出</button>
        </div>
    </div>

</div>


<script type="text/javascript" src="/dashboard/AdminAddEdit.js?v=@php echo time();@endphp"></script>

@include('dashboard.footer')