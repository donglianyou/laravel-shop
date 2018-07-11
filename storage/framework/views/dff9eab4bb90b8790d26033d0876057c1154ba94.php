<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>注册页面</title>
    <link rel="stylesheet" type="text/css" href="/style/admin/bs/css/bootstrap.css">
    <script type="text/javascript" src="/style/admin/bs/js/jquery.min.js"></script>
    <script type="text/javascript" src="/style/admin/bs/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        联想注册页面
                    </div>
                    <div class="panel-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo e($error); ?></div>
                        <?php endif; ?>
                        <form action="/regCheck" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="">邮箱:</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">用户名:</label>
                                <input type="text" class="form-control" name="name" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">电话:</label>
                                <input type="tel" class="form-control" name="tel" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">密码:</label>
                                <input type="password" class="form-control" name="pass" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">确认密码:</label>
                                <input type="password" class="form-control" name="repass" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">验证码:</label>
                                <div>
                                    <input type="text" class="form-control" style="width: 120px; float: left; margin-right: 10px;" name="code" value="" placeholder="">
                                    <img src="/yzm" alt="" style="cursor: pointer;" onclick="this.src='/yzm?'+Math.random()">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" class="btn btn-success" value="确认注册">
                                <input type="reset" name="" class="btn btn-primary" value="重置">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>