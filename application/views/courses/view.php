<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">

	<div class="row">
		<div class="col s12">
	       <h4><?php echo $course->course_name; ?></h4>
	       <div class="divider"></div>
		</div>
	</div>

	<div class="row">
		<div class="col s12">
	       <a href="/courses/edit/<?php echo $course->course_id; ?>" class="btn"><i class="material-icons left">edit</i>EDIT</a>
	       <?php if($user_level == 'lecturer'):?>
	       	<a href="/courses/delete/<?php echo $course->course_id; ?>" class="btn red"><i class="material-icons left">delete</i>DELETE</a>
	       <?php endif;?>
		</div>
	</div>

	<div class="row">
		<div class="col s6">
			<table class="striped">
				<tbody>
				  <tr>
				    <td><b>Course ID</b></td>
				    <td><?php echo $course->course_id; ?></td>
				  </tr>
				  <tr>
				    <td><b>Created</b></td>
				    <td><?php echo $course->created; ?></td>
				  </tr>
				  <tr>
				    <td><b>Course Description</b></td>
				    <td><?php echo $course->course_description; ?></td>
				  </tr>
				  <tr>
				    <td><b>Lecturer</b></td>
				    <td><?php echo $course->name; ?></td>
				  </tr>
				  <tr>
				    <td><b>Status</b></td>
				    <td><?php echo $course->status; ?></td>
				  </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

