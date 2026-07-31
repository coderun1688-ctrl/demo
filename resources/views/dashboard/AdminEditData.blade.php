@include('dashboard.header')

<div class="row">
    <div class="col-md-2">
        <h2>編輯管理員</h2>
    </div>
    <div class="col-md-2">
        <a href="{{ url()->previous() }}/?page={{$page}}" class="btn btn-secondary" >返回上一頁</a>
    </div>
    <div class="col-md-4">

    </div>
</div>


<div id="myForm">
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="page" value="{{$page}}">
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">權限等級</label>
        <div class="col-sm-10">
            @foreach ($AdminPermissionlist as $key=>$value)

                @if ($key == $Admindb->groups)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="groups" value="{{$key}}" checked>
                        <label class="form-check-label" >{{$value}} </label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="groups" value="{{$key}}">
                        <label class="form-check-label" >{{$value}} </label>
                    </div>
                @endif


            @endforeach
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">帳號</label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" name="username" value="{{$Admindb->username}}">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-2 col-form-label">E-mail</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="{{$Admindb->email}}">
            <div class="invalid-feedback">
                請輸入正確 E-mail 格式
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label  class="col-sm-2 col-form-label">密碼</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" placeholder="需要變更密碼才輸入，否則無需要輸入。">
            <div class="invalid-feedback">
                請輸入正確密碼格式，包含 1 個大小寫英文字母、1 個數字、密碼長度至少 6 碼開始以上
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="button" class="btn btn-primary" name="Send" onclick="SendEditClick();">送出</button>
        </div>
    </div>

</div>

<script type="text/javascript" src="/dashboard/AdminAddEdit.js?v=@php echo time();@endphp"></script>

@include('dashboard.footer')