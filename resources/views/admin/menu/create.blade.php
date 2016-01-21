@extends('admin.public.main')

@section('style')
    <link rel="stylesheet" href="/bower_components/admin-lte/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/bower_components/admin-lte/plugins/daterangepicker/daterangepicker-bs3.css">
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">新增菜单</h3>
                </div>
                <form class="form-horizontal" action="{{URL::to('menu')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">菜单名称</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="菜单名称" v-model="menu.name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">菜单地址</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Controller/method" v-model="menu.url">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级菜单</label>

                            <div class="col-sm-9">
                                <select class="form-control select2" style="width:100%;" name="parent_id">
                                    <option value="0">顶级元素</option>
                                    @foreach($tree as $menu)
                                        <option value="{{$menu->id}}">{{$menu->html}}{{$menu->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                            返回
                        </button>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script src="/bower_components/admin-lte/plugins/select2/select2.full.min.js"></script>
    <script src="/bower_components/admin-lte/plugins/daterangepicker/moment.min.js"></script>
    <script src="/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $(function () {
            $(".select2").select2();
        });

        //        var vm = new Vue({
        //            el: "#create-menu",
        //            data: {
        //                menu: {
        //                    url: "",
        //                    name: "",
        //                    parent_id: ""
        //                }
        //            },
        //            methods: {
        //                changeSelectedValue:function(value){
        //                    this.menu.parent_id = value;
        //                },
        //                addMenu: function () {
        //                    var data = {'url': this.menu.url, 'name': this.menu.name, 'parent_id': this.menu.parent_id};
        //                    console.log(data);
        //                    $.ajax({
        //                                url: "http://lumen.coding.com/menu/store",
        //                                data: data,
        //                                method: "POST",
        //                                dataType: "json"
        //                            })
        //                            .done(function (data) {
        //                                console.log(data);
        //                            });

        //                    var menu = {};
        //                    menu.url = this.menu.url;
        //                    menu.name = this.menu.name;
        //                    menu.parent_id = this.menu.parent_id;
        //                    console.log(menu);
        //                    this.$http.post('http://lumen.coding.com/menu/store', menu, function (data, status, request) {
        //                        console.log(data);
        //                        console.log(status);
        //                        console.log(request);
        //                    }).error(function (data, status, request) {
        //                        console.log(data);
        //                        console.log(status);
        //                        console.log(request);
        //                    });
        //                }
        //            },
        //            http: {
        //                headers: {
        //                    'Content-Type': 'application/x-www-form-urlencoded',
        //                    'X-HTTP-Method-Override':'POST'
        //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                }
        //            }
        //        });
    </script>
@stop