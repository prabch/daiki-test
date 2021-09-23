<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Edit Lecturer - <?php echo $lecturer->name; ?></h4>
	       <div class="divider"></div>
		</div>
	</div>

	<div class="row">
		<div class="col s12">
			<?php echo validation_errors(); ?>
		</div>
	</div>
	
	<?php echo form_open(NULL, ['id' => 'editlecturer']);?>
		<div class="section">

			<div class="row">
				  <div class="input-field col s12 m6 l3">
				    <select name="status">
				      <option value="active" <?php echo ($lecturer->status == 'active') ? 'selected' : '' ; ?>>Active</option>
				      <option value="inactive" <?php echo ($lecturer->status != 'active') ? 'selected' : '' ; ?>>Inactive</option>
				    </select>
				    <label>Status</label>
				  </div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<div class="section">
						<div class="divider"></div>
					</div>
				</div>
				<div class="col s6">
					<div class="section">
						<button class="btn submit red waves-effect waves-light">Edit Lecturer</button>
					</div>
				</div>
				<div class="col s6">
					<div class="section right">
						<a class="btn go-back waves-effect waves-light" href="/lecturers">Go Back</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>