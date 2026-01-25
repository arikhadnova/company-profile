<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/<?= ($article->type == 'blog' ? 'articles' : 'library') ?>" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge mb-1 d-inline-block">PORTFOLIO & MEDIA / <?= ($article->type == 'blog' ? 'BLOG / EDIT ARTIKEL' : 'LIBRARY / EDIT RESOURCE') ?></span>
            <h1 class="fw-bold mb-0">Edit <?= ($article->type == 'blog' ? 'Artikel' : 'Resource Library') ?></h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/articles_update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $article->id; ?>">
    <input type="hidden" name="type" value="<?= $article->type; ?>">
    <div class="row g-4">
        <div class="col-12">
            <?php Flasher::flash(); ?>
        </div>
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Konten Artikel</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label">Judul Artikel</label>
                        <input type="text" name="title_id" class="form-control" value="<?= $article->title_id; ?>" required>
                        <input type="hidden" name="title_en" value="<?= $article->title_en; ?>">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Konten Artikel</label>
                        <textarea name="content_id" class="form-control" rows="15" required><?= $article->content_id; ?></textarea>
                        <input type="hidden" name="content_en" value="<?= $article->content_en; ?>">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan diperbarui otomatis jika dikosongkan.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Publishing Settings</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label">Unggah Gambar Baru (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <?php if ($article->image) : ?>
                            <div class="mt-2 text-center p-2 border rounded-3 bg-light">
                                <img src="<?= ASSETS_URL; ?>img/blog/<?= $article->image; ?>" style="max-height: 100px; border-radius: 8px;" alt="Current Image">
                                <p class="small text-muted mt-1 mb-0">Image saat ini</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="Environment" <?= $article->category == 'Environment' ? 'selected' : ''; ?>>Environment</option>
                            <option value="Education" <?= $article->category == 'Education' ? 'selected' : ''; ?>>Education</option>
                            <option value="Innovation" <?= $article->category == 'Innovation' ? 'selected' : ''; ?>>Innovation</option>
                            <option value="Community" <?= $article->category == 'Community' ? 'selected' : ''; ?>>Community</option>
                            <option value="Consulting" <?= $article->category == 'Consulting' ? 'selected' : ''; ?>>Consulting</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" <?= $article->status == 'draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="published" <?= $article->status == 'published' ? 'selected' : ''; ?>>Published</option>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-3 fw-bold shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Perubahan
                    </button>
                    <a href="<?= BASE_URL; ?>admin/<?= ($article->type == 'blog' ? 'articles' : 'library') ?>" class="btn btn-link w-100 text-decoration-none mt-2 text-muted small">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>
