<div class="posts form">
<?php 
echo $this->Form->create('Post', array('enctype'=>'multipart/form-data')); // edited by MD to allow file upload
?> 
	<fieldset>
 		<legend><?php echo __('Add Post'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('submittedfile', array('type' => 'file'));
		// echo $this->Form->file('submittedfile');
		/* modification by MD - replace the next few lines with the file input above
		echo $this->Form->input('file_name');
		echo $this->Form->input('file_type');
		echo $this->Form->input('file_size');
		*/
		echo $this->Form->input('content');
		/* modification by MD - user can't change their ID to pretend to be somebody else!
		echo $this->Form->input('user_id');
		*/
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
	</ul>
</div>