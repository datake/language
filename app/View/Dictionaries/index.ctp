<div class="dictionaries index">
	<h2><?php echo __('Dictionaries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('kanji'); ?></th>
			<th><?php echo $this->Paginator->sort('kana'); ?></th>
			<th><?php echo $this->Paginator->sort('english'); ?></th>
			<th><?php echo $this->Paginator->sort('german'); ?></th>
			<th><?php echo $this->Paginator->sort('日本語義数'); ?></th>
			<th><?php echo $this->Paginator->sort('英語義数'); ?></th>
			<th><?php echo $this->Paginator->sort('独語義数'); ?></th>
			<th><?php echo $this->Paginator->sort('独語性'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($dictionaries as $dictionary): ?>
	<tr>
		<td><?php echo h($dictionary['Dictionary']['kanji']);
		//echo (getalphabet($dictionary['Dictionary']['kanji']));?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['kana']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['english']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['german']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['janum']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['ennum']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['denum']); ?>&nbsp;</td>
		<td><?php echo h($dictionary['Dictionary']['COL 8']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $dictionary['Dictionary']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $dictionary['Dictionary']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $dictionary['Dictionary']['id']), null, __('Are you sure you want to delete # %s?', $dictionary['Dictionary']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	<script type="text/javascript" src="http://localhost/gviz/gviz.js"></script>
	<script type="gviz" data-layout="dot"><![CDATA[
    digraph G {
        this -> that;
        that -> theother;
        theother -> this;
    }
]]></script>

<img src='http://g.gravizo.com/g?
digraph G {

<?php
foreach ($dictionaries as $dictionary):
	echo(getalphabet($dictionary['Dictionary']['kanji']));
	echo ("->");
	echo ($dictionary['Dictionary']['english']);
	echo(";");
endforeach;
?>
<?php
foreach ($dictionaries as $dictionary):
	echo($dictionary['Dictionary']['english']);
	echo ("->");
	echo ($dictionary['Dictionary']['german']);
	echo(";");
endforeach;
?>
}
'/>
<!--日本語がもじばけする-->
<!--	<img src='http://g.gravizo.com/g?
   digraph G {
      日本語-> 英語;
     英語 -> 独語;
   }
  '/>-->

</div>
<div class="actions">
  <div class="well" style="margin-top:20px;">
      <?php echo $this->Form->create('Dictionary', array('action'=>'index')); ?>
      <fieldset>
          <legend>検索</legend>
      </fieldset>
      <?php //echo $this->Form->input('sort',array('options' => $select_language)); ?>
      <?php //echo $select_language; ?>
      <?php echo $this->Form->input('kanji', array('label' => '日本語(漢字)', 'empty' => true)); ?>
      <?php echo $this->Form->input('english', array('label' => 'english', 'empty' => true)); ?>
      <?php echo $this->Form->input('german', array('label' => 'german', 'empty' => true)); ?>
      <?php echo $this->Form->input('janum', array('label' => '日本語義数', 'empty' => true)); ?>
      <?php echo $this->Form->input('ennum', array('label' => '英語義数', 'empty' => true)); ?>
      <?php echo $this->Form->input('denum', array('label' => '独語義数', 'empty' => true)); ?>
      <?php echo $this->Form->end('検索'); ?>
  </div>
	<!--<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Dictionary'), array('action' => 'add')); ?></li>
	</ul>
-->
</div>

<?php
function getalphabet($kanji){

$api = 'http://jlp.yahooapis.jp/FuriganaService/V1/furigana';
$appid = 'dj0zaiZpPWxQaFBRSzBnM1JlTSZzPWNvbnN1bWVyc2VjcmV0Jng9ZjU-';
$params = array(
    'sentence' => $kanji
);

$ch = curl_init($api);
curl_setopt_array($ch, array(
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT      => "Yahoo AppID: $appid",
    CURLOPT_POSTFIELDS     => http_build_query($params),
));

$result = curl_exec($ch);
curl_close($ch);
$xml = simplexml_load_string($result);
return $xml->Result->WordList->Word->Roman[0];
}

				?>
