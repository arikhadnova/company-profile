<div class="admin-header-section mb-4">
    <span class="admin-header-badge mb-2 d-inline-block">DASHBOARD / WELCOME</span>
    <h1 class="fw-bold mb-0">Admin Dashboard</h1>
    <p class="text-muted small mb-0">Selamat datang kembali! Berikut ringkasan performa website GoSirk hari ini.</p>
</div>

<!-- Quick Stats -->
<div class="row g-4 mb-5">
    <!-- Stat 1 -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card-modern card shadow-sm">
            <div class="stat-icon-box stat-icon-blue">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="stat-label">Total Pengunjung</div>
                <div class="stat-value text-dark"><?= number_format($counts['total_visitors']); ?></div>
                <div class="stat-trend <?= $counts['visitor_stats']['increase'] >= 0 ? 'text-success' : 'text-danger'; ?>">
                    <i class="fas fa-arrow-<?= $counts['visitor_stats']['increase'] >= 0 ? 'up' : 'down'; ?> me-1"></i> 
                    <?= number_format(abs($counts['visitor_stats']['increase']), 1); ?>% 
                    <span class="text-muted fw-normal">last month</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 2 -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card-modern card shadow-sm">
            <div class="stat-icon-box stat-icon-orange">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <div>
                <div class="stat-label">Pesan Baru</div>
                <div class="stat-value text-dark"><?= $counts['unread_messages']; ?></div>
                <div class="stat-trend <?= $counts['unread_messages'] > 0 ? 'text-orange' : 'text-success'; ?>">
                    <i class="fas fa-envelope me-1"></i> <?= $counts['unread_messages'] > 0 ? 'Urgent' : 'No'; ?> <span class="text-muted fw-normal">actions needed</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 3 -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card-modern card shadow-sm">
            <div class="stat-icon-box stat-icon-green">
                <i class="fas fa-newspaper"></i>
            </div>
            <div>
                <div class="stat-label">Artikel Blog</div>
                <div class="stat-value text-dark"><?= $counts['articles']; ?></div>
                <div class="stat-trend text-success">
                    <i class="fas fa-plus me-1"></i> Data Real <span class="text-muted fw-normal">from database</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Stat 4 -->
    <div class="col-xl-3 col-md-6">
        <div class="stat-card-modern card shadow-sm">
            <div class="stat-icon-box stat-icon-purple">
                <i class="fas fa-briefcase"></i>
            </div>
            <div>
                <div class="stat-label">Total Proyek</div>
                <div class="stat-value text-dark"><?= $counts['portfolios']; ?></div>
                <div class="stat-trend text-purple">
                    <i class="fas fa-check-circle me-1"></i> <?= $counts['portfolios']; ?> Active <span class="text-muted fw-normal">projects</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Quick Actions -->
<div class="row g-4">
    <!-- Recent Activity Board -->
    <div class="col-lg-8">
        <div class="card h-100 border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Aktivitas Terkini</h5>
                <a href="#" class="btn btn-sm btn-light text-primary rounded-pill px-3 fw-bold">Lihat Semua</a>
            </div>
            <div class="activity-list">
                <div class="activity-item d-flex align-items-center">
                    <div class="activity-dot bg-warning"></div>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-bold small text-dark">Admin baru saja menambahkan projek <strong>"Pemerintah Kabupaten Tabanan"</strong></p>
                        <small class="text-muted">2 jam yang lalu</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-center">
                    <div class="activity-dot bg-success"></div>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-bold small text-dark">Artikel <strong>"Menuju Indonesia Bebas Sampah 2030"</strong> telah dipublikasikan</p>
                        <small class="text-muted">5 jam yang lalu</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-center">
                    <div class="activity-dot bg-info"></div>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-bold small text-dark">Menerima pesan baru dari formulir kontak partner</p>
                        <small class="text-muted">Kemarin, 14:00</small>
                    </div>
                </div>
                <div class="activity-item d-flex align-items-center border-0">
                    <div class="activity-dot bg-primary"></div>
                    <div class="flex-grow-1">
                        <p class="mb-0 fw-bold small text-dark">Update konfigurasi footer website</p>
                        <small class="text-muted">2 hari yang lalu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="col-lg-4">
        <div class="card h-100 border-0 quick-action-card p-4 text-white">
            <h5 class="fw-bold mb-4">Aksi Cepat</h5>
            <div class="d-grid gap-3">
                <a href="<?= BASE_URL ?>admin/articles" class="btn quick-action-btn w-100 btn-lg">
                    <span class="small">Tulis Artikel Baru</span>
                    <i class="fas fa-pen-nib fs-6"></i>
                </a>
                <a href="<?= BASE_URL ?>admin/portfolio" class="btn quick-action-btn w-100 btn-lg">
                    <span class="small">Manajemen Portfolio</span>
                    <i class="fas fa-briefcase fs-6"></i>
                </a>
                <a href="<?= BASE_URL ?>admin/settings" class="btn quick-action-btn w-100 btn-lg">
                    <span class="small">Pengaturan Website</span>
                    <i class="fas fa-cog fs-6"></i>
                </a>
            </div>
            <div class="mt-auto pt-5">
                <div class="p-3 rounded-4 bg-white bg-opacity-20">
                    <p class="small mb-0 opacity-75">Bagi mitra GoSirk, pastikan data impact diperbarui setiap bulan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
