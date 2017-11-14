<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:85:"D:\PHP\phpstudy\WWW\9503\360\public_html/../application/member\view\index\index.phtml";i:1510656127;s:80:"D:\PHP\phpstudy\WWW\9503\360\public_html/../application/member\view\layout.phtml";i:1510656127;}*/ ?>
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
                <link rel="stylesheet" href="__INDEX__/index/css/amazeui.css" />
<link rel="stylesheet" href="__INDEX__/index/css/font-awesome.css">
<link rel="stylesheet" href="__INDEX__/index/css/core.css" />
<link rel="stylesheet" href="__INDEX__/index/css/menu.css" />
<link rel="stylesheet" href="__INDEX__/index/css/index.css" />
<link rel="stylesheet" href="__INDEX__/index/css/admin.css" />
<link rel="stylesheet" href="__INDEX__/index/css/page/typography.css" />
<link rel="stylesheet" href="__INDEX__/index/css/component.css">
<link rel="stylesheet" href="__INDEX__/index/css/stylexa.css">
<!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="am-g">
                    <div class="am-u-md-3">
                        <div class="card-box widget-user xa-index-card-green xa-font-white xa-card">
                            <div>
                                <i class="fa fa-user"></i>
                                <div class="wid-u-info">
                                    <p class="">客户池总量</p>
                                    <span class="xa-card-span">14</span>
                                     <div class="" style="margin-left: -80px;margin-top: 20px;">
                                        <div class="xa-card-more" >
                                         机会客户数量<p>4</p>
                                        </div>
                                        <div class="xa-card-more">
                                         成交客户数量<p>4</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                   <div class="am-u-md-3">
                        <div class="card-box widget-user xa-index-card-red xa-font-white xa-card">
                            <div>
                                <i class="fa fa-line-chart"></i>
                                <div class="wid-u-info">
                                    <p class="">销售漏斗成功率</p>
                                    <span class="xa-card-span">25.00%</span>
                                     <div class="" style="margin-left: -80px;margin-top: 20px;">
                                        <div class="xa-card-more" >
                                         在跟<p>3</p>
                                        </div>
                                        <div class="xa-card-more">
                                         灭失<p>0</p>
                                        </div>
                                        <div class="xa-card-more">
                                         成功<p>1</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="am-u-md-3">
                        <div class="card-box widget-user xa-index-card-bule xa-font-white xa-card">
                            <div>
                                <i class="fa fa-cny (alias)"></i>
                                <div class="wid-u-info">
                                    <p class="">今年销售额</p>
                                    <span class="xa-card-span">1,960,000</span>
                                     <div class="" style="margin-left: -80px;margin-top: 20px;">
                                        <div class="xa-card-more" >
                                         本月销售额<p>810,000</p>
                                        </div>
                                        <div class="xa-card-more">
                                         上月销售额<p>450,000</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="am-u-md-3">
                        <div class="card-box widget-user xa-index-card-gray xa-font-white xa-card">
                            <div>
                                <i class="fa fa-area-chart "></i>
                                <div class="wid-u-info">
                                    <p class="">今年回款额</p>
                                    <span class="xa-card-span">1,600,000</span>
                                     <div class="" style="margin-left: -80px;margin-top: 20px;">
                                        <div class="xa-card-more" >
                                         本月回款额<p>600,000</p>
                                        </div>
                                        <div class="xa-card-more">
                                         上月回款额<p>400,000</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <!-- 柱状图 -->
                    <div class="am-u-md-9" id="bar-graph">
                        <div class="card-box">
                            <div  id="columnar1" style="width: 100%;height: 400px;"></div>
                        </div>
                    </div>
                    <div class="am-u-md-3">
                        <div class="card-box xa-card-box" style="height: 440.15px;">
                            <p>年度目标</p> 
                            <span>根据设定显示今年各项指标达成度</span>
                            <h5>合同量达成（16%）</h5>
                            <div class="am-progress xa-progress-lg am-margin-bottom-0">
                                <div class="am-progress-bar" style="width: 16%;"></div>
                            </div>
                            <h5>销售额达成（39%）</h5>
                            <div class="am-progress xa-progress-lg am-margin-bottom-0">
                                <div class="am-progress-bar am-progress-bar-success" style="width: 39%;"></div>
                            </div>
                            <h5>回款额达成（35%）</h5>
                            <div class="am-progress xa-progress-lg am-margin-bottom-0">
                                <div class="am-progress-bar am-progress-bar-danger" style="width: 35%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-g">
                    <div class="am-u-md-6" >
                        <!-- 折线图堆叠 -->
                        <div class="card-box">
                            <div  id="pie1" style="width: 100%;height: 400px;"></div>
                        </div>
                    </div>
                    <div class="am-u-md-6">
                        <!-- 年度销售精英榜 -->
                        <div class="card-box xa-card-box">
                            <p>年度销售精英榜（TOP6）</p>
                            <div class="am-scrollable-horizontal am-text-ms">
                                <table class="am-table am-text-nowrap xa-am-table">
                                    <thead>
                                        <tr >
                                            <td><i class="fa fa-user-o"></i></td>
                                            <td>员工</td>
                                            <td>销售额</td>
                                            <td>合同量</td>
                                            <td>回款额</td>
                                            <td>行动数</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="xa-level-frist">
                                            <td>1</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td>43434131</td>
                                            <td>54</td>
                                            <td>53435413</td>
                                            <td>5</td>
                                        </tr>   
                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align: right;margin-top: 20px;">
                                <a href="#">查看更多</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="am-g">
                <!-- 事件动态-->
                    <div class="am-u-md-4">
                       <div class="card-box xa-card-box">
                           <p>事件动态</p>
                           <div class="inbox-widget nicescroll" style="height: 286.5px; overflow: hidden; outline: none;" tabindex="5000">
                               <a href="#">
                                   <div class="inbox-item xa-inbox-item">
                                       <p class="inbox-item-author">事件类型<small>   发布时间：10-12</small></p>
                                       <p class="inbox-item-text">事件描述例如某时某地会见一个重要客户</p>
                                       <p class="inbox-item-date"><span class="label label-danger">紧急</span></p>
                                   </div>
                               </a>
                               <a href="#">
                                   <div class="inbox-item xa-inbox-item">
                                       <p class="inbox-item-author">事件类型<small>   发布时间：10-12</small></p>
                                       <p class="inbox-item-text">事件描述例如某时某地会见一个重要客户</p>
                                       <p class="inbox-item-date"><span class="label label-danger">紧急</span></p>
                                   </div>
                               </a>
                               <a href="#">
                                   <div class="inbox-item xa-inbox-item">
                                       <p class="inbox-item-author">事件类型<small>   发布时间：10-12</small></p>
                                       <p class="inbox-item-text">事件描述例如某时某地会见一个重要客户</p>
                                       <p class="inbox-item-date"><span class="label label-primary">待处理</span></p>
                                   </div>
                               </a>
                               <a href="#">
                                   <div class="inbox-item xa-inbox-item">
                                       <p class="inbox-item-author">事件类型<small>   发布时间：10-12</small></p>
                                       <p class="inbox-item-text">事件描述例如某时某地会见一个重要客户</p>
                                       <p class="inbox-item-date"><span class="label label-primary">待处理</span></p>
                                   </div>
                               </a>
                           </div>
                           <div style="text-align: center;">
                               <a href="#" class="am-btn am-btn-primary">添加事件</a>
                           </div>
                       </div> 
                    </div>
                    <!-- 合同动态-->
                    <div class="am-u-md-8">
                        <div class="card-box xa-card-box">
                            <p>合同动态</p>
                            <div class="am-scrollable-horizontal am-text-ms">
                                <table class="am-table am-text-nowrap xa-am-table">
                                    <thead>
                                        <tr >
                                         
                                            <td>客户</td>
                                            <td>合同状态</td>
                                            <td>促成时间</td>
                                            <td>销售额</td>
                                            <td>业务员</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr >
                                         
                                            <td class="xa-frist-mane">XXXX集团</td>
                                            <td><span class="label label-warning">待处理</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr>
                                        <tr>
                                           
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td><span class="label label-success">已处理</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr>
                                        <tr>
                                           
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td><span class="label label-primary">进行中</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr>
                                       <tr >
                                           
                                            <td class="xa-frist-mane">XXXX集团</td>
                                            <td><span class="label label-warning">待处理</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr>
                                        <tr>
                                           
                                            <td class="xa-frist-mane">李书婷</td>
                                            <td><span class="label label-primary">进行中</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr>
                                        <tr >
                                            
                                            <td class="xa-frist-mane">XXXX集团</td>
                                            <td><span class="label label-warning">待处理</span></td>
                                            <td>2017/12/04</td>
                                            <td>53435413</td>
                                            <td>吴小法</td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
        <!-- end right Content here -->

<script type="text/javascript" src="__INDEX__/index/js/jquery-2.1.0.js" ></script>
<script type="text/javascript" src="__INDEX__/index/js/amazeui.min.js"></script>
<script type="text/javascript" src="__INDEX__/index/js/app.js" ></script>
<script type="text/javascript" src="__INDEX__/index/js/blockUI.js" ></script>
<script type="text/javascript" src="__INDEX__/index/js/charts/echarts.min.js" ></script>
<script type="text/javascript" src="__INDEX__/index/js/charts/pieChart.js" ></script>   
<script type="text/javascript" src="__INDEX__/index/js/charts/columnarChart.js" ></script>     
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