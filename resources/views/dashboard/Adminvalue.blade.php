@include('dashboard.header')

<div class="row">
    <div class="col-md-4">
        <h2>{{(isset($AdminPermissionlist[$id]) && $AdminPermissionlist[$id] ? $AdminPermissionlist[$id] : '')}}權限</h2>
    </div>
    <div class="col-md-2">
        <a href="{{ url()->previous() }}" class="btn btn-secondary" >返回上一頁</a>
    </div>

</div>
<div id="myForm">
    <input type="hidden" name="id" value="{{$id}}">
    <div class="mb-3">
        <div class="col-sm-12">
            <p>後臺權限</p>
        </div>
    </div>
    <div class="mb-3">
        <div class="col-sm-12">
            <div style="padding-left:80px;">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Setting[OpenBackend]" value="1"  {{(isset($AdminGroupid['OpenBackend']) && $AdminGroupid['OpenBackend'] ? "checked" : "")}} >
                        <label class="form-check-label" for="switchCheckChecked">進入後臺權限</label>
                    </div>
            </div>
        </div>
    </div>

    @isset($MenuList)
    @foreach ($MenuList as $key=>$value)

        <div class="mb-3">
            <div class="col-sm-12">
                <p>{{$value['name']}}</p>
            </div>
        </div>

        <div class="mb-3">
            <div class="col-sm-12">
                <div style="padding-left:80px;">
                @foreach ($value['option'] as $k=>$v)

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" name="Setting[{{$k}}]" value="1" {{(isset($AdminGroupid[$k]) && $AdminGroupid[$k] ? "checked" : "")}} >
                        <label class="form-check-label" for="switchCheckChecked">{{$v}}</label>
                    </div>

                @endforeach
                </div>
            </div>
        </div>

    @endforeach
    @endempty
</div>
<p class="text-center">
    <button type="button" class="btn btn-success" name="Send" onclick="SendClick();">送出</button>
</p>


<script type="text/javascript" src="/dashboard/Adminvalue.js?v=@php echo time();@endphp"></script>


@include('dashboard.footer')