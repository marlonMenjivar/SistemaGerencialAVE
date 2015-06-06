<div class="branchOffices form">
<?php echo $this->Form->create('BranchOffice'); ?>
	<fieldset>
		<legend><?php echo __('Add Branch Office'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Branch Offices'), array('action' => 'index')); ?></li>
	</ul>
</div>
