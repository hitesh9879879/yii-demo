<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Arunlal Panja">
    <title><?= \yii\helpers\Html::encode($this->title) ?></title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <!-- CSS Files -->
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="assets/css/aos.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- <link rel="stylesheet" href="assets/css/owl.carousel.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- <link rel="stylesheet" href="assets/css/owl.theme.default.min.css"> -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Custom CSS -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <style>
        /* Custom Style */
        body {
            overflow-x: hidden;
        }

        #offcanvasTop {
            --bs-offcanvas-height: 80vh;
            background-color: #c5e1d4;
        }

        .scrollToTop {
            padding: 10px;
            color: #444;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 99;
        }

        .owl-item.active.center h5, .owl-item.active.center span {
            color: #000;
        }

        @media screen and (max-width: 1023px) {
            #myCarousel .carousel-item img {
                height: auto !important;
            }
        }
    </style>
</head>

<body>
<!-- Header Block Start -->
<header id="site-header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.html"><img src="https://demo.dashboardpack.com/architectui-html-free/assets/images/logo-inverse.png" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= \Yii::$app->controller->action->getUniqueId() === 'site/index' ? 'active' : '' ?>" aria-current="page" href="/site/index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= \Yii::$app->controller->action->getUniqueId() === 'site/about' ? 'active' : '' ?>" aria-current="page" href="/site/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= \Yii::$app->controller->action->getUniqueId() === 'comment' ? 'active' : '' ?>" aria-current="page" href="/comment">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= \Yii::$app->controller->action->getUniqueId() === 'site/contact' ? 'active' : '' ?>" aria-current="page" href="/site/contact">Contact</a>
                    </li>
                </ul>
                <div class="btn-group">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <button type="button" class="btn btn-dark dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->username ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><span class="dropdown-item"><?= Yii::$app->user->isGuest ? '' : Yii::$app->user->identity->email ?></span></li>
<!--                            <li><a class="dropdown-item" href="#">Profile Edit</a></li>-->
<!--                            <li><a class="dropdown-item" href="#">Something else here</a></li>-->
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
                </div> &nbsp;&nbsp;
                <?php if (!Yii::$app->user->isGuest): ?>
                    <a href="<?= \yii\helpers\Url::to(['../debug']) ?>" class="btn btn-dark p-2">
                        <i class="fa fa-bug"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<?= $content ?>

<!-- Footer Block Start -->
<footer id="site-footer">
    <div class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-3 col-sm-12">
                    <h5 class="pb-3"><i class="fa-solid fa-user-group pe-1"></i> About us</h5>
                    <span class="text-secondary">This is a wider card with supporting text below as a natural lead-in to additional content.</span>
                </div>
                <div class="col-md-6 col-xl-3 col-sm-12">
                    <h5 class="pb-3"><i class="fa-solid fa-link pe-1"></i> Important links</h5>
                    <ul>
                        <li><a href="#" class="text-decoration-none link-secondary">About us</a></li>
                        <li><a href="#" class="text-decoration-none link-secondary">Privacy policy</a></li>
                        <li><a href="#" class="text-decoration-none link-secondary">Terms of services</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-xl-3 col-sm-12">
                    <h5 class="pb-3"><i class="fa-solid fa-location-dot pe-1"></i> Our location</h5>
                    <span class="text-secondary">
                            Milannagar bazar<br>
                            Tamluk, East Medinipore, West Bengal<br>
                            720001, India<br>
                        </span>
                </div>
                <div class="col-md-6 col-xl-3 col-sm-12">
                    <h5 class="pb-3"><i class="fa-solid fa-paper-plane pe-1"></i> Stay updated</h5>
                    <form>
                        <input type="text" class="w-100 mb-2 form-control" name="" placeholder="Email ID">
                        <button class="w-100 btn btn-dark">Subscribe now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                        class="fa-brands fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                        class="fa-brands fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                        class="fa-brands fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                        class="fa-brands fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                        class="fa-brands fa-github"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12"><span class="text-secondary pt-1 float-md-end float-sm-start">Copyright &copy; 2023</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="scrollToTop btn btn-outline-secondary">Top</a>
<!-- JavaScript Files -->
<!-- <script src="assets/js/jquery-3.6.4.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="assets/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<!-- <script src="assets/js/aos.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<!-- <script src="assets/js/owl.carousel.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- Custom JS -->
<!-- <script src="assets/js/custom.js"></script> -->

<script>
    /* Custom Script */
    /* Scroll Top */
    $(document).ready(function () {
        "use strict";
        var offSetTop = 200;
        var $scrollToTopButton = $('.scrollToTop');
        //Check to see if the window is top if not then display button
        $(window).scroll(function () {
            if ($(this).scrollTop() > offSetTop) {
                $scrollToTopButton.fadeIn();
            } else {
                $scrollToTopButton.fadeOut();
            }
        });

        //Click event to scroll to top
        $scrollToTopButton.click(function () {
            $('html, body').animate({scrollTop: 0}, 200);
            return false;
        });

    });
    // fixed footer
    var siteFooter = document.getElementById('site-footer');
    if ((siteFooter.offsetTop + siteFooter.offsetHeight) < window.innerHeight) {
        siteFooter.classList.add('fixed-bottom', 'bottom-0', 'left-0', 'w-full');
    }
    /* Animate On Scroll */
    AOS.init();
    /* Owl Carousel */
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        center: true,
        dots: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
</script>
</body>

</html>