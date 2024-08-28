<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $user */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex align-items-center justify-content-center" style="height: 80vh; width: 100%">
    <div class="card">
        <div class="card-body">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>
        </div>
    </div>
</div>
