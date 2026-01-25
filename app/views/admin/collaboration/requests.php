<div class="admin-header-section d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <span class="admin-header-badge d-inline-block">DASHBOARD / COLLABORATION / REQUESTS</span>
        <h1 class="fw-bold mb-0">Collaboration Request Logs</h1>
        <p class="text-muted small mb-0">Daftar pengunjung yang meminta pengiriman Executive Summary atau Company Profile.</p>
    </div>
    <div>
        <a href="<?= BASE_URL; ?>admin/collaboration" class="btn btn-light text-secondary fw-bold px-3">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Dokumen
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<div class="table-responsive mt-4">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Pemohon</th>
                <th>Kontak</th>
                <th>Instansi / Jabatan</th>
                <th>Dokumen</th>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($requests)) : ?>
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">Belum ada permintaan dokumen terekam.</div>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($requests as $req) : ?>
                    <tr class="shadow-sm">
                        <td>
                            <div class="text-dark fw-bold small"><?= date('d M Y', strtotime($req->requested_at)); ?></div>
                            <div class="text-muted extra-small"><?= date('H:i:s', strtotime($req->requested_at)); ?></div>
                        </td>
                        <td><div class="fw-bold text-dark small"><?= $req->name; ?></div></td>
                        <td><a href="mailto:<?= $req->email; ?>" class="extra-small text-primary text-decoration-none"><?= $req->email; ?></a></td>
                        <td>
                            <div class="extra-small fw-bold text-dark"><?= $req->organization ?: '-'; ?></div>
                            <div class="extra-small text-muted"><?= $req->jabatan ?: '-'; ?></div>
                        </td>
                        <td>
                            <span class="badge bg-light text-warning border-0 px-3 py-1 extra-small">
                                <?= $req->doc_title ?: 'Deleted Document'; ?>
                            </span>
                        </td>
                        <td class="text-end">
                             <a href="mailto:<?= $req->email; ?>?subject=Follow Up: Request for <?= $req->doc_title; ?>" class="btn btn-sm btn-light text-primary" title="Hubungi Via Email">
                                <i class="fas fa-envelope"></i>
                             </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
