@extends('admin.public.main')

@section('content')
    <div class="box" id="app">

        <div class="box-header with-border">
            <h3 class="box-title">菜单列表</h3>

            <div class="box-tools pull-right">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="快速查询">

                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default disabled"><i class="fa fa-search"></i></button>
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
                <tr v-for="(index,menu) in menus">
                    <td>@{{ menu.id }}</td>
                    <td>@{{{ menu.html }}}@{{ menu.name }}</td>
                    <td>@{{ menu.url }}</td>
                    <td>
                        <a href="{{url('menu')}}/@{{ menu.id }}/edit">
                            <button type="button" class="btn btn-primary">编辑菜单</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="box-footer">

        </div>
    </div>
@stop

@section('script')
    <script>
        var vm = new Vue({
            el: '#app',
            ready: function () {
//                this.$http.get('http://lumen.coding.com/menu/index', function (response) {
//                    this.$set('menus', response);
//                }).error(function (response, status, request) {
//                    console.log('fail' + status + "," + request);
//                })

                $.ajax({
                    url: "http://lumen.coding.com/menu/index",
                    method: "GET"
                }).
                done(function (data) {
                    vm.menus = data;
                });

            },
            data: {
                menus: ""
            },
            http: {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }
        });

    </script>
@stop