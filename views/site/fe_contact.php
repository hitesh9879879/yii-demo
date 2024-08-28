<?php

/** @var yii\web\View $this */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Send Mail';
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-car fa fa-envelope"></i>
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
                    <div class="p-4">
                        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>

                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <div class="form-group text-center">
                            <?= Html::submitButton(\yii\helpers\Html::encode($this->title), ['class' => 'btn btn-primary btn-block', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
