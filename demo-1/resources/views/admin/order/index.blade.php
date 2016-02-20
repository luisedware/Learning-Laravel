@extends('admin.public.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                {!! Form::open(['url'=>'order/index']) !!}
                <div class="box-header with-border">
                    <h3 class="box-title">查询条件</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>订单状态:</label>
                                <select class="form-control select2" style="width: 100%;" name="opstatus">
                                    <option value="">/</option>
                                    @foreach(json_decode(\App\Http\AdminHelpers::getOrderStatusArray(),true) as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>下单时间:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="create_time"
                                           name="create_time">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="realname">客户姓名:</label>
                                <input type="text" class="form-control" id="realname" name="realname">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tel">手机号码:</label>
                                <input type="text" class="form-control" id="tel" name="tel">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>支付方式:</label>
                                <select class="form-control select2" style="width: 100%;" name="pay_type">
                                    <option value="">/</option>
                                    @foreach(json_decode(\App\Http\AdminHelpers::getOrderPayTypeArray(),true) as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>完成时间:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="delivery_time"
                                           name="delivery_time">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="addr3">送货地址:</label>
                                <input type="text" class="form-control" id="addr3" name="addr3">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="orderno">订单编号:</label>
                                <input type="text" class="form-control" id="orderno" name="orderno">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="button" class="btn btn-primary" id="search">查询</button>
                    <button type="button" class="btn btn-info">Excel导出订单明细</button>
                    <button type="button" class="btn btn-success">Excel导出订单汇总</button>
                </div>
                <!-- /.box-footer-->
                <!-- Default box -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.box -->
    <div class="row">
        <div class="col-md-12">
            <div class="box" id="app">
                <div class="box-header with-border">
                    <h3 class="box-title">订单列表(@{{ total }})</h3>

                    <div class="box-tools pull-right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="快速查询"
                                   v-model="orderno">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default disabled"><i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <orders-component :orders="orders" :orderno="orderno"></orders-component>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <ul class="pagination">
                        <li v-for="page in pages" track-by="$index" :class="{
                'active':current_page == page,'disabled':(page == '«' && current_page == 1) || (page == '...') || (page == '»' && current_page == last_page)}">
                            <a href="javascript:;" @click="getOrdersByPage(page)" >@{{page}}</a>
                        </li>
                    </ul>
                </div>
                <div class="overlay" v-bind:style="{display:is_loaded?'block':'none'}">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/x-template" id="orders-template">
        <table class="table table-hover">
            <tr>
                <th>订单编号</th>
                <th>购买商品</th>
                <th>优惠金额</th>
                <th>订单金额</th>
                <th>用户信息</th>
                <th>订单时间</th>
                <th>订单状态</th>
                <th>店长操作</th>
            </tr>
            <tr v-for="(index,item) in orders | filterBy orderno in 'orderno'">
                <td>@{{ item.orderno }}</td>
                <td>
                    <p v-for="(key,object) in item.subject | json_decode">
                        @{{ object.num + '份' }}
                        @{{ object.title }}
                        @{{ '&yen;' + object.price }}
                    </p>
                </td>
                <td>
                    <p>@{{ item.has_one_voucher.title ? '优惠卡券:' + item.has_one_voucher.title : '' }}</p>

                    <p>@{{ item.activity_discount ? '活动优惠&yen;:' + item.activity_discount : '' }}</p>

                    <p>@{{ item.blance_money ? '使用余额:&yen;' + item.blance_money : '' }}</p>
                </td>
                <td>
                    @{{ '&yen;' + item.total_fee }}
                </td>
                <td>
                    <p>@{{ '编号:' + item.uid }}</p>

                    <p>@{{ '姓名:' + item.realname }}</p>

                    <p>@{{ '手机:' + item.tel }}</p>

                    <p>@{{ '地区:' + item.addr3 }}</p>
                </td>
                <td>
                    <p>@{{ item.create_time | date '用户下单时间:'}}</p>

                    <p>要求送达时间:@{{ item.reciveTime }}</p>

                    <p>@{{ item.delivery_time ? item.delivery_time : '' | date '送货完成时间:'}}</p>
                </td>
                <td>
                    @{{ item.opstatus }}
                </td>
                <td>
                    <button type="button" class="btn btn-primary">编辑订单</button>
                </td>
            </tr>
        </table>
    </script>
    <script>
        $(function () {
            $(".select2").select2();
            $('#create_time').daterangepicker({format: 'YYYY-MM-DD HH:mm:ss'});
            $('#delivery_time').daterangepicker({format: 'YYYY-MM-DD HH:mm:ss'});
        });

        Vue.component('orders-component', {
            template: "#orders-template",
            props: {
                orders: "",
                orderno: ""
            }
        });

        var vm = new Vue({
            el: '#app',
            ready: function () {
                this.$http.get('http://lumen.app/order/index', function (response) {
                    this.$set('total', response.total);
                    this.$set('orders', response.data);
                    this.$set('last_page', response.last_page);
                    this.$set('is_loaded', false);
                    this.$set('current_page', response.current_page);
                }).error(function (response, status, request) {
                    console.log('fail' + status + "," + request);
                })
            },
            data: {
                total: "",
                orders: "",
                orderno: "",
                last_page: "",
                is_loaded: true,
                current_page: ""
            },
            http: {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            },
            computed: {
                pages: function () {
                    if (!this.current_page || !this.last_page) {
                        return false;
                    }

                    var leftBtns = this.current_page;
                    var rightBtns = this.last_page;


                    if (this.last_page >= 12) {
                        var arr = [];
                        arr.push('«');

                        if (this.current_page >= 7 && this.current_page < this.last_page - 5) {
                            arr.push(1);
                            arr.push(2);
                            arr.push('...');
                            leftBtns = this.current_page - 3;
                            rightBtns = this.current_page + 3;
                            while (leftBtns <= rightBtns) {
                                arr.push(leftBtns);
                                leftBtns++;
                            }
                            arr.push('...');
                            arr.push(this.last_page - 1);
                            arr.push(this.last_page);
                        } else {

                            if (this.current_page < 7) {
                                leftBtns = 1;
                                rightBtns = 8;

                                while (leftBtns <= rightBtns) {
                                    arr.push(leftBtns);
                                    leftBtns++;
                                }

                                arr.push('...');
                                arr.push(this.last_page - 1);
                                arr.push(this.last_page);
                            } else {
                                arr.push(1);
                                arr.push(2);
                                arr.push('...');
                                leftBtns = this.last_page - 8;
                                rightBtns = this.last_page;
                                while (leftBtns <= rightBtns) {
                                    arr.push(leftBtns);
                                    leftBtns++;
                                }
                            }

                        }
                        arr.push('»');
                    } else {
                        var arr = [];
                        arr.push('«');
                        while (leftBtns <= rightBtns) {
                            arr.push(leftBtns);
                            leftBtns++;
                        }
                        arr.push('»');
                    }

                    return arr;
                }
            }, methods: {
                getOrdersByPage: function (page) {

                    if (this.current_page == page) {
                        return false;
                    }

                    if (page == '...') {
                        return false;
                    }

                    if (page == '«') {
                        page = this.current_page - 1;
                    }

                    if (page == "»") {
                        page = this.current_page + 1;
                    }

                    if (page > this.last_page) {
                        return false;
                    }

                    if (page < 1) {
                        return false;
                    }

                    console.log(page);
                    console.log(this.current_page);
                    this.$set('is_loaded', true);
                    this.$http.get('http://lumen.app/order/index?page=' + page, function (response) {
                        this.$set('total', response.total);
                        this.$set('orders', response.data);
                        this.$set('last_page', response.last_page);
                        this.$set('current_page', response.current_page);
                        this.$set('is_loaded', false);
                    }).error(function (response, status, request) {
                        console.log('fail' + status + "," + request);
                    })
                }
            }
        });
    </script>
@stop