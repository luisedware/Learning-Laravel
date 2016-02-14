@extends('admin.public.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">管理操作</h3>
                </div>
                <div class="box-body">
                    <a href="" class="btn btn-success">新增文件夹</a>
                    <a href="" class="btn btn-info">上传新文件</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">文件列表</h3>

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
                            <th>文件名称</th>
                            <th>文件类型</th>
                            <th>上传日期</th>
                            <th>文件大小</th>
                            <th>操作</th>
                        </tr>

                    </table>
                </div>

                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>
    @include('admin.public.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这条菜单吗?'])
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