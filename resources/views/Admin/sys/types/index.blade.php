@extends("admin.public.admin")
@section('main')
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">分类广告列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-danger">分类广告展示</a>
			<a href="/admin/sys/types/create" class="btn btn-success">分类广告添加</a>
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
			<th>广告标题</th>
			<th>所属分类</th>
			<th>类型</th>
			<th>图片</th>
			<th>状态</th>
			@foreach ($data as $value)
				<tr>
	   				<td>{{$value->id}}</td>
	   				<td>{{$value->title}}</td>
	   				<td>{{$value->name}}</td>
	   				<td>
						@if ($value->type)
							大图
						@else
							小图
						@endif
	   				</td>
	   				<td><img src="/Uploads/ads/{{$value->img}}" width="200px" alt=""></td>
	   				<td>修改 删除</td>
				</tr>
			@endforeach
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{$data->links()}}
		</div>
	</div>
</div>
@endsection