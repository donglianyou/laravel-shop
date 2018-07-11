<?php $__env->startSection("main"); ?>
<!-- 引入CSS -->
<link rel="stylesheet" href="/up/uploadify.css">
<!-- 引入JQ -->
<script src="/style/admin/bs/js/jquery.min.js"></script>
<!-- 引入文件上传插件 -->
<script src="/up/jquery.uploadify.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<!-- 内容 -->
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">商品管理</a></li>
		<li class="active">商品添加</li>
		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="/admin/goods" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 商品页面</a>
			<a href="/admin/goods/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加商品</a>
		</div>
		<div class="panel-body">
			<form action="/admin/goods" method="post">
				<?php echo e(csrf_field()); ?>

				<div class="form-group">
					<label for="">商品名</label>
					<input type="text" name="title" class="form-control" id="" placeholder="请输入商品名">
				</div>

				<div class="form-group">
					<label for="">商品简介</label>
					<textarea name="info" id="" cols="30" class="form-control" placeholder="请输入商品简介" rows="3"></textarea>
				</div>
				<div class="form-group">
					<label for="">所属分类</label>
					<select name="cid" id="" class="form-control">
						<option value="">请选择商品分类</option>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($value->size == 2): ?>
								<option value="<?php echo e($value->id); ?>"><?php echo e($value->html); ?></option>
							<?php else: ?>
								<option disabled value="<?php echo e($value->id); ?>"><?php echo e($value->html); ?></option>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">商品价格</label>
					<input type="text" name="price" class="form-control" id="" placeholder="请输入商品价格">
				</div>
				<div class="form-group">
					<label for="">库存</label>
					<input type="number" name="num" min="0" class="form-control" id="" placeholder="请输入库存">
				</div>
				<div class="form-group">
					<label for="">商品封面图片</label>
					<input type="file" accept="image/png, image/jpeg, image/gif, image/jpg" name="" id="uploads">
					<div id="main">

					</div>
					<input type="hidden" name="img" id="imgs" value="<?php echo e(config('web.logo')); ?>">
				</div>
				<div class="form-group">
					<label for="">商品图片集</label>
					<input type="file" accept="image/png, image/jpeg, image/gif, image/jpg" name="" id="uploads1">
					<div id="main1">
						
					</div>
					<input type="hidden" name="imgs" id="imgs1" value="<?php echo e(config('web.logo')); ?>">
				</div>
				<div class="form-group">
					<label for="">商品详情</label>
					<script id="editor" type="text/plain" name="text" style="width:100%;height:300px;"></script>
				</div>
				<div class="form-group">
					<label for="">配置信息</label>
					<script id="editor1" type="text/plain" name="config" style="width:100%;height:300px;"></script>
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
	// 商品详情百度编辑器调用
    var ue = UE.getEditor('editor');
    var ue1 = UE.getEditor('editor1');
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
            	'files':'goods',
            },
            // 上传的flash动画
            'swf'      : "/up/uploadify.swf",
            // 文件上传的地址
            'uploader' : "/admin/shangchuan",
            // 当文件上传成功
            'onUploadSuccess' : function(file, data, response) {
            	// 拼接图片
            	imgs="<img width='200px'  src='/Uploads/goods/"+data+"'>";
            	// 展示图片
            	$("#main").html(imgs);
            	// 隐藏传递数据
            	$("#imgs").val(data);
               
            }
        });
    });
    // 商品图片集上传
	$(function() {
		// 声明字符串
		var imgs1='';
		var arr=[];
		// 使用 uploadify 插件
        $('#uploads1').uploadify({
        	// 设置文本
            'buttonText' : '多图片上传',
            // 设置文件传输数据
            'formData'     : {
            	'_token':'<?php echo e(csrf_token()); ?>',
            	'files':'goods',
            },
            // 上传的flash动画
            'swf'      : "/up/uploadify.swf",
            // 文件上传的地址
            'uploader' : "/admin/shangchuan",
            // 当文件上传成功
            'onUploadSuccess' : function(file, data, response) {
            	// 拼接图片
            	imgs1+="<img width='200px'  src='/Uploads/goods/"+data+"'>";
            	arr.push(data);
            	// 展示图片
            	$("#main1").html(imgs1);
            	// 隐藏传递数据
            	$("#imgs1").val(arr.join(','));
            }
        });
    });
    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.public.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>