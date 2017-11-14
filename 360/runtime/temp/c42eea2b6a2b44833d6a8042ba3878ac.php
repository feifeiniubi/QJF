<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\phpStudy\WWW\360\public_html/../application/member\view\member\role_edit.phtml";i:1505288073;s:71:"D:\phpStudy\WWW\360\public_html/../application/member\view\layout.phtml";i:1510577482;}*/ ?>
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
                <link rel="stylesheet" href="__INDEX__/jquery-treegrid/css/jquery.treegrid.css">
<script src="__INDEX__/jquery-treegrid/js/jquery.treegrid.min.js"></script>
<div class="panel">
    <div class="panel-heading">
        角色
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" id="editForm">
            <div class="form-group">
                <label class="col-sm-2">角色名称</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">备注</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="remark">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">排序</label>
                <div class="col-sm-10 col-md-3 col-lg-2">
                    <input type="text" class="form-control" name="sort">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2">权限</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <table class="tree table table-bordered table-condensed">
                        <?php
                        $menu_data = config('member_data');
                        foreach ($menu_data as $k1 => $r1) {
                            if ($taocanAuth and !in_array($k1, $taocanAuth)) {
                                continue;
                            }
                            ?>
                            <tr class="treegrid-<?php echo $k1; ?>">
                                <td><label><input type="checkbox" name="auth[]" value="<?php echo $k1; ?>"> <?php echo $r1['text']; ?></label></td>
                                <td><!-- <?php echo $k1; ?> --></td>
                            </tr>

                            <?php
                            if ($r1['auth']) {
                                foreach ($r1['auth'] as $a1 => $a2) {
                                    $a1 = "$k1-auth-$a1";
                                    ?>
                                    <tr class="success treegrid-<?php echo $a1; ?> treegrid-parent-<?php echo $k1; ?>">
                                        <td><label><input type="checkbox" name="auth[]" value="<?php echo $a1; ?>"> <?php echo $a2; ?></label></td>
                                        <td>权限<!-- <?php echo $a1; ?> --></td>
                                    </tr>
                                    <?php
                                }
                            }
                            
                            if ($r1['children']) {
                                foreach ($r1['children'] as $k2 => $r2) {
                                    $k2 = "$k1-$k2";

                                    if ($taocanAuth and !in_array($k2, $taocanAuth)) {
                                        continue;
                                    }
                                    ?>
                                    <tr class="treegrid-<?php echo $k2; ?> treegrid-parent-<?php echo $k1; ?>">
                                        <td><label><input type="checkbox" name="auth[]" value="<?php echo $k2; ?>"> <?php echo $r2['text']; ?></label></td>
                                        <td><!-- <?php echo $k2; ?> --></td>
                                    </tr>

                                    <?php
                                    if ($r2['auth']) {
                                        foreach ($r2['auth'] as $b1 => $b2) {
                                            $b1 = "$k2-auth-$b1";
                                            ?>
                                            <tr class="success treegrid-<?php echo $b1; ?> treegrid-parent-<?php echo $k2; ?>">
                                                <td><label><input type="checkbox" name="auth[]" value="<?php echo $b1; ?>"> <?php echo $b2; ?></label></td>
                                                <td>权限<!-- <?php echo $b1; ?> --></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    
                                }
                            }
                            
                        }
                        ?>
                      
                    </table>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="button" class="btn btn-default" id="checkAllBtn">全选</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    my.menuActive('role/index');

    $('.tree').treegrid();

    $('#editForm').myForm();

    // <?php if ($editData) { ?> //
    var editData = <?=json_encode($editData, JSON_UNESCAPED_UNICODE)?>;
    $('#editForm').myFormData(editData);
    // <?php } ?> //

    var checkAll = true;
    var checkAllEle = $(':checkbox[name="auth[]"]');
    $('#checkAllBtn').on('click', function (e) {
        checkAllEle.prop('checked', checkAll);
        checkAll = !checkAll;
    });

    checkAllEle.on('click', function (e) {
        var self = $(this);
        var isCkd = self.prop('checked');
        var value = self.val();
        var str = '';
//        console.log(isCkd, value);

        if (value.indexOf('-')>=0) { // 子菜单
            if (isCkd) {
                str = value.split('-')[0];
                str = '[value="' + str + '"]';
                checkAllEle.filter(str).prop('checked', isCkd);
            }
        }else{ // 父菜单
            str = '[value^="' + value + '-"]';
            checkAllEle.filter(str).prop('checked', isCkd);
        }
    });
</script>
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