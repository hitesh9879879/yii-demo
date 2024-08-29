
<style>
    body {
        overflow: <?= Yii::$app->session->get('key') == 'locked' ? 'hidden' : 'scroll' ?>;
        position: <?= Yii::$app->session->get('key') == 'locked' ? 'fixed' : 'relative' ?>;
    }
    .lock-screen {
        z-index: 9999;
        background: rgba(0, 0, 0, 0.69);
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        display: <?= Yii::$app->session->get('key') == 'locked' ? 'flex' : 'none' ?>;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: #ffffff;
        text-align: center;
    }

    .user-image {
        height: 100px;
        width: 100px;
        border-radius: 50%;
    }

    h4 {
        margin-top: 20px;
    }

    .password-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 15px;
    }

    .password-input {
        padding: 10px;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        border: 1px solid #ccc;
        width: 80%;
        max-width: 300px;
    }

    .submit-button {
        padding: 10px 20px;
        border: none;
        background-color: #1e7e34;
        color: white;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        cursor: pointer;
    }
</style>

<?php if (\Yii::$app->user->can('user')): ?>
    <?php echo $this->render('frontend', ['content' => $content]); ?>
<?php else: ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="lock-screen">
            <img src="<?= Yii::$app->session->get('user_image') ?>" alt="User Image" class="user-image"/>
            <h4 style="margin-top: 20px"><b><?= Yii::$app->session->get('username') ?></b></h4>
            <form action="<?= \yii\helpers\Url::to(['site/lock-admin-panel']) ?>" method="GET">
                <div style="display: flex; justify-content: center; align-items: center; flex-direction: column">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <input type="password" placeholder="Enter your password" name="password"
                               style="padding: 10px; margin: 15px 0; border-top-left-radius: 5px; border-bottom-left-radius: 5px; border: 1px solid #ccc; width: 80%; max-width: 300px;">
                        <button type="submit" style="padding: 10px 20px; border: none; background-color: #1e7e34; color: white; border-top-right-radius: 5px; border-bottom-right-radius: 5px; cursor: pointer;">
                            Unlock
                        </button>
                    </div>

                    <?php if (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert" style="color: white">
                            <b><?= Yii::$app->session->getFlash('error') ?></b>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    <?php endif; ?>
    <?php echo $this->render('backend', ['content' => $content]); ?>
<?php endif; ?>