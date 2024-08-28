<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $user */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex align-items-center justify-content-center" style="height: 80vh; width: 100%">
    <div class="card">
        <div class="card-body">
            <div class="site-login text-center">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>Please fill out the following fields to <?= Html::encode($this->title) ?>:</p>

                <div class="row">
                    <div class="col-lg-12">

                        <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'fieldConfig' => [
                                'template' => "{label}\n{input}\n{error}",
                                'labelOptions' => ['class' => 'col-form-label'],
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'invalid-feedback'],
                            ],
                        ]); ?>

                        <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($user, 'email')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($user, 'password')->passwordInput() ?>

                        <div class="form-group">
                            <?= Html::submitButton( Html::encode($this->title), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <div style="color:#999; width: 30rem">
                            <strong><a href="/site/login">Login</a></strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
