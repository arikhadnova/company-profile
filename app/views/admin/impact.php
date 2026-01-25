<div class="admin-header-section d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <span class="admin-header-badge d-inline-block">DASHBOARD / IMPACT DATA</span>
        <h1 class="fw-bold mb-0">Impact Data Management</h1>
        <p class="text-muted small mb-0">Kelola metrik dampak. Tersedia 4 slot tetap per halaman yang dapat diperbarui.</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<?php 
$pages = [
    'home' => 'Home Page',
    'gi' => 'GoSirk Institute',
    'ggc' => 'GoSirk Green Community',
    'partnership' => 'Partnership',
    'implementasi' => 'Implementasi Partner',
    'konsultan' => 'Konsultan'
];

foreach ($pages as $slug => $name) : 
    $impacts = $grouped_impacts[$slug] ?? [];
?>
    <div class="card border-0 shadow-sm rounded-4 mb-5">
        <div class="card-header bg-white p-4 border-bottom">
            <h5 class="fw-bold mb-0 text-primary"><?= $name ?></h5>
            <small class="text-muted">4 metrik ditampilkan di halaman ini</small>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Slot</th>
                            <th>Icon</th>
                            <th>Label</th>
                            <th class="text-center">Value</th>
                            <th>Unit</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $slot = 1;
                        foreach ($impacts as $imp) : 
                        ?>
                            <tr class="hover-bg-light">
                                <td class="ps-4 text-muted small fw-bold">#<?= $slot++ ?></td>
                                <td>
                                    <div class="stat-icon-box stat-icon-blue m-0" style="width: 35px; height: 35px;">
                                        <i class="<?= $imp->icon ?: 'fas fa-chart-line'; ?> fs-6"></i>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark small"><?= $imp->label_id; ?></div>
                                    <div class="text-muted extra-small"><?= $imp->label_en; ?></div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                                        <?= $imp->value; ?>
                                    </span>
                                </td>
                                <td><span class="text-muted small"><?= $imp->unit ?: '-'; ?></span></td>
                                <td class="text-end pe-4">
                                    <a href="<?= BASE_URL; ?>admin/impact/edit/<?= $imp->id; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-bold">
                                        <i class="fas fa-edit me-1"></i> Update
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        
                        <?php if (count($impacts) == 0) : ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted small">Sedang mensinkronisasi slot... Silakan refresh halaman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<style>
.hover-bg-light:hover { background-color: rgba(0,0,0,0.015); }
.extra-small { font-size: 11px; }
.stat-icon-box {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
}
.stat-icon-blue {
    background: rgba(41, 180, 113, 0.1);
    color: #29b471;
}
</style>
