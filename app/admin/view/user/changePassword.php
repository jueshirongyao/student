<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php include 'public/view/header.php'?>
<div class="container">
    <div class="row">
        <?php include 'public/view/left.php'?>
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">修改密码</h3>
                </div>
                <div class="panel-body">
                    <form action="index.php?s=admin/user/password" method="post" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">账号:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $_SESSION['username'] ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">原密码:</label>
                            <div class="col-sm-10">
                                <input type="password" name="oldPassword" class="form-control" value="">
                                <span class="help-block">输入正确的原密码</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">新密码:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" value="">
                                <span class="help-block">新密码位数在6-20位之间</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">确认密码:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password2" class="form-control" value="">
                                <span class="help-block">两次密码要相同</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'public/view/footer.php'?>
</body>
</html>