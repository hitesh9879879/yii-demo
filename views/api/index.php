<?php

/** @var yii\web\View $this */
/** @var array $articles */
/** @var \yii\data\Pagination $pagination */

$this->title = 'Api Request Data';
?>
<div class="app-main__outer">
    <div class="app-main__inner <?= Yii::$app->user->can('user') ? 'p-5' : '' ?>">

        <div class="card mb-2" style="<?= Yii::$app->user->can('user') ? 'margin-top: 50px' : '' ?>">
            <div class="card-header">
                <h5><?= \yii\helpers\Html::encode($this->title) ?> Filter</h5>
            </div>
            <div class="card-body">
                <form action="<?= \yii\helpers\Url::to(['api/index']) ?>" method="GET">
                    <div class="row mb-4">
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" value="<?php echo $title ?? '' ?>">
                        </div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">New Date</label>
                            <input type="date" name="date" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp" value="<?php echo $date ?? '' ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary col-lg-12">Search</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5><?= \yii\helpers\Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body p-3">

                <div class="row">
                    <div class="col-md-12">
                        <div class="<?= \Yii::$app->user->can('user') ? 'row row-cols-1 row-cols-md-3 g-4' : 'row row-cols-1 row-cols-md-2 g-4' ?>">
                            <?php if (!empty($articles)): ?>
                                <?php foreach ($articles as $article): ?>
                                    <div class="col">
                                        <div class="card">
                                            <img src="<?= \yii\helpers\Html::encode($article['urlToImage'] ?? 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg') ?>"
                                                 class="card-img-top" alt="..." style="height: 250px; object-fit: cover">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title"><?= \yii\helpers\Html::encode($article['title']) ?></h5>
                                                <h5 class="card-title"> Author: <?= \yii\helpers\Html::encode($article['author']) ?></h5>
                                                <p class="card-text flex-grow-1"><?= \yii\helpers\Html::encode($article['content']) ?></p>
                                                <a href="<?= \yii\helpers\Html::encode($article['url']) ?>"
                                                   class="btn btn-primary col-lg-12 mt-auto">Read more</a>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted"><?= \yii\helpers\Html::encode($article['publishedAt']) ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h5 class="text-center col-lg-12"><b>No news available.</b></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12 mt-4">
                    <?= \yii\widgets\LinkPager::widget(['pagination' => $pagination]) ?>
                </div>
            </div>
        </div>

    </div>
</div>
