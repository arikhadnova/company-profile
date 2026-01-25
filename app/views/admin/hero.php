<?php
$heroes = $data['heroes'];
$pages = [
    'home' => 'Home',
    'partner' => 'Implementasi Partner',
    'konsultan' => 'Konsultan',
    'gi' => 'GoSirk Institute',
    'ggc' => 'GoSirk Green Community'
];
?>

<div class="admin-header-section mb-4">
    <span class="admin-header-badge d-inline-block">DASHBOARD / HERO SECTION</span>
    <h1 class="fw-bold mb-0">Hero Section Management</h1>
    <p class="text-muted small mb-0">Manage the hero banners and messaging across various pages of your website.</p>
</div>

<div class="row">
    <div class="col-lg-11 mx-auto">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom p-0">
                <ul class="nav nav-tabs border-0 px-4 pt-3" id="heroTabs" role="tablist">
                    <?php $first = true; foreach ($pages as $key => $name): ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $first ? 'active' : ''; ?> fw-bold border-0 bg-transparent py-3 px-4 position-relative" 
                                id="<?= $key; ?>-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#tab-<?= $key; ?>" 
                                type="button" 
                                role="tab">
                            <?= $name; ?>
                            <?php if ($first) $first = false; ?>
                        </button>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content" id="heroTabsContent">
                    <?php $first = true; foreach ($pages as $key => $name): 
                        $hero = $heroes[$key] ?? null;
                    ?>
                    <div class="tab-pane fade <?= $first ? 'show active' : ''; ?>" id="tab-<?= $key; ?>" role="tabpanel">
                        <?php if ($hero): ?>
                        <form action="<?= BASE_URL; ?>admin/update_hero" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="page_name" value="<?= $key; ?>">
                            
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="p-4 bg-light rounded-4 border text-center mb-4">
                                        <div class="small fw-bold text-muted mb-3 text-uppercase tracking-wider">Current Hero Layout Preview</div>
                                        <div class="hero-preview-container position-relative rounded-3 overflow-hidden shadow-sm mx-auto" style="max-width: 800px; height: 350px;">
                                            <?php 
                                                $imageUrl = $hero->image;
                                                if ($imageUrl && !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                                                    $imageUrl = ASSETS_URL . 'img/' . $imageUrl;
                                                }
                                            ?>
                                            <div class="preview-bg" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('<?= $imageUrl; ?>') center/cover no-repeat; width: 100%; height: 100%;"></div>
                                            <div class="preview-content position-absolute top-50 start-50 translate-middle w-100 px-4 text-white">
                                                <?php if($hero->tag_id): ?>
                                                    <span class="badge bg-primary mb-2"><?= $hero->tag_id; ?></span>
                                                <?php endif; ?>
                                                <h3 class="fw-bold mb-1"><?= $hero->title_id; ?></h3>
                                                <p class="small opacity-75 mb-0" style="max-width: 600px; margin: 0 auto;"><?= $hero->subtitle_id; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-4">
                                <!-- Single Content -->
                                <div class="col-12 px-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="fw-bold mb-0">Konten Hero</h6>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-dark">Tag / Hashtag</label>
                                        <input type="text" name="tag_id" class="form-control" value="<?= htmlspecialchars($hero->tag_id); ?>">
                                        <input type="hidden" name="tag_en" value="<?= htmlspecialchars($hero->tag_en); ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-dark">Hero Title (HTML allowed)</label>
                                        <textarea name="title_id" class="form-control" rows="2"><?= htmlspecialchars($hero->title_id); ?></textarea>
                                        <input type="hidden" name="title_en" value="<?= htmlspecialchars($hero->title_en); ?>">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-dark">Hero Subtitle</label>
                                        <textarea name="subtitle_id" class="form-control" rows="3"><?= htmlspecialchars($hero->subtitle_id); ?></textarea>
                                        <input type="hidden" name="subtitle_en" value="<?= htmlspecialchars($hero->subtitle_en); ?>">
                                    </div>

                                    <div class="mt-2">
                                        <small class="text-muted"><i class="fas fa-magic me-1"></i> Versi Bahasa Inggris akan diperbarui otomatis jika dikosongkan.</small>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <label class="form-label small fw-bold text-dark">Change Hero Background Image</label>
                                        <div class="d-flex align-items-center">
                                            <input type="file" name="hero_image" class="form-control me-3" accept="image/*">
                                            <div class="text-muted small">Max 2MB. Recommended 1920x1080px.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-5 text-end pt-3 border-top">
                                    <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                                        <i class="fas fa-save me-2"></i> Save Changes for <?= $name; ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                    <?php if ($first) $first = false; endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs .nav-link {
        color: #6c757d;
        transition: all 0.2s;
        border-bottom: 3px solid transparent !important;
    }
    .nav-tabs .nav-link.active {
        color: var(--primary-color) !important;
        border-bottom: 3px solid var(--primary-color) !important;
    }
    .nav-tabs .nav-link:hover {
        color: var(--primary-color);
        background: rgba(var(--primary-rgb), 0.05);
    }
    .extra-small {
        font-size: 0.75rem;
    }
    .preview-content h3 {
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .border-dashed {
        border-style: dashed !important;
    }
</style>
