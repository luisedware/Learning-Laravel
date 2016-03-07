@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="{{URL::to('role/updatePermission')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="role_id" value="{{$id}}">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-repeat" onclick="location.reload();"></i>
                        <h3 class="box-title">权限列表</h3>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>
                                    <i id="checkedAll" class="fa fa-check fa-2x text-success"></i>
                                </th>
                                <th>权限标识</th>
                                <th>权限名称</th>
                                <th>权限描述</th>
                            </tr>
                            @forelse($permissions as $permission)
                                <tr>
                                    <td>
                                        <input @if(in_array($permission->id,$checked_permissions)) checked @endif
                                        type="checkbox" class="checkbox icheck" name="permission_id[]" value="{{$permission->id}}">
                                    </td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->display_name}}</td>
                                    <td>{{$permission->description}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">暂无数据</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>

                    <div class="box-footer">
                        <a href="{{route('role.index')}}" class="btn btn-default">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">更新角色权限</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('#checkedAll').click(function () {
                $('input').iCheck('toggle');
            });
        });
    </script>
@stop