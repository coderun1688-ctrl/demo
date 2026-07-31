@include('dashboard.header')

<div class="row">
    <div class="col-md-2">
        <h2>超級管理員</h2>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="adminusername" placeholder="請輸入管理員帳號...">
            <button class="btn btn-primary" type="button" name="Sendclick" onclick="Sendclick();">新增</button>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
            加入超級管理員名單，將不會取決於權限等級控制。
        </div>
    </div>
</div>

<table class="table table-hover ResponsiveTable">
    <thead>
    <tr>
        <th>序號</th>
        <th>帳號</th>
        <th>時間</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @isset($managdb)
    @foreach ($managdb as $key => $value)
    <tr id="tr{{$value->id}}">
        <td data-label="序號" style="vertical-align: middle;">{{$value->id}}</td>
        <td data-label="帳號" style="vertical-align: middle;">{{$value->username}}</td>
        <td data-label="時間" style="vertical-align: middle;">{{date("Y-m-d H:i:s",$value->postdate)}}</td>
        <td data-label="操作" style="vertical-align: middle;">
            @if ($value->id == 1)
                ---
            @else
                <button type="button" class="btn btn-danger" onclick="DeleteList('{{$value->id}}');" {{$counter}}>刪除</button>
            @endif

        </td>
    </tr>
    @endforeach
    @endempty
    </tbody>
</table>

{{$managdb->links() }}


<script type="text/javascript" src="/dashboard/SuperAdmin.js?v=@php echo time();@endphp"></script>


@include('dashboard.footer')