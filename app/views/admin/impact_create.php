<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/impact" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge mb-1 d-inline-block">IMPACT / CREATE</span>
            <h1 class="fw-bold mb-0">Tambah Data Dampak</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/impact_store" method="POST">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Label Dampak</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label">Label Dampak</label>
                        <input type="text" name="label_id" class="form-control" placeholder="Contoh: Mitra Kerja Sama" required>
                        <input type="hidden" name="label_en" value="">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan dibuat otomatis.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Pengaturan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Halaman Target</label>
                        <select name="page" class="form-select" required>
                            <option value="home" <?= $selected_page == 'home' ? 'selected' : '' ?>>Home</option>
                            <option value="gi" <?= $selected_page == 'gi' ? 'selected' : '' ?>>GI (GoSirk Institute)</option>
                            <option value="ggc" <?= $selected_page == 'ggc' ? 'selected' : '' ?>>GGC (GoSirk Green Community)</option>
                            <option value="partnership" <?= $selected_page == 'partnership' ? 'selected' : '' ?>>Partnership</option>
                            <option value="implementasi" <?= $selected_page == 'implementasi' ? 'selected' : '' ?>>Implementasi Partner</option>
                            <option value="konsultan" <?= $selected_page == 'konsultan' ? 'selected' : '' ?>>Konsultan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nilai (Value)</label>
                        <input type="text" name="value" class="form-control" placeholder="Contoh: 15" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Satuan (Unit)</label>
                        <input type="text" name="unit" class="form-control" placeholder="kg, m2, unit, etc.">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Ikon (FontAwesome)</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-light"><i class="fas fa-icons text-muted"></i></span>
                            <input type="text" name="icon" class="form-control" placeholder="fas fa-handshake" id="iconInput" required>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-2">
                            <div id="iconPreview" class="border rounded-3 d-flex align-items-center justify-content-center bg-light" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                <i class="fas fa-question text-muted"></i>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm">
                        <i class="fas fa-plus me-2"></i> Tambah Data
                    </button>
                    <a href="<?= BASE_URL; ?>admin/impact" class="btn btn-link w-100 text-decoration-none mt-2 text-muted small text-center d-block">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('iconInput');
    const iconPreview = document.getElementById('iconPreview');

    iconInput.addEventListener('input', function() {
        if (this.value.trim() !== '') {
            iconPreview.innerHTML = '<i class="' + this.value + '"></i>';
        } else {
            iconPreview.innerHTML = '<i class="fas fa-question text-muted"></i>';
        }
    });
});
</script>
