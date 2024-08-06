<?php include 'admin/db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-dark">
		<div class="card-body">
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Date Ordered</th>
						<th class="text-center">Order Code</th>
						
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$query = $conn->query("SELECT * FROM orders where user_id = '{$_SESSION['login_id']}' order by unix_timestamp(date_created)");
					while($row= $query->fetch_assoc()):
					?>
					<tr>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class=""><?php echo date("M d, Y",strtotime($row['date_created'])) ?></td>
						<td class=""><?php echo $row['ref_id'] ?></td>
						
						<td class="text-center">
		                    <a href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" data-code="<?php echo $row['ref_id'] ?>" class="btn btn-primary btn-flat view_order">
		                          <i class="fas fa-eye"></i>View Order
	                        </a>
					</tr>
					<?php endwhile; ?>
				</tbody>
				
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('table').dataTable()
		$('.view_order').click(function(){
			uni_modal("My Order "+$(this).attr('data-code'),"view_order.php?id="+$(this).attr('data-id'),"large")
		})
	})
</script>