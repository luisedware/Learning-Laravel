@extends('backend.layout.main')

@section('content')
<div class="row">
    <div class="col-xs-1">
        <div class="small-box">
            <a href="javascript:;" class="btn btn-facebook" onclick="location.reload();">
                <i class="fa fa-repeat"></i> 刷 新
            </a>
        </div>
    </div>
</div>
<div  class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">采购信息</h3>
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
                        <th>采购单号</th>
                        <th>原材料</th>
                        <th>材料分类</th>
                        <th>数量</th>
                        <th>单价</th>
                        <th>总价</th>
                        <th>单位</th>
                        <th>箱规格</th>
                        <th>存储方式</th>
                        <th>供应商</th>
                        <th>状态</th>
                    </tr>
                    @forelse($data as $d)
                    <tr>
                        <td>{{$d->orderno}}</td>
                        <td>{{$d->name}}</td>
                        <td>{{$d->c_key}}</td>
                        <td>{{$d->num}}</td>
                        <td>{{$d->price}}</td>
                        <td>{{$d->total_price}}</td>
                        <td>{{$d->unit}}</td>
                        <td>{{$d->box_spec}}</td>
                        <td>{{$d->save}}</td>
                        <td>{{$d->supplier}}</td>
                        <td>{{$d->status==1?'已审核':'未审核'}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center">暂无数据</td>
                    </tr>
                    @endforelse
                </table>
            </div>

            @if($data->render() !== "")
            <div class="box-footer">
                {!! $data->render() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    $('#defalutModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var url = button.data('url');
        var modal = $(this);

        modal.find('form').attr('action', url);
    })
</script>
@stop