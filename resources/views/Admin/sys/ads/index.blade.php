@extends("admin.public.admin")
@section('main')
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">系统管理</a></li>
		<li class="active">广告列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-danger">广告展示</a>
			<a href="/admin/sys/ads/create" class="btn btn-success">广告添加</a>
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
			<th>广告链接</th>
			<th>图片</th>
			<th>排序</th>
			<th>状态</th>
			@foreach ($data as $value)
				<tr>
					<td>{{$value->id}}</td>
					<td>{{$value->title}}</td>
					<td><a href="{{$value->href}}" target="_blank" title="{{$value->href}}">{{$value->href}}</a></td>
					<td><img src="/Uploads/ads/{{$value->img}}" width="200px" alt=""></td>
					<td>{{$value->sort}}</td>
					<td>修改  删除</td>
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