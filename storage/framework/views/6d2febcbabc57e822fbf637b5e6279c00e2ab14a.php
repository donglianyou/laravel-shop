<?php $__env->startSection("main"); ?>
<!-- 引入CSS -->
<link rel="stylesheet" href="/up/uploadify.css">
<!-- 引入JQ -->
<script src="/style/admin/bs/js/jquery.min.js"></script>
<!-- 引入文件上传插件 -->
<script src="/up/jquery.uploadify.min.js"></script>
<!-- 内容 -->
<div class="col-md-10">
	
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">广告添加</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="/admin/sys/ads" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 广告页面</a>
			<a href="/admin/sys/ads/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加广告</a>
		</div>
		<div class="panel-body">
			<form action="/admin/sys/types" method="post">
				<?php echo e(csrf_field()); ?>

				<div class="form-group">
					<label for="">标题</label>
					<input type="text" name="title" class="form-control" id="" placeholder="请输入标题">
				</div>

				<div class="form-group">
					<label for="">所属分类</label>
					<select name="cid" class="form-control">
                        
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
				</div>
				<div class="form-group">
                    <label for="">类型</label>
                    <br>
                    <input type="radio" name="type" value="0" checked>小图
                    <input type="radio" name="type" value="1">大图
                </div>
				<div class="form-group">
                        <label for="">图片</label>
                        <input type="file" name="" id="uploads">
						<div id="main">
							
						</div>
						<input type="hidden" name="img" id="imgs">
                    </div>
				<div class="form-group">
					<input type="submit" value="提交" class="btn btn-success">
					<input type="reset" value="重置" class="btn btn-danger">
				</div>

			</form>
		</div>
		
	</div>
</div>
<script>
	// 当所有HTML代码都加载完毕
	$(function() {
		// 声明字符串

		var imgs='';
		// 使用 uploadify 插件
        $('#uploads').uploadify({
        	// 设置文本
            'buttonText' : '图片上传',
            // 设置文件传输数据
            'formData'     : {
            	'_token':'<?php echo e(csrf_token()); ?>',
            	'files':'ads',
            },
            // 上传的flash动画
            'swf'      : "/up/uploadify.swf",
            // 文件上传的地址
            'uploader' : "/admin/shangchuan",
            // 当文件上传成功
            'onUploadSuccess' : function(file, data, response) {

            	// 拼接图片
            	imgs="<img width='200px'  src='/Uploads/ads/"+data+"'>";
            	// 展示图片
            	$("#main").html(imgs);
            	// 隐藏传递数据
            	$("#imgs").val(data);
               
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.public.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>