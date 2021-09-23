<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4 class="red-text">Delete Course - <?php echo $course->course_name; ?></h4>
	       <div class="divider"></div>
		</div>
	</div>

	<?php echo form_open(NULL, ['id' => 'deletecourse']);?>
		<div class="section">
			<div class="row">
				<div class="col s12"><p>Are you sure you want to delete this course ?</p></div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="section">
						<div class="divider"></div>
					</div>
				</div>
				<div class="col s6">
					<div class="section">
						<button class="btn submit red waves-effect waves-light">Yes, Delete Course</button>
					</div>
				</div>
				<div class="col s6">
					<div class="section right">
						<a class="btn go-back waves-effect waves-light" href="/courses">Go Back</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>