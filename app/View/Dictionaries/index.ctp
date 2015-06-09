<!--//こんにちは???さんの処理 http://www.moonmile.net/blog/archives/4858-->
<style>
body {
  text-align:center;
}

ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

/*li.movie {
float:left;
width:120px;
padding:10px;
}*/
</style>


<h2>日英独</h2>

<?php $tmpCount=0;
?>
<!--<ul>-->
<table>
  <!--<tr>
    <td>Japanese</td>
    <td>English</td>
    <td>German</td>
  </tr>-->
  <!--<div class ="row">-->
  <?php //foreach ($dictionaries as $dictionary) : ?>
    <?php for($i=1;$i<100;$i++){ ?>
      <tr>
        <td><?php echo h($dictionaries[$i]['Dictionary']['kanji']);?></td>
        <td><?php echo h($dictionaries[$i]['Dictionary']['english']);?></td>
        <td><?php echo h($dictionaries[$i]['Dictionary']['german']);?></td>
        <td><?php echo h($dictionaries[$i]['Dictionary']['janum']);?></td>
        <td><?php echo h($dictionaries[$i]['Dictionary']['ennum']);?></td>
        <td><?php echo h($dictionaries[$i]['Dictionary']['denum']);?></td>
      </tr>
      <!--<div class ="col-md-3">
      <li>
      <div class="col-md-4"><?php echo h($dictionaries[$i]['Dictionary']['kana']);?></div>
      <div class="col-md-4"><?php echo h($dictionaries[$i]['Dictionary']['english']);?></div>
      <div class="col-md-4"><?php echo h($dictionaries[$i]['Dictionary']['german']);?></div>
    </li>-->
  </div>

  <?php };?>
  <?php //endforeach; ?>

</div>
</table>
</ul>
