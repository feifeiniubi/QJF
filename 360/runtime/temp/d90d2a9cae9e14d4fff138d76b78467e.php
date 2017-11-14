<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:98:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/member/edit.phtml";i:1499832452;s:93:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/layout.phtml";i:1505292852;}*/ ?>
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
    <title>UT企业信息化管理系统管理系统</title>
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

<div class="panel">
    <div class="panel-heading">
        员工
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-10">
                <form class="form-horizontal" method="post" id="editForm">

                    <div class="form-group">
                        <label class="col-sm-2">用户名：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" placeholder="登录系统的用户名">
                        </div>
                        <label class="col-sm-2">密码：</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" placeholder="登录密码，更新时留空则不修改">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">权限角色：</label>
                        <div class="col-sm-4">
                            <select name="role_id" class="mySelect" style="width: 100%">
                                <?=\app\admin\model\Role::option_member()?>
                            </select>
                        </div>

                    </div>

                    <hr/>

                    <div class="form-group">
                        <label class="col-sm-2">姓名：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="realname">
                        </div>
                        <label class="col-sm-2">照片：</label>
                        <div class="col-sm-4">
                            <div class="input-group">
    <input type="text" class="form-control" name="photo">
    <span class="input-group-btn">
        <button class="btn btn-default tmdUpload-upload" type="button">上传</button>
        <button class="btn btn-default tmdUpload-show" type="button">查看</button>
        <button class="btn btn-default tmdUpload-delete" type="button">删除</button>
    </span>
</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">性别：</label>
                        <div class="col-sm-4">
                            <select name="gender" class="mySelect form-control"><option value=""></option><option value="1">男</option><option value="2">女</option></select>
                        </div>
                        <label class="col-sm-2">生日：</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control tmdDate" name="birthday">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">备注说明：</label>
                        <div class="col-sm-10">
                            <link rel="stylesheet" href="__INDEX__/wangEditor/css/wangEditor.min.css"/>
<script src="__INDEX__/wangEditor/js/wangEditor.js"></script>
<textarea name="remark" id="editor_3698" class="form-control" style="height: 400px"></textarea>
<script>
$(function(){
    var editor_3698 = new wangEditor('editor_3698');
    editor_3698.create();
    editor_3698.onchange = function () {
        var tmp = this.$txt.html();
        $('#editor_3698').val(tmp); 
    };
});
</script>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="uid">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#editForm').myForm();
    
    // <?php if ($editData) { ?> //
    var editData = <?=json_encode($editData, JSON_UNESCAPED_UNICODE)?>;
    $('#editForm').myFormData(editData);
    // <?php } ?> //

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