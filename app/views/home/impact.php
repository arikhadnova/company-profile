<?php
  $heroHome = $data['hero'];
  $bgHome = $heroHome->image ?? 'petugas-baju-biru.png';
  if ($bgHome && !filter_var($bgHome, FILTER_VALIDATE_URL)) {
      $bgHome = ASSETS_URL . 'img/' . $bgHome;
  }
?>

<!-- SUB-HERO IMPACT -->
<section class="section text-white" style="background: linear-gradient(135deg, #0d4a7c 0%, #FF8F56 100%); padding: 80px 0; margin-top: 70px;">
  <div class="container text-center">
    <h1 class="fw-bold display-4" data-i18n="home.impact_detail.hero_title">
      JEJAK DAMPAK KAMI
    </h1>
    <p class="lead mt-2" data-i18n="home.impact_detail.hero_subtitle">
      Angka-angka yang merepresentasikan komitmen kami terhadap perubahan berkelanjutan.
    </p>
  </div>
</section>

<!-- INTRO SECTION -->
<section class="section pb-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white">
          <p class="lead text-dark text-center mb-4" data-i18n="home.impact_detail.intro_p1">
            Komitmen kami terhadap pendekatan holistik dan berbasis komunitas divalidasi oleh hasil yang terukur dan nyata. Go Sirk mendefinisikan keberhasilan bukan hanya dari volume sampah yang dikelola, tetapi dari ketahanan institusional, sosial, dan ekonomi yang kami ciptakan di wilayah mitra.
          </p>
          <p class="text-muted text-center mb-0" data-i18n="home.impact_detail.intro_p2">
            Metrik berikut, yang sebagian besar bersumber dari Program Pendampingan Desa GoSirk-CLOCC di Tabanan, Bali (per September 2025), berfungsi sebagai bukti dampak dan potensi skalabilitas kami.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CATEGORY I: OPERATIONAL & ENVIRONMENTAL -->
