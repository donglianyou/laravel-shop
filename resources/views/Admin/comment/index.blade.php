@extends("admin.public.admin")
@section('main')
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">评论管理</a></li>
		<li class="active">评论列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-success">评论展示</a>
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
			<th>用户名</th>
			<th>商品名</th>
			<th>商品图片</th>
			<th>内容</th>
			<th>星级</th>
			<th>评论时间</th>
			<th>状态</th>
			@foreach ($data as $value)
				<tr>
					<td>{{$value->id}}</td>
					<td>{{$value->name}}</td>
					<td>{{$value->title}}</td>
					<td><img src="/Uploads/goods/{{$value->gimg}}" width="200px" alt=""></td>
					<td>{{$value->text}}</td>
					<td style="color: red;">{{str_repeat("★", $value->start)}}{{str_repeat("☆", 5 - $value->start)}}</td>
					<td>{{date('Y-m-d H:i:s',$value->time)}}</td>
					<td>
						<select name="" onchange="a(this,{{$value->id}})" class="form-control">
						@if ($value->statu == 1)
							<option value="0">未审核</option>
							<option value="1" selected>正常</option>
							<option value="2">黑名单</option>
						@elseif($value->statu == 2)
							<option value="0">未审核</option>
							<option value="1">正常</option>
							<option value="2" selected>黑名单</option>
						@else
							<option value="0" selected>未审核</option>
							<option value="1">正常</option>
							<option value="2">黑名单</option>
						@endif
						</select>
					</td>
				</tr>
			@endforeach
			
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{-- {{$data->links()}} --}}
		</div>
	</div>
</div>
<script language="javascript">
// 更新状态值
function a(obj,id){
	val = $(obj).val();
	// 发送ajax请求
	$.post("/admin/comment/ajaxStatu",{"id":id,"statu":val,"_token":'{{csrf_token()}}'},function(data){
		if(data ==1){
			alert("状态修改成功！");
		}else{
			alert("状态修改失败！");
		}
	})
}
</script>
@endsection