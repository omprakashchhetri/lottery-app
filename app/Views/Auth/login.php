<?= $this->extend('Auth/layout') ?>

<?= $this->section('title') ?>Admin Dashboard - Login<?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="app-wrapper d-block">
    <div class="main-container">
        <!-- Body main section starts -->
        <div class="container">
            <div class="row sign-in-content-bg">
                <div class="col-lg-6 image-contentbox d-none d-lg-block">
                    <div class="form-container">
                        <div class="signup-content mt-4">
                            <h2 class="text-primary text-center">
                                Admin - Login
                                <!-- <img alt="" class="img-fluid" src="<?= base_url('assets/images/logo/1.png') ?>" /> -->
                            </h2>
                        </div>

                        <div class="signup-bg-img">
                            <img alt="" class="img-fluid" src="<?= base_url('assets/images/login-cover.webp') ?>" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-contentbox">
                    <div class="form-container">

                        <!-- Display validation errors -->
                        <?php if (session('error') !== null) : ?>
                        <div class="alert alert-danger bg-light-danger text-center p-2 rounded-1" role="alert">
                            <?= session('error') ?></div>
                        <?php elseif (session('errors') !== null) : ?>
                        <div class="alert alert-danger bg-light-danger text-center p-2 rounded-1" role="alert">
                            <?php if (is_array(session('errors'))) : ?>
                            <?php foreach (session('errors') as $error) : ?>
                            <?= $error ?><br>
                            <?php endforeach ?>
                            <?php else : ?>
                            <?= session('errors') ?>
                            <?php endif ?>
                        </div>
                        <?php endif ?>

                        <!-- Display success message -->
                        <?php if (session('message') !== null) : ?>
                        <div class="alert alert-success bg-light-success text-center p-2 rounded-1" role="alert">
                            <?= session('message') ?></div>
                        <?php endif ?>

                        <form action="<?= url_to('login') ?>" method="post" class="app-form rounded-control">
                            <?= csrf_field() ?>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5 text-center text-lg-start">
                                        <h2 class="text-primary-dark f-w-600">Welcome!</h2>
                                        <p>
                                            Sign in with your data that you entered during your
                                            registration
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">
                                            <?= lang('Auth.email') ?>
                                        </label>
                                        <input class="form-control" id="email" name="email"
                                            placeholder="Enter Your Email" type="email" value="<?= old('email') ?>"
                                            required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="password">
                                            <?= lang('Auth.password') ?>
                                        </label>
                                        <!-- <a class="link-primary-dark float-end" href="<?= url_to('magic-link') ?>">Forgot
                                            Password ?</a> -->
                                        <input class="form-control" id="password" name="password"
                                            placeholder="Enter Your Password" type="password" required />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" id="remember" name="remember" type="checkbox"
                                            value="1" <?= old('remember') ? 'checked' : '' ?> />
                                        <label class="form-check-label text-secondary" for="remember">
                                            <?= lang('Auth.rememberMe') ?>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <button class="btn btn-light-primary w-100" type="submit">
                                            <?= lang('Auth.login') ?>
                                        </button>
                                    </div>
                                </div>

                                <?php if (!setting('Auth.allowRegistration')) : ?>
                                <div class="col-12">
                                    <div class="text-center">
                                        <p><?= lang('Auth.needAccount') ?> <a
                                                href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
                                    </div>
                                </div>
                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Body main section ends -->
    </div>
</div>
<?= $this->endSection() ?>