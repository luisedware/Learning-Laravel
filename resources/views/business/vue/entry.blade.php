<script type="text/x-template" id="entry">
    <input type="hidden" v-model="key">
    <input
        type="text"
        class="form-control"
        v-model="name"
        style="position: relative"
        @focus="putInCommodity"
    >
    <div class="commodity" style="position: absolute;overflow-y: auto;max-height:300px;display: none;z-index: 100;">
        <ul class="list-group">
            <li class="list-group-item"
                style="width:100%"
                v-for="commodity in commodities | filterBy name in 'name'"
                @click="setCommodity(commodity.key,commodity.name,$event)">
            @{{commodity.name}}
            </li>
            <li class="list-group-item">
                <a class="btn btn-success">新增</a>
                <a class="btn btn-primary">更多</a>
                <a class="btn btn-info" @click="leaveCommodityList">关闭</a>
            </li>
        </ul>
    </div>
</script>