<?php

/** @var yii\web\View $this */

$this->title = 'Comments List';
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car fa fa-list"></i>
                    </div>
                    <div><?= \yii\helpers\Html::encode($this->title) ?>
                        <div class="page-title-subheading">This is an example dashboard created using build-in
                            elements and components.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><?= \yii\helpers\Html::encode($this->title) ?>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th>Post Name</th>
                                <th>User Name</th>
                                <th>Description</th>
                                <th>Like</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment): ?>

                                <tr>
                                    <td class="text-center text-muted">#<?= $comment['id']; ?></td>
                                    <td class="text-muted"><?= $comment->post->title; ?></td>
                                    <td class="text-muted"><?= $comment->user->username ?></td>
                                    <td class="text-muted"><?= \yii\helpers\StringHelper::truncate($comment['description'], 80) ?></td>
                                    <td class="text-muted"><?= \yii\helpers\Html::encode($comment->like ? '👍' : '👎'); ?></td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
