<!-- Body main section starts -->
<main>
    <?php // echo"<pre>";print_r($resultArray)?>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h4 class="main-title">Dashboard</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a class="f-s-14 f-w-500" href="#">
                                    <span>
                                        Login
                                    </span>
                                </a>
                            </li>
                            <li class="active">
                                <a class="f-s-14 f-w-500" href="<?=base_url('admin/admin-dashboard')?>">Dashboard</a>
                            </li>
                        </ul>
                    </div>
                    <a href="<?=base_url('admin/add-result')?>"
                        class="btn btn-primary d-flex align-items-center gap-1 px-2">
                        <i class="ti ti-playlist-add fs-5"></i>Add Result
                    </a>
                </div>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <!-- Ticket start -->
        <div class="row ticket-app">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="clock-wrapper d-flex align-items-center position-relative bg-light-primary rounded-2 p-3 mb-4"
                            style="height: 90%; min-height: 150px">
                            <div class="clock-box" style="scale: 2; position: unset; margin-left: 40px">
                                <div class="clock">
                                    <div class="hour" id="hour"></div>
                                    <div class="min" id="min"></div>
                                    <div class="sec" id="sec"></div>
                                </div>
                            </div>
                            <div class="w-100">
                                <h2 class="fw-bold text-end" id="date-display"></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card ticket-card bg-light-primary">
                            <div class="card-body">
                                <i class="ph-bold ph-circle circle-bg-img"></i>
                                <div class="h-50 w-50 d-flex-center b-r-15 bg-white mb-3">
                                    <i class="ph-bold ph-ticket f-s-25 text-primary"></i>
                                </div>
                                <p class="f-s-16">All Results</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="text-primary-dark">
                                        <?=!empty($lotteryResults) ? count($lotteryResults) : 0?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card ticket-card bg-light-info">
                            <div class="card-body">
                                <i class="ph-bold ph-circle circle-bg-img"></i>
                                <div class="h-50 w-50 d-flex-center b-r-15 bg-white mb-3">
                                    <i class="ph-bold ph-clock-countdown f-s-25 text-info"></i>
                                </div>
                                <p class="f-s-16">1PM Results</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="text-info-dark"><?=$counterData['1pm']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card ticket-card bg-light-success">
                            <div class="card-body">
                                <i class="ph-bold ph-circle circle-bg-img"></i>
                                <div class="h-50 w-50 d-flex-center b-r-15 bg-white mb-3">
                                    <i class="ph-bold ph-clock-countdown f-s-25 text-success"></i>
                                </div>
                                <p class="f-s-16">8PM Results</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="text-success-dark"><?=$counterData['8pm']?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ticket end -->

        <!-- Create Buttons Sections Starts -->
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-around mb-3 gap-3 flex-wrap">
                    <!-- 1 PM Result -->
                    <?php if (empty($resultArray['1pm-result'])): ?>
                    <a href="<?= base_url('admin/add-result?time=1pm') ?>"
                        class="current-date-result p-3 bg-outline-primary b-r-22">
                        <div class="pending-result">
                            <small class="badge text-light-danger">Pending</small>
                            <div class="text-primary fs-5">
                                <span><i class="ti ti-plus"></i></span><span class="ms-2">Create 1 PM</span>
                            </div>
                        </div>
                    </a>
                    <?php else: ?>
                    <!-- <a href="<?= base_url('admin/edit-result/'.$resultArray['1pm-result']->id) ?>"
                        class="current-date-result p-3 bg-outline-primary b-r-22"> -->
                    <div class="current-date-result p-3 bg-outline-primary b-r-22 position-relative">
                        <button data-id="<?=$resultArray['1pm-result']->id?>"
                            onclick="window.location.href='<?= base_url('admin/edit-result/' . $resultArray['1pm-result']->id) ?>'"
                            class="text-white border-0 px-3 py-4 rounded-1 bg-light-warning action-edit-btn">
                            <i class="ti ti-edit text-warning"></i>
                        </button>

                        <div class="<?= $resultArray['1pm-result']->status === 'published' ? 'published-result' : 'draft-result' ?>"
                            style="min-width: 150px">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <small
                                    class="badge <?= $resultArray['1pm-result']->status === 'published' ? 'text-light-success' : 'text-light-warning' ?>">
                                    <?= ucfirst($resultArray['1pm-result']->status) ?>
                                </small>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status"
                                        data-record="<?=$resultArray['1pm-result']->id?>"
                                        <?= $resultArray['1pm-result']->status === 'published' ? 'checked' : '' ?> />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="fs-5 text-primary">
                                <span class="ms-2">8 PM Result</span>
                            </div>
                        </div>

                        <div class="d-flex gap-1">
                            <button data-id="<?=$resultArray['1pm-result']->id?>"
                                class="delete-result-btn text-white border-0 px-3 py-1 rounded-start bg-light-danger action-btn right">
                                <i class="ti ti-trash text-danger f-s-18"></i>
                            </button>
                            <button
                                onclick="window.location.href='<?= base_url('admin/view-result/' . $resultArray['1pm-result']->id) ?>'"
                                class="view-result-btn text-white border-0 px-3 py-1 rounded-end bg-light-success action-btn-view">
                                <i class="ti ti-eye text-success f-s-18"></i>
                            </button>
                        </div>
                    </div>

                    <?php endif; ?>


                    <!-- 8 PM Result -->
                    <?php if (empty($resultArray['8pm-result'])): ?>
                    <a href="<?= base_url('admin/add-result?time=8pm') ?>"
                        class="current-date-result p-3 bg-outline-primary b-r-22">
                        <div class="pending-result">
                            <small class="badge text-light-danger">Pending</small>
                            <div class="text-primary fs-5">
                                <span><i class="ti ti-plus"></i></span><span class="ms-2">Create 8 PM</span>
                            </div>
                        </div>
                    </a>
                    <?php else: ?>
                    <!-- <a href="<?= base_url('admin/edit-result/'.$resultArray['8pm-result']->id) ?>" class="current-date-result p-3 bg-outline-primary b-r-22"> -->
                    <div class="current-date-result p-3 bg-outline-primary b-r-22 position-relative">
                        <button data-id="<?=$resultArray['8pm-result']->id?>"
                            onclick="window.location.href='<?= base_url('admin/edit-result/' . $resultArray['8pm-result']->id) ?>'"
                            class="text-white border-0 px-3 py-4 rounded-1 bg-light-warning action-edit-btn">
                            <i class="ti ti-edit text-warning"></i>
                        </button>

                        <div class="<?= $resultArray['8pm-result']->status === 'published' ? 'published-result' : 'draft-result' ?>"
                            style="min-width: 150px">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <small
                                    class="badge <?= $resultArray['8pm-result']->status === 'published' ? 'text-light-success' : 'text-light-warning' ?>">
                                    <?= ucfirst($resultArray['8pm-result']->status) ?>
                                </small>
                                <label class="switch">
                                    <input type="checkbox" class="toggle-status"
                                        data-record="<?=$resultArray['8pm-result']->id?>"
                                        <?= $resultArray['8pm-result']->status === 'published' ? 'checked' : '' ?> />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="fs-5 text-primary">
                                <span class="ms-2">8 PM Result</span>
                            </div>
                        </div>

                        <div class="d-flex gap-1">
                            <button data-id="<?=$resultArray['8pm-result']->id?>"
                                class="delete-result-btn text-white border-0 px-3 py-1 rounded-start bg-light-danger action-btn right">
                                <i class="ti ti-trash text-danger f-s-18"></i>
                            </button>
                            <button
                                onclick="window.location.href='<?= base_url('admin/view-result/' . $resultArray['8pm-result']->id) ?>'"
                                class="view-result-btn text-white border-0 px-3 py-1 rounded-end bg-light-success action-btn-view">
                                <i class="ti ti-eye text-success f-s-18"></i>
                            </button>
                        </div>
                    </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
        <!-- Create Buttons Sections Starts -->

        <!-- Blank start -->
        <div class="row">
            <!-- Default Datatable start -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table class="display app-data-table default-data-table" id="example">
                                <thead>
                                    <tr>
                                        <th>Result ID</th>
                                        <th>Status</th>
                                        <th>Draw Date (Full)</th>
                                        <th>Draw Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($lotteryResults)): ?>
                                    <?php foreach ($lotteryResults as $result): ?>
                                    <tr>
                                        <td><?= esc($result['result_id']) ?></td>
                                        <td>
                                            <span
                                                class="badge text-light-<?= $result['status'] === 'published' ? 'success' : 'warning' ?>">
                                                <?= esc(ucfirst($result['status'])) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($result['draw_date_full']) ?></td>
                                        <td><?= esc($result['draw_time']) ?></td>
                                        <td>
                                            <button
                                                onclick="window.location.href='<?= base_url('admin/edit-result/' . $result['result_id']) ?>'"
                                                class="btn btn-light-success icon-btn b-r-4 edit-btn" type="button"
                                                data-id="<?= $result['result_id'] ?>">
                                                <i class="ti ti-edit text-success"></i>
                                            </button>

                                            <button class="btn btn-light-primary icon-btn b-r-4" type="button"
                                                onclick="window.open('<?= base_url('admin/view-result/' . $result['result_id']) ?>', '_blank')">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No results found.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Default Datatable end -->
        </div>

        <!-- Blank end -->
    </div>
</main>
<!-- Body main section ends -->