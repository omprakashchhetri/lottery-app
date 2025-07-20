<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$title?></title>
    <link rel="icon" href="<?=base_url()?>assets/images/logo.png" />
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/bootstrap-5.3.7-dist/css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Montserrat:wght@400;600;700&display=swap"
        rel="stylesheet" />

    <!-- Bebas Neue CDN (via Bunny Fonts) -->
    <link href="https://fonts.bunny.net/css?family=bebas-neue:400" rel="stylesheet" />

    <link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css" />
</head>

<body>
    <div id="mainBody-content"
        class="container-body font-body-oswald font-title-bebas-neue font-heading-bebas-neue font-button-bebas-neue font-nav_item-montserrat font-nav_dropdown-oswald contain-body">
        <div class="menu-backdrop"></div>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-primary p-0">
                <div class="container-fluid navbar-wraper inline-gap padding-main">
                    <a class="navbar-brand icon-main" href="#">
                        <img class="img-fluid" src="<?=base_url()?>assets/images/icon.jpg" alt="Logo" />
                    </a>
                    <span class="brand-name font-title">MEGHALAYA STATE LOTTERIES</span>
                    <button class="navbar-toggler menubar-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="closed">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5">
                                </path>
                            </svg>
                        </span>
                        <span class="opened">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#fff" class="bi bi-x"
                                viewBox="0 0 16 16">
                                <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708">
                                </path>
                            </svg>
                        </span>
                    </button>
                    <div class="navbar-menu-md collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link font-nav_item active" aria-current="page"
                                    href="<?=base_url()?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-nav_item active" aria-current="page"
                                    href="<?=base_url()?>old-results">Old
                                    Result</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-nav_item active" aria-current="page" href="#">Games</a>
                            </li>
                            <li class="nav-link">
                                <a class="common-button custom-btn tnc-btn font-button"
                                    href="<?=base_url('document/Terms&Conditions.pdf')?>" target="_blank">Terms
                                    &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>