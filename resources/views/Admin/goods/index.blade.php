@extends("admin.public.admin")
@section('main')
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">商品管理</a></li>
		<li class="active">商品列表</li>
		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 批量删除</button>
			<a href="/admin/goods/create" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> 添加商品</a>
			<p class="pull-right tots" >共有 {{$tot}} 条数据</p>
			<form action="" class="form-inline pull-right">
				<div class="form-group">
					<input type="text" name="" class="form-control" placeholder="请输入你要搜索的内容" id="">
				</div>
				<input type="submit" value="搜索" class="btn btn-success">
			</form>
		</div>
		<table class="table-bordered table table-hover">
			<th><input type="checkbox" name="" id=""></th>
			<th>ID</th>
			<th>名称</th>
			<th>简介</th>
			<th>图片</th>
			<th>价格</th>
			<th>库存</th>
			<th>操作</th>
			@foreach ($data as $value)
				<tr>
					<td><input type="checkbox" name="" id=""></td>
					<td>{{$value->id}}</td>
					<td>{{$value->title}}</td>
					<td>{{$value->info}}</td>
					<td><img src="/Uploads/goods/{{$value->img}}" width="200px" alt=""><br>
						@foreach ($value->tupian as $val)
							<img src="/Uploads/goods/{{$val->img}}" width="50px" alt="">
						@endforeach
					</td>
					<td>{{$value->price}}</td>
					<td>{{$value->num}}</td>
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
<script type="text/javascript">
//删除数据
function del(id) {
	if (confirm("您确定要删除吗？")) {
		// 发送post请求
		$.post('/admin/types/'+id,{'_token':'{{csrf_token()}}','_method':'delete'},function(data){
			if (data ==1) {
				window.location.reload();
			}else{
				alert("删除失败！");
			}
		})
	}
}
</script>
@endsection