<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\phpStudy\WWW\360\public_html/../application/admin\view\login\index.phtml";i:1505288073;}*/ ?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UT科技</title>
    <link rel="stylesheet" href="__INDEX__/zui/css/zui.min.css">
    <link rel="stylesheet" href="__INDEX__/zui/css/zui-theme-green.css">
    <link rel="stylesheet" href="__INDEX__/my/css/common.css">
</head>
<body class="hl-default myLoginBg">
<div class="container-fluid">
    <div class="row">
        <div class="myLogin
         col-lg-4 col-lg-offset-4
         col-md-4 col-md-offset-4
         col-sm-4 col-sm-offset-4">
            <div class="bigtitle" align="center">UT企业信息管理系统</div><br>
            <div class="panel">
                <div class="panel-body">
                    <form method="post" id="loginForm">
                        <fieldset>
                            <div class="form-group">
                                <label>用户名：</label>
                                <input type="text" class="form-control" placeholder="请输入用户名" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label>密码：</label>
                                <input type="password" class="form-control" placeholder="请输入密码" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="remember" checked> 记住密码
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-block">登录</button>
                        <!--<button type="submit" class="btn btn-block">忘记密码</button>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="__INDEX__/jquery/jquery.min.js"></script>
<script src="__INDEX__/zui/js/zui.min.js"></script>
<script src="__INDEX__/zui/lib/datetimepicker/datetimepicker.min.js"></script>
<script src="__INDEX__/layer/layer.js"></script>
<script src="__INDEX__/select2/js/select2.full.min.js"></script>
<script src="__INDEX__/my/js/common.js"></script>
<script>
    $(function () {
        $('#loginForm').myForm(function (ret) {
            var isCkd = $('#remember').prop('checked');
            if (isCkd) {
                // 将用户名密码保存起来
                var erpLogin = {
                    username: $('#username').val(),
                    password: $('#password').val()
                };
                window.localStorage.setItem('erpLogin', JSON.stringify(erpLogin))
            }
            // 跳转
            window.location.href = ret.url;
        });
        // 自动填空
        var erpLogin = window.localStorage.getItem('erpLogin');
        if (erpLogin) {
            erpLogin = JSON.parse(erpLogin);
            $('#username').val(erpLogin.username);
            $('#password').val(erpLogin.password);
            $('#remember').prop('checked', true);
//            $('#loginForm').submit();
        }
        // 清除记录
        $('#remember').on('click', function () {
            window.localStorage.setItem('erpLogin', '');
        });

    });

</script>
</body>
</html>