<?php echo $this->Form->create('Login', array('url' => '/users/login', 'class' => 'form-signin')); ?>
<h2 class="form-signin-heading">Please sign in</h2>
<div class="control-group">
	<?php
	echo $this->Form->input('Login.email', array(
		'type' => 'text',
		'label' => array('text' => 'Email address', 'class' => 'sr-only'),
		'placeholder' => 'Enter email address',
		'class' => 'form-control'
	));
	?>
</div>
<div class="control-group">
	<?php
	echo $this->Form->input('Login.password', array(
		'type' => 'password',
		'label' => array('text' => 'Password', 'class' => 'sr-only'),
		'placeholder' => 'Password',
		'class' => 'form-control'
	));
	?>
</div>
<div class="checkbox">
	<label>
		<?php echo $this->Form->checkbox('Login.remember_me', array('hiddenField' => false, 'value' => '1')); ?> Remember me
	</label>
</div>
<?php echo $this->Form->button('Sign in', array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block')); ?>
<?php echo $this->Form->end(); ?>