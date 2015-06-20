<div class="zsms index">
	<h2><?php echo __('Zsms'); ?></h2>

	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('zsm'); ?></th>
			<th><?php echo $this->Paginator->sort('ind'); ?></th>
			<th><?php echo $this->Paginator->sort('mnk'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($joins as $zsm): ?>
	<tr>
		<td><?php echo h($zsm['Zsm']['zsm']); ?>&nbsp;</td>
		<td><?php echo h($zsm['Zsm']['ind']); ?>&nbsp;</td>
		<td><?php echo h($zsm['mnks']['mnk']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $zsm['Zsm']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $zsm['Zsm']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $zsm['Zsm']['id']), null, __('Are you sure you want to delete # %s?', $zsm['Zsm']['id'])); ?>
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
foreach ($zsms as $zsm):
	echo(getalphabet($zsm['Zsm']['ind']));
	echo ("->");
	echo ($zsm['Zsm']['zsm']);
	echo(";");
endforeach;
?>
<?php
/*foreach ($zsms as $zsm):
	echo($zsm['Zsm']['english']);
	echo ("->");
	echo ($zsm['Zsm']['german']);
	echo(";");
endforeach;*/
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
	<?php debug($joins) ?>
</div>
<div class="actions">
  <div class="well" style="margin-top:20px;">
      <?php echo $this->Form->create('Zsm', array('action'=>'index')); ?>
      <fieldset>
          <legend>検索</legend>
      </fieldset>
			<?php echo $this->Form->input('zsms', array('label' => 'malay', 'empty' => true)); ?>
      <?php echo $this->Form->input('ind', array('label' => 'indonesia', 'empty' => true)); ?>
      <?php echo $this->Form->input('mnk', array('label' => 'Minangkabau', 'empty' => true)); ?>

      <?php echo $this->Form->end('検索'); ?>
  </div>
	<!--<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Zsm'), array('action' => 'add')); ?></li>
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
