<?php foreach ($news as $post): ?>
    <div class="block clearfix">
      <b class="right"><?= $post->date ?></b>
      <b><?= $post->title ?></b>
      <hr>
      <p><?= $post->short_text ?></p>
      <hr>
      <a class="pull-right" href="<?= $post->link ?>">Подробнее</a>
    </div>
    <?php endforeach;
    //echo $pagination;
?>