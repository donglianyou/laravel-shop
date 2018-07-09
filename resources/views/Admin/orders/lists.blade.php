@extends("admin.public.admin")
@section('main')
<div class="col-md-10">
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="/admin/orders">订单管理</a></li>
		<li class="active">订单列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>
	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="javascript:;" class="btn btn-success">订单详情</a>
		</div>
		<table class="table-bordered table table-hover">
			<th>商品名</th>
			<th>商品图片</th>
			<th>购买价格</th>
			<th>购买数量</th>
			<th>小计</th>
			@php
				$number = 0;
				$money = 0;
			@endphp
			@foreach ($data as $value)
				<tr>
					<td>{{$value->title}}</td>
					<td><img src="/Uploads/goods/{{$value->img}}" width="200px" alt=""></td>
					<td>{{$value->price}}</td>
					<td>{{$value->num}}</td>
					<td>{{$value->price * $value->num}}</td>
					@php
						$number += $value->num;
						$money += $value->price * $value->num;
					@endphp
				</tr>
			@endforeach
			<tr>
				<td>合计</td>
				<td>价格：{{$money}}</td>
				<td>数量：{{$number}}</td>
			</tr>	
			
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{-- {{$data->links()}} --}}
		</div>
	</div>
</div>
@endsection