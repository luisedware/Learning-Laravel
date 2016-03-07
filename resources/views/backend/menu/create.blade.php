@extends('backend.layout.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <form class="form-horizontal" action="{{URL::to('menu')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "Page Title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级菜单</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="parent_id">
                                    <option value="0">顶级菜单</option>
                                    @foreach($tree as $menu)
                                        <option value="{{$menu->id}}" @if(old('parent_id') == $menu->id) selected @endif >{{$menu->html}}{{$menu->name}}</option>
                                    @endforeach
                                </select>
                                @include('backend.layout.message.tips',['field'=>'parent_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">菜单名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="菜单名称" value="{{old('name')}}">
                                @include('backend.layout.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">菜单地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" name="url" placeholder="route.name" value="{{old('url')}}">
                                @include('backend.layout.message.tips',['field'=>'url'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">菜单描述</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description" placeholder="菜单描述" value="{{old('description')}}">
                                @include('backend.layout.message.tips',['field'=>'description'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ico" class="col-sm-3 control-label">菜单图标</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ico" name="ico" placeholder="fa fa-bars" value="{{old('ico')}}">
                                @include('backend.layout.message.tips',['field'=>'ico'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="col-sm-3 control-label">菜单排序</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sort" name="sort" placeholder="0" value="{{old('sort')}}">
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
