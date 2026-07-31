@include('dashboard.header')

<div class="row">
    <div class="col-md-2">
        <h2>管理員</h2>
    </div>
    <div class="col-md-2">
        <a href="/dashboards/AdminList/AddData" class="btn btn-secondary">新增帳號</a>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="SearchKeyword" placeholder="請輸入管理員帳號...">
            <button class="btn btn-primary" type="button" name="Sendclick" onclick="Sendclick();">搜尋</button>
        </div>
    </div>
</div>



<table class="table table-hover ResponsiveTable">
    <thead>
    <tr>

        <th>帳號</th>
        <th>權限等級</th>
        <th>E-Mail</th>
        <th>登入時間</th>
        <th>註冊時間</th>
        <th>狀態</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @isset($managdb)
        @foreach ($managdb as $key => $value)
            <tr id="tr{{$value->id}}">

                <td data-label="帳號" style="vertical-align: middle;">{{$value->username}}</td>
                <td data-label="權限等級" style="vertical-align: middle;">{{$AdminPermissionlist[$value->groups]}}</td>
                <td data-label="E-Mail" style="vertical-align: middle;">{{$value->email}}</td>
                <td data-label="登入時間" style="vertical-align: middle;">{{date("Y-m-d H:i:s",$value->logindate)}}</td>
                <td data-label="註冊時間" style="vertical-align: middle;">{{date("Y-m-d H:i:s",$value->registerdate)}}</td>
                <td data-label="狀態" id="Status{{$value->id}}" style="vertical-align: middle;">
                    @if ($value->active == 1)
                        <span class="badge text-bg-success">帳號啓用中</span>
                    @else
                        <span class="badge text-bg-danger">帳號停權中</span>
                    @endif

                </td>
                <td data-label="操作" style="vertical-align: middle;">

                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                操作選單
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if ($value->id ==  1)
                                    <li><a class="dropdown-item" href="/dashboards/AdminList/EditData/{{$value->id}}/{{$managdb->currentPage()}}">編輯帳號</a></li>
                                @else
                                    <li><a class="dropdown-item" href="/dashboards/AdminList/EditData/{{$value->id}}/{{$managdb->currentPage()}}">編輯帳號</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:;" onclick="EnableClick('{{$value->id}}');">帳號啓用</a></li>
                                    <li><a class="dropdown-item" href="javascript:;" onclick="DisableClick('{{$value->id}}');">帳號停權</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:;" onclick="DeleteList('{{$value->id}}');">刪除帳號</a></li>
                                @endif


                            </ul>
                        </div>

                </td>
            </tr>
        @endforeach
    @endempty
    </tbody>
</table>

{{$managdb->onEachSide(2)->appends(['SearchKeyword' => $SearchKeyword])->links() }}


<script type="text/javascript" src="/dashboard/AdminList.js?v=@php echo time();@endphp"></script>



@include('dashboard.footer')