<section class="section">
  <div class="container">
    <div class="text-center mb-5">
      <h3 class="fw-bold text-primary mb-3" data-i18n="home.impact_detail.cat1_title">I. KINERJA OPERASIONAL & LINGKUNGAN</h3>
      <div class="mx-auto bg-primary rounded-pill mb-4" style="height: 4px; width: 60px;"></div>
      <p class="text-muted col-lg-8 mx-auto" data-i18n="home.impact_detail.cat1_desc">
        Intervensi kami telah menghasilkan dampak yang signifikan terhadap pengurangan beban lingkungan akibat timbulan sampah dan peningkatan kinerja operasional di wilayah percontohan.
      </p>
    </div>
    
    <div class="row g-4">
      <!-- Total Waste -->
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">delete_sweep</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value">513.03</h2>
           <h5 class="fw-bold text-primary mb-2">Ton</h5>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat1_label1">Total Sampah Terkelola</h6>
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat1_focus1">Pengurangan Kebocoran Sampah ke Lingkungan</p>
        </div>
      </div>
      <!-- Organic -->
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto bg-green-soft text-green">
             <span class="material-symbols-outlined">compost</span>
           </div>
           <h2 class="fw-bold text-success mb-1 impact-metric-value">242.17</h2>
           <h5 class="fw-bold text-success mb-2">Ton</h5>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat1_label2">Total Sampah Organik</h6>
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat1_focus2">Penanganan Sampah Organik</p>
        </div>
      </div>
      <!-- Inorganic -->
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto bg-blue-soft text-blue">
             <span class="material-symbols-outlined">recycling</span>
           </div>
           <h2 class="fw-bold text-info mb-1 impact-metric-value">154.99</h2>
           <h5 class="fw-bold text-info mb-2">Ton</h5>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat1_label3">Total Sampah Anorganik</h6>
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat1_focus3">Ekonomi Sirkular & Daur Ulang</p>
        </div>
      </div>
      <!-- Tools -->
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto bg-orange-soft text-orange">
             <span class="material-symbols-outlined">precision_manufacturing</span>
           </div>
           <h2 class="fw-bold text-warning mb-1 impact-metric-value">584</h2>
           <h5 class="fw-bold text-warning mb-2">Alat</h5>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat1_label4">Alat Pendukung TPS 3R</h6>
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat1_focus4">Penguatan Infrastruktur</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CATEGORY II: SOCIO-ECONOMIC -->
<section class="section bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h3 class="fw-bold text-primary mb-3" data-i18n="home.impact_detail.cat2_title">II. DAMPAK SOSIO-EKONOMI & KOMUNITAS</h3>
      <div class="mx-auto bg-primary rounded-pill mb-4" style="height: 4px; width: 60px;"></div>
      <p class="text-muted col-lg-8 mx-auto" data-i18n="home.impact_detail.cat2_desc">
        Kami mendorong hasil lingkungan yang bersih melalui pendekatan ekonomi sirkular, penciptaan lapangan kerja, dan peluang bisnis lokal.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center bg-white">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">work</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat2_val1">113</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat2_label1">Lapangan Kerja Lokal</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat2_desc1">Diciptakan di desa mitra.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center bg-white">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">groups</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat2_val2">19.908</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat2_label2">Penduduk Desa</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat2_desc2">Terjangkau layanan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center bg-white">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">home</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat2_val3">3.189</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat2_label3">Layanan Rumah Tangga</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat2_desc3">Terlayani sistem terintegrasi.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center bg-white">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">school</span>
           </div>
           <div class="row g-0 align-items-center mb-0">
              <div class="col-6 border-end">
                <h2 class="fw-bold text-primary mb-0 impact-metric-value" data-i18n="home.impact_detail.cat2_val4">1.914</h2>
                <div class="small fw-bold text-uppercase text-muted" data-i18n="home.impact_detail.cat2_label4">Siswa</div>
              </div>
              <div class="col-6">
                <h2 class="fw-bold text-primary mb-0 impact-metric-value" data-i18n="home.impact_detail.cat2_val4b">805</h2>
                <div class="small fw-bold text-uppercase text-muted" data-i18n="home.impact_detail.cat2_label4b">Penduduk</div>
              </div>
           </div>
           <hr class="w-25 mx-auto border-primary my-3">
           <h6 class="text-dark small fw-bold text-uppercase mb-1">Edukasi Komunitas</h6>
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat2_desc4">Mencakup 23 sekolah & 11 hamlets.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CATEGORY III: INSTITUTIONAL -->
<section class="section">
  <div class="container">
     <div class="text-center mb-5">
      <h3 class="fw-bold text-primary mb-3" data-i18n="home.impact_detail.cat3_title">III. PENGUATAN INSTITUSIONAL & KEMITRAAN</h3>
      <div class="mx-auto bg-primary rounded-pill mb-4" style="height: 4px; width: 60px;"></div>
      <p class="text-muted col-lg-8 mx-auto" data-i18n="home.impact_detail.cat3_desc">
        Kami memperkuat kapasitas pemerintah daerah, komunitas, dan institusi dalam mendorong implementasi pengelolaan sampah yang efektif.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">person_celebrate</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat3_val1">169</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat3_label1">Penerima Manfaat</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat3_desc1">Dilatih aspek teknis & tata kelola.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">gavel</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat3_val2">3</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat3_label2">Peraturan Desa</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat3_desc2">Terbit sebagai payung kebijakan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto">
             <span class="material-symbols-outlined">map</span>
           </div>
           <h2 class="fw-bold text-primary mb-1 impact-metric-value" data-i18n="home.impact_detail.cat3_val3">3</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat3_label3">Rencana Aksi</h6>
           <hr class="w-25 mx-auto border-primary my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat3_desc3">Roadmap jangka menengah.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto text-info bg-blue-soft">
             <span class="material-symbols-outlined">contract</span>
           </div>
           <h2 class="fw-bold text-info mb-1 impact-metric-value" data-i18n="home.impact_detail.cat3_val4">9</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat3_label4">Perjanjian Of-ttaker</h6>
           <hr class="w-25 mx-auto border-info my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat3_desc4">Mengamankan rantai pasok material.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="impact-card-stat h-100 p-4 rounded-4 shadow-sm text-center">
           <div class="icon-box mx-auto text-success bg-green-soft">
             <span class="material-symbols-outlined">corporate_fare</span>
           </div>
           <h2 class="fw-bold text-success mb-1 impact-metric-value" data-i18n="home.impact_detail.cat3_val5">3</h2>
           <h6 class="text-dark small fw-bold text-uppercase mb-2" data-i18n="home.impact_detail.cat3_label5">Kemitraan Unit</h6>
           <hr class="w-25 mx-auto border-success my-3">
           <p class="small text-muted mb-0" data-i18n="home.impact_detail.cat3_desc5">Penguatan kerangka kelembagaan.</p>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
       <a href="<?= BASE_URL ?>" class="btn btn-primary rounded-pill px-5 py-3 fw-bold shadow-sm" style="background-color: #0d4a7c; border: none;">
          <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
       </a>
    </div>
  </div>
</section>

<style>
.impact-card-stat {
    background: #fff;
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05) !important;
}
.impact-card-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}
.icon-box {
    width: 70px;
    height: 70px;
    min-width: 70px;
    min-height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(13, 74, 124, 0.1);
    color: #0d4a7c;
    margin-bottom: 1.5rem;
}
.icon-box span { font-size: 36px; }

.impact-metric-value {
    font-size: 2.75rem;
    line-height: 1;
    letter-spacing: -1px;
}

.bg-green-soft { background: rgba(41, 180, 113, 0.1); }
.text-green { color: #29b471; }
.bg-blue-soft { background: rgba(13, 110, 253, 0.1); }
.text-blue { color: #0d6efd; }
.bg-orange-soft { background: rgba(255, 193, 7, 0.1); }
.text-orange { color: #ffc107; }

@media (max-width: 768px) {
    .section { padding: 50px 0; }
    .impact-metric-value { font-size: 2.25rem; }
}
</style>
