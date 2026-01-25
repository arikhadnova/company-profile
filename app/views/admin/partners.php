<div class="admin-header-section d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <span class="admin-header-badge d-inline-block">DASHBOARD / STRATEGIC PARTNERS</span>
        <h1 class="fw-bold mb-0">Partner Management</h1>
        <p class="text-muted small mb-0">Kelola daftar logo partner strategis yang bekerja sama dengan GoSirk.</p>
    </div>
    <div>
        <a href="<?= BASE_URL; ?>admin/partners/create" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Tambah Partner Baru
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<!-- Search Area -->
<div class="row mb-4 mt-2">
    <div class="col-lg-5">
        <div class="card border-0 shadow-none bg-white p-1 rounded-3 d-flex flex-row align-items-center px-3" style="border: 1px solid #E2E8F0 !important;">
            <i class="fas fa-search text-muted me-3"></i>
            <input type="text" class="form-control border-0 shadow-none bg-transparent py-2" placeholder="Cari nama partner..." id="partnerSearch">
        </div>
    </div>
</div>

<!-- CATEGORY 1: OUR CONTRIBUTION & PARTNER -->
<div class="row mb-5">
    <div class="col-12 mb-3 d-flex align-items-center">
        <div class="bg-success rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: rgba(25, 135, 84, 0.1) !important;">
            <i class="fas fa-handshake text-success"></i>
        </div>
        <h4 class="fw-bold mb-0">Our Contribution & Partner</h4>
    </div>
    
    <div class="col-12">
        <div class="row g-4">
            <?php 
            $countContribution = 0;
            foreach ($partners as $p) : 
                if (($p->category ?? '') == 'contribution') :
                    $countContribution++;
            ?>
                <div class="col-xl-3 col-lg-4 col-md-6 partner-item">
                    <div class="card h-100 border-0 p-4 text-center partner-card-modern shadow-sm">
                        <div class="partner-actions-overlay">
                            <a href="<?= BASE_URL; ?>admin/partners/edit/<?= $p->id; ?>" class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit Partner">
                                <i class="fas fa-edit extra-small"></i>
                            </a>
                            <a href="<?= BASE_URL; ?>admin/partners_delete/<?= $p->id; ?>" class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center btn-delete-confirm" style="width: 32px; height: 32px;" title="Hapus Partner">
                                <i class="fas fa-trash extra-small"></i>
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-3" style="height: 100px;">
                            <?php if ($p->logo) : ?>
                                <img src="<?= ASSETS_URL; ?>img/partners/<?= $p->logo; ?>" alt="<?= $p->name; ?>" style="max-height: 70px; max-width: 140px; object-fit: contain;" onerror="this.src='<?= ASSETS_URL ?>img/<?= $p->logo ?>';">
                            <?php else : ?>
                                <i class="fas fa-building fa-3x text-muted opacity-25"></i>
                            <?php endif; ?>
                        </div>
                        <h6 class="fw-bold mb-1 text-dark"><?= $p->name; ?></h6>
                        <span class="badge bg-light text-muted fw-normal extra-small px-3 mt-2"><?= $p->type; ?></span>
                    </div>
                </div>
            <?php 
                endif;
            endforeach; 
            
            if ($countContribution == 0) : ?>
                <div class="col-12">
                    <div class="bg-white rounded-4 p-4 text-center border" style="border-style: dashed !important;">
                        <p class="text-muted mb-0 small">Belum ada partner di kategori kontribusi.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<hr class="my-5 opacity-0">

<!-- CATEGORY 2: OUR NETWORK -->
<div class="row">
    <div class="col-12 mb-3 d-flex align-items-center">
        <div class="bg-info rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background-color: rgba(13, 202, 240, 0.1) !important;">
            <i class="fas fa-network-wired text-info"></i>
        </div>
        <h4 class="fw-bold mb-0">Our Network</h4>
    </div>

    <div class="col-12">
        <div class="row g-4" id="partnerGrid">
            <?php 
            $countNetwork = 0;
            foreach ($partners as $p) : 
                if (($p->category ?? 'network') == 'network') :
                    $countNetwork++;
            ?>
                <div class="col-xl-3 col-lg-4 col-md-6 partner-item">
                    <div class="card h-100 border-0 p-4 text-center partner-card-modern shadow-sm">
                        <div class="partner-actions-overlay">
                            <a href="<?= BASE_URL; ?>admin/partners/edit/<?= $p->id; ?>" class="btn btn-sm btn-light text-primary shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit Partner">
                                <i class="fas fa-edit extra-small"></i>
                            </a>
                            <a href="<?= BASE_URL; ?>admin/partners_delete/<?= $p->id; ?>" class="btn btn-sm btn-light text-danger shadow-sm rounded-circle d-flex align-items-center justify-content-center btn-delete-confirm" style="width: 32px; height: 32px;" title="Hapus Partner">
                                <i class="fas fa-trash extra-small"></i>
                            </a>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-3" style="height: 100px;">
                            <?php if ($p->logo) : ?>
                                <img src="<?= ASSETS_URL; ?>img/partners/<?= $p->logo; ?>" alt="<?= $p->name; ?>" style="max-height: 70px; max-width: 140px; object-fit: contain;" onerror="this.src='<?= ASSETS_URL ?>img/<?= $p->logo ?>';">
                            <?php else : ?>
                                <i class="fas fa-building fa-3x text-muted opacity-25"></i>
                            <?php endif; ?>
                        </div>
                        <h6 class="fw-bold mb-1 text-dark"><?= $p->name; ?></h6>
                        <span class="badge bg-light text-muted fw-normal extra-small px-3 mt-2"><?= $p->type; ?></span>
                    </div>
                </div>
            <?php 
                endif;
            endforeach; 
            
            if ($countNetwork == 0) : ?>
                <div class="col-12 text-center py-5">
                    <div class="bg-white rounded-4 p-5 border" style="border-style: dashed !important;">
                        <i class="fas fa-users-slash fa-3x text-muted opacity-25 mb-3"></i>
                        <h6 class="text-muted">Belum ada data network partner.</h6>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.partner-actions-overlay {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 10;
}
.partner-card-modern:hover .partner-actions-overlay {
    opacity: 1;
}
.partner-card-modern {
    position: relative;
    background: #fff;
    border-radius: 16px;
    text-align: center;
    transition: transform 0.3s ease;
}
.partner-card-modern:hover {
    transform: translateY(-5px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('partnerSearch');
    const partnerCards = document.querySelectorAll('.partner-card-modern');

    searchInput.addEventListener('input', function() {
        const term = this.value.toLowerCase();
        partnerCards.forEach(card => {
            const name = card.querySelector('h6').innerText.toLowerCase();
            const typeAndCat = card.innerText.toLowerCase();
            if (name.includes(term) || typeAndCat.includes(term)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
