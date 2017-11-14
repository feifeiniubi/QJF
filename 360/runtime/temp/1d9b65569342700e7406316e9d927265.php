<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\phpStudy\WWW\360\public_html/../application/member\view\sales\add.phtml";i:1505648772;s:71:"D:\phpStudy\WWW\360\public_html/../application/member\view\layout.phtml";i:1510577482;}*/ ?>
<?php
if(!request()->isAjax()){
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>UT企业信息化管理系统</title>
    <link rel="stylesheet" href="__INDEX__/zui/css/zui.min.css">
    <link rel="stylesheet" href="__INDEX__/zui/css/zui-theme-green.css">
    <link rel="stylesheet" href="__INDEX__/zui/lib/datetimepicker/datetimepicker.min.css">
    <link rel="stylesheet" href="__INDEX__/select2/css/select2.min.css">
    <link rel="stylesheet" href="__INDEX__/pure/grids-responsive-min.css">
    <link rel="stylesheet" href="__INDEX__/my/css/common.css?v=4">
    <link href="__INDEX__/login/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="__INDEX__/login/css/font-awesome.min.css" rel="stylesheet">
    <link href="__INDEX__/login/css/amazeui.min.css" rel="stylesheet" type="text/css">
    <link href="__INDEX__/login/css/admin.css" rel="stylesheet" type="text/css">
    <link href="__INDEX__/login/css/app.css" rel="stylesheet" type="text/css">
    <link href="__INDEX__/login/css/loginstyle.css" rel="stylesheet" type="text/css">

    <script src="__INDEX__/jquery/jquery.min.js"></script>
    <script src="__INDEX__/zui/js/zui.min.js"></script>
    <script src="__INDEX__/zui/lib/datetimepicker/datetimepicker.min.js"></script>
    <script src="__INDEX__/layer/layer.js"></script>
    <script src="__INDEX__/select2/js/select2.full.min.js"></script>
    <script src="__INDEX__/select2/js/i18n/zh-CN.js"></script>
    <script src="__INDEX__/my/js/common.js?v=1"></script>
    <script src="__INDEX__/echart/echarts.common.min.js"></script>

</head>
<body class="hl-default">
<div class="container-fluid">
    <div class="row navbar-fixed-top">
        <nav class="navbar navbar-inverse myHead">
            <div class="container-fluid">
                <!-- 导航头部 -->
                <div class="navbar-header">
                    <!-- 品牌名称或logo -->
                    <a class="navbar-brand" href="<?php echo url('index/index'); ?>"><img src="__INDEX__/my/img/logo2.png" alt="云托管"></a>
                    <div class="myBrand">

                    </div>
                </div>
                
                <!-- 导航项目 -->
                <div class="collapse navbar-collapse">
                    <!-- 一般导航项目 -->
                    <ul class="nav navbar-nav navbar-right myTop">
                        
                        <li>
                            <a href="javascript:window.location.reload();">
                                <i class="icon icon-refresh"></i>
                                刷新
                            </a>
                        </li>
                        <!-- 导航中的下拉菜单 -->
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon icon-user"></i>
                                <?= \app\member\model\Member::login('username') ?>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a type="button"  data-toggle="modal" data-remote="<?php echo url('member/password'); ?>"><i class="icon icon-key"></i>修改密码</a></li>
                                <li><a href="<?php echo url('login/logout'); ?>"><i class="icon icon-signout"></i> 退出系统</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- END .navbar-collapse -->
            </div>
        </nav>
    </div>
    <div  style="margin-top:58px;"></div>

    <div class="row">
        <div class="col-sm-2 hidden-xs myNav">
            <nav class="menu" data-toggle="menu">
                <ul class="nav nav-primary">
                    <?php
                    $menu_data = config('member_data');

                    $baseUrl = request()->baseUrl();

                    foreach ($menu_data as $k1 => $r1) {
                        if (!\app\member\model\Member::authCheck($k1)) {
                            continue;
                        }

                        if (empty($r1['children'])) {
                            $tmpAdd = empty($r1['new']) ? '' : 'target="_blank"';
                            ?>
                            <li <?= $r1['link']==$baseUrl ? 'class="active"' : '' ?>>
                                <a href="<?php echo $r1['link']; ?>" <?php echo $tmpAdd; ?>>
                                    <i class="icon icon-<?php echo $r1['icon']; ?>"></i> <?php echo $r1['text']; ?>
                                </a>
                            </li>
                            <?php
                        }else{
                            ?>
                            <li class="nav-parent">
                                <a href="<?php echo $r1['link']; ?>">
                                    <i class="icon icon-<?php echo $r1['icon']; ?>"></i> <?php echo $r1['text']; ?>
                                </a>
                                <ul class="nav">
                                    <?php
                                    foreach ($r1['children'] as $k2 => $r2) {
                                        $k2 = "$k1-$k2";
                                        
                                        if (!\app\member\model\Member::authCheck($k2)) {
                                            continue;
                                        }

                                        if ($taocan_data and !in_array($k2, $taocan_data)) {
                                            continue;
                                        }


                                        $tmpAdd = empty($r2['new']) ? '' : 'target="_blank"';
                                        ?>
                                        <li <?= $r2['link']==$baseUrl ? 'class="active"' : '' ?>>
                                            <a href="<?php echo $r2['link']; ?>" <?php echo $tmpAdd; ?>>
                                                <i class="icon icon-<?php echo $r2['icon']; ?>"></i> <?php echo $r2['text']; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                   
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
        <div class="col-sm-10 myMain">
            <?php } ?>
                <link rel="stylesheet" href="__INDEX__/layui/css/layui.css"  media="all">
<div class="panel">
    <div class="panel-heading">
        销售订单
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="<?php echo request()->url(); ?>" method="post" id="editForm">
                    <div class="form-group">
                        <label class="pull-left text-left" style="margin-left: 10px">客户:</label>
                        <div class="pull-left col-sm-2">
                            <select name="cid" style="width:100%" class="mySelect">
                                <option value=""></option>
                                <?= \app\member\model\Customer::option()?>
                            </select>
                        </div>
                        <label for="title" class="col-sm-2">单据编号</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="title" placeholder="" name="order_sn">
                        </div>
                        <label for="title" class="col-sm-2">业务员</label>
                        <div class="col-sm-2">
                            <select name="sales" style="width:100%" class="mySelect">
                                <option value=""></option>
                                <?= \app\member\model\Member::option()?>
                            </select>
                        </div>
                    </div>
                    <table class="table  table-bordered parent">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width:12%;">新增</th>
                                <th style="width:40%">商品</th>
                                <th style="width:6%">单位</th>
                                <th style="width:6%">数量</th>
                                <th style="width:6%">单价</th>
                                <th style="width:6%">折扣率(%)</th>
                                <th style="width:6%">折扣额</th>
                                <th style="width:6%">销售金额</th>
                                <th style="width:15%">备注</th>
                            </tr>
                        </thead>
                        <tbody class="t-body">
                            <tr class="row" id="firstRow">
                                <td>
                                    <a class="btn btn-sm btn-info clone" href="javascript:;"><i class="icon icon-plus-sign"></i></a> 
                                    <a class="btn btn-sm btn-info clone_remove" href="javascript:;"><i class="icon icon-trash"></i></a>
                                </td>
                                <td class="select-doc">
                                    <select name="data_pid[]" style="border:0px;width:100%" class="mySelect select-w">
                                        <option value=""></option>
                                        <?= \app\member\model\StockProduct::option()?>
                                    </select>
                                </td>
                                <td><input type="text" class="text-center" style="border:0px;" name="data_unit[]"> </td>
                                <td><input type="text" class="text-center quantity calcs_input_quantity" style="border:0px;" name="data_quantity[]"> </td>
                                <td><input type="text" class="text-right price calcs_input_price" style="border:0px;" name="data_price[]"> </td>
                                <td><input type="text" class="text-right calcs_input_discount_rate" style="border:0px;" name="data_discount_rate[]" > </td>
                                <td><input type="text" class="text-right discount_number calcs_input_discount" style="border:0px;" name="data_discount_money[]"> </td>
                                <td><input type="text" class="text-right sale_money calcs_input_money" style="border:0px;" name="data_money[]"> </td>
                                <td><input type="text" class="" style="border:0px;" name="data_remark[]" placeholder=""> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>合计: <span class="total_calc"></span></td>
                                <td></td>
                                <td class="text-center" id="total_quantity"><input type="text" class="text-center" style="border:0px;" name="total_quantity"></td>
                                <td id="totla_price"></td>
                                <td></td>
                                <td class="text-right" id="total_discount"><input type="text" class="text-right" style="border:0px;" name="total_discount"></td>
                                <td class="text-right" id="total_sale"><input type="text" class="text-right" style="border:0px;" name="total_money" ></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-group" style="margin-top:10px;">
                        <label for="title" class="pull-left" style="margin-left: 10px">备注</label>
                        <div class="pull-left col-sm-6">
                            <input type="text" class="form-control" id="title" placeholder="" name="remark">
                        </div>
                        <label for="title" class="col-sm-2">开单日期</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control tmdDate" name="billtime">
                        </div>

                    </div>
                    <div class="form-group" style="margin-top:10px;">
                        <label class="pull-left text-left" style="margin-left: 10px">付款方式:</label>
                        <div class="pull-left">
                            <select name="payment" class="mySelect form-control"><option value=""></option><option value="1">货到付款</option><option value="2">款到发货</option><option value="3">现金欠款</option></select>
                        </div>
                        <label for="title" class="col-sm-1">已收款:</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="received" placeholder="" name="received">
                        </div>

                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var ectype = $('.t-body').html();
    $(function () {
         $('.parent').on('change','.select-w', function () {
            var that = $(this);
            var id = that.val();
            var url = "<?php echo url('Sales/get_product'); ?>";
            $.post(url, {id: id}, function (ret) {
                that.parent().next().find('input').val(ret.unit);//单位
                that.parent().next().next().find('input').val('1');//数量
                that.parent().next().next().next().find('input').val(ret.selling_price);//单价
                that.parent().next().next().next().next().find('input').val('0');//折扣率
                that.parent().next().next().next().next().next().find('input').val('0.00');//折扣额
                that.parent().next().next().next().next().next().next().find('input').val(ret.selling_price);//总金额
                calcs();
            }, "json");
        });
        //追加行
        $('.parent').on('click','.clone', function () {
            $('.t-body').append(ectype);
            pageInit();
            calcs();
        });
        //删除行
        $('.parent').on('click','.clone_remove', function () {
            $(this).closest('tr').remove();
            pageInit();
            calcs();
        });
        //计算修改数量
        $('.parent').on('change','.calcs_input_quantity', function () {
            var thats = $(this);
            //计算改行销售金额
            var current_quantity = thats.val();//数量
            var current_price = thats.parent().next().find('input').val();//单价
            var current_discount_price = thats.parent().next().next().next().find('input').val();//折扣
            //如果折扣率为0
            if(thats.parent().next().next().find('input').val()=='0')
            {
                var sale_money = current_quantity * current_price  - current_discount_price;//计算新的总金额
                thats.parent().next().next().next().next().find('input').val(sale_money.toFixed(2));//写入新的总金额
            }else{
                var sale_money = ( current_quantity * current_price ) * thats.parent().next().next().find('input').val() /100;//计算新的总金额
                thats.parent().next().next().next().find('input').val(sale_money.toFixed(2));//写入新的折扣金额
                thats.parent().next().next().next().next().find('input').val((( current_quantity * current_price ) - sale_money).toFixed(2));//写入新的总金额
            }
            calcs();
        });
        //计算修改单价
        $('.parent').on('change','.calcs_input_price', function () {
            var thats = $(this);
            //计算改行销售金额
            var current_price = thats.val();//当前单价
            var current_quantity = thats.parent().prev().find('input').val();//当前数量
            var current_discount = thats.parent().next().next().find('input').val();//当前折扣金额
            //如果折扣率为0
            if(thats.parent().next().find('input').val()=='0')
            {
                var sale_money = current_price * current_quantity  - current_discount;//计算新的总金额
                thats.parent().next().next().next().find('input').val(sale_money.toFixed(2));//写入新的总金额
            }else{
                var sale_money = ( current_price * current_quantity ) * (100-thats.parent().next().find('input').val()) /100;//计算新的总金额
                thats.parent().next().next().find('input').val(sale_money.toFixed(2));//写入新的折扣金额
                thats.parent().next().next().next().find('input').val((( current_quantity * current_price ) - sale_money).toFixed(2));//写入新的总金额
            }
            calcs();
        });
        //计算修改折扣金额
        $('.parent').on('change','.calcs_input_discount', function () {
            var thats = $(this);
            //计算改行销售金额
            var current_discount_price = thats.val();//当前折扣金额
            var sale_money =( thats.parent().prev().prev().find('input').val() * thats.parent().prev().prev().prev().find('input').val());//当前总价
            var sale_money_new = sale_money  - current_discount_price;//计算新的总金额
            thats.parent().next().find('input').val(sale_money_new.toFixed(2));//写入新的总金额
            var discount_rate = 100-(current_discount_price / sale_money)*100;
            thats.parent().prev().find('input').val(discount_rate.toFixed(2));//写入折扣率
            calcs();
        });
        //计算修改折扣率
        $('.parent').on('change','.calcs_input_discount_rate', function () {
            var thats = $(this);
            //计算改行销售金额
            var current_discount_rate = thats.val();//当前折扣率
            var sale_money = thats.parent().prev().prev().find('input').val() * thats.parent().prev().find('input').val();//当前总价
            var sale_money_new = sale_money - (sale_money  * ((100-current_discount_rate) / 100));//计算新的总金额
            thats.parent().next().next().find('input').val(sale_money_new.toFixed(2));//写入新的总金额
            var discount_price = (sale_money  * ((100-current_discount_rate) / 100));
            thats.parent().next().find('input').val(discount_price.toFixed(2));//写入折扣金额
            calcs();
        });
        //计算修改总价
        $('.parent').on('change','.calcs_input_money', function () {
            var thats = $(this);
            //计算改行销售金额
            var sale_money = thats.val();//当前总价
            var current_quantity = thats.parent().prev().prev().prev().prev().find('input').val();//当前数量
            var current_discount = thats.parent().prev().prev().prev().find('input').val();//当前单价
            //如果折扣率为0
            if(thats.parent().prev().prev().find('input').val()=='0')
            {
                var quantity = current_quantity * current_discount  - sale_money;//计算新的折扣金额
                thats.parent().prev().find('input').val(quantity.toFixed(2));//写入新的折扣金额
            }else{
                var quantity = ( current_quantity * current_discount ) - sale_money ;//计算新的折扣金额
                var quantity_rate = sale_money / ( current_quantity * current_discount ) *100  ;//计算新的折扣率
                if(quantity<'0'){layer.alert('折扣金额不能小于0');return;}
                thats.parent().prev().find('input').val(quantity.toFixed(2));//写入新的折扣金额
                thats.parent().prev().prev().find('input').val(quantity_rate);//写入新的折扣率
            }
            calcs();
        });
        
        //添加新行
        function calcs(){
            //总数量
            var calc_quantity = 0;
            $('.quantity').each(function (i) {
                var tmp = isNaN(parseFloat($(this).val())) ? 0 :parseFloat($(this).val());
                calc_quantity = calc_quantity +tmp;
            });
            $('#total_quantity').find('input').val(calc_quantity);
            //总金额
            var calc_sale_money = 0;
            $('.sale_money').each(function (i) {
                var tmps = isNaN(parseFloat($(this).val())) ? 0 :parseFloat($(this).val());
                calc_sale_money = calc_sale_money +tmps;
            });
            $('#total_sale').find('input').val(calc_sale_money.toFixed(2));
            //总折扣额
            var calc_discount_money = 0;
            $('.discount_number').each(function (i) {
                var tmpss = isNaN(parseFloat($(this).val())) ? 0 :parseFloat($(this).val());
                calc_discount_money = calc_discount_money +tmpss;
            });
            $('#total_discount').find('input').val(calc_discount_money.toFixed(2));
        }


    })
</script>
<script>
    $('#editForm').myForm();
    
    // <?php if ($list) { ?> //
    var list = <?=json_encode($list, JSON_UNESCAPED_UNICODE)?>;
    $('#editForm').myFormData(list);
    // <?php } ?> //

</script>
<script>pageInit();</script>
            <?php
            if(!request()->isAjax()){
            ?>
        </div><!-- end myMain -->
    </div><!-- end row 2 -->
<?php
            if (request()->isMobile()) {
            // 手机端 才有的底部
            ?>
                <!-- 移动设备上的导航切换按钮 -->
                <div style="height: 80px"></div>
                <div class="myMobFoot">
                    <a href="<?php echo url('member/index/index'); ?>" data-id="index">
                        <i class="icon icon-home"></i>
                        首页
                    </a>
                    <a href="<?php echo url('member/customer/search'); ?>" data-id="bill">
                        <i class="icon icon-search"></i>
                        搜索
                    </a>
                    <a href="<?php echo url('member/customer/index'); ?>" data-id="customer">
                        <i class="icon icon-user"></i>
                        客户
                    </a>
                    <!--a href="<?php echo url('booking/index'); ?>" data-id="booking">
                        <i class="icon icon-comment"></i>
                        销售
                    </a-->
                    <a href="javascript:void(0);" onclick="navbar-toggle" class="navbar-toggle" data-id="remind">
                        <i class="icon icon-align-justify"></i>
                        功能
                    </a>
                </div>
            <?php
            }else{
                // 非手机端 显示 版权信息
            }?>

        <div class="row">
            <div class="myFoot">
                © 2017 UT企业信息化管理系统

            </div>
        </div>

</div><!-- end container-fluid -->

</body>
</html>
            <?php } ?>