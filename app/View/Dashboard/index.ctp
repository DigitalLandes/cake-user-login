<div class="row">
	<div class="col-lg-10">
		<h3>User data from session</h3>
	</div>
	<div class="col-lg-2">
		<?php echo $this->Html->link("Logout", '/users/logout', array('class' => 'pull-right')); ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td>ID</td>
					<td><?php echo $loggedinUser['id']; ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo $loggedinUser['username']; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $loggedinUser['email']; ?></td>
				</tr>
				<tr>
					<td>First Name</td>
					<td><?php echo $loggedinUser['first_name']; ?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?php echo $loggedinUser['last_name']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>