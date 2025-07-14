<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template"
        name="description" />
    <meta
        content="admin template, axelit admin template, dashboard template, flat admin template, responsive admin template, web app"
        name="keywords" />
    <meta content="la-themes" name="author" />
    <link href="<?=base_url()?>assets/images/logo/favicon.png" rel="icon" type="image/x-icon" />
    <link href="<?=base_url()?>assets/images/logo/favicon.png" rel="shortcut icon" type="image/x-icon" />

    <title><?=$title?></title>

    <!--font-awesome-css-->
    <link href="<?=base_url()?>assets/vendor-assets/fontawesome/css/all.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />

    <!-- iconoir icon css  -->
    <link href="<?=base_url()?>assets/vendor-assets/ionio-icon/css/iconoir.css" rel="stylesheet" />

    <!-- Data Table css-->
    <link href="<?=base_url()?>assets/vendor-assets/datatable/jquery.dataTables.min.css" rel="stylesheet"
        type="text/css" />

    <!-- tabler icons-->
    <link href="<?=base_url()?>assets/vendor-assets/tabler-icons/tabler-icons.css" rel="stylesheet" type="text/css" />

    <!--animation-css-->
    <link href="<?=base_url()?>assets/vendor-assets/animation/animate.min.css" rel="stylesheet" />

    <!--flag Icon css-->
    <link href="<?=base_url()?>assets/vendor-assets/flag-icons-master/flag-icon.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap css-->
    <link href="<?=base_url()?>assets/vendor-assets/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- simplebar css-->
    <link href="<?=base_url()?>assets/vendor-assets/simplebar/simplebar.css" rel="stylesheet" type="text/css" />

    <!-- App css-->
    <link href="<?=base_url()?>assets/css/main-style.css" rel="stylesheet" type="text/css" />

    <!-- Responsive css-->
    <link href="<?=base_url()?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
</head>

