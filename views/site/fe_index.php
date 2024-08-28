<?php

/** @var yii\web\View $this */

$this->title = 'Dashboard';
?>

<style>
    .conbg {
        width: 100%;
        height: 40rem;
    }

    .bg2 {
        z-index: 2;
        position: relative;
        width: 70%;
        margin: 100px auto;
        transform: rotate(10deg);
        background-image: url(https://images.unsplash.com/photo-1623691183627-4d6075a8d0d7?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NzIyMzUwNDk&ixlib=rb-4.0.3&q=80);
        background-size: cover;
        background-position: right -50px;
        background-color: lightslategray;
        box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.5);
        margin-top: 200px;
    }

    .bg1 {
        z-index: 3;
        position: relative;
        margin: auto;
        transform: rotate(-5deg);
        background-image: url(https://images.unsplash.com/photo-1575419268007-a9a5e6b1ce0b?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NzIyMzQ5NjY&ixlib=rb-4.0.3&q=80);
        background-size: cover;
        background-position: right -70px;
        background-color: lightslategray;
        box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.5);
    }

    .bg {
        z-index: 4;
        position: relative;
        margin: auto;
        transform: rotate(-5deg);
        height: 500px;
        background-image: url(https://images.unsplash.com/photo-1630534658718-395efda906cb?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NzIyMzUxMDA&ixlib=rb-4.0.3&q=80);
        background-size: cover;
        background-position: right -50px;
        background-color: lightslategray;
        box-shadow: 5px 5px 3px rgba(0, 0, 0, 0.5);
    }

    .bg-text {
        width: 100%;
        position: absolute;
        display: inline-block;
        bottom: 0;
        left: 0;
    }

    .bg-text a {
        margin: 5px;
        float: right;
    }

    #bg1:target .bg {
        animation: ciut 1s forwards;
    }

    #bg1:target {
        animation: fre 0.3s forwards;
    }

    #bg2:target .bg1 {
        animation: ciut 1s forwards;
    }

    #bg2:target {
        animation: fre1 0.3s forwards;
    }

    #conbg:target .bg2 {
        animation: ciut1 1s;
    }

    @keyframes fre1 {
        0% {
            transform: rotate(10deg);
        }
        100% {
            transform: rotate(0deg);
        }
    }

    @keyframes fre {
        0% {
            transform: rotate(-5deg);
        }
        100% {
            transform: rotate(-10deg);
        }
    }

    @keyframes ciut {
        0% {
            opacity: 1;
            transform: rotate(-5deg) scale(1);
        }
        100% {
            opacity: 0;
            transform: rotate(360deg) scale(0);
        }
    }

    @keyframes ciut1 {
        0% {
            opacity: 0;
            transform: rotate(0deg) scale(0);
        }
        100% {
            opacity: 1;
            transform: rotate(370deg) scale(1);
        }
    }

</style>

<div class="container conbg" style="margin-top: 30px; margin-bottom: 30px" id="conbg">
    <div class="bg2" id="bg2">
        <div class="bg1" id="bg1">
            <div class="bg" id="bg">
                <div class="bg-text text-light ps-3">
                    <h3>Selamat datang di<br/>PutihNET Official</h3>
                    <p>
                        Desain Login Page Hotspot<br/>
                        Desain Voucher Wifi<br/>
                        Bisnis Voucher
                    </p>
                    <a class="text-light" href="#bg1">
                        <svg viewBox="0 0 448 512" width="30" fill="#fff" title="angle-double-right">
                            <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="bg-text text-light ps-3">
                <h3>Selamat datang di<br/>PutihNET Official</h3>
                <p>
                    Desain Login Page Hotspot<br/>
                    Desain Voucher Wifi<br/>
                    Bisnis Voucher
                </p>
                <a class="text-light" href="#bg2">
                    <svg viewBox="0 0 448 512" width="30" fill="#fff" title="angle-double-right">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"/>
                    </svg>
                </a>
            </div>
        </div>
        <div class="bg-text text-light ps-3">
            <h3>Selamat datang di<br/>PutihNET Official</h3>
            <p>
                Desain Login Page Hotspot<br/>
                Desain Voucher Wifi<br/>
                Bisnis Voucher
            </p>
            <a class="text-light" href="#conbg">
                <svg viewBox="0 0 448 512" width="30" fill="#fff" title="angle-double-right">
                    <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34zm192-34l-136-136c-9.4-9.4-24.6-9.4-33.9 0l-22.6 22.6c-9.4 9.4-9.4 24.6 0 33.9l96.4 96.4-96.4 96.4c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l136-136c9.4-9.2 9.4-24.4 0-33.8z"/>
                </svg>
            </a>
        </div>
    </div>
</div>
