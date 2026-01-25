<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="<?= BASE_URL; ?>admin/portfolio" class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="fas fa-arrow-left text-muted"></i>
        </a>
        <div>
            <span class="admin-header-badge d-inline-block">PORTFOLIO / TAMBAH BARU</span>
            <h1 class="fw-bold mb-0">Tambah Proyek Baru</h1>
        </div>
    </div>
</div>

<form action="<?= BASE_URL; ?>admin/portfolio_store" method="POST" enctype="multipart/form-data">
    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Informasi Proyek</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Judul Proyek</label>
                        <input type="text" name="title_id" class="form-control" placeholder="Contoh: Pendampingan Desa Bengkel" required>
                        <input type="hidden" name="title_en" value="">
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Sub-judul / Nama Klien</label>
                        <input type="text" name="subtitle_id" class="form-control" placeholder="Contoh: Pemerintah Desa Bengkel, Tabanan">
                        <input type="hidden" name="subtitle_en" value="">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Deskripsi Proyek</label>
                        <textarea name="description_id" class="form-control" rows="6" placeholder="Jelaskan detail proyek, tujuan, dan hasil..."></textarea>
                        <input type="hidden" name="description_en" value="">
                    </div>
                    <div class="mt-3">
                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan dibuat otomatis.</small>
                    </div>
                </div>
            </div>

            <!-- Media & Icons -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Visual & Identitas</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark text-dark">Pilih Icon Representatif</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-icons text-muted"></i></span>
                                <input type="text" name="icon_name" class="form-control border-start-0 ps-0" placeholder="Contoh: fas fa-leaf" id="iconInput">
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <div class="stat-icon-box stat-icon-blue" id="iconPreview" style="width: 50px; height: 50px;">
                                    <i class="fas fa-question text-muted"></i>
                                </div>
                                <small class="text-muted extra-small">Gunakan class FontAwesome 5 (misal: <code>fas fa-recycle</code>)</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Atau Unggah Gambar Cover</label>
                            <div class="p-3 border rounded-3 text-center bg-light border-dashed">
                                <input type="file" name="cover_image" class="form-control form-control-sm mb-2">
                                <small class="text-muted extra-small d-block">Ukuran ideal 800x600px, Maks 2MB.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Options Column -->
        <div class="col-lg-4">
            <!-- Metadata & Settings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Metadata & Kategori</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Kategori Utama</label>
                        <select name="main_category" class="form-select">
                            <option value="capacity_building">Capacity Building (GI)</option>
                            <option value="program_development">Program Development</option>
                            <option value="consultancy">Consultancy & Advisory</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Tipe Partner (Badge)</label>
                        <select name="partner_type" class="form-select">
                            <option value="GOVERNMENT">Government</option>
                            <option value="COMMUNITY">Community</option>
                            <option value="EDUCATION">Education/Academic</option>
                            <option value="CORPORATE">Corporate/CSR</option>
                            <option value="NGO">NGO/Foundation</option>
                        </select>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Tahun Mulai</label>
                            <input type="text" name="year_start" class="form-control" placeholder="2024">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Tahun Selesai</label>
                            <input type="text" name="year_end" class="form-control" placeholder="2025">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Client Name</label>
                        <input type="text" name="client_name" class="form-control" placeholder="Nama instansi/perusahaan mitra...">
                    </div>
                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Project Tags</label>
                        <input type="text" name="tags" class="form-control" placeholder="Circular Economy, Waste Management, etc.">
                    </div>
                </div>
            </div>

            <!-- Display Settings -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom p-4">
                    <h5 class="fw-bold mb-0">Pengaturan Tampilan & Kategori Halaman</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted extra-small mb-3">Pilih halaman dan tentukan kategori spesifiknya:</p>
                    
                    <div class="d-flex flex-column gap-3">
                        <!-- Home Display -->
                        <div class="display-option-group">
                            <label class="p-3 bg-light rounded-3 d-flex align-items-center cursor-pointer border border-transparent hover-border-primary transition-all mb-2">
                                <input type="checkbox" name="show_home" id="check_home" class="form-check-input me-3" checked>
                                <div>
                                    <div class="fw-bold text-dark small">Halaman Utama (Home)</div>
                                    <div class="text-muted extra-small">Tampil di section Portfolio & Partnership.</div>
                                </div>
                            </label>
                            <div id="cat_home" class="ms-4 ps-3 border-start mb-3">
                                <label class="form-label extra-small fw-bold text-muted">Kategori di Home</label>
                                <select name="home_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Section Home --</option>
                                    <option value="institute">Capacity Building (GoSirk Institute)</option>
                                    <option value="partner">Program dan Implementasi Partner</option>
                                    <option value="advisory">Konsultansi & Advisory Strategis</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Partnership Display -->
                        <div class="display-option-group">
                            <label class="p-3 bg-light rounded-3 d-flex align-items-center cursor-pointer border border-transparent hover-border-primary transition-all mb-2">
                                <input type="checkbox" name="show_partnership" id="check_partnership" class="form-check-input me-3" checked>
                                <div>
                                    <div class="fw-bold text-dark small">Halaman Partnership</div>
                                    <div class="text-muted extra-small">Tampil di kategori Collaboration Model.</div>
                                </div>
                            </label>
                            <div id="cat_partnership" class="ms-4 ps-3 border-start mb-3">
                                <label class="form-label extra-small fw-bold text-muted">Kategori di Partnership</label>
                                <select name="partnership_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Tipe Partnership --</option>
                                    <option value="community">Community Partnership</option>
                                    <option value="academic">Academic Partnership</option>
                                    <option value="program">Program Partnership</option>
                                </select>
                            </div>
                        </div>

                        <!-- GI Display -->
                        <div class="display-option-group">
                            <label class="p-3 bg-light rounded-3 d-flex align-items-center cursor-pointer border border-transparent hover-border-primary transition-all mb-2">
                                <input type="checkbox" name="show_gi" id="check_gi" class="form-check-input me-3" checked>
                                <div>
                                    <div class="fw-bold text-dark small">GoSirk Institute (GI)</div>
                                    <div class="text-muted extra-small">Tampil di portal edukasi & knowledge.</div>
                                </div>
                            </label>
                            <div id="cat_gi" class="ms-4 ps-3 border-start">
                                <label class="form-label extra-small fw-bold text-muted">Section di GI</label>
                                <select name="gi_category" class="form-select form-select-sm">
                                    <option value="">-- Pilih Section GI --</option>
                                    <option value="daerah">1. Peningkatan Kapasitas Daerah</option>
                                    <option value="desa">2. Pendampingan Desa</option>
                                    <option value="kampanye">3. Kampanye Perubahan Perilaku</option>
                                    <option value="modul">4. Penyusunan Modul & Toolkit</option>
                                    <option value="webinar">5. Webinar & E-learning</option>
                                    <option value="akademik">6. Academic Partnership (GI)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <p class="text-muted small mb-4">Apakah data sudah benar? Proyek akan langsung ditampilkan sesuai pengaturan.</p>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-3">
                        <i class="fas fa-save me-2"></i> PUBLIKASIKAN PROYEK
                    </button>
                    <a href="<?= BASE_URL; ?>admin/portfolio" class="btn btn-light w-100 py-2 mt-2 text-muted small">Batalkan</a>
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

    // Simple Tab synchronization (Auto switch to tab if label is focused)
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
