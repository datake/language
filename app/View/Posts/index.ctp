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
li.movie {
    float:left;
    width:120px;
    padding:10px;
}
</style>


<h2>Videos</h2>

    <?php $tmpCount=0;
    ?>
    <ul >
        <div class ="row">
        <?php foreach ($posts as $post) : ?>
        <div class ="col-md-3">
        <li id="post_<?php echo h($post['Post']['id']); ?>" class="movie" >
            <img src="http://img.youtube.com/vi/<?php echo h($post['Post']['URL']); ?>/3.jpg" alt="alt here..." />

            <?php
    
            echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);;
            ?>
            <br>
            <?php //echo h($post['Post']['URL']);?>
            <?php //echo h($post['Post']['created']);?>
            <?php echo $this->Html->link('編集',array('action'=>'edit',$post['Post']['id']));?>

            <?php
    //クラスとデータ属性を指定してjQueryでとる
            echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-post-id'=>$post['Post']['id']));
            ?>
        </li>
        </div>
        <?php if($tmpCount==3){//次から下の段へ
            $tmpCount=0;
        ?>
          </div >
            <div class ="row">
        <?php
        }else {$tmpCount+=1;}
        
        ?>
    <?php endforeach; ?>
</div>
    </ul>

<h2>Upload </h2>
<?php echo $this->Html->Link('Upload from here',array('controller'=>'posts','action'=>'add'));?>


<!--サイドバー-->
<!--
<div class="actions">
<?php if ($auth->loggedIn()) : ?>
<?php echo h($auth->user('username')); ?> さん、<br>こんにちは<br><br> <a href="/cakephp-blog/Users/logout">logout</a>
<?php else: ?>
<a href="/cakephp-blog/Users/login">login</a>
<?php endif ?>
<br>
<br>
<h3><?php echo __('Actions'); ?></h3>
<ul>
<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
</ul>
</div>-->
<script>
$(function() {
$('a.delete').click(function(e) {//a要素のdeleteクラスがついたものがクリックされた処理
    if (confirm('sure?')) {
//次の行パスを間違えてはまった!注意！
$.post('/cakephp-blog/posts/delete/'+$(this).data('post-id'), {}, function(res) {
//削除にフェードアウトを使う
$('#post_'+res.id).fadeOut();
}, "json");
}
return false;
});
});
</script>








