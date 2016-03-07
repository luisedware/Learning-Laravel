@extends('backend.layout.main')

@section('content')
    <div class="row">
        <div class="col-xs-1">
            <div class="small-box">
            </div>
        </div>
    </div>
    <div id="purchase" class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-xs-4">
                            <h3 class="box-title">采购单号:</h3>
                            <input type="text" class="form-control" value="{{$data['orderno']}}" readonly>
                        </div>

                        <div class="col-xs-4">
                            <h3 class="box-title">采购日期:</h3>
                            <input id="create_time" type="text" class="form-control datepicker">
                        </div>

                        <input type="hidden" v-model="item.orderno">
                        <input type="hidden" v-model="item.create_time">
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>商品分类</th>
                            <th>商品名称</th>
                            <th>数量</th>
                            <th>单位</th>
                            <th>单价</th>
                            <th>总价</th>
                            <th>箱规格</th>
                            <th>存储方式</th>
                            <th>供货商</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="!list">
                            <td colspan="7" class="text-center">暂无入库数据</td>
                        </tr>
                        <tr v-for="item in list">
                            <td>
                                <entry :name.sync="item.cate_name" :key.sync="item.c_key" type="cate"></entry>
                            </td>
                            <td>
                                <entry :name.sync="item.name" :key.sync="item.p_key" type="commodity"></entry>
                            </td>
                            <td>
                                <input type="text" class="form-control" v-model="item.num">
                            </td>
                            <td>
                                <entry :name.sync="item.unit" :key.sync="item.unit_key" type="unit"></entry>
                            </td>
                            <td>
                                <input type="text" class="form-control" v-model="item.price">
                            </td>
                            <td>
                                <input type="text" class="form-control" v-model="item.total_price">
                            </td>
                            <td>
                                <entry :name.sync="item.box_spec" :key.sync="item.box_spec_key" type="box_spec"></entry>
                            </td>
                            <td>
                                <entry :name.sync="item.save" :key.sync="item.save_key" type="save"></entry>
                            </td>
                            <td>
                                <entry :name.sync="item.supplier" :key.sync="item.supplier_key" type="supplier"></entry>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <a href="javascript:;" class="btn btn-primary" onclick="location.reload();">
                        <i class="fa fa-repeat"></i> 刷 新
                    </a>
                    <button type="button" class="add-data btn btn-info" @click="addData">
                    <i class="fa fa-plus"></i> 新增一条采购数据
                    </button>
                    <button type="button" class="btn btn-success" @click="submitData">
                    <i class="fa fa-save"></i> 保 存
                    </button>
                </div>
            </div>
        </div>
        <pre>@{{$data|json}}</pre>
    </div>
    @include('business.vue.entry')
@stop
@section('script')
    <script type="text/javascript">
        $(function () {
            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                startDate: '-3d'
            });
            $('.select2').select2();
        });

        $('.add-data').click(function () {
            $('.datepicker').datepicker({
                format: 'yyyy/mm/dd',
                startDate: '-3d'
            });
            $('.select2').select2();
        });

        var checkData = {!!$data['data']!!};
        var vm = new Vue({
            el: "#purchase",
            data: {
                list: checkData
            },
            methods: {
                addData: function () {
                    this.list.push({
                        num: "",
                        cate_name: "",
                        c_key: "",
                        unit: "",
                        unit_key: "",
                        name: "",
                        p_key: "",
                        price: "",
                        total_price: "",
                        box_spec: "",
                        box_spec_key: "",
                        save: "",
                        save_key: "",
                        supplier: "",
                        supplier_key: "",
                        type: "",
                        create_time: '{{$data['create_time']}}',
                        orderno: '{{$data['orderno']}}'
                    });
                },
                submitData: function () {
                    var rs = this.list;
                    $.ajax({
                        type: 'POST',
                        url: '/purchasein',
                        data: {rs},
                        datatype: 'text',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (d) {
                            if (d == 1) {
                                alert('保存成功');
                                location.reload();
                            }
                        },
                        error: function () {

                        }
                    });
                }
            }
        });


    </script>

@stop