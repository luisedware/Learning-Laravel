@extends('admin.public.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">菜单权限管理</a></li>
                    <li><a href="#tab_2" data-toggle="tab">操作权限管理</a></li>
                    <li><a href="#tab_3" data-toggle="tab">数据权限管理</a></li>
                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @forelse($sidebar_menus as $menu)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-warning">
                                        <div class="box-header with-border">
                                            <label>
                                                <input class="checkbox icheck" type="checkbox">
                                                <span>{{$menu->name}}</span>
                                            </label>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                                        title="Collapse">
                                                    <i class="fa fa-minus"></i></button>
                                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                                        title="Remove">
                                                    <i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="box-body responsive no-padding">
                                            <table class="table table-hover">
                                                @forelse($menu->child as $child)
                                                    <tr>
                                                        <td style="width: 50%">
                                                            <label>
                                                                <input type="checkbox" class="checkbox icheck" value="{{$child->id}}">
                                                                {{$child->html}}{{$child->name}}
                                                            </label>
                                                        </td>
                                                        <td style="width:50%">{{$child->url}}</td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                    <div class="tab-pane" id="tab_2">
                        The European languages are members of the same family. Their separate existence is a myth.
                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                        new common language would be desirable: one could refuse to pay expensive translators. To
                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                        words. If several languages coalesce, the grammar of the resulting language is more simple
                        and regular than that of the individual languages.
                    </div>
                    <div class="tab-pane" id="tab_3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        It has survived not only five centuries, but also the leap into electronic typesetting,
                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')

    @stops