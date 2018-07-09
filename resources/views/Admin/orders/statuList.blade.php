@extends("admin.public.admin")
@section('main')
<style>
	.edit{
		display: none;
	}
	.w20{
		width: 20%;
	}
</style>
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">订单管理</a></li>
		<li class="active">订单状态列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-success">订单状态展示</a>
			<p class="pull-right tots" >共有 {{count($data)}}  条数据</p>
			<form action="" class="form-inline pull-right">
				<div class="form-group">
					<input type="text" name="search" class="form-control" placeholder="请输入你要搜索的内容" id="">
				</div>

				<input type="submit" value="搜索" class="btn btn-success">
			</form>
		</div>
		<table class="table-bordered table table-hover">
			<th>ID</th>
			<th>订单状态名</th>
			@foreach ($data as $value)
				<tr>
					<td>{{$value->id}}</td>
					<td><input type="text" name="" class="form-control w20 col-md-4" value="{{$value->name}}" placeholder=""><button onclick="save(this,{{$value->id}})" class="btn btn-success edit">确认</button></td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
<script>
//修改状态
$("input[type=text]").focus(function(){
	$(".edit").hide();
	$(this).next("button").show();
});
// 修改数据
function save(obj,id){
	val = $(obj).prev("input").val();
	$.post("/admin/orders/statu/ajaxStatu",{"id":id,"name":val,"_token":"{{csrf_token()}}"},function(data){
		if(data ==1){
			alert("状态修改成功！");
		}else{
			alert("状态修改失败！");
		}
	})
}
</script>
@endsection