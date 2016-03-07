@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <form class="form-horizontal" action="{{URL::to('dictionary/'.$info->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "Page Title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">名称</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" placeholder="名称" class="form-control" dataType='*' nullmsg="名称不能为空!" value="{{$info->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">类型</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-control select2" onchange="add_num()">
                                    <option  value="">请选择</option>
                                    <option  value="fruits" <?php if(($info->type)=="fruits"){echo 'selected';}?>>水果</option>
                                    <option  value="vegetables" <?php if(($info->type)=="vegetables"){echo 'selected';}?>>蔬菜</option>
                                    <option  value="snacks" <?php if(($info->type)=="snacks"){echo 'selected';}?>>零食</option>
                                    <option  value="fresh" <?php if(($info->type)=="fresh"){echo 'selected';}?>>生鲜</option>
                                    <option  value="dairy" <?php if(($info->type)=="dairy"){echo 'selected';}?>>奶类</option>
                                    <option  value="material" <?php if(($info->type)=="material"){echo 'selected';}?>>物料</option>
                                    <option  value="specs" <?php if(($info->type)=="specs"){echo 'selected';}?>>规格</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">值</label>
                            <div class="col-sm-9">
                                <input type="text" name="value" placeholder="值" class="form-control" value="{{$info->value}}">
                            </div>
                        </div>
                        <div class="form-group" id="num" style="display: none">
                            <label for="description" class="col-sm-3 control-label">key</label>
                            <div class="col-sm-9">
                                <input type="text" name="key" placeholder="key" class="form-control" value="{{$info->key}}">
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
@stop
@section('script')
    <script>
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
