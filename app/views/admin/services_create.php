<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/services" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge mb-1 d-inline-block text-uppercase">SERVICES / CATEGORY / ADD</span>
            <h1 class="fw-bold mb-0">Tambah Layanan Utama</h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/services_store" method="POST">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-dark">Informasi Layanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Nama Layanan</label>
                        <input type="text" name="name_id" class="form-control form-control-lg" placeholder="Contoh: Pengelolaan Sampah Kawasan" required>
                        <input type="hidden" name="name_en" value="">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small text-dark">Deskripsi Layanan</label>
                        <textarea name="description_id" class="form-control" rows="8" placeholder="Jelaskan detail layanan..."></textarea>
                        <input type="hidden" name="description_en" value="">
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
                    <h5 class="fw-bold mb-0 text-dark">Visual & Priority</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Icon (FontAwesome)</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-icons text-muted"></i></span>
                            <input type="text" name="icon" class="form-control border-start-0 ps-0" placeholder="recycle" id="iconInput" required>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-3">
                            <div id="iconPreview" class="stat-icon-box stat-icon-blue" style="width: 50px; height: 50px;">
                                <i class="fas fa-question text-muted"></i>
                            </div>
                            <small class="text-muted extra-small">Ikon akan muncul secara otomatis.</small>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Order Priority</label>
                        <input type="number" name="order_priority" class="form-control" value="1" min="1">
                    </div>
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Layanan
                    </button>
                    <a href="<?= BASE_URL; ?>admin/services" class="btn btn-link w-100 text-decoration-none mt-2 text-muted small text-center d-block">Batal dan Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('iconInput');
    const iconPreview = document.getElementById('iconPreview');

    function updateIconPreview() {
        let iconClass = iconInput.value.trim();
        if (iconClass !== '') {
            if (!iconClass.startsWith('fa') && !iconClass.startsWith('fab') && !iconClass.startsWith('fas')) {
                iconClass = 'fas fa-' + iconClass;
            } else if (!iconClass.includes(' ')) {
                iconClass = 'fas ' + iconClass;
            }
            iconPreview.innerHTML = '<i class="' + iconClass + '"></i>';
        } else {
            iconPreview.innerHTML = '<i class="fas fa-question text-muted"></i>';
        }
    }

    iconInput.addEventListener('input', updateIconPreview);
    updateIconPreview();
});
</script>
