<div class="inds index">
	<h2><?php echo __('Inds'); ?></h2>
<?php //debug($joins);?>
<?php //debug($searched) ?>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo $this->Paginator->sort('zsm'); ?></th>
			<th><?php echo $this->Paginator->sort('ind'); ?></th>
			<th><?php echo $this->Paginator->sort('mnk'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($searched as $ind): ?>
	<tr>
		<td><?php echo h($ind['zsms']['zsm']); ?>&nbsp;</td>
		<td><?php echo h($ind['Ind']['ind']); ?>&nbsp;</td>
		<td><?php echo h($ind['mnks']['mnk']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ind['Ind']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $zsm['Ind']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $zsm['Ind']['id']), null, __('Are you sure you want to delete # %s?', $zsm['Ind']['id'])); ?>
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
foreach ($searched as $ind):
	echo($ind['zsms']['zsm']);
	echo ("->");
	echo ($ind['Ind']['ind']);
	echo(";");
endforeach;
?>
<?php
foreach ($searched as $ind):
	echo($ind['Ind']['ind']);
	echo ("->");
	echo ($ind['mnks']['mnk']);
	echo(";");
endforeach;
?>
}
'/>

	<?php //debug($joins) ?>

</div>
<div class="actions">
  <div class="well" style="margin-top:20px;">

      <fieldset>
          <legend>検索</legend>
      </fieldset>

        <!--サーチプラグイン使わない検索-->
				<?php // echo $this->Form->create('Ind', array('action'=>'index')); ?>
	  <?php //echo $this->Form->input('zsm', array('label' => 'malay', 'empty' => true)); ?>
      <?php //echo $this->Form->input('ind', array('label' => 'indonesia', 'empty' => true)); ?>
      <?php //echo $this->Form->input('mnk', array('label' => 'Minangkabau', 'empty' => true)); ?>
			<?php
			echo $this->Form->create('Ind',array('action'=>'index'));
 			?>インドネシア:<?php echo $this->Form->text('Ind.ind');
			?>ミナケバブ:<?php echo $this->Form->text('mnks.mnk');
			?>マレー: <?php echo $this->Form->text('zsms.zsm');
      echo $this->Form->end('検索'); ?>


  </div>
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ind'), array('action' => 'add', 'url'=>'index')); ?></li>
	</ul>

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
