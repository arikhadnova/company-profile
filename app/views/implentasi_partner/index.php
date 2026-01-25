<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

    :root {
        --gosirk-orange: #FF8F56;
        --gosirk-orange-dark: #e5763d;
        --gi-dark: #0b1120;
        --gi-bg-light: #f8f9fa;
        --text-dark: #1e293b;
        --text-muted: #64748b;
    }

    body { 
        font-family: 'Plus Jakarta Sans', sans-serif;
        line-height: 1.8; 
        color: #334155;
        background-color: #fff;
    }

    /* Standardized Section Headers */
    .section-subheader {
        font-size: 1.25rem; /* Matches h5 in GI */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--gosirk-orange);
        margin-bottom: 0.75rem;
        display: block;
    }

    .section-title {
        font-weight: 700;
        color: var(--gi-dark);
        margin-bottom: 1.5rem;
    }

    /* Hero Section - GI Style */
    .hero-partner {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('https://images.unsplash.com/photo-1517048676732-d65bc937f952?q=80&w=1920&auto=format&fit=crop') center/cover no-repeat;
        min-height: 80vh;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 100px 0;
    }

    .hero-partner .display-3 {
        font-weight: 700;
        color: #ff9f43; /* GI Gold-ish Orange */
        margin-bottom: 1rem;
    }

    .hero-partner .lead {
        max-width: 900px;
        margin: 0 auto 2.5rem;
        opacity: 0.9;
        font-weight: 400;
    }

    /* About Section - GI Style */
    .about-section {
        padding: 100px 0;
        background: white;
    }
    
    .about-image-wrapper {
        position: relative;
    }
    
    .about-image-wrapper img {
        border-radius: 20px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.1);
    }
    
    .about-logo-overlay {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 15px;
        border-radius: 12px;
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 5;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    /* Focus Section - Non-Card Layout */
    .partner-focus {
        padding: 80px 0;
        background: #fdfdfd;
    }
    
    .focus-item {
        padding: 20px;
        transition: transform 0.3s ease;
    }
    
    .focus-icon-box {
        width: 65px;
        height: 65px;
        background: white;
        border: 1px solid rgba(255, 143, 86, 0.2);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        color: var(--gosirk-orange);
        box-shadow: 0 10px 20px rgba(255, 143, 86, 0.05);
    }
    
    .focus-icon-box span {
        font-size: 2.2rem;
    }
    
    .focus-title {
        font-size: 1.5rem; /* Matches h4 in GI */
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: 15px;
        position: relative;
        padding-bottom: 10px;
    }

    .focus-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 30px;
        height: 3px;
        background: var(--gosirk-orange);
        border-radius: 2px;
    }
    
    .focus-text {
        color: #64748b;
        line-height: 1.8;
    }

    /* Stats Section Adjustment - No longer overlapping */
    .partner-stats {
        position: relative;
        padding-top: 80px;
        padding-bottom: 80px;
    }

    .stats-card-wrapper {
        background: white;
        border-radius: 30px;
        padding: 60px 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }

    

    .about-card {
        background: var(--soft-bg);
        border-radius: 24px;
        padding: 50px;
        border-left: 8px solid var(--gosirk-orange);
    }

    .problem-item {
        padding: 10px;
        transition: all 0.3s ease;
    }

    .problem-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 143, 86, 0.1);
        color: var(--gosirk-orange);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
    }

    .problem-icon .material-symbols-outlined {
        font-size: 2rem; /* fs-1 equivalent */
    }

    /* Service Cards - GI Style */
    .service-card {
        border: 1px solid #f0f0f0;
        border-radius: 20px;
        padding: 35px 25px;
        height: 100%;
        transition: all 0.3s ease;
        background: #fff;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .service-icon-box {
        width: 60px;
        height: 60px;
        background: var(--gosirk-orange);
        color: white;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        box-shadow: 0 10px 20px rgba(255, 143, 86, 0.2);
    }

    .service-icon-box .material-symbols-outlined {
        font-size: 2rem; /* fs-1 equivalent */
    }

    /* Workflow Timeline */
    .workflow-item {
        background: white;
        border-radius: 20px;
        padding: 30px;
        border: 1px solid #f0f0f0;
        height: 100%;
        position: relative;
        transition: all 0.3s ease;
    }

    .workflow-item:hover {
        border-color: var(--gosirk-orange);
    }

    .workflow-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: rgba(255, 143, 86, 0.15);
        position: absolute;
        top: 15px;
        right: 25px;
        line-height: 1;
    }

    /* Rounded Pill Buttons - GI Style */
    .btn-gi-primary {
        background: var(--gosirk-orange);
        color: white;
        border-radius: 50px;
        padding: 12px 32px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        border: 2px solid var(--gosirk-orange);
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .btn-gi-primary:hover {
        background: white;
        color: var(--gosirk-orange);
        transform: translateY(-2px);
    }

    .btn-gi-outline {
        background: transparent;
        color: white;
        border: 2px solid white;
        border-radius: 50px;
        padding: 12px 32px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        letter-spacing: 0.5px;
    }

    .btn-gi-outline:hover {
        background: white;
        color: var(--gi-dark);
        transform: translateY(-2px);
    }

    .bg-gi-light {
        background-color: var(--gi-bg-light);
    }

    .cta-banner {
        background: linear-gradient(90deg, var(--gosirk-orange) 0%, #ffac7d 100%);
        border-radius: 30px;
        padding: 70px 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(255, 143, 86, 0.25);
    }

    .cta-banner::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .check-list-item i {
        color: var(--gosirk-orange);
        font-size: 1.1rem;
    }

    @media (min-width: 768px) {
        .border-start-md {
            border-left: 1px solid #eee;
        }
    }

    /* Testimonials Styles */
    .testimonial-section {
        background-color: #f8f9fa;
        overflow: hidden;
    }
    .testimonial-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        transform: translateY(-5px);
    }
    .quote-icon {
        font-size: 3rem;
        color: var(--gosirk-orange);
        opacity: 0.2;
        margin-bottom: -20px;
    }
    .testimonial-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #475569;
        font-style: italic;
        margin-bottom: 30px;
        flex-grow: 1;
    }
    .profile-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        background: #e2e8f0;
    }
    
    /* FAQ Styles */
    .accordion-gi .accordion-item {
        border: none;
        margin-bottom: 15px;
        border-radius: 16px !important;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .accordion-gi .accordion-button {
        padding: 20px 25px;
        font-weight: 700;
        color: var(--gi-dark);
        background: white;
    }
    .accordion-gi .accordion-button:not(.collapsed) {
        color: var(--gosirk-orange);
        background: white;
        box-shadow: none;
    }
    .accordion-gi .accordion-button:focus {
        box-shadow: none;
    }
    .accordion-gi .accordion-body {
        padding: 0 25px 25px;
        color: #64748b;
        background: white;
    }

    /* Updated CTA Styles */
    .partnership-cta .cta-banner {
        border-radius: 30px;
        overflow: hidden;
        position: relative;
        padding: 0;
        background: transparent;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    .cta-overlay {
        position: absolute;
        inset: 0;
        z-index: 1;
    }
    .cta-content {
        position: relative;
        z-index: 3;
        padding: 80px 60px;
    }

    /* GI Portfolio Style Sections */
    .section-header-sm {
        font-weight: 800;
        font-size: 1.2rem;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }
    
    .target-container {
        background-color: #f8f9fa;
        padding: 40px;
        border-radius: 20px;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .impact-grid-item {
        text-align: center;
        padding: 20px;
    }
    .impact-value-blue {
        color: var(--gosirk-orange);
        font-weight: 800;
        font-size: 1.8rem;
        display: block;
    }
    .impact-label-gray {
        color: #666;
        font-size: 0.8rem;
    }
    
    .highlight-card {
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        height: 250px;
        margin-bottom: 30px;
    }
    .highlight-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .highlight-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        display: flex;
        align-items: flex-end;
        padding: 20px;
        color: white;
    }
</style>

<div class="partner-page">
    <!-- HERO SECTION -->
    <?php
    $heroPartner = $data['hero'];
    $bgPartner = $heroPartner->image;
    if ($bgPartner && !filter_var($bgPartner, FILTER_VALIDATE_URL)) {
        $bgPartner = ASSETS_URL . 'img/' . $bgPartner;
    }
    ?>
    <section class="hero-partner" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('<?= $bgPartner ?>') center/cover no-repeat !important;">
        <div class="container">
            <h1 class="display-3 fw-bold text-uppercase mb-3" data-lang-id="<?= $heroPartner->title_id ?>" data-lang-en="<?= $heroPartner->title_en ?>" data-i18n-html="true">
                <?= $heroPartner->title_id ?>
            </h1>
            <p class="lead fs-4 mb-2 text-light opacity-90 mx-auto" style="max-width: 900px;" data-lang-id="<?= $heroPartner->subtitle_id ?>" data-lang-en="<?= $heroPartner->subtitle_en ?>">
                <?= $heroPartner->subtitle_id ?>
            </p>
            <p class="text-light fs-5 mb-5 opacity-75 fw-medium" data-lang-id="<?= $heroPartner->tag_id ?>" data-lang-en="<?= $heroPartner->tag_en ?>"><?= $heroPartner->tag_id ?></p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="#tentang" class="btn btn-light rounded-pill px-5 py-3 fw-bold text-uppercase" style="color: var(--gosirk-orange) !important;">Eksplorasi</a>
                <a href="<?= BASE_URL ?>contact" class="btn btn-outline-light rounded-pill px-5 py-3 fw-bold text-uppercase" data-i18n="partner.cta_secondary">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="gi-stats">
        <div class="container">
            <div class="stats-card-wrapper shadow-lg rounded-4 p-4 p-md-5 bg-white">
                <div class="row text-center g-4">
                    <?php if (!empty($data['impacts'])) : ?>
                        <?php foreach ($data['impacts'] as $index => $imp) : ?>
                            <div class="col-6 col-md-3">
                                <div class="stat-item <?= $index > 0 ? 'border-start-md' : ''; ?>">
                                    <h2 class="fw-bold mb-0 text-primary">
                                        <span class="counter" data-target="<?= $imp->value; ?>">0</span><?= $imp->unit; ?>
                                    </h2>
                                    <p class="text-muted small text-uppercase fw-semibold mb-0" 
                                       data-lang-id="<?= $imp->label_id; ?>" 
                                       data-lang-en="<?= $imp->label_en; ?>">
                                        <?= $imp->label_id; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col-12"><p class="text-muted">Data statistik belum tersedia.</p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="about-section">
        <div class="container">
            <!-- PARTNER LOGOS -->
            <div class="row align-items-center justify-content-center g-4 g-md-5 mb-5">
                <div class="col-6 col-md-2 text-center">
                    <img src="<?= ASSETS_URL ?>img/Logo-GoSirk-01.png" alt="GoSirk" class="img-fluid" style="max-height: 70px; width: auto;">
                </div>
                <div class="col-6 col-md-2 text-center">
                    <img src="<?= ASSETS_URL ?>img/Logo CLOCC.png" alt="CLOCC" class="img-fluid" style="max-height: 70px; width: auto;">
                </div>
                <div class="col-6 col-md-2 text-center">
                    <img src="<?= ASSETS_URL ?>img/logo-sirk-norge.png" alt="Sirk Norge" class="img-fluid" style="max-height: 70px; width: auto;">
                </div>
                <div class="col-6 col-md-2 text-center">
                    <img src="<?= ASSETS_URL ?>img/logo-kab-tabanan.png" alt="Pemkab Tabanan" class="img-fluid" style="max-height: 70px; width: auto;">
                </div>
            </div>

            <div class="row g-5">
                <!-- Left Column: Narrative -->
                <div class="col-lg-7">
                    <span class="section-subheader" data-lang-id="Ringkasan Program" data-lang-en="Program Overview" data-i18n="partner.badge">Program Overview</span>
                    <h2 class="display-6 fw-bold mb-4" style="color: var(--dark-blue);" data-i18n="partner.hero_title">Bersama Menghadapi Tantangan Persampahan di Indonesia</h2>
                    <p class="text-muted mb-3" style="text-align: justify; line-height: 1.8;" data-i18n="partner.desc_p1">
                        Program Clean Oceans through Clean Communities (CLOCC), yang dimiliki oleh Sirk Norge...
                    </p>
                    <p class="text-muted mb-4" style="text-align: justify; line-height: 1.8;" data-i18n="partner.desc_p2">
                        Tujuan dari program pendampingan desa di desa-desa percontohan di Kabupaten Tabanan...
                    </p>
                </div>

                <!-- Right Column: Role & SOW -->
                <div class="col-lg-5 col-xl-5">
                    <div class="p-4 bg-light rounded-4 border-start border-4 border-orange mb-4 shadow-sm">
                        <h5 class="fw-bold mb-3" style="color: var(--gi-dark);" data-i18n="partner.gosirk_role_title">Peran GoSirk</h5>
                        <p class="small text-muted mb-0" style="line-height: 1.6;" data-i18n="partner.gosirk_role_desc">
                            Sebagai Mitra Pelaksana Lokal (Local Implementing Partner) CLOCC di Indonesia...
                        </p>
                    </div>

                    <div class="p-4 bg-white rounded-4 border border-1 shadow-sm">
                        <h5 class="fw-bold mb-3" style="color: var(--gi-dark);" data-i18n="partner.sow_title">Scope of Work</h5>
                        <p class="small text-muted mb-3" data-i18n="partner.sow_desc">
                            Program ini berupaya mencapai target 100% melalui:
                        </p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex gap-2 mb-3">
                                <span class="material-symbols-outlined text-orange small">check_circle</span>
                                <span class="small text-muted" data-i18n="partner.sow_item1">Capacity building</span>
                            </li>
                            <li class="d-flex gap-2 mb-3">
                                <span class="material-symbols-outlined text-orange small">check_circle</span>
                                <span class="small text-muted" data-i18n="partner.sow_item2">Infrastructure</span>
                            </li>
                            <li class="d-flex gap-2 mb-3">
                                <span class="material-symbols-outlined text-orange small">check_circle</span>
                                <span class="small text-muted" data-i18n="partner.sow_item3">Institutional strengthening</span>
                            </li>
                            <li class="d-flex gap-2 mb-3">
                                <span class="material-symbols-outlined text-orange small">check_circle</span>
                                <span class="small text-muted" data-i18n="partner.sow_item4">Policy advocacy</span>
                            </li>
                            <li class="d-flex gap-2">
                                <span class="material-symbols-outlined text-orange small">check_circle</span>
                                <span class="small text-muted" data-i18n="partner.sow_item5">Education & awareness</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROGRAM_IMPLEMENTATION SECTION (Combined Background & Pilot Villages) -->
    <section id="program-implementation" class="py-5 bg-white">
        <div class="container">
            <!-- Background Part -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="display-6 fw-bold mb-4" style="color: var(--gi-dark);" data-i18n="partner.background_title">Background</h2>
                        <p class="text-muted" style="text-align: justify; line-height: 1.8;" data-i18n="partner.background_desc">
                            Initiated in August 2024, the Village Assistance Program in Tabanan—delivered in
                            partnership with PT GO Circular Solution Indonesia (GoSirk) as the local implementing
                            partner of the CLOCC Program—aims to strengthen the capacity of village
                            governments in advancing integrated and sustainable waste management in line
                            with the Tabanan District Waste Management Master Plan (RIPS). The program was
                            formally launched through the signing of a Memorandum of Understanding (MoU)
                            between GoSirk and the governments of the three pilot villages: Bengkel, Dauh Peken,
                            and Wongaya Gede.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Village Part -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-2" style="color: var(--gi-dark);" data-i18n="partner.pilot_villages_title">Desa Percontohan</h2>
                    <div class="mx-auto mb-5 rounded-pill bg-orange opacity-25" style="width: 60px; height: 3px;"></div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Village 1: Bengkel -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border border-1 shadow-sm rounded-4 overflow-hidden" style="border-color: #f0f0f0 !important; border-radius: 20px !important; transition: all 0.3s ease;">
                        <div class="position-relative overflow-hidden">
                            <img src="<?= ASSETS_URL ?>img/IMG_8082.jpg" class="card-img-top" alt="Desa Bengkel" style="height: 280px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-end p-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);">
                                <div class="w-100 p-4 text-center">
                                    <h5 class="fw-bold mb-0 text-white text-uppercase tracking-wider" data-i18n="partner.village_bengkel">Desa Bengkel</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Village 2: Dauh Peken -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border border-1 shadow-sm rounded-4 overflow-hidden" style="border-color: #f0f0f0 !important; border-radius: 20px !important; transition: all 0.3s ease;">
                        <div class="position-relative overflow-hidden">
                            <img src="<?= ASSETS_URL ?>img/IMG_8084.jpg" class="card-img-top" alt="Desa Dauh Peken" style="height: 280px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-end p-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);">
                                <div class="w-100 p-4 text-center">
                                    <h5 class="fw-bold mb-0 text-white text-uppercase tracking-wider" data-i18n="partner.village_dauh_peken">Desa Dauh Peken</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Village 3: Wongaya Gede -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border border-1 shadow-sm rounded-4 overflow-hidden" style="border-color: #f0f0f0 !important; border-radius: 20px !important; transition: all 0.3s ease;">
                        <div class="position-relative overflow-hidden">
                            <img src="<?= ASSETS_URL ?>img/IMG_8097.jpg" class="card-img-top" alt="Desa Wongaya Gede" style="height: 280px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-end p-0" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 60%);">
                                <div class="w-100 p-4 text-center">
                                    <h5 class="fw-bold mb-0 text-white text-uppercase tracking-wider" data-i18n="partner.village_wongaya_gede">Desa Wongaya Gede</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button Part -->
            <div class="text-center mt-5 pt-3">
                <a href="#" class="btn btn-gi-primary shadow-sm" data-i18n="partner.view_more">
                    Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- FOCUS SECTION - Non-Card Feature Grid -->
    <section class="partner-focus">
        <div class="container">
            <div class="text-center mb-5 pb-3">
                <span class="section-subheader" data-i18n="partner.focus_subheader">Strategi Kami</span>
                <h2 class="section-title display-6" data-i18n="partner.focus_title">Pendekatan Kami</h2>
                <div class="mx-auto mt-3 rounded-pill bg-orange opacity-25" style="width: 60px; height: 3px;"></div>
            </div>
            
            <div class="row g-4 pt-4">
                <div class="col-md-6 col-lg-3">
                    <div class="focus-item">
                        <div class="focus-icon-box">
                            <span class="material-symbols-outlined">groups</span>
                        </div>
                        <h4 class="focus-title" data-i18n="partner.focus1_title">Pendekatan Holistik & Inklusif</h4>
                        <p class="focus-text" data-i18n="partner.focus1_desc">Pemberdayaan komunitas lokal, keterlibatan pemangku kepentingan, dan kolaborasi sektor swasta.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="focus-item">
                        <div class="focus-icon-box">
                            <span class="material-symbols-outlined">eco</span>
                        </div>
                        <h4 class="focus-title" data-i18n="partner.focus2_title">Solusi Berkelanjutan</h4>
                        <p class="focus-text" data-i18n="partner.focus2_desc">Sistem pengelolaan sampah efisien dalam rangka mendorong terwujudnya ekonomi sirkular daerah.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="focus-item">
                        <div class="focus-icon-box">
                            <span class="material-symbols-outlined">target</span>
                        </div>
                        <h4 class="focus-title" data-i18n="partner.focus3_title">Tepat Guna & Tepat Sasaran</h4>
                        <p class="focus-text" data-i18n="partner.focus3_desc">Solusi praktis menjawab kebutuhan masyarakat dan mendorong hasil nyata yang terukur.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="focus-item">
                        <div class="focus-icon-box">
                            <span class="material-symbols-outlined">handshake</span>
                        </div>
                        <h4 class="focus-title" data-i18n="partner.focus4_title">Model Kemitraan</h4>
                        <p class="focus-text" data-i18n="partner.focus4_desc">Kerja sama strategis fleksibel & adaptif memastikan implementasi dan pendanaan solid.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted small italic" data-i18n="partner.note">
                    Catatan: Detail spesifik proyek dan dampaknya akan diuraikan lebih lanjut pada bagian PROJEK & PARTNER BISNIS.
                </p>
            </div>
        </div>
    </section>

    <!-- NEW SECTIONS: TARGET, DAMPAK, SOROTAN (GI Style) -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="target-container shadow-sm bg-white">
                <h5 class="fw-bold mb-4 text-center">TARGET PROYEK</h5>
                <ul class="list-unstyled d-flex flex-column gap-3">
                    <li class="d-flex gap-3">
                        <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px; color: var(--gosirk-orange) !important;"></i>
                        <span data-i18n="partner.target_item1">Target 100% tingkat pengumpulan sampah (collection rate) di desa-desa percontohan secara bertahap.</span>
                    </li>
                    <li class="d-flex gap-3">
                        <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px; color: var(--gosirk-orange) !important;"></i>
                        <span data-i18n="partner.target_item2">Penurunan tingkat kebocoran sampah ke lingkungan (waste leakage rate).</span>
                    </li>
                    <li class="d-flex gap-3">
                        <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px; color: var(--gosirk-orange) !important;"></i>
                        <span data-i18n="partner.target_item3">Peningkatan daur ulang (recycling rate).</span>
                    </li>
                    <li class="d-flex gap-3">
                        <i class="fas fa-circle text-primary" style="font-size: 8px; margin-top: 8px; color: var(--gosirk-orange) !important;"></i>
                        <span data-i18n="partner.target_item4">Penurunan timbulan sampah residu ke TPA yang secara jauhnya berimplikasi pada pencegahan kebocoran sampah plastik ke laut.</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h4 class="text-center section-header-sm mb-5" data-i18n="gi.detail.impact">Dampak</h4>
            <div class="row g-4 justify-content-center">
                <!-- Initial items (Always visible) -->
                <div class="col-md-4 col-6">
                    <div class="impact-grid-item">
                        <span class="impact-value-blue">90%</span>
                        <span class="impact-label-gray" data-i18n="partner.impact_item1">waste reduced through recycling & composting</span>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="impact-grid-item">
                        <span class="impact-value-blue">120+</span>
                        <span class="impact-label-gray" data-i18n="partner.impact_item2">Established partnerships</span>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="impact-grid-item">
                        <span class="impact-value-blue">1000+</span>
                        <span class="impact-label-gray" data-i18n="partner.impact_item3">tons of waste collected and treated</span>
                    </div>
                </div>
            </div>

            <!-- Expandable items -->
            <div class="collapse mt-4" id="moreImpacts">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4 col-6">
                        <div class="impact-grid-item">
                            <span class="impact-value-blue">5000+</span>
                            <span class="impact-label-gray">Community members reached</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="impact-grid-item">
                            <span class="impact-value-blue">50+</span>
                            <span class="impact-label-gray">Local Champions trained</span>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="impact-grid-item">
                            <span class="impact-value-blue">15+</span>
                            <span class="impact-label-gray">Village policies developed</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toggle Button -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-orange rounded-pill px-4" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#moreImpacts" 
                        aria-expanded="false" 
                        aria-controls="moreImpacts"
                        id="impactToggleButton"
                        data-i18n="partner.view_more_impact">
                    Lihat Lebih Banyak Dampak
                </button>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <h4 class="text-center section-header-sm mb-5" data-i18n="gi.detail.highlights">Sorotan</h4>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-card shadow-sm">
                        <img src="<?= ASSETS_URL ?>img/IMG_6566.jpg" alt="Highlight 1">
                        <div class="highlight-overlay">
                            <p class="small mb-0" data-i18n="partner.highlight_item1">Cerita sukses pemberdayaan masyarakat di lapangan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-card shadow-sm">
                        <img src="<?= ASSETS_URL ?>img/IMG_8093-crop.jpg" alt="Highlight 2">
                        <div class="highlight-overlay">
                            <p class="small mb-0" data-i18n="partner.highlight_item2">Implementasi sistem pengelolaan sampah terpadu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="highlight-card shadow-sm">
                        <img src="<?= ASSETS_URL ?>img/IMG_8114.jpg" alt="Highlight 3">
                        <div class="highlight-overlay">
                            <p class="small mb-0" data-i18n="partner.highlight_item3">Kolaborasi dengan mitra strategis lokal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PORTFOLIO SECTION -->
    <section id="portfolio" class="py-5 bg-light">
        <div class="container py-5">
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div>
                    <span class="section-subheader">Portfolio</span>
                    <h2 class="section-title display-6 mb-0">Rekam Jejak Kami</h2>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-orange rounded-circle p-2 portfolio-prev" style="width: 45px; height: 45px; border-color: var(--gosirk-orange); color: var(--gosirk-orange);">
                        <span class="material-symbols-outlined v-align-middle">chevron_left</span>
                    </button>
                    <button class="btn btn-orange rounded-circle p-2 portfolio-next" style="width: 45px; height: 45px; background: var(--gosirk-orange); border-color: var(--gosirk-orange); color: white;">
                        <span class="material-symbols-outlined v-align-middle">chevron_right</span>
                    </button>
                </div>
            </div>

            <div class="swiper portfolio-slider">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide h-auto">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div style="height: 200px; overflow: hidden;">
                                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Village Mentoring">
                            </div>
                            <div class="card-body p-4 bg-white">
                                <span class="badge bg-soft-orange text-orange mb-2" style="color: var(--gosirk-orange); background-color: rgba(255, 143, 86, 0.1);">Mentoring Program</span>
                                <h5 class="fw-bold mb-2">Program Pendampingan Desa GoSirk-CLOCC</h5>
                                <p class="text-muted small mb-0">Implementasi sistem pengelolaan sampah terintegrasi di Tabanan, Bali, yang melibatkan 3 desa mitra.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide h-auto">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div style="height: 200px; overflow: hidden;">
                                <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Facility Optimization">
                            </div>
                            <div class="card-body p-4 bg-white">
                                <span class="badge bg-soft-orange text-orange mb-2" style="color: var(--gosirk-orange); background-color: rgba(255, 143, 86, 0.1);">Infrastructure</span>
                                <h5 class="fw-bold mb-2">Optimalisasi TPS 3R & Bank Sampah</h5>
                                <p class="text-muted small mb-0">Penyediaan fasilitas dan alat pendukung untuk meningkatkan efisiensi operasional pengelolaan sampah tingkat desa.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide h-auto">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div style="height: 200px; overflow: hidden;">
                                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Community Education">
                            </div>
                            <div class="card-body p-4 bg-white">
                                <span class="badge bg-soft-orange text-orange mb-2" style="color: var(--gosirk-orange); background-color: rgba(255, 143, 86, 0.1);">Education</span>
                                <h5 class="fw-bold mb-2">Kampanye Perubahan Perilaku Siswa</h5>
                                <p class="text-muted small mb-0">Edukasi pengelolaan sampah yang menjangkau ribuan siswa di berbagai sekolah wilayah mitra.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 4 -->
                    <div class="swiper-slide h-auto">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                            <div style="height: 200px; overflow: hidden;">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=800&q=80" class="w-100 h-100 object-fit-cover" alt="Institutional Strength">
                            </div>
                            <div class="card-body p-4 bg-white">
                                <span class="badge bg-soft-orange text-orange mb-2" style="color: var(--gosirk-orange); background-color: rgba(255, 143, 86, 0.1);">Governance</span>
                                <h5 class="fw-bold mb-2">Penyusunan Perdes Persampahan</h5>
                                <p class="text-muted small mb-0">Penyusunan payung kebijakan tingkat desa untuk memastikan keberlanjutan sistem pengelolaan sampah.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mt-4 position-relative"></div>
            </div>
        </div>
    </section>
    
    <!-- LOGO PARTNERS SLIDER (Home Style) -->
    <section class="section bg-light pb-5">
      <div class="container">
        <h3 class="text-center fw-bold mb-5" data-i18n="partner.implementation.partners_title">OUR PARTNER</h3>
        <div class="swiper logo-slider">
          <div class="swiper-wrapper align-items-center">
            <?php 
            $partners_data = $data['partners'] ?? [];
            $foundContribution = false;
            if (!empty($partners_data)) : 
              foreach ($partners_data as $ptr) : 
                if (($ptr->category ?? '') == 'contribution') :
                  $foundContribution = true;
            ?>
                <div class="swiper-slide text-center">
                  <?php 
                    $logoFile = $ptr->logo;
                    $logoUrl = ASSETS_URL . 'img/partners/' . $logoFile;
                    echo '<img src="' . $logoUrl . '" alt="' . $ptr->name . '" style="max-height: 80px; width: auto;" onerror="this.src=\'' . ASSETS_URL . 'img/Logo-GoSirk-01.png\'; this.style.opacity=\'0.3\';">';
                  ?>
                </div>
            <?php 
                endif;
              endforeach; 
            endif; 
            
            if (!$foundContribution) : ?>
              <div class="swiper-slide text-center text-muted small">No contribution partners yet</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section class="testimonial-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="section-subheader" data-i18n="partner.testimonials.title">Bukti Kontribusi Kami</span>
                <h3 class="fw-bold">Apa Kata Mitra Kami?</h3>
            </div>
            
            <div class="swiper testimonials-slider">
                <div class="swiper-wrapper pb-5">
                    <?php if (!empty($testimonials)) : ?>
                        <?php foreach ($testimonials as $t) : ?>
                            <div class="swiper-slide h-auto">
                                <div class="testimonial-card">
                                    <span class="material-symbols-outlined quote-icon">format_quote</span>
                                    <p class="testimonial-text" data-lang-id="<?= $t->content_id ?>" data-lang-en="<?= $t->content_en ?>">
                                        <?= $t->content_id ?>
                                    </p>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="profile-img" style="background-image: url('<?= $t->image ? ASSETS_URL . 'img/testimonials/' . $t->image : 'https://ui-avatars.com/api/?name=' . urlencode($t->name) . '&background=FF8F56&color=fff' ?>'); background-size: cover; background-position: center;"></div>
                                        <div>
                                            <h6 class="fw-bold mb-0"><?= $t->name ?></h6>
                                            <small class="text-muted" data-lang-id="<?= $t->role_id ?>" data-lang-en="<?= $t->role_en ?>"><?= $t->role_id ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="swiper-slide h-auto w-100">
                            <div class="text-center p-5">
                                <p class="text-muted" data-i18n="home.testimonials.empty">Testimoni belum tersedia.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <span class="section-subheader" data-i18n="partner.faq.title">FAQ Implementasi</span>
                        <h3 class="fw-bold">Pertanyaan Umum</h3>
                    </div>
                    
                    <div class="accordion accordion-gi" id="faqAccordion">
                        <?php if (!empty($faqs)) : ?>
                            <?php foreach ($faqs as $index => $faq) : ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#ifaq<?= $faq->id ?>">
                                            <span data-lang-id="<?= $faq->question_id ?>" data-lang-en="<?= $faq->question_en ?>">
                                                <?= $faq->question_id ?>
                                            </span>
                                        </button>
                                    </h2>
                                    <div id="ifaq<?= $faq->id ?>" class="accordion-collapse collapse <?= $index == 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <div data-lang-id="<?= $faq->answer_id ?>" data-lang-en="<?= $faq->answer_en ?>">
                                                <?= nl2br($faq->answer_id) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="text-center p-4">
                                <p class="text-muted">FAQ belum tersedia untuk kategori ini.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION - Updated to Partnership Style -->
    <section class="partnership-cta py-5 mb-5">
        <div class="container">
            <div class="cta-banner rounded-5 overflow-hidden position-relative">
                <div class="cta-overlay" style="background: linear-gradient(90deg, rgba(255, 143, 86, 0.95) 0%, rgba(229, 118, 61, 0.9) 100%);"></div>
                <div class="row align-items-center position-relative z-3 p-5">
                    <div class="col-lg-8 text-center text-lg-start">
                        <h2 class="display-6 fw-bold text-white mb-3 text-uppercase" data-i18n="partner.cta_title">Siap Mengembangkan Program Bersama?</h2>
                        <p class="text-white-50 mb-4 fs-5" data-i18n="partner.cta_subtitle">Mulai diskusi strategis Anda hari ini untuk menciptakan dampak yang berkelanjutan.</p>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <a href="<?= BASE_URL ?>contact" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow border-0" 
                           style="background-color: white; color: var(--gosirk-orange);" data-i18n="partner.cta_button">
                            Ajukan Kerja Sama
                        </a>
                    </div>
                </div>
                <div class="position-absolute bottom-0 end-0 p-4 opacity-25">
                     <img src="<?= ASSETS_URL ?>img/Logo-GoSirk-01.png" alt="GoSirk" style="max-height: 80px; filter: brightness(0) invert(1);">
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Testimonials Slider
        new Swiper(".testimonials-slider", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 5000,
            }
        });
        // Initialize Portfolio Slider
        new Swiper(".portfolio-slider", {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".portfolio-next",
                prevEl: ".portfolio-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            }
        });

        // Initialize Logo Slider (Home Style)
        new Swiper(".logo-slider", {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                1024: { slidesPerView: 5 },
            }
        });

        // Toggle Impact Button Text
        const impactToggle = document.getElementById('impactToggleButton');
        const impactCollapse = document.getElementById('moreImpacts');
        
        if (impactToggle && impactCollapse) {
            impactCollapse.addEventListener('show.bs.collapse', function () {
                impactToggle.setAttribute('data-i18n', 'partner.view_less_impact');
                if (typeof updateTranslations === 'function') updateTranslations();
            });
            
            impactCollapse.addEventListener('hide.bs.collapse', function () {
                impactToggle.setAttribute('data-i18n', 'partner.view_more_impact');
                if (typeof updateTranslations === 'function') updateTranslations();
            });
        }
    });
</script>
