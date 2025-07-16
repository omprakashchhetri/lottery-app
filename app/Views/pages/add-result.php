                <!-- Body main section starts -->
                <main>
                    <div class="container-fluid">
                        <!-- Breadcrumb start -->
                        <div class="row m-1">
                            <div class="col-12">
                                <div class="d-flex align-items-start justify-content-between mb-3">
                                    <div>
                                        <h4 class="main-title">Add Result</h4>
                                        <ul class="app-line-breadcrumbs mb-3">
                                            <li class="">
                                                <a class="f-s-14 f-w-500" href="<?=base_url('admin/admin-dashboard')?>">
                                                    <span>
                                                        Dashboard
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="active">
                                                <a class="f-s-14 f-w-500" href="#">Add Result</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-md btn-primary" id="saveLotteryResultBtn">Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- Breadcrumb end -->

                        <!-- Blank start -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between flex-wrap px-2">
                                    <div class="mb-2" style="max-width: 200px;">
                                        <div class="d-flex align-items-center bg-white p-2 rounded-1 gap-2">
                                            <i class="ti ti-calendar text-primary fs-5"></i>
                                            <h6 class="m-0" id="date-display"></h6>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="date-time-wrapper text-end">
                                            <div class="form-selectgroup">
                                                <label class="select-items">
                                                    <input checked="" class="select-input" name="select-options"
                                                        type="radio" />
                                                    <span class="select-box">
                                                        <span class="selectitem">
                                                            <i class="ti ti-clock"></i> 1 PM Result
                                                        </span>
                                                    </span>
                                                </label>
                                                <label class="select-items">
                                                    <input class="select-input" name="select-options" type="radio" />
                                                    <span class="select-box">
                                                        <span class="selectitem">
                                                            <i class="ti ti-clock"></i> 8 PM Result
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 1st Prize start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>1st Prize Section</h5>
                                        <button class="btn btn-sm btn-light-info text-info" id="generateSection1"><i
                                                class="iconoir-refresh-double"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-md-5">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text b-r-left text-bg-primary"
                                                    id="basic-addon1"><i class="iconoir-component"></i></span>
                                                <input aria-describedby="basic-addon1" aria-label="12A 12345"
                                                    class="form-control b-r-right py-3 section1-input"
                                                    placeholder="12A 12345" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 1st Prize end -->

                            <!-- Sections 2nd Prize start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>2nd Prize Section</h5>
                                        <button class="btn btn-sm btn-light-info text-info" id="generateSection2"><i
                                                class="iconoir-refresh-double"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php for($i = 1; $i <= 10 ; $i++) { ?>
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text b-r-left text-bg-primary"
                                                        id="basic-addon-sec2<?=$i?>"><?=$i?></i></span>
                                                    <input aria-describedby="basic-addon-sec2<?=$i?>" aria-label="12345"
                                                        class="form-control b-r-right section2-input"
                                                        placeholder="12345" type="text" />
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 2nd Prize end -->

                            <!-- Sections 3rd Prize start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>3rd Prize Section</h5>
                                        <button class="btn btn-sm btn-light-info text-info" id="generateSection3"><i
                                                class="iconoir-refresh-double"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php for($i=1; $i<=10;$i++) { ?>
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text b-r-left text-bg-primary"
                                                        id="basic-addon-sec3<?=$i?>"><?=$i?></i></span>
                                                    <input aria-describedby="basic-addon-sec3<?=$i?>" aria-label="1234"
                                                        class="form-control b-r-right section3-input" placeholder="1234"
                                                        type="text" />
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 3rd Prize end -->

                            <!-- Sections 4th Prize start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>4th Prize Section</h5>
                                        <button class="btn btn-sm btn-light-info text-info" id="generateSection4"><i
                                                class="iconoir-refresh-double"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php for($i=1; $i<=10;$i++) { ?>
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text b-r-left text-bg-primary"
                                                        id="basic-addon-sec4<?=$i?>"><?=$i?></i></span>
                                                    <input aria-describedby="basic-addon-sec4<?=$i?>" aria-label="1234"
                                                        class="form-control b-r-right section4-input" placeholder="1234"
                                                        type="text" />
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 4th Prize end -->

                            <!-- Sections 5th Prize start -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5>5th Prize Section</h5>
                                        <button class="btn btn-sm btn-light-info text-info" id="generateSection5"><i
                                                class="iconoir-refresh-double"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php for($i = 1 ; $i <= 100 ; $i++) { ?>
                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text b-r-left text-bg-primary"
                                                        id="basic-addon-sec5<?=$i?>"><?=$i?></i></span>
                                                    <input aria-describedby="basic-addon-sec5<?=$i?>" aria-label="1234"
                                                        class="form-control b-r-right section5-input" placeholder="1234"
                                                        type="text" />
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Sections 5th Prize end -->

                            <div class="col-12">
                                <div class="text-center">
                                    <button class="btn btn-lg btn-primary" id="saveLotteryResultBtnBottom">Save</button>
                                </div>
                            </div>

                            <!-- Default Card end -->
                        </div>
                        <!-- Blank end -->
                    </div>
                </main>
                <!-- Body main section ends -->