<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>找回密码页面</title>
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
                        联想找回密码页面
                    </div>
                    <div class="panel-body">
                        <form action="/findPass" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label for="">邮箱:</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="" class="btn btn-success" value="找回">
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