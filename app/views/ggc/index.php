<!-- HERO SECTION -->
<?php
$heroGGC = $data['hero'];
$bgGGC = $heroGGC->image;
if ($bgGGC && !filter_var($bgGGC, FILTER_VALIDATE_URL)) {
    $bgGGC = ASSETS_URL . 'img/' . $bgGGC;
}
?>
<section class="hero-ggc">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <div class="hero-logo-wrapper mb-4">
          <img src="<?= ASSETS_URL ?>img/logo-ggc.png?v=<?= time() ?>" alt="GoSirk Green Community" class="img-fluid" style="max-height: 200px;">
        </div>
        <p class="lead text-secondary mb-4 fs-4" style="max-width: 500px;" data-lang-id="<?= $heroGGC->subtitle_id ?>" data-lang-en="<?= $heroGGC->subtitle_en ?>">
          <?= $heroGGC->subtitle_id ?>
        </p>
        <div class="d-flex gap-3">
          <a href="#about" class="btn btn-success btn-sm rounded-pill px-4 py-3 fw-bold shadow-sm" data-i18n="ggc.hero.cta_learn">Pelajari Lebih Lanjut</a>
          <a href="#gallery" class="btn btn-outline-success btn-sm rounded-pill px-4 py-3 fw-bold" data-i18n="ggc.hero.cta_action">Aksi Kami</a>
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <div class="position-relative">
            <div class="bg-success position-absolute top-50 start-50 translate-middle rounded-circle opacity-50" style="width: 500px; height: 500px;"></div>
            <img src="<?= $bgGGC ?>" class="img-fluid rounded-5 shadow-lg position-relative z-1" alt="Community Growth">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- IMPACT SECTION -->
<section class="section bg-white border-top">
  <div class="container">
    <div class="section-title-wrapper text-center">
      <div class="title-bg" data-i18n="ggc.impact.title_bg">Impact</div>
      <h4 class="fw-bold fs-2 mb-2 text-success" data-i18n="ggc.impact.title">DAMPAK YANG TERUKUR</h4>
      <p class="text-muted" data-i18n="ggc.impact.subtitle">Kontribusi nyata kami dalam membangun ekosistem hijau berbasis komunitas.</p>
    </div>

    <div class="row g-4">
      <?php 
      $main_impacts = array_filter($data['impacts'], fn($i) => $i->section === 'Main');
      $collapsed_impacts = array_filter($data['impacts'], fn($i) => $i->section === 'Collapse');
      ?>
      <?php if (!empty($main_impacts)) : $idx = 1; ?>
        <?php foreach($main_impacts as $imp): ?>
          <div class="col-lg-3 col-md-6">
            <div class="metric-card">
              <div class="metric-value"><?= $imp->value ?></div>
              <div class="metric-unit" data-i18n="ggc.impact.m<?= $idx ?>_unit"><?= $imp->unit ?></div>
              <div class="metric-label" data-lang-id="<?= $imp->label_id ?>" data-lang-en="<?= $imp->label_en ?>">
                <?= $imp->label_id ?>
              </div>
              <div class="metric-note" data-lang-id="<?= $imp->note_id ?>" data-lang-en="<?= $imp->note_en ?>">
                <?= $imp->note_id ?>
              </div>
            </div>
          </div>
        <?php $idx++; endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center text-muted">No primary impact data available.</div>
      <?php endif; ?>
    </div>

    <!-- More Impacts (Collapse) -->
    <div class="collapse mt-4" id="moreImpacts">
      <div class="row g-4 justify-content-center">
        <?php if (!empty($collapsed_impacts)) : $idx = 5; // Continuing from m5 ?>
          <?php foreach($collapsed_impacts as $imp): ?>
            <div class="col-lg-3 col-md-6">
              <div class="metric-card">
                <div class="metric-value"><?= $imp->value ?></div>
                <div class="metric-unit" data-i18n="ggc.impact.m<?= $idx ?>_unit"><?= $imp->unit ?></div>
                <div class="metric-label" data-lang-id="<?= $imp->label_id ?>" data-lang-en="<?= $imp->label_en ?>">
                  <?= $imp->label_id ?>
                </div>
                <div class="metric-note" data-lang-id="<?= $imp->note_id ?>" data-lang-en="<?= $imp->note_en ?>">
                  <?= $imp->note_id ?>
                </div>
              </div>
            </div>
          <?php $idx++; endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center text-muted">No additional impact data available.</div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Toggle Button -->
    <div class="text-center mt-5">
      <button class="btn border-1 btn-outline-success rounded-pill px-4 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#moreImpacts" id="impactToggleButton" data-i18n="ggc.impact.btn_more">
        LIHAT DATA LENGKAP
      </button>
    </div>
  </div>
