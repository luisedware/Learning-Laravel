@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xs-1">
            <div class="small-box">
            </div>
        </div>
    </div>
    <div id="demo" class="row">
        <div class="col-md-12">
            <form action="" class="form-horizontal">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <i class="fa fa-repeat" onclick="location.reload();"></i>
                        <h3 class="box-title">用户列表</h3>

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
                    <div class="box-body no-padding">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>采购日期</th>
                                <th>商品分类</th>
                                <th>商品名称</th>
                                <th>数量</th>
                                <th>单位</th>
                                <th>单价</th>
                                <th>供货商</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-if="!list">
                                <td colspan="7" class="text-center">暂无入库数据</td>
                            </tr>
                            <tr v-for="item in list">
                                <td>
                                    <select class="form-control" v-model="item.create_time" style="width: 100%;">
                                        <option value="2016-02-24">2016-02-24</option>
                                        <option value="2016-02-25">2016-02-25</option>
                                        <option value="2016-02-26">2016-02-26</option>
                                        <option value="2016-02-27">2016-02-27</option>
                                        <option value="2016-02-28">2016-02-28</option>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" v-model="item.type" style="width: 100%;">
                                        <option value="水果">水果</option>
                                        <option value="零食">零食</option>
                                        <option value="生鲜">生鲜</option>
                                        <option value="蔬菜">蔬菜</option>
                                    </select>
                                </td>
                                <td>
                                    <material-select-input :name.sync="item.name"></material-select-input>
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.num">
                                </td>
                                <td>
                                    <select class="form-control" v-model="item.unit" style="width: 100%;">
                                        <option value="份">份</option>
                                        <option value="斤">斤</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.price">
                                </td>
                                <td>
                                    <input type="text" class="form-control" v-model="item.supplier">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="add-data btn btn-info" v-on:click="addData">
                            <i class="fa fa-plus"></i> 新增一条采购数据
                        </button>
                        <button type="button" class="btn btn-success">保 存</button>
                    </div>
                </div>
                <pre>@{{$data | json}}</pre>
            </form>
        </div>
    </div>
@stop
@section('script')
    <script type="text/javascript"></script>
@stop