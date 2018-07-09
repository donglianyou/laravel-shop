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
		<li class="active">轮播图列表</li>
		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-danger">轮播图展示</a>
			<a href="javascript:;" data-toggle="modal" data-target="#add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加轮播图</a>
			<p class="pull-right tots" >共有  条数据</p>
			<form action="" class="form-inline pull-right">
				<div class="form-group">
					<input type="text" name="search" class="form-control" placeholder="请输入你要搜索的内容" id="">
				</div>

				<input type="submit" value="搜索" class="btn btn-success">
			</form>
		</div>
		<table class="table-bordered table table-hover">
			<th>ID</th>
			<th>标题</th>
			<th>图片</th>
			<th>友情链接</th>
			<th>排序</th>
			<th>操作</th>

			@foreach ($data as $value)
				<tr>
					<td>{{$value->id}}</td>
					<td>{{$value->title}}</td>
					<td><img width="200px" src="/Uploads/lun/{{$value->img}}" alt=""></td>
					<td>{{$value->href}}</td>
					<td>{{$value->order}}</td>
					<td>操作</td>
				</tr>
			@endforeach
			
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{$data->links()}}
		</div>
	</div>
</div>
<!-- 添加轮播图的摸态框 -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">添加轮播图</h4>
            </div>
            <div class="modal-body">
            	@if (count($errors) > 0)
            		<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
						</ul>
            		</div>
            	@endif
                <form action="/admin/sys/slider" method="post">
                	{{csrf_field()}}
                    <div class="form-group">
                        <label for="">标题</label>
                        <input type="text" name="title" class="form-control" placeholder="请输入标题" id="">
                        <div id="userInfo"></div>
                    </div>
                    <div class="form-group">
                        <label for="">友情链接</label>
                        <input type="text" name="href" class="form-control" placeholder="请输入友情链接" id="">
                        <div id="passInfo"></div>
                    </div>
                    <div class="form-group">
                        <label for="">排序</label>
                        <input type="number" name="order" class="form-control" placeholder="数值越大越靠前" id="">
                        <div id="repassInfo"></div>
                    </div>
                    <div class="form-group">
                        <label for="">图片</label>
                        <input type="file" name="" id="uploads">
						<div id="main">
							
						</div>
						<input type="hidden" name="img" id="imgs">
                    </div>
                    <div class="form-group pull-right">
                        <input type="submit" value="提交" class="btn btn-success">
                        <input type="reset" value="重置" class="btn btn-danger">
                    </div>

                    <div style="clear:both"></div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
            	'files':'lun',
            },
            // 上传的flash动画
            'swf'      : "/up/uploadify.swf",
            // 文件上传的地址
            'uploader' : "/admin/shangchuan",
            // 当文件上传成功
            'onUploadSuccess' : function(file, data, response) {

            	// 拼接图片
            	imgs="<img width='200px'  src='/Uploads/lun/"+data+"'>";
            	// 展示图片
            	$("#main").html(imgs);
            	// 隐藏传递数据
            	$("#imgs").val(data);
               
            }
        });
    });
</script>
@endsection