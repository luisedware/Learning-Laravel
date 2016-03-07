@extends('backend.layout.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <form class="form-horizontal" action="{{URL::to('dictionary')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "Page Title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-9">
                            <input type="text" name="name" placeholder="例：香蕉、单位、胶袋" class="form-control" value="{{old('name')}}">

                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="name" class="col-sm-3 control-label">记录类型</label>--}}
                            {{--<div class="col-sm-9">--}}
                                {{--<select name="type" class="form-control">--}}
                                    {{--<option  value="">请选择</option>--}}
                                    {{--<option  value="1">购货入库</option>--}}
                                    {{--<option  value="2">销货出库</option>--}}
                                    {{--<option  value="3">仓库调拨</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">类型</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-control select2" onchange="add_num()">
                                    <option  value="">请选择</option>
                                    <option  value="fruits">水果</option>
                                    <option  value="vegetables">蔬菜</option>
                                    <option  value="snacks">零食</option>
                                    <option  value="fresh">生鲜</option>
                                    <option  value="dairy">奶类</option>
                                    <option  value="material">物料</option>
                                    <option  value="specs">规格</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">值</label>
                            <div class="col-sm-9">
                                <input type="text" name="value" placeholder="例：1" class="form-control" value="{{old('value')}}">
                            </div>
                        </div>
                        <div class="form-group" id="num" style="display: none">
                            <label for="description" class="col-sm-3 control-label">num</label>
                            <div class="col-sm-9">
                                <input type="text" name="num" placeholder="例：1、12、16" class="form-control" value="{{old('num')}}">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{route('dictionary.index')}}" class="btn btn-default">返 回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" name="_method" value="put">
@stop
@section('script')
    <script type="text/javascript">
        function add_type(){
            var btn = $("select[name='type']").val();
            var met = $("input[name='_method']").val();
            $.ajax({
                type: 'POST',
                url: 'ajax',
                data: { btn : btn,met:met},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(data){
                    console.log(data);
                },
                error: function(xhr, type){
                    alert('Ajax error!')
                }
            });
        }
        function add_num(){
            var btn = $("select[name='type']").val();
            if(btn=='specs'){
                $("#num").show();
            }else {
                $("#num").hide();
            }
        }
    </script>
@stop

