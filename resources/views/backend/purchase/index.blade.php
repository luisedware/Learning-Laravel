@extends('backend.layout.main')

@section('content')
<div class="row">
    <div class="col-xs-1">
        <div class="small-box">
            <a href="{{URL::to('user/create')}}" class="btn btn-success">新增用户</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">

            <div class="box-header with-border">
                <i class="fa fa-repeat" onclick="location.reload();"></i>
                <h3 class="box-title">用户列表</h3>

                <div class="box-tools pull-right">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="快速查询">

                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default disabled">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>条码</th>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>管理操作</th>
                    </tr>
                    @forelse($users as $user)
                    <tr>
                        <td>{{$user->sku_code}}</td>
                        <td>{{$user->sku_name}}</td>
                        <td>{{$user->num}}</td>
                        <td>
                            <a class="btn btn-info">
                                编辑
                            </a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#defalutModal" >
                                删除
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">暂无数据</td>
                    </tr>
                    @endforelse
                </table>
            </div>

            @if($users->render() !== "")
            <div class="box-footer">
                {!! $users->render() !!}
            </div>
            @endif
        </div>
    </div>
</div>
<div id="app">
    @{{message}}
</div>
@include('backend.layout.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这名用户吗?'])
@stop
@section('script')
<script src="{{asset('/assets/js/vue.min.js')}}"></script>
<script type="text/javascript">
    new Vue({
        el:'#app',
        data:{
            message:"hello world"
        }
    });

    $('#defalutModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var url = button.data('url');
        var modal = $(this);

        modal.find('form').attr('action', url);
    })
</script>
@stop