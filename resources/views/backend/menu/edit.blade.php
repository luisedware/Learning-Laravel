@extends('backend.layout.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('menu/'.$menu->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑菜单</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级菜单</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="parent_id">
                                    <option value="0">顶级菜单</option>
                                    @foreach($tree as $data)
                                        <option value="{{$data->id}}" @if($menu->parent_id == $data->id) selected @endif >{{$data->html}}{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @include('backend.layout.message.tips',['field'=>'parent_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">菜单名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="菜单名称" value="{{$menu->name}}">
                                @include('backend.layout.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">菜单地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Controller/method" value="{{$menu->url}}">
                                @include('backend.layout.message.tips',['field'=>'url'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">菜单描述</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description" placeholder="菜单描述" value="{{$menu->description}}">
                                @include('backend.layout.message.tips',['field'=>'description'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ico" class="col-sm-3 control-label">菜单图标</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ico" name="ico" placeholder="fa fa-bars" value="{{$menu->ico}}">
                                @include('backend.layout.message.tips',['field'=>'ico'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="col-sm-3 control-label">菜单排序</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sort" name="sort" placeholder="0" value="{{$menu->sort}}">
                                @include('backend.layout.message.tips',['field'=>'sort'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_hide" class="col-sm-3 control-label">是否隐藏</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="is_hide" style="width:100%">
                                    <option value="0">否</option>
                                    <option value="1" selected>是</option>
                                </select>
                                @include('backend.layout.message.tips',['field'=>'is_hide'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{route('menu.index')}}" class="btn btn-default">返 回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $(".select2").select2();
        });
    </script>
@stop
