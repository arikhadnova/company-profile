<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/gi_services" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge d-inline-block text-uppercase">DASHBOARD / CAPACITY BUILDING / EDIT</span>
            <h1 class="fw-bold mb-0">Update Layanan GI</h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/gi_services_update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $service->id; ?>">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Informasi Layanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Judul Layanan</label>
                        <input type="text" name="title_id" class="form-control form-control-lg" placeholder="Contoh: Training dan Workshop" value="<?= $service->title_id; ?>" required>
                        <input type="hidden" name="title_en" value="<?= $service->title_en; ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Subtitle Kecil</label>
                        <input type="text" name="small_subtitle_id" class="form-control" placeholder="Contoh: Capacity Building" value="<?= $service->small_subtitle_id; ?>">
                        <input type="hidden" name="small_subtitle_en" value="<?= $service->small_subtitle_en; ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Deskripsi Singkat</label>
                        <textarea name="description_id" class="form-control" rows="3" placeholder="Ringkasan layanan untuk kartu di halaman utama..."><?= $service->description_id; ?></textarea>
                        <input type="hidden" name="description_en" value="<?= $service->description_en; ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Output <span class="text-muted fw-normal">(Pisahkan dengan koma)</span></label>
                        <input type="text" name="outputs_id" class="form-control" placeholder="Contoh: Modul, Sertifikat, Dokumentasi" value="<?= $service->outputs_id; ?>">
                        <input type="hidden" name="outputs_en" value="<?= $service->outputs_en; ?>">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small text-dark">Konten Detail</label>
                        <textarea name="detail_content_id" class="form-control rich-editor" rows="15" placeholder="Konten lengkap untuk halaman detail..."><?= $service->detail_content_id; ?></textarea>
                        <input type="hidden" name="detail_content_en" value="<?= $service->detail_content_en; ?>">
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
                    <h5 class="fw-bold mb-0 text-dark">Pengaturan Layanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="training" <?= $service->category == 'training' ? 'selected' : ''; ?>>Training</option>
                            <option value="publikasi-riset" <?= $service->category == 'publikasi-riset' ? 'selected' : ''; ?>>Publikasi dan Riset</option>
                            <option value="fasilitasi-knowledge" <?= $service->category == 'fasilitasi-knowledge' ? 'selected' : ''; ?>>Fasilitasi & Knowledge Exchange</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Gambar Layanan</label>
                        <?php if ($service->image) : ?>
                            <div class="mb-2">
                                <img src="<?= ASSETS_URL; ?>img/gi/<?= $service->image; ?>" class="img-fluid rounded-3 border">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted extra-small d-block mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Urutan Prioritas</label>
                        <input type="number" name="order_priority" class="form-control" value="<?= $service->order_priority; ?>" min="0">
                    </div>
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                        <i class="fas fa-save me-2"></i> Perbarui Layanan
                    </button>
                    <a href="<?= BASE_URL; ?>admin/gi_services" class="btn btn-link w-100 text-decoration-none mt-2 text-muted small text-center d-block">Batal dan Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>
