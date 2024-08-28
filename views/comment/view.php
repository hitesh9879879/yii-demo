<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Posts List';
?>

<style>
    /* turquoise */
    .text-turquoise, .link-turquoise {
        color: #1abc9c;
    }

    .bg-turquoise {
        background-color: #1abc9c;
    }

    .btn-turquoise {
        background-color: #1abc9c;
    }
</style>

<div class="app-main__outer <?= \Yii::$app->user->can('user') ? 'p-5 mt-5' : '' ?>">
    <div class="app-main__inner">
        <div class="d-flex justify-content-start flex-column">
            <div>
                <div class="row my-5 shadow">
                    <div class="col-md-6 bg-light p-4 border">
                        <img src="<?= Yii::getAlias('@web') . '/posts/' . Html::encode($post->post_image); ?>"
                             class="card-img-top" alt="..." style="height: 400px; object-fit: cover">
                    </div>
                    <!-- .col end -->
                    <div class="col-md-6 bg-dark p-4 text-light">
                        <h2 data-tilt><?= Html::encode($post->title); ?></h2>
                        <h6 data-tilt> CreatedBy : <?= Html::encode($post->user->username); ?></h6>
                        <p data-tilt><?= Html::encode($post->description); ?></p>
                        <button class="btn btn-lg btn-light link-dark shadow rounded-0" onclick="comment()">Comment</button>
                    </div>
                    <!-- .col end -->
                </div>
            </div>

            <div class="pt-2">
                <div class="<?= \Yii::$app->user->can('user') ? 'row row-cols-1 row-cols-md-1 g-4' : 'row row-cols-1 row-cols-md-2 g-4' ?>">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Existing Comments</h5>

                                <!-- Display Comments -->
                                <?php foreach ($comments as $com): ?>
                                    <?php if ($com->post_id == $post->id): ?>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-start">
                                                <p><strong><?= Html::encode($com->user->username); ?>:</strong></p> &nbsp;&nbsp;&nbsp;
                                                <p><?= Html::encode($com->like ? '👍' : '👎'); ?></p>
                                            </div>
                                            <p><?= Html::encode($com->description); ?></p>
                                        </div>
                                        <hr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-2" id="commentBox" style="display: none">
                <div class="<?= \Yii::$app->user->can('user') ? 'row row-cols-1 row-cols-md-1 g-4' : 'row row-cols-1 row-cols-md-2 g-4' ?>">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <?php $form = \yii\widgets\ActiveForm::begin(); ?>

                                <?= $form->field($comment, 'description')->textarea(['autofocus' => true]) ?>

                                <?= $form->field($comment, 'like')->checkbox(['autofocus' => true]) ?>

                                <div class="form-group">
                                    <?= \yii\helpers\Html::submitButton('Post', ['class' => 'btn btn-primary btn-block']); ?>
                                </div>

                                <?php \yii\widgets\ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function comment() {
                const commentBox = document.getElementById('commentBox');

                if (commentBox.style.display == 'block') {
                    commentBox.style.display = 'none';
                } else {
                    commentBox.style.display = 'block';
                }

            }
        </script>
    </div>
</div>
