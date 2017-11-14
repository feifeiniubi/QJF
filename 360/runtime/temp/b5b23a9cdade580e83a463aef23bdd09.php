<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/customer/track.phtml";i:1499832450;s:93:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/layout.phtml";i:1505647697;}*/ ?>
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
<div class="panel">
    <div class="panel-heading">
        客户跟踪记录
    </div>
    
    <div class="panel-body">
        <?php if(input('get.id')){ $row= \app\member\model\Customer::where('id',input('get.id'))->find();?>
        <!--table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>名称</th>
                <th>电话</th>
                <th>区域</th>
                <th>类型</th>
                <th>来源</th>
                <th>状态</th>
                <th>时间</th>
                <th>业务员</th>
                <th>客服</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['company']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['province']; ?>-<?php echo $row['city']; ?></td>
                    <td><?php echo \my::selectText('customer_type',$row['type']) ?></td>
                    <td><?php echo \my::selectText('customer_comefrom',$row['comefrom']) ?></td>
                    <td><?php echo \my::selectText('customer_status',$row['status']) ?></td>
                    <td><?php echo $row['addtime']; ?></td>
                    <td><?php $u= \app\member\model\Member::where('uid',$row['sales'])->find();?><?php echo $u['realname']; ?></td>
                    <td><?php $u= \app\member\model\Member::where('uid',$row['service'])->find();?><?php echo $u['realname']; ?></td>
                </tr>
            </tbody>
        </table-->
        <div class="row">
            <div class="col-sm-4">
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-remote="<?php echo url('customer/track_add'); ?>?id=<?php echo $row['id']; ?>"><i class="icon icon-plus"></i>添加跟踪记录</button>
            </div>
        </div>
        <?php } ?>
        
    </div>
    <!--客户资料-->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>客户名称</th>
                <th>客户电话</th>
                <th>客户微信</th>
                <th>客户状态</th>
                <th>客户地址</th>
            </tr>
            </thead>
            <tbody>                
                <tr>
                    <td><?php echo $customer['company']; ?></td>
                    <td><?php echo $customer['mobile']; ?> / <?php echo $customer['mobile2']; ?></td>
                    <td><?php echo $customer['weixin']; ?></td>
                    <td><?php echo \my::selectText('customer_status',$customer['status']) ?></td>
                    <td><?php echo $customer['province']; ?>-<?php echo $customer['city']; ?></td>
                    <td><?php echo $customer['remark']; ?></td>

                </tr>
            </tbody>
        </table>
    </div>
    <!--列表-->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>跟踪时间</th>
                <th>跟踪人员</th>
                <th>跟踪方式</th>
                <th>对接人员</th>
                <th>对接情况</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $i => $row) { ?>
                
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $row['addtime']; ?></td>
                    <td><?php $u= \app\member\model\Member::where('uid',$row['userid'])->find();?><?php echo $u['realname']; ?></td>
                    <td><?php echo \my::selectText('track_type',$row['type']) ?></td>
                    <td><?php echo $row['linkman']; ?></td>
                    <td><?php echo $row['remark']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-remote="<?php echo url('track_edit'); ?>?id=<?php echo $row['id']; ?>">修改</button>
                        <a href="<?php echo url('track_delete'); ?>?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary tmdDelete">删除</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $list->render(); 
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