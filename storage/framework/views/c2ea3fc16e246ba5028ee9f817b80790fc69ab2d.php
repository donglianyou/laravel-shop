<?php $__env->startSection('main'); ?>
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
			<a href="javascript:;" class="btn btn-success">收货地址详情</a>
		</div>
		<table class="table-bordered table table-hover">
			<tr>
				<td>姓名：</td>
				<td><?php echo e($data->sname); ?></td>
			</tr>
			<tr>
				<td>电话：</td>
				<td><?php echo e($data->stel); ?></td>
			</tr>
			<tr>
				<td>所在省市：</td>
				<td><?php echo e($data->addr); ?></td>
			</tr>
			<tr>
				<td>收货地址详细信息：</td>
				<td><?php echo e($data->addrInfo); ?></td>
			</tr>
			<tr>
				<td>邮箱：</td>
				<td><?php echo e($data->email); ?></td>
			</tr>
		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.public.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>