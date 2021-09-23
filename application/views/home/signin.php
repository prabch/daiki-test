<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Sign In</h4>
	       <div class="divider"></div>
		</div>
	</div>

	<?php echo form_open(NULL, ['id' => 'signin']);?>
		<div class="section">
			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="username" name="username" type="text" placeholder="Username" required>
			          <label for="username">Useranme</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="password" name="password" type="password" placeholder="Password" class="validate" required>
			          <label for="password">Password</label>
			          <p>Don't have an account ? <a href="signup">Sign Up Here</a></p>
				</div>				
			</div>

			<div class="row">
				<div class="col s12">
			       <div class="divider"></div>
					<div class="section">
						<button class="btn blue submit waves-effect waves-light">Sign In</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>