<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
	<div class="row">
		<div class="col s12">
	       <h4>Sign Up</h4>
	       <div class="divider"></div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s12">
			<?php echo validation_errors(); ?>
		</div>
	</div>
	
	<?php echo form_open(NULL, ['id' => 'signup']);?>
		<div class="section">
			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="name" name="name" type="text" placeholder="Your Name" class="validate" required>
			          <label for="name">Your Name</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="username" name="username" type="text" placeholder="Username" class="validate" required>
			          <label for="username">Useranme</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="password" name="password" type="password" placeholder="Password" class="validate" required>
			          <label for="password">Password</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12 m6 l3">
			          <input id="password_verify" name="password_verify" type="password" placeholder="Verify Password" class="validate" required>
			          <label for="password_verify">Verify Password</label>
			          <p>Already have an account ? <a href="signin">Sign In Here</a></p>
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
						<button class="btn submit blue waves-effect waves-light">Sign Up</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>