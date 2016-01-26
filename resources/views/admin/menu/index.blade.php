@extends('admin.public.main')

@section('content')
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">菜单列表</h3>

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
                    <th>菜单编号</th>
                    <th>菜单名称</th>
                    <th>菜单地址</th>
                    <th>操作</th>
                </tr>
            @forelse($menus as $menu)
                <tr>
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->name}}</td>
                    <td>{{$menu->url}}</td>
                    <td></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">暂无数据</td> 
                </tr>
            @endforelse
            </table>
        </div>
        
        @if($menus->render() !== "")
        <div class="box-footer">
            {!! $menus->render() !!}
        </div>
        @endif
    </div>
@stop