<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Новини</h1>
    </div>

    <div class="body-content">
            <?= \yii\helpers\Html::a('Перемішати першу новину',['site/shuffle'], ['class' => 'btn btn-outline-secondary']) ?>
        <div class="row">
            <?php foreach($news as $new): ?>
            <div class="col-lg-4">
                <h2>Заголовок</h2>

                <p><?= $new->text ?></p>
                <span><?php echo $new->date ?></span>
                <?= \yii\helpers\Html::a('Дивитись',['site/view-new','id' =>$new->id], ['class' => 'btn btn-outline-secondary']) ?>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>
