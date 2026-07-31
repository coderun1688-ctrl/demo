@include('dashboard.header')


<div class="row">
    <div class="col-md-2">
        <h2>權限等級</h2>
    </div>
    <div class="col-md-4">
            <button class="btn btn-primary" type="button" name="Sendclick" onclick="SendAddclick();">新增權限</button>
    </div>
</div>
<table id="myForm" class="table table-hover ResponsiveTable">
    <thead>
    <tr>

        <th>序號</th>
        <th>名稱</th>
        <th>權限</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @isset($managdb)
        @foreach ($managdb as $key => $value)
            <tr id="tr{{$value->id}}">

                <td data-label="序號" style="vertical-align: middle;">{{$value->id}}</td>
                <td data-label="名稱" style="vertical-align: middle;">

                        <input type="text" class="form-control" name="setting[{{$value->id}}][levelname]" value="{{$value->levelname}}" placeholder="請輸入名稱">

                </td>

                <td data-label="權限" style="vertical-align: middle;">

                    <a href="/dashboards/Permission/Levelvalue/{{$value->id}}" class="btn btn-info">權限</a>

                </td>

                <td data-label="操作" style="vertical-align: middle;">

                    <button type="button" class="btn btn-danger" onclick="DeleteClick('{{$value->id}}')">刪除</button>


                </td>
        </tr>
        @endforeach
    @endempty
    </tbody>
</table>


<p class="text-center">
    <button type="button" class="btn btn-success" onclick="Sendclick()">送出</button>
</p>


<script type="text/javascript">
var id = '{!!$pid['id']!!}';
</script>


<script type="text/javascript" src="/dashboard/Permission.js?v=@php echo time();@endphp"></script>


@include('dashboard.footer')