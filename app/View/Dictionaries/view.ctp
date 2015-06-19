<div class="dictionaries view">
<h2><?php echo __('Dictionary'); ?></h2>
	<dl>
		<dt><?php echo __('Kanji'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['kanji']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kana'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('English'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['english']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('German'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['german']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Janum'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['janum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ennum'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['ennum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Denum'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['denum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('COL 8'); ?></dt>
		<dd>
			<?php echo h($dictionary['Dictionary']['COL 8']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dictionary'), array('action' => 'edit', $dictionary['Dictionary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Dictionary'), array('action' => 'delete', $dictionary['Dictionary']['id']), null, __('Are you sure you want to delete # %s?', $dictionary['Dictionary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dictionaries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dictionary'), array('action' => 'add')); ?> </li>
	</ul>
</div>
