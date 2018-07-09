@extends("admin.public.admin")
@section("main")
<!-- 内容 -->
			<div class="col-md-10">
				
				<ol class="breadcrumb">
					<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
					<li><a href="#">分类管理</a></li>
					<li class="active">分类添加</li>

					<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
				</ol>

				<!-- 面版 -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="/admin/types" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 分类页面</a>
						<a href="/admin/types/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加分类</a>
					</div>
					<div class="panel-body">
						<form action="/admin/types" method="post">
							{{csrf_field()}}
							<input type="hidden" name="pid" value="@php
								echo isset($_GET['pid']) ? $_GET['pid'] : 0;
							@endphp">
							<input type="hidden" name="path" value="@php
								echo isset($_GET['path']) ? $_GET['path'] : '0,'; 
							@endphp">
							<div class="form-group">
								<label for="">分类名</label>
								<input type="text" name="name" class="form-control" id="" placeholder="请输入分类名">
							</div>

							<div class="form-group">
								<label for="">标题</label>
								<input type="text" name="title" class="form-control" id="" placeholder="请输入标题">
							</div>
							<div class="form-group">
								<label for="">关键词</label>
								<input type="text" name="keywords" class="form-control" id="" placeholder="请输入关键词">
							</div>
							<div class="form-group">
								<label for="">描述</label>
								<input type="text" name="description" class="form-control" id="" placeholder="请输入描述">
							</div>
							<div class="form-group">
								<label for="">排序</label>
								<input type="number" name="sort" min="0" class="form-control" id="" placeholder="请输入排序数">
							</div>
							<div class="form-group">
								<label for="">是否楼层</label>
								<input type="radio" name="is_lou" value="1">是
								<input type="radio" name="is_lou" value="0" checked>否
							</div>

							<div class="form-group">
								<input type="submit" value="提交" class="btn btn-success">
								<input type="reset" value="重置" class="btn btn-danger">
							</div>

						</form>
					</div>
					
				</div>
			</div>
@endsection