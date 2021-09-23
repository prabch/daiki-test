<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Lecturers</h4>
	       <div class="divider"></div>
		</div>
	</div>

	<div class="row">
		<div class="col s12">
			<table class="responsive-table highlight">
				<thead>
					<tr>
						<th>Lecturer ID</th>
						<th>Created</th>
						<th>Lecturer Name</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (isset($lecturers) && is_array($lecturers) && $lecturers) :?>
						<?php foreach ($lecturers as $each_lecturer):?>
							<tr>
								<td><?php echo $each_lecturer->user_id; ?></td>
								<td><?php echo $each_lecturer->created; ?></td>
								<td><?php echo $each_lecturer->name; ?></td>
								<td><?php echo $each_lecturer->status; ?></td>
								<td>
									<a href="/courses?lecturer_id=<?php echo $each_lecturer->user_id; ?>">Courses</a>
									| <a href="/lecturers/edit/<?php echo $each_lecturer->user_id; ?>">Edit</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr><td colspan="5"><i class="material-icons left">error</i>No Results Found</td></tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>