<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Edit Course - <?php echo $course->course_name; ?></h4>
	       <div class="divider"></div>
		</div>
	</div>

	<div class="row">
		<div class="col s12">
			<?php echo validation_errors(); ?>
		</div>
	</div>
	
	<?php echo form_open(NULL, ['id' => 'editcourse']);?>
		<div class="section">

			<?php if ($user_level == 'lecturer') : ?>
				<div class="row">
					<div class="input-field col s12 m6 l3">
						<input id="course_name" name="course_name" type="text" placeholder="Course Name" class="validate" required value="<?php echo $course->course_name; ?>">
						<label for="course_name">Course Name</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12 m6 l3">
						<textarea id="course_description" name="course_description" class="materialize-textarea" placeholder="Description">
							<?php echo $course->course_description; ?>
						</textarea>
						<label for="course_description">Course Description</label>
					</div>
				</div>
			<?php else : ?>
				<div class="row">
					  <div class="input-field col s12 m6 l3">
					    <select name="status">
					      <option value="active" <?php echo ($course->status == 'active') ? 'selected' : '' ; ?>>Active</option>
					      <option value="inactive" <?php echo ($course->status != 'active') ? 'selected' : '' ; ?>>Inactive</option>
					    </select>
					    <label>Status</label>
					  </div>
				</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="col s12">
					<div class="section">
						<div class="divider"></div>
					</div>
				</div>
				<div class="col s6">
					<div class="section">
						<button class="btn submit red waves-effect waves-light">Edit Course</button>
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