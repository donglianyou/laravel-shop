@extends("admin.public.admin")
@section('main')
<!-- 引入CSS -->
<link rel="stylesheet" href="/up/uploadify.css">
<!-- 引入JQ -->
<script src="/style/admin/bs/js/jquery.min.js"></script>
<!-- 引入文件上传插件 -->
<script src="/up/jquery.uploadify.min.js"></script>
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">系统列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-body">
			<form action="/admin/sys/config" method="post">
        	{{csrf_field()}}
            <div class="form-group">
                <label for="">标题</label>
                <input type="text" name="title" value="{{config('web.title')}}" class="form-control" placeholder="请输入标题" id="">
            </div>
            <div class="form-group">
                <label for="">关键词</label>
                <input type="text" name="keywords" value="{{config('web.keywords')}}" class="form-control" placeholder="请输入关键词" id="">
            </div>
            <div class="form-group">
                <label for="">描述</label>
                <textarea name="description" id="" cols="30" class="form-control" rows="3">{{config('web.description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="">网站Logo</label>
                <input type="file" name="" id="uploads">
				<div id="main">
					<img src="/Uploads/sys/{{config('web.logo')}}" style="max-width: 300px;" alt="">
				</div>
				<input type="hidden" name="logo" id="imgs" value="{{config('web.logo')}}">
				<input type="hidden" name="oldLogo" value="{{config('web.logo')}}">
            </div>
            <div class="form-group">
                <label for="">统计代码</label>
                <textarea name="tongji" id="" cols="30" class="form-control" rows="6">{{config('web.tongji')}}</textarea>
            </div>
            <div class="form-group pull-right">
                <input type="submit" value="提交" class="btn btn-success">
                <input type="reset" value="重置" class="btn btn-danger">
            </div>

            <div style="clear:both"></div>
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
            	'_token':'{{ csrf_token() }}',
            	'files':'sys',
            },
            // 上传的flash动画
            'swf'      : "/up/uploadify.swf",
            // 文件上传的地址
            'uploader' : "/admin/shangchuan",
            // 当文件上传成功
            'onUploadSuccess' : function(file, data, response) {

            	// 拼接图片
            	imgs="<img width='200px'  src='/Uploads/sys/"+data+"'>";
            	// 展示图片
            	$("#main").html(imgs);
            	// 隐藏传递数据
            	$("#imgs").val(data);
               
            }
        });
    });
</script>
@endsection