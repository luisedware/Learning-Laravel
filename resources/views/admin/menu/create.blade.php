@extends('admin.public.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('menu')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增菜单</h3>
                        {!! csrf_field() !!}
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级菜单</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" style="width:100%;" name="parent_id">
                                    <option value="0">顶级元素</option>
                                    @foreach($tree as $menu)
                                        <option value="{{$menu->id}}" @if(old('parent_id') == $menu->id) selected @endif >{{$menu->html}}{{$menu->name}}</option>
                                    @endforeach
                                </select>
                                @include('admin.public.message.formTips',['field'=>'parent_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">菜单名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="菜单名称"
                                       value="{{old('name')}}">
                                @include('admin.public.message.formTips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">菜单地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Controller/method" value="{{old('url')}}">
                                @include('admin.public.message.formTips',['field'=>'url'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default"
                                onclick="javascript:history.back(-1);return false;">
                            返回
                        </button>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop