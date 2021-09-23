<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Courses
	       	<?php echo ($lecturer_id) ? ' - by lecturer ' . $lecturer_id : ''; ?>
	       </h4>
	       <div class="divider"></div>
		</div>
	</div>

	<?php if($user_level == 'lecturer'):?>
		<div class="row">
			<div class="col s12">
		       <a href="courses/add" class="btn"><i class="material-icons left">add</i>ADD COURSE</a>
			</div>
		</div>
	<?php endif;?>

	<div class="row">
		<div class="col s12">
			<table class="responsive-table highlight">
				<thead>
					<tr>
						<th>Course ID</th>
						<th>Created</th>
						<th>Course Name</th>
						<?php if($user_level != 'lecturer'):?><th>Lecturer</th><?php endif;?>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (isset($courses) && is_array($courses) && $courses) :?>
						<?php foreach ($courses as $each_course):?>
							<tr>
								<td><?php echo $each_course->course_id; ?></td>
								<td><?php echo $each_course->created; ?></td>
								<td><?php echo $each_course->course_name; ?></td>
								<?php if($user_level != 'lecturer'):?>
									<td><?php echo $each_course->name; ?></td>
								<?php endif;?>
								<td><?php echo $each_course->status; ?></td>
								<td>
									<a href="/courses/view/<?php echo $each_course->course_id; ?>">View</a>
									| <a href="/courses/edit/<?php echo $each_course->course_id; ?>">Edit</a>
									<?php if($user_level == 'lecturer'):?>
									| <a href="/courses/delete/<?php echo $each_course->course_id; ?>" class="red-text">Delete</a>
									<?php endif;?>
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