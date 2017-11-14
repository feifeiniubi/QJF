<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:101:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/customer/index.phtml";i:1505700908;s:93:"/Applications/XAMPP/xamppfiles/htdocs/360/public_html/../application/member/view/layout.phtml";i:1505647697;}*/ ?>
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
        客户基本资料
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-remote="<?php echo url('customer/add'); ?>"><i class="icon icon-plus"></i> 添加客户</button>
            </div>
            <?php if (!(request()->isMobile())) {?>
            <div class="col-sm-11 mySearch">
                <form class="form-inline" id="searchForm" action="<?php echo request()->url(); ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="客户名称" name="company">
                        <input type="text" class="form-control" placeholder="电话号码" name="mobile">
                        <label>客户类型：</label>
                        <select name="type" class="mySelect form-control"><option value=""></option><option value="1">代理商</option><option value="2">终端门店</option><option value="3">云托管客户</option><option value="4">招商加盟客户</option><option value="5">淘宝客户</option></select>
                        <label>客户状态：</label>
                        <select name="status" class="mySelect form-control"><option value=""></option><option value="1">成交客户</option><option value="2">未成交客户</option><option value="0">无效客户</option></select>
                        <label>业务员：</label>
                        <select name="sales" class="mySelect">
                            <option value=""></option>
                            <?=\app\member\model\Member::option()?>
                        </select>
                        <label>客服：</label>
                        <select name="service" class="mySelect">
                            <option value=""></option>
                            <?=\app\member\model\Member::option()?>
                        </select>
                        <!--label>排序：</label>
                        <select name="sort" class="form-control">
                            <option value="1">最后跟踪时间</option>
                            <option value="2">录入时间</option>
                            <option value="3">客户状态 升序</option>
                            <option value="4">客户状态 降序</option>
                        </select-->
                    </div>
                    <button type="submit" class="btn btn-primary">搜索</button>
                </form>
                <script>
                    $('#searchForm').myFormData(<?= json_encode(input('get.'), JSON_UNESCAPED_UNICODE) ?>);
                </script>
            </div>
            <?php } ?>
        </div>
    </div>
    <!--列表-->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>电话</th>
                <th>区域</th>
                <th>类型</th>
                <th>状态</th>
                <th>时间</th>
                <th style="width:100px">对接人员</th>
                <th style="width:400px">最后跟踪</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($list as $i => $row) { ?>
                
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['company']; ?></b></td>
                    <td><a href="tel:<?php echo $row['mobile']; ?>" class="btn btn-default"><b><?php echo $row['mobile']; ?></b></a></td>
                    <td><?php echo $row['province']; ?>-<?php echo $row['city']; ?></td>
                    <td><?php echo \my::selectText('customer_type',$row['type']) ?></td>
                    <td><?php echo \my::selectText('customer_status',$row['status']) ?></td>
                    <td><?php echo $row['addtime']; ?></td>
                    <td>
                        <?php $u= \app\member\model\Member::where('uid',$row['userid'])->find();?>
                        录入:<a class="btn btn-mini <?php if($row['userid']==U_ID){echo "btn-danger";}else{echo "btn-info";}?>"><?php echo $u['realname']; ?></a><br>
                        <?php $u= \app\member\model\Member::where('uid',$row['sales'])->find();?>
                        业务:<a class="btn btn-mini <?php if($row['sales']==U_ID){echo "btn-danger";}else{echo "btn-info";}?>"><?php echo $u['realname']; ?></a><br>
                        <?php $u= \app\member\model\Member::where('uid',$row['service'])->find();?>
                        客服:<a class="btn btn-mini <?php if($row['service']==U_ID){echo "btn-danger";}else{echo "btn-info";}?>"><?php echo $u['realname']; ?></a>
                    </td>
                    <?php $track= \app\member\model\CustomerTrack::where('cid',$row['id'])->order('id desc')->find();?>
                    <td>(<?php echo $track['addtime']; ?>)<?php echo mb_substr($track['remark'],'0','50','utf-8'); ?>...</td>
                    <td>
                        <a href="<?php echo url('track'); ?>?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary"><i class="icon icon-columns"></i> 跟踪记录</a>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-remote="<?php echo url('edit'); ?>?id=<?php echo $row['id']; ?>"><i class="icon icon-edit"></i> 修改</button>
                        <a href="<?php echo url('delete'); ?>?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary tmdDelete"><i class="icon icon-trash"></i> 删除</a>
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