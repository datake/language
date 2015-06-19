<div class="dictionaries form">
<?php echo $this->Form->create('Dictionary'); ?>
	<fieldset>
		<legend><?php echo __('Add Dictionary'); ?></legend>
	<?php
		echo $this->Form->input('kanji');
		echo $this->Form->input('kana');
		echo $this->Form->input('english');
		echo $this->Form->input('german');
		echo $this->Form->input('janum');
		echo $this->Form->input('ennum');
		echo $this->Form->input('denum');
		echo $this->Form->input('COL 8');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dictionaries'), array('action' => 'index')); ?></li>
	</ul>
</div>
