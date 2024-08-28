<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Posts List';
?>
<div class="app-main__outer <?= \Yii::$app->user->can('user') ? 'p-5 mt-5' : '' ?>">
    <div class="app-main__inner">
        <div class="row">
            <div class="col-md-12">
                <div class="<?= \Yii::$app->user->can('user') ? 'row row-cols-1 row-cols-md-3 g-4' : 'row row-cols-1 row-cols-md-2 g-4' ?>">
                    <?php foreach ($posts as $post): ?>
                        <div class="col">
                            <div class="card">
                                <img src="<?= Yii::getAlias('@web') . '/posts/' . Html::encode($post->post_image); ?>"
                                     class="card-img-top" alt="..." style="height: 250px; object-fit: cover">
                                <div class="card-body">
                                    <h5 class="card-title"><?= Html::encode($post->title); ?></h5>
                                    <h5 class="card-title"> CreatedBy : <?= Html::encode($post->user->username); ?></h5>
                                    <p class="card-text"><?= Html::encode($post->description); ?></p>
                                    <a href="<?= Url::to(['comment/post-view', 'id' => $post->id]) ?>"
                                       class="btn btn-primary">Comment</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
