<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpStudy\WWW\360\public_html/../application/member\view\stock\add_product.phtml";i:1499832452;s:71:"D:\phpStudy\WWW\360\public_html/../application/member\view\layout.phtml";i:1505647697;}*/ ?>
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
<form class="form-horizontal" method="post" id="editForm" action="<?php echo request()->url(); ?>">
                    <div class="form-group">
                        <label class="col-sm-2">产品名称：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="pname" placeholder="">
                        </div>
                        <label class="col-sm-2">产品规格：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="spec" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">供应商：</label>
                        <div class="col-sm-4">
                            <select name="gid" class="mySelect" style="width: 100%">
                                <option value=""></option>
                                <?= \app\member\model\StockSet::option_gys()?>
                            </select>
                        </div>
                        <label class="col-sm-2">产品分类：</label>
                        <div class="col-sm-4">
                            <select name="fid" class="mySelect" style="width: 100%">
                                <option value=""></option>
                                <?= \app\member\model\StockSet::option_fl()?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">采购价：</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="buying_price" placeholder="">
                        </div>
                        <label class="col-sm-2">销售价：</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="selling_price" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">产品编码：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sn" placeholder="">
                        </div>
                        <label class="col-sm-2">条形码：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="bar_code" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">单位：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="unit" placeholder="">
                        </div>
                        <label class="col-sm-2">安全线：</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="safeline" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">产品图：</label>
                        <div class="col-sm-10">
                            <div class="input-group">
    <input type="text" class="form-control" name="photo">
    <span class="input-group-btn">
        <button class="btn btn-default tmdUpload-upload-member" type="button">上传</button>
    </span>
</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">状态：</label>
                        <div class="col-sm-4">
                            <select name="status" class="mySelect form-control"><option value=""></option><option value="1">正常状态</option><option value="2">缺货中</option><option value="3">已下架</option></select>
                        </div>
                        <label class="col-sm-2">排序：</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="listorder" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">备注：</label>
                        <div class="col-sm-10">
                            <textarea name="remark" rows="5" style="width:100%" class="form-control" placeholder=""></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" class="form-control" name="id">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>

                </form>


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