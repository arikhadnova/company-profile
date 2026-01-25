<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/<?= ($data['type'] == 'blog' ? 'articles' : 'library') ?>" class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left text-muted"></i>
        </a>
        <div>
            <span class="admin-header-badge d-inline-block">PORTFOLIO & MEDIA / <?= ($data['type'] == 'blog' ? 'BLOG / TULIS ARTIKEL' : 'LIBRARY / TAMBAH RESOURCE') ?></span>
            <h1 class="fw-bold mb-0"><?= ($data['type'] == 'blog' ? 'Tulis Artikel Baru' : 'Tambah Resource Library') ?></h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/articles_store" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="type" value="<?= $data['type'] ?>">
    <div class="row g-4">
        <div class="col-12">
            <?php Flasher::flash(); ?>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Konten Artikel</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Judul Artikel</label>
                        <input type="text" name="title_id" class="form-control" placeholder="Contoh: Menuju Indonesia Bebas Sampah" required>
                        <input type="hidden" name="title_en" value="">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Konten Artikel</label>
                        <textarea name="content_id" class="form-control" rows="12" placeholder="Tulis isi artikel di sini..." required></textarea>
                        <input type="hidden" name="content_en" value="">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan dibuat otomatis.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Publishing Settings</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Thumbnail Image</label>
                        <div class="p-3 border rounded-3 text-center bg-light border-dashed mb-2">
                             <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                             <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                        </div>
                        <div class="text-muted extra-small">Recommended size: 1200x800px. Max: 2MB.</div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Category</label>
                        <select name="category" class="form-select">
                            <option value="Environment">Environment</option>
                            <option value="Education">Education</option>
                            <option value="Innovation">Innovation</option>
                            <option value="Community">Community</option>
                            <option value="Consulting">Consulting</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                        <i class="fas fa-paper-plane me-2"></i> Simpan Artikel
                    </button>
                    <a href="<?= BASE_URL; ?>admin/<?= ($data['type'] == 'blog' ? 'articles' : 'library') ?>" class="btn btn-light w-100 py-2 mt-2 text-muted small">Batalkan</a>
                </div>
            </div>
        </div>
    </div>
</form>
