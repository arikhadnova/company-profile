<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/portfolio" class="btn btn-outline-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <span class="admin-header-badge mb-1 d-inline-block">PORTFOLIO / EDIT</span>
            <h1 class="fw-bold mb-0">Edit Proyek</h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/portfolio_update" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $portfolio->id; ?>">
    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Informasi Proyek</h5>
                </div>
                <div class="card-body p-4">
                    <div class="form-group-premium mb-4">
                        <label class="bilingual-label label-id">Judul Proyek</label>
                        <input type="text" name="title_id" class="form-control form-control-lg rounded-3" value="<?= $portfolio->title_id; ?>" required>
                        <input type="hidden" name="title_en" value="<?= $portfolio->title_en; ?>">
                    </div>
                    <div class="form-group-premium mb-4">
                        <label class="bilingual-label label-id">Sub-judul / Nama Klien</label>
                        <input type="text" name="subtitle_id" class="form-control rounded-3" value="<?= $portfolio->subtitle_id; ?>">
                        <input type="hidden" name="subtitle_en" value="<?= $portfolio->subtitle_en; ?>">
                    </div>
                    <div class="form-group-premium mb-0">
                        <label class="bilingual-label label-id">Deskripsi Proyek</label>
                        <textarea name="description_id" class="form-control rounded-3" rows="6"><?= $portfolio->description_id; ?></textarea>
                        <input type="hidden" name="description_en" value="<?= $portfolio->description_en; ?>">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan diperbarui otomatis jika dikosongkan.</small>
                    </div>
                </div>
            </div>

            <!-- Media & Icons -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Visual & Identitas</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Icon Representatif</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-icons text-muted"></i></span>
                                <input type="text" name="icon_name" class="form-control border-start-0" value="<?= $portfolio->icon_name; ?>" id="iconInput">
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-preview-box" id="iconPreview">
                                    <i class="<?= $portfolio->icon_name ?: 'fas fa-question text-muted'; ?>"></i>
                                </div>
                                <small class="text-muted">Gunakan class FontAwesome 5</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Unggah Gambar Cover Baru</label>
                            <input type="file" name="cover_image" class="form-control rounded-3 mb-2">
                            <?php if ($portfolio->cover_image) : ?>
                                <div class="mt-2 text-center p-2 border rounded-3 bg-light">
                                    <img src="<?= ASSETS_URL; ?>img/portfolio/<?= $portfolio->cover_image; ?>" style="max-height: 100px; border-radius: 8px;" alt="Current Cover">
                                    <p class="small text-muted mt-1 mb-0">Image saat ini</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options Column -->
        <div class="col-lg-4">
            <!-- Metadata & Settings -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Metadata & Kategori</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori Utama</label>
                        <select name="main_category" class="form-select rounded-3">
                            <option value="capacity_building" <?= $portfolio->main_category == 'capacity_building' ? 'selected' : ''; ?>>Capacity Building (GI)</option>
                            <option value="program_development" <?= $portfolio->main_category == 'program_development' ? 'selected' : ''; ?>>Program Development</option>
                            <option value="consultancy" <?= $portfolio->main_category == 'consultancy' ? 'selected' : ''; ?>>Consultancy & Advisory</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tipe Partner (Badge)</label>
                        <select name="partner_type" class="form-select rounded-3">
                            <option value="GOVERNMENT" <?= $portfolio->partner_type == 'GOVERNMENT' ? 'selected' : ''; ?>>Government</option>
                            <option value="COMMUNITY" <?= $portfolio->partner_type == 'COMMUNITY' ? 'selected' : ''; ?>>Community</option>
                            <option value="EDUCATION" <?= $portfolio->partner_type == 'EDUCATION' ? 'selected' : ''; ?>>Education/Academic</option>
                            <option value="CORPORATE" <?= $portfolio->partner_type == 'CORPORATE' ? 'selected' : ''; ?>>Corporate/CSR</option>
                            <option value="NGO" <?= $portfolio->partner_type == 'NGO' ? 'selected' : ''; ?>>NGO/Foundation</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label fw-bold">Tahun Mulai</label>
                            <input type="text" name="year_start" class="form-control" value="<?= $portfolio->year_start; ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold">Tahun Selesai</label>
                            <input type="text" name="year_end" class="form-control" value="<?= $portfolio->year_end; ?>">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Client Name</label>
                        <input type="text" name="client_name" class="form-control" value="<?= $portfolio->client_name; ?>">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-bold">Project Tags (Comma separated)</label>
                        <input type="text" name="tags" class="form-control" value="<?= $portfolio->tags; ?>">
                    </div>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Pengaturan Tampilan & Kategori Halaman</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <!-- Home -->
                        <div class="display-option-group">
                            <label class="display-checkbox-card d-flex align-items-center mb-2">
                                <input type="checkbox" name="show_home" id="check_home" class="form-check-input me-3" <?= $portfolio->show_home ? 'checked' : ''; ?>>
                                <div>
                                    <div class="fw-bold">Halaman Utama (Home)</div>
                                    <small class="text-muted">Tampil di section Portfolio & Partnership.</small>
                                </div>
                            </label>
                            <div id="cat_home" class="ms-4 ps-3 border-start mb-3">
                                <label class="form-label extra-small fw-bold text-muted">Kategori di Home</label>
                                <select name="home_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Section Home --</option>
                                    <option value="institute" <?= $portfolio->home_category == 'institute' ? 'selected' : ''; ?>>Capacity Building (GoSirk Institute)</option>
                                    <option value="partner" <?= $portfolio->home_category == 'partner' ? 'selected' : ''; ?>>Program dan Implementasi Partner</option>
                                    <option value="advisory" <?= $portfolio->home_category == 'advisory' ? 'selected' : ''; ?>>Konsultansi & Advisory Strategis</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Partnership -->
                        <div class="display-option-group">
                            <label class="display-checkbox-card d-flex align-items-center mb-2">
                                <input type="checkbox" name="show_partnership" id="check_partnership" class="form-check-input me-3" <?= $portfolio->show_partnership ? 'checked' : ''; ?>>
                                <div>
                                    <div class="fw-bold">Halaman Partnership</div>
                                    <small class="text-muted">Tampil di kategori Collaboration Model.</small>
                                </div>
                            </label>
                            <div id="cat_partnership" class="ms-4 ps-3 border-start mb-3">
                                <label class="form-label extra-small fw-bold text-muted">Kategori di Partnership</label>
                                <select name="partnership_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Tipe Partnership --</option>
                                    <option value="community" <?= $portfolio->partnership_category == 'community' ? 'selected' : ''; ?>>Community Partnership</option>
                                    <option value="academic" <?= $portfolio->partnership_category == 'academic' ? 'selected' : ''; ?>>Academic Partnership</option>
                                    <option value="program" <?= $portfolio->partnership_category == 'program' ? 'selected' : ''; ?>>Program Partnership</option>
                                </select>
                            </div>
                        </div>

                        <!-- GI -->
                        <div class="display-option-group">
                            <label class="display-checkbox-card d-flex align-items-center mb-2">
                                <input type="checkbox" name="show_gi" id="check_gi" class="form-check-input me-3" <?= $portfolio->show_gi ? 'checked' : ''; ?>>
                                <div>
                                    <div class="fw-bold">GoSirk Institute (GI)</div>
                                    <small class="text-muted">Tampil di portal edukasi & knowledge.</small>
                                </div>
                            </label>
                            <div id="cat_gi" class="ms-4 ps-3 border-start">
                                <label class="form-label extra-small fw-bold text-muted">Section di GI</label>
                                <select name="gi_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Section GI --</option>
                                    <option value="daerah" <?= $portfolio->gi_category == 'daerah' ? 'selected' : ''; ?>>1. Peningkatan Kapasitas Daerah</option>
                                    <option value="desa" <?= $portfolio->gi_category == 'desa' ? 'selected' : ''; ?>>2. Pendampingan Desa</option>
                                    <option value="kampanye" <?= $portfolio->gi_category == 'kampanye' ? 'selected' : ''; ?>>3. Kampanye Perubahan Perilaku</option>
                                    <option value="modul" <?= $portfolio->gi_category == 'modul' ? 'selected' : ''; ?>>4. Penyusunan Modul & Toolkit</option>
                                    <option value="webinar" <?= $portfolio->gi_category == 'webinar' ? 'selected' : ''; ?>>5. Webinar & E-learning</option>
                                    <option value="akademik" <?= $portfolio->gi_category == 'akademik' ? 'selected' : ''; ?>>6. Academic Partnership (GI)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-warning w-100 fw-bold py-3 rounded-pill shadow-sm">
                        <i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN
                    </button>
                    <a href="<?= BASE_URL; ?>admin/portfolio" class="btn btn-link text-white text-decoration-none mt-3 d-block small">Batalkan</a>
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

        // Conditional Category Display
    const toggles = [
        { check: 'check_home', target: 'cat_home' },
        { check: 'check_partnership', target: 'cat_partnership' },
        { check: 'check_gi', target: 'cat_gi' }
    ];

    toggles.forEach(t => {
        const checkbox = document.getElementById(t.check);
        const section = document.getElementById(t.target);
        
        const updateVisibility = () => {
            section.style.display = checkbox.checked ? 'block' : 'none';
        };

        checkbox.addEventListener('change', updateVisibility);
        updateVisibility(); // Initial state
    });

    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            const pane = this.closest('.tab-pane');
            if (pane) {
                const id = pane.id;
                const tabTrigger = document.querySelector(`[data-bs-target="#${id}"]`);
                if (tabTrigger && !tabTrigger.classList.contains('active')) {
                    const tab = new bootstrap.Tab(tabTrigger);
                    tab.show();
                }
            }
        });
    });
});
</script>
