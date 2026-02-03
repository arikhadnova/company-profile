<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/gi_videos" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge d-inline-block text-uppercase">DASHBOARD / CAPACITY BUILDING / VIDEOS / CREATE</span>
            <h1 class="fw-bold mb-0">Tambah Video GI Baru</h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/gi_videos_store" method="POST" enctype="multipart/form-data">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Informasi Video</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Judul Video / Playlist</label>
                        <input type="text" name="title_id" class="form-control form-control-lg" placeholder="Contoh: Ngobrol Sampah" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">URL Video / Playlist YouTube</label>
                        <input type="url" name="url" id="yt_url" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold small text-dark">Deskripsi</label>
                        <textarea name="description_id" id="yt_desc" class="form-control" rows="4" placeholder="Ringkasan tentang video atau playlist ini..."></textarea>
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan dibuat otomatis jika dikosongkan.</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0 text-dark">Pengaturan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Tipe</label>
                        <select name="type" class="form-select" required>
                            <option value="playlist">Playlist</option>
                            <option value="highlight">Highlight (Utama)</option>
                        </select>
                        <small class="text-muted extra-small d-block mt-2">Pilih 'Highlight' untuk menjadikannya video besar yang ditampilkan di bagian atas.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Thumbnail Custom <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <small class="text-muted extra-small d-block mt-2">Jika kosong, thumbnail akan diambil otomatis dari YouTube.</small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-dark">Urutan Prioritas</label>
                        <input type="number" name="order_priority" class="form-control" value="0" min="0">
                    </div>
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm">
                        <i class="fas fa-save me-2"></i> Simpan Video
                    </button>
                    <a href="<?= BASE_URL; ?>admin/gi_videos" class="btn btn-link w-100 text-decoration-none mt-2 text-muted small text-center d-block">Batal dan Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>