<body class="dark">
    <div class="app-wrapper">
        <div class="loader-wrapper">
            <div class="app-loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Menu Navigation starts -->
        <nav>
            <div class="app-logo">
                <a class="logo d-inline-block" href="<?=base_url('admin/admin-dashboard')?>">
                    <img class="logo-light" src="<?=base_url('assets/images/admin-logo.png ')?>" alt="">
                    <img class="logo-dark" src="<?=base_url('assets/images/admin-logo-dark.png ')?>" alt="">
                </a>
                <span class="bg-light-primary toggle-semi-nav">
                    <i class="ti ti-chevrons-right f-s-20"></i>
                </span>
            </div>
            <div class="app-nav" id="app-simple-bar">
                <ul class="main-nav p-0 mt-2">
                    <li class="menu-title">
                        <span>My Pages</span>
                    </li>
                    <li class="no-sub">
                        <a href="<?=base_url('admin/admin-dashboard')?>">
                            <i class="iconoir-home-alt"></i>
                            dashboard
                        </a>
                    </li>
                    <li class="no-sub">
                        <a href="<?=base_url('admin/add-result')?>">
                            <i class="iconoir-keyframes-couple"></i>
                            Add Result
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-navs">
                <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
                <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
            </div>
        </nav>
        <!-- Menu Navigation ends -->

        <div class="app-content">
            <div class="">
                <!-- Header Section starts -->
                <header class="header-main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                                <span class="header-toggle me-3">
                                    <i class="iconoir-view-grid"></i>
                                </span>
                            </div>

                            <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">
                                <ul class="d-flex align-items-center">
                                    <li class="header-cloud">
                                        <a aria-controls="cloudoffcanvasTops" class="head-icon"
                                            data-bs-target="#cloudoffcanvasTops" data-bs-toggle="offcanvas"
                                            href="blank.html#" role="button">
                                            <i class="iconoir-dew-point text-primary f-s-26 me-1"></i>
                                            <span class="f-w-600">26 <sup class="f-s-10">°C</sup></span>
                                        </a>

                                        <div aria-labelledby="cloudoffcanvasTops"
                                            class="offcanvas offcanvas-end header-cloud-canvas" id="cloudoffcanvasTops"
                                            tabindex="-1">
                                            <div class="offcanvas-body p-0">
                                                <div class="cloud-body">
                                                    <div class="cloud-content-box">
                                                        <div class="cloud-box bg-primary-900">
                                                            <p class="mb-3">Mon</p>
                                                            <h6 class="mt-4 f-s-13">+29°C</h6>
                                                            <span>
                                                                <i
                                                                    class="ph-duotone ph-cloud-fog text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 2%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-800">
                                                            <p class="mb-3">Tue</p>
                                                            <h6 class="mt-4 f-s-13">+29°C</h6>
                                                            <span>
                                                                <i
                                                                    class="ph-duotone ph-cloud-sun text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 2%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-700">
                                                            <p class="mb-3 text-light">Wed</p>
                                                            <h6 class="mt-4 f-s-13">+20°C</h6>
                                                            <span>
                                                                <i class="ph-duotone ph-sun-dim text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 1%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-600">
                                                            <p class="mb-3">Thu</p>
                                                            <h6 class="mt-4 f-s-13">+17°C</h6>
                                                            <span>
                                                                <i class="ph-duotone ph-sun-dim text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 1%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-500">
                                                            <p class="mb-3">Fri</p>
                                                            <h6 class="mt-4 f-s-13">+18°C</h6>
                                                            <span>
                                                                <i class="ph-duotone ph-sun-dim text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 1%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-400">
                                                            <p class="mb-3">Sat</p>
                                                            <h6 class="mt-4 f-s-13">+16°C</h6>
                                                            <span>
                                                                <i class="ph-duotone ph-sun-dim text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 1%
                                                            </p>
                                                        </div>
                                                        <div class="cloud-box bg-primary-300">
                                                            <p class="mb-3">Sun</p>
                                                            <h6 class="mt-4 f-s-13">+29°C</h6>
                                                            <span class="mb-3">
                                                                <i class="ph-duotone ph-sun-dim text-white f-s-25"></i>
                                                            </span>
                                                            <p class="f-s-13 mt-3">
                                                                <i class="wi wi-raindrop"></i> 1%
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="header-dark">
                                        <div class="sun-logo head-icon">
                                            <i class="iconoir-sun-light"></i>
                                        </div>
                                        <div class="moon-logo head-icon">
                                            <i class="iconoir-half-moon"></i>
                                        </div>
                                    </li>
                                    <li class="header-profile">
                                        <a aria-controls="profilecanvasRight" class="d-block head-icon"
                                            data-bs-target="#profilecanvasRight" data-bs-toggle="offcanvas"
                                            href="blank.html#" role="button">
                                            <img alt="avtar" class="b-r-50 h-35 w-35 bg-dark"
                                                src="<?=base_url()?>assets/images/6.png" />
                                        </a>

                                        <div aria-labelledby="profilecanvasRight"
                                            class="offcanvas offcanvas-end header-profile-canvas h-auto"
                                            id="profilecanvasRight" tabindex="-1" style="max-height: 170px">
                                            <div class="offcanvas-body app-scroll">
                                                <ul class="">
                                                    <li class="d-flex gap-3 mb-3">
                                                        <div class="d-flex-center">
                                                            <span
                                                                class="h-45 w-45 d-flex-center b-r-10 position-relative">
                                                                <img alt="" class="img-fluid b-r-10"
                                                                    src="<?=base_url()?>assets/images/6.png" />
                                                            </span>
                                                        </div>
                                                        <div class="text-center mt-2">
                                                            <h6 class="mb-0">
                                                                Admin
                                                                <img alt="instagram-check-mark" class="w-20 h-20"
                                                                    src="<?=base_url()?>assets/images/check.png" />
                                                            </h6>
                                                            <p class="f-s-12 mb-0 text-secondary">
                                                                admin@gmail.com
                                                            </p>
                                                        </div>
                                                    </li>

                                                    <!-- <li>
                                                        <a class="f-w-500" href="profile" target="_blank">
                                                            <i class="iconoir-user-love pe-1 f-s-20"></i>
                                                            Profile Details
                                                        </a>
                                                    </li> -->
                                                    <li>
                                                        <form action="<?= url_to('logout') ?>" method="get"
                                                            style="display: inline;">
                                                            <?= csrf_field() ?>
                                                            <button type="submit"
                                                                class="btn btn-danger w-100 rounded-2">Logout</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Header Section ends -->