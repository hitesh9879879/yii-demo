<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?= \yii\helpers\Html::encode($this->title) ?></title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.css"
          integrity="sha512-Dovl+OCTZYdn+CwnU7ChS28VCZ1lDlhpZUpDIFvYtW8y20+lcZeWYnQrILYfGhcXSgzeXVhgjwQP39zfbdDPQw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<?php $this->beginBody() ?>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <div class="logo-src"></div>
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        <div class="app-header__content">
            <?php if (!Yii::$app->user->isGuest): ?>
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>

                    <?php if (\Yii::$app->user->can('admin')): ?>
                        <ul class="header-menu nav">
                            <li class="nav-item">
                                <a href="/site/send-mail"
                                   class="nav-link <?= Yii::$app->controller->action->getUniqueId() === 'site/send-mail' ? 'text-primary' : '' ?>">
                                    <i class="nav-link-icon fa fa-envelope <?= Yii::$app->controller->action->getUniqueId() === 'site/send-mail' ? 'text-primary' : '' ?>"> </i>
                                    Send Mail
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="/setting"
                                   class="nav-link <?= Yii::$app->controller->action->getUniqueId() === 'setting/index' ? 'text-primary' : '' ?>">
                                    <i class="nav-link-icon fa fa-cog <?= Yii::$app->controller->action->getUniqueId() === 'setting/index' ? 'text-primary' : '' ?>"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <span class="nav-link" onclick="add()">
                                    <i class="nav-link-icon fa fa-check"></i>
                                    Add Comment
                                </span>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="/site/comment-remove" class="nav-link">
                                    <i class="nav-link-icon fa fa-close"></i>
                                    All Comment Remove
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="/site/queue-work" class="nav-link">
                                    <i class="nav-link-icon fa fa-cloud-upload"></i>
                                    Run Queue
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="/site/clear-directory" class="nav-link">
                                    <i class="nav-link-icon fa fa-trash"></i>
                                    Clear Directory
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>

                <form action="<?= \yii\helpers\Url::to(['site/comment-add']) ?>" method="GET" id="count"
                      style="display: none;">
                    <div class="d-flex justify-content-center">
                        <input type="text" class="form-control" minlength="0" maxlength="2" max="50" name="query"
                               placeholder="Count" min="1">&nbsp;
                        <button type="submit" class="btn btn-dark"><i class="nav-link-icon fa fa-check"></i></button>&nbsp;
                        <span class="btn btn-dark" onclick="hide()"><i class="nav-link-icon fa fa-close"></i></span>
                    </div>
                </form>
            <?php endif; ?>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="btn-group">
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <button type="button" class="btn btn-dark dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username ?>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><span class="dropdown-item"><?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->email ?></span></li>
<!--                                        <li><a class="dropdown-item" href="#">Profile Edit</a></li>-->
<!--                                        <li><a class="dropdown-item" href="#">Something else here</a></li>-->
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><?= Yii::$app->user->isGuest ? '' :
                                                \yii\helpers\Html::beginForm(['/site/logout'])
                                                . \yii\helpers\Html::submitButton(
                                                    \yii\helpers\Html::tag('span', 'Logout'),
                                                    ['class' => 'dropdown-item logout']
                                                )
                                                . \yii\helpers\Html::endForm()
                                            ?></li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> &nbsp;&nbsp;
            <?php if (!Yii::$app->user->isGuest): ?>
                <a href="<?= \yii\helpers\Url::to(['../debug']) ?>" class="btn btn-dark p-2">
                    <i class="fa fa-bug"></i>
                </a> &nbsp;&nbsp;
            <?php endif; ?>
            <?php if (!Yii::$app->user->isGuest): ?>
                <a href="<?= \yii\helpers\Url::to(['site/lock-admin-panel']) ?>" class="btn btn-dark p-2">
                    <i class="fa fa-lock"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="app-main">
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                    data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                        <span>
                            <button type="button"
                                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="/site/index"
                                   class="<?= Yii::$app->controller->action->getUniqueId() === 'site/index' ? 'mm-active' : 'mm' ?>">
                                    <i class="fa fa-th pe-7s-rocket"></i>
                                    Dashboard
                                </a>
                            </li>
<!--                            --><?php //if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('temporary admin')): ?>
<!--                                <li class="mt-1">-->
<!--                                    <a href="/site/about"-->
<!--                                       class="--><?php //= Yii::$app->controller->action->getUniqueId() === 'site/about' ? 'mm-active' : 'mm' ?><!--">-->
<!--                                        <i class="fa fa-th pe-7s-rocket"></i>-->
<!--                                        About-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            --><?php //endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/site/user"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'site/user' || Yii::$app->controller->action->getUniqueId() === 'site/user-add' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        User
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/site/post"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'site/post' || Yii::$app->controller->action->getUniqueId() === 'site/post-add' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Posts
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/comment/comment-list"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'comment/comment-list' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Comments
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/array/index"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'array/index' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Array Data
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/api/index"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'api/index' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        News Api
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin') || \Yii::$app->user->can('user') || \Yii::$app->user->can('temporary admin')): ?>
                                <li class="mt-1">
                                    <a href="/excel/index"
                                       class="<?= Yii::$app->controller->action->getUniqueId() === 'excel/index' ? 'mm-active' : 'mm' ?>">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Excel Import & Export
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin')): ?>
                                <li class="mt-1">
                                    <a href="/gii/controller"
                                       class="mm">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Gii Generator
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (\Yii::$app->user->can('admin')): ?>
                                <li class="mt-1">
                                    <a href="/admin"
                                       class="mm">
                                        <i class="fa fa-th pe-7s-rocket"></i>
                                        Role
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?= $content ?>

        <?php $this->endBody() ?>

        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
</div>
<script type="text/javascript"
        src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    function add() {
        const commentBox = document.getElementById('count');

        commentBox.style.display = 'block';
    }

    function hide() {
        const commentBox = document.getElementById('count');

        commentBox.style.display = 'none';
    }
    //
    //let timeout;
    //
    //function startTimer() {
    //    clearTimeout(timeout);
    //    timeout = setTimeout(function() {
    //        window.location.href = "<?php //= \yii\helpers\Url::to(['site/lock-admin-panel']) ?>//";
    //    }, 20000);
    //}
    //window.addEventListener('mousemove', startTimer);
    //startTimer();
</script>
</body>
</html>
