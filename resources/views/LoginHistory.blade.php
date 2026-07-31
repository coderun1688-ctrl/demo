@include('header',['WebTitle'  =>  (!empty($WebTitle) ? $WebTitle : ''),'WebDescription'  =>  (!empty($WebDescription) ? $WebDescription : '')])
<div class="heightauto">
    <section class="padding-large">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">登入記錄</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    @include('PersonalMenu')
                </div>
                <div class="col-md-10">


                            <table class="table ResponsiveTable table-hover">
                                <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>From</th>
                                    <th>時間</th>
                                </tr>
                                </thead>
                                <tbody>
                                @isset($managdb)
                                    @foreach ($managdb as $key => $value)
                                            <tr>
                                                <td  data-label="IP">{{$value->ip}}</td>
                                                <td  data-label="From">{{$value->from}}</td>
                                                <td  data-label="時間">{{date('Y-m-d H:i:s',$value->logindate)}}</td>
                                            </tr>
                                    @endforeach
                                @endempty
                                </tbody>
                            </table>

                            {{$managdb->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

@include('footer')