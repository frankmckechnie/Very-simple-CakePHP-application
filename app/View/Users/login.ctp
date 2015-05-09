<h1>Login</h1>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User',array('action'=>'login')); ?>
<?php echo $this->Form->input('username'); ?>
<?php echo $this->Form->input('password'); ?>
<?php echo $this->Form->end('Login'); ?>