</section>

<!-- ABOUT SECTION -->
<section class="section" id="about">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="bg-light p-2 rounded-5 shadow-sm overflow-hidden">
            <img src="<?= ASSETS_URL ?>img/IMG_8093-crop.jpg" class="img-fluid rounded-4 shadow" alt="About GGC">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="ps-lg-4">
            <div class="text-success fw-bold mb-2" data-i18n="ggc.about.badge">SIAPA KAMI?</div>
            <h2 class="fw-bold mb-4 display-6" data-i18n="ggc.about.title">
              MENGENAL <span class="text-success">GOSIRK GREEN COMMUNITY</span>
            </h2>
            <p class="lead text-secondary mb-4" data-i18n="ggc.about.p1">
              GoSirk Green Community adalah inisiatif unggulan yang digagas oleh
              PT Go Circular Solutions Indonesia (GoSirk) yang menghadirkan solusi
              nyata dalam pengelolaan sampah berbasis komunitas.
            </p>
            <p class="text-muted mb-4" data-i18n="ggc.about.p2">
              Melalui pendekatan partisipatif, edukatif, dan kolaborasi lintas sektor,
              program ini mendorong transformasi sosial dan pelestarian lingkungan
              di tingkat desa dan kelurahan.
            </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- PROGRAM SECTION -->
<section class="section bg-light-subtle">
  <div class="container">
    <div class="section-title-wrapper text-center">
      <div class="title-bg" data-i18n="ggc.programs.title_bg">Programs</div>
      <h4 class="fw-bold fs-2 mb-2 text-success" data-i18n="ggc.programs.title">PROGRAM BERDAMPAK KAMI</h4>
      <p class="text-muted mx-auto" style="max-width: 600px;" data-i18n="ggc.programs.subtitle">Kami merancang inisiatif yang fokus pada pemberdayaan dan perubahan perilaku masyarakat.</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="program-card">
          <div class="program-card-img-wrapper">
            <img src="https://images.unsplash.com/photo-1526951521990-620dc14c214b?auto=format&fit=crop&q=80&w=800" alt="Pelatihan Pengolahan Sampah">
            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-success text-white rounded-pill small fw-bold" data-i18n="ggc.programs.p1_badge">Pemberdayaan</div>
          </div>
          <div class="program-card-content text-center">
            <h6 class="fw-bold" data-i18n="ggc.programs.p1_title">Pelatihan Pengolahan Sampah</h6>
            <p class="text-muted small" data-i18n="ggc.programs.p1_desc">
              Meningkatkan kemampuan kader desa dalam pemilahan dan pengolahan sampah.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="program-card">
          <div class="program-card-img-wrapper">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" alt="Pelatihan Kader (PRA)">
            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-primary text-white rounded-pill small fw-bold" data-i18n="ggc.programs.p2_badge">Edukasi</div>
          </div>
          <div class="program-card-content text-center">
            <h6 class="fw-bold" data-i18n="ggc.programs.p2_title">Pelatihan Kader (PRA)</h6>
            <p class="text-muted small" data-i18n="ggc.programs.p2_desc">
              Mendorong peran kader PKK dalam pengelolaan sampah rumah tangga.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="program-card">
          <div class="program-card-img-wrapper">
            <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800" alt="Pendampingan & Edukasi">
            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-orange text-white rounded-pill small fw-bold" style="background-color: var(--ggc-orange);" data-i18n="ggc.programs.p3_badge">Pendampingan</div>
          </div>
          <div class="program-card-content text-center">
            <h6 class="fw-bold" data-i18n="ggc.programs.p3_title">Pendampingan & Edukasi</h6>
            <p class="text-muted small" data-i18n="ggc.programs.p3_desc">
              Praktik pengelolaan sampah berkelanjutan di desa binaan.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="program-card">
          <div class="program-card-img-wrapper">
            <img src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&q=80&w=800" alt="Pengurangan Emisi">
            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-info text-white rounded-pill small fw-bold" data-i18n="ggc.programs.p4_badge">Lingkungan</div>
          </div>
          <div class="program-card-content text-center">
            <h6 class="fw-bold" data-i18n="ggc.programs.p4_title">Pelatihan Pengolahan Sampah</h6>
            <p class="text-muted small" data-i18n="ggc.programs.p4_desc">
              Berkontribusi dalam pengurangan emisi gas rumah kaca.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="program-card">
          <div class="program-card-img-wrapper">
            <img src="https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&q=80&w=800" alt="Penanaman Bibit">
            <div class="position-absolute top-0 start-0 m-3 px-3 py-1 bg-warning text-dark rounded-pill small fw-bold" data-i18n="ggc.programs.p5_badge">Ketahanan Pangan</div>
          </div>
          <div class="program-card-content text-center">
            <h6 class="fw-bold" data-i18n="ggc.programs.p5_title">Penanaman Bibit Tanaman</h6>
            <p class="text-muted small" data-i18n="ggc.programs.p5_desc">
              Mendukung ketahanan pangan dan pemenuhan tanaman obat.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- GALLERY SECTION -->
