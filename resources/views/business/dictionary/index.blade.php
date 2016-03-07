@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xs-1">
            <div class="small-box">
                <a href="{{URL::to('dictionary/create')}}" class="btn btn-success">新增字典</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-repeat" onclick="location.reload();"></i>
                    <h3 class="box-title">字典列表</h3>

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
                            <th>字典编号</th>
                            <th>字典类型</th>
                            <th>字典名称</th>
                            <th>字典键</th>
                            <th>字典值</th>
                            <th>操作</th>
                        </tr>
                        @forelse($dictionary as $dic)
                            <tr>
                                <td>{{$dic->id}}</td>
                                <td>{{$dic->type}}</td>
                                <td>{{$dic->name}}</td>
                                <td>{{$dic->key}}</td>
                                <td>{{$dic->value}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('dictionary/'.$dic->id.'/edit')}}">
                                        编辑
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#defalutModal" data-url="{{URL::to('dictionary/'.$dic->id)}}">
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
                @if($dictionary->render() !== "")
                    <div class="box-footer">
                        {!! $dictionary->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('backend.layout.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这条字典吗?'])
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