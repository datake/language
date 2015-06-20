<h2>検索</h2>

<?php
echo $this->Form->create('Search');
echo $this->Form->text('query');
echo $this->Form->end('Search ');
?>

<h2>検索結果</h2>
<?php echo h($dictionaries[1]['Dictionary']['kanji']);?>
