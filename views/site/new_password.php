<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'New password';
?>

<div class="d-flex align-items-center justify-content-center flex-column" style="height: 80vh; width: 100%">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <div class="site-login">
                <h1><?= Html::encode($this->title) ?></h1>
                <div class="row ">
                    <div class="col-lg-12 p-3">

                        <form action="<?= \yii\helpers\Url::to(['site/new-password']) ?>" method="GET">
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" readonly id="exampleInputEmail1"
                                           aria-describedby="emailHelp" value="<?php echo $email ?? '' ?>">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1" class="form-label">Conform Password</label>
                                    <input type="password" name="con_password" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary col-lg-12">Change Password</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
