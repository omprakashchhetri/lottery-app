<?php
/** @var array $lottery_data */
/** @var int $resultId */
/** @var string $draw_time */
?>

<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <h4 class="main-title">Update Result</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a class="f-s-14 f-w-500" href="<?= base_url('admin/admin-dashboard') ?>">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class="active">
                                <a class="f-s-14 f-w-500" href="#">Update</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <button data-id="<?=$resultId?>"
                            class="delete-result-btn text-white border-0 px-3 py-1 rounded-1 bg-light-danger"><i
                                class="ti ti-trash text-danger"></i></button>
                        <button class="btn btn-md btn-primary" id="saveChangesBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prize Sections -->
        <div class="row">
            <!-- Draw Time Selection -->
            <div class="col-12">
                <div class="d-flex align-items-end justify-content-between flex-wrap px-2">
                    <div class="d-flex flex-column mb-2" style="max-width: 400px;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <small
                                class="badge <?= $lottery_data['status'] === 'published' ? 'text-light-success' : 'text-light-warning' ?>">
                                <?= ucfirst($lottery_data['status']) ?>
                            </small>
                            <label class="switch">
                                <input type="checkbox" class="toggle-status" data-record="<?=$resultId?>"
                                    <?= $lottery_data['status'] === 'published' ? 'checked' : '' ?> />
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="d-flex">
                            <div class="d-flex align-items-center bg-white p-2 rounded-1 gap-2">
                                <i class="ti ti-calendar text-primary fs-5"></i>
                                <h6 class="m-0" id=""><?=date('d M Y' , strtotime($lottery_data['draw_date']))?>
                                </h6>
                            </div>
                            <button class="btn btn-light-primary icon-btn b-r-4" type="button"
                                onclick="window.open('<?= base_url('admin/view-result/' . $resultId) ?>', '_blank')">
                                <i class="ti ti-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="date-time-wrapper text-end">
                            <div class="form-selectgroup">
                                <label class="select-items">
                                    <input class="select-input" value="1pm" name="select-options" type="radio"
                                        <?= (strtolower($lottery_data['draw_time']) === '1 pm') ? 'checked' : '' ?> />
                                    <span class="select-box">
                                        <span class="selectitem">
                                            <i class="ti ti-clock"></i> 1 PM Result
                                        </span>
                                    </span>
                                </label>
                                <label class="select-items">
                                    <input class="select-input" value="8pm" name="select-options" type="radio"
                                        <?= (strtolower($lottery_data['draw_time']) === '8 pm') ? 'checked' : '' ?> />
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

            <!-- Prize Sections (1st to 5th) -->
            <?php
            $lottery_data = $lottery_data['lottery_data'] ?? [];

            $sections = [
                'section1' => ['label' => '1st', 'count' => 1, 'max'=>9],
                'section2' => ['label' => '2nd', 'count' => 10, 'max'=>5],
                'section3' => ['label' => '3rd', 'count' => 10, 'max'=>4],
                'section4' => ['label' => '4th', 'count' => 10, 'max'=>4],
                'section5' => ['label' => '5th', 'count' => 100, 'max'=>4],
            ];

            foreach ($sections as $key => $config):
                $num = substr($key, -1);
            ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5><?= $config['label'] ?> Prize Section</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php for ($i = 0; $i < $config['count']; $i++): ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text b-r-left text-bg-primary"><?= $i + 1 ?></span>
                                    <input data-id="<?=$lottery_data[$key][$i]['id']?>"
                                        class="form-control prize-input b-r-right section<?= $num ?>-input"
                                        placeholder="12345" type="text" maxlength="<?=$config['max']?>"
                                        data-current="<?= esc($lottery_data[$key][$i]['number'] ?? '') ?>"
                                        value="<?= esc($lottery_data[$key][$i]['number'] ?? '') ?>" />
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.prize-input');
    const saveBtn = document.getElementById('saveChangesBtn');

    // Show button if any field is edited
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            const original = input.dataset.current?.trim();
            const current = input.value.trim();
            if (original !== current) {
                saveBtn.classList.remove('d-none');
            }
        });
    });

    // On Save button click
    saveBtn.addEventListener('click', () => {
        const changed = [];

        inputs.forEach(input => {
            const prizeId = input.dataset.id;
            const original = input.dataset.current?.trim();
            const current = input.value.trim();

            if (original !== current && prizeId) {
                changed.push({
                    prize_id: prizeId,
                    prize_number: current
                });
            }
        });

        if (changed.length === 0) {
            alert("No changes found.");
            return;
        }

        // Send AJAX POST request
        fetch('/admin/update-prize-series', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    updates: changed
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert("Prizes updated successfully.");
                    saveBtn.classList.add('d-none');

                    // Optionally update data-current after success
                    changed.forEach(item => {
                        const updatedInput = document.querySelector(
                            `.prize-input[data-id="${item.prize_id}"]`);
                        if (updatedInput) {
                            updatedInput.dataset.current = item.prize_number;
                        }
                    });
                } else {
                    alert("Update failed: " + data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert("Something went wrong.");
            });
    });
});
</script>