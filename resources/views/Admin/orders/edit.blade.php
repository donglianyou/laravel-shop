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
			<a href="javascript:;" class="btn btn-success">订单状态修改</a>
		</div>
		<div class="panel-body">
			<form action="" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label for="">订单号</label>
					<input type="text" class="form-control" disabled name="code" value="{{$_GET['code']}}" id="">
				</div>
				<div class="form-group">
					<label for="">订单状态</label>
					<select name="sid" class="form-control">
						@foreach ($data as $value)
							@if ($_GET['sid'] == $value->id)
								<option value="{{$value->id}}" selected>{{$value->name}}</option>
							@else
								<option value="{{$value->id}}">{{$value->name}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="form-group pull-left">
			        <input type="submit" value="提交" class="btn btn-success">
			        <input type="reset" id="reset" value="重置" class="btn btn-danger">
			    </div>
			</form>
		</div>
		<!-- 分页效果 -->
		<div class="panel-footer">
			{{-- {{$data->links()}} --}}
		</div>
	</div>
</div>
@endsection