<section class="section pb-5" id="gallery">
  <div class="container">
            <!-- Gallery Header -->
            <div class="position-relative text-center mb-5">
                <div class="title-bg" data-i18n="ggc.gallery.title_bg">Gallery</div>
                <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold mb-3" data-i18n="ggc.gallery.badge">HIGHLIGHT</div>
                <h4 class="fw-bold fs-2 mb-2 text-success" data-i18n="ggc.gallery.title">AKSI KAMI</h4>
                <p class="text-muted" data-i18n="ggc.gallery.subtitle">Momen-momen inspiratif dalam setiap kegiatan komunitas kami.</p>
            </div>

    <div class="row g-4 overflow-hidden">
      <?php 
      $gallery_items = [
          [
              "img" => "https://images.unsplash.com/photo-1542601906990-b4d3fb7d5fa5?auto=format&fit=crop&q=80&w=600",
              "title" => "Aksi Tanam Mangrove",
              "desc" => "Restorasi kawasan pesisir bersama pemuda desa setempat."
          ],
          [
              "img" => "https://images.unsplash.com/photo-1536964542287-430ae5f1394c?auto=format&fit=crop&q=80&w=600",
              "title" => "Workshop Kompos",
              "desc" => "Pelatihan pengolahan sampah organik rumah tangga."
          ],
          [
              "img" => "https://images.unsplash.com/photo-1593113598332-cd288d649433?auto=format&fit=crop&q=80&w=600",
              "title" => "Edukasi Lingkungan",
              "desc" => "Menanamkan nilai kelestarian kepada generasi muda."
          ],
          [
              "img" => "https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?auto=format&fit=crop&q=80&w=600",
              "title" => "Kebun Toga Komunitas",
              "desc" => "Pemanfaatan pekarangan untuk ketahanan pangan."
          ],
          [
              "img" => "https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&q=80&w=600",
              "title" => "Aksi Pilah Sampah",
              "desc" => "Gerakan pilah dari sumber di lingkup rukun tetangga."
          ],
          [
              "img" => "https://images.unsplash.com/photo-1526951521990-620dc14c214b?auto=format&fit=crop&q=80&w=600",
              "title" => "Pertemuan Kader GGC",
              "desc" => "Koordinasi rutin perencanaan program pemberdayaan."
          ]
      ];
      foreach($gallery_items as $item): ?>
      <div class="col-lg-4 col-md-6">
        <div class="gallery-item shadow-sm">
          <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>">
          <div class="gallery-overlay d-flex flex-column justify-content-end p-4">
              <h5 class="text-white fw-bold mb-1"><?= $item['title'] ?></h5>
              <p class="text-white-50 small mb-0"><?= $item['desc'] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA SECTION -->
<section class="cta-ggc text-center">
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4 display-5" data-i18n="ggc.cta.title">Mari Bangun Dampak Bersama</h2>
            <p class="mb-5 lead opacity-75" data-i18n="ggc.cta.desc">
              Kami percaya kolaborasi yang tepat dapat menciptakan perubahan lingkungan
              yang berkelanjutan. Bersama komunitas, kita bisa memberikan kontribusi lebih bagi bumi.
            </p>
            <a href="<?= BASE_URL ?>contact" class="btn btn-ggc-light btn-lg shadow-lg" data-i18n="ggc.cta.btn">
                <i class="bi bi-chat-dots-fill me-2"></i> Hubungi Kami
            </a>
        </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const impactToggle = document.getElementById('impactToggleButton');
    const impactCollapse = document.getElementById('moreImpacts');
    
    if (impactToggle && impactCollapse) {
        impactCollapse.addEventListener('show.bs.collapse', function () {
            const lang = localStorage.getItem('gosirk_language') || 'en';
            impactToggle.textContent = resources[lang].translation.ggc.impact.btn_less;
            impactToggle.setAttribute('data-i18n', 'ggc.impact.btn_less');
        });
        
        impactCollapse.addEventListener('hide.bs.collapse', function () {
            const lang = localStorage.getItem('gosirk_language') || 'en';
            impactToggle.textContent = resources[lang].translation.ggc.impact.btn_more;
            impactToggle.setAttribute('data-i18n', 'ggc.impact.btn_more');
        });
    }
});
</script>