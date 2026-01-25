<!-- Custom CSS for this page -->
<style>
    .doc-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .doc-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
        border-color: var(--bs-warning);
    }
    .doc-icon-wrapper {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        transition: all 0.3s ease;
    }
    .doc-card:hover .doc-icon-wrapper {
        background: linear-gradient(135deg, #fff3cd 0%, #ffecb5 100%);
    }
    .doc-card:hover .material-symbols-outlined.doc-icon {
        color: var(--bs-warning) !important;
    }
</style>

<section class="section py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
        <span class="badge bg-warning text-dark rounded-pill px-3 py-2 mb-3 fw-bold">COLLABORATION</span>
        <h2 class="fw-bold display-5 mb-3">EXECUTIVE SUMMARY</h2>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Pelajari lebih lanjut tentang inisiatif, pencapaian, dan rencana strategis kami melalui dokumen-dokumen berikut.
        </p>
    </div>
    
    <div class="row justify-content-center">
      <div class="col-lg-10">
        
        <?php if (empty($data['docs'])) : ?>
            <div class="text-center py-5">
                <i class="fas fa-file-invoice fs-1 text-muted mb-3"></i>
                <p class="text-muted">Belum ada dokumen yang tersedia saat ini.</p>
            </div>
        <?php else : ?>
            <?php foreach ($data['docs'] as $doc) : ?>
                <!-- Document Item -->
                <div class="card doc-card bg-white shadow-sm mb-4 rounded-4">
                <div class="card-body p-4">
                    <div class="row g-4 align-items-center">
                    <div class="col-md-3">
                        <div class="doc-icon-wrapper rounded-4 d-flex align-items-center justify-content-center h-100" style="min-height: 180px;">
                        <span class="material-symbols-outlined text-muted doc-icon" style="font-size: 64px;">description</span>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-primary border border-primary rounded-pill">Executive Summary</span>
                            <small class="text-muted"><i class="far fa-clock me-1"></i> Updated: <?= date('M Y', strtotime($doc->created_at)) ?></small>
                        </div>
                        <h3 class="fw-bold mb-3 text-dark"><?= $doc->title_id ?></h3>
                        <p class="text-muted mb-4 small">
                            Klik tombol di bawah ini untuk mendapatkan salinan dokumen ini melalui email Anda.
                        </p>
                        <div class="d-flex align-items-center flex-wrap gap-3">
                        <button type="button" class="btn btn-warning btn-md text-white rounded-pill px-5 shadow-sm" 
                                data-bs-toggle="modal" data-bs-target="#downloadModal" 
                                data-doc-title="<?= $doc->title_id ?>" 
                                data-doc-id="<?= $doc->id ?>">
                            <div class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined">download</span>
                                <span>Download Dokumen</span>
                            </div>
                        </button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>

      </div>
    </div>
  </div>
</section>

<!-- Request Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header border-bottom-0 pb-0">
        <h5 class="modal-title fw-bold" id="downloadModalLabel">Dapatkan Executive Summary Kami</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="mb-4 text-muted">Untuk mengunduh dokumen ini, mohon isi formulir berikut. Dokumen akan dikirimkan ke email Anda.</p>
        
        <div class="alert alert-warning d-flex align-items-center gap-2 mb-4" role="alert">
            <span class="material-symbols-outlined">folder_open</span>
            <div>
               Dokumen: <strong id="modalDocTitle">...</strong>
            </div>
        </div>

        <form id="downloadForm">
          <input type="hidden" name="doc_id" id="modalDocId">
          <div class="mb-3">
            <label for="dlName" class="form-label fw-bold small text-uppercase text-muted">Nama Lengkap</label>
            <input type="text" class="form-control bg-light border-0 py-2" id="dlName" placeholder="Masukkan nama Anda" required>
          </div>
          <div class="mb-3">
            <label for="dlEmail" class="form-label fw-bold small text-uppercase text-muted">Alamat Email</label>
            <input type="email" class="form-control bg-light border-0 py-2" id="dlEmail" placeholder="name@company.com" required>
          </div>
          <div class="mb-3">
            <label for="dlOrganization" class="form-label fw-bold small text-uppercase text-muted">Organisasi / Perusahaan</label>
            <input type="text" class="form-control bg-light border-0 py-2" id="dlOrganization" placeholder="Nama organisasi Anda" required>
          </div>
          <div class="mb-3">
            <label for="dlJabatan" class="form-label fw-bold small text-uppercase text-muted">Jabatan</label>
            <input type="text" class="form-control bg-light border-0 py-2" id="dlJabatan" placeholder="Posisi atau jabatan Anda" required>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-warning text-white fw-bold py-2 rounded-pill shadow-sm">
              Kirim
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    // Simple script to update modal title based on which button was clicked
    document.addEventListener('DOMContentLoaded', function () {
        var downloadModal = document.getElementById('downloadModal');
        downloadModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var docTitle = button.getAttribute('data-doc-title');
            var docId = button.getAttribute('data-doc-id');
            
            var modalTitle = downloadModal.querySelector('#modalDocTitle');
            var modalDocId = downloadModal.querySelector('#modalDocId');
            
            modalTitle.textContent = docTitle;
            modalDocId.value = docId;
        });

        const downloadForm = document.getElementById('downloadForm');
        downloadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalBtnHtml = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Mengirim...';

            const formData = new FormData();
            formData.append('doc_id', document.getElementById('modalDocId').value);
            formData.append('name', document.getElementById('dlName').value);
            formData.append('email', document.getElementById('dlEmail').value);
            formData.append('organization', document.getElementById('dlOrganization').value);
            formData.append('jabatan', document.getElementById('dlJabatan').value);

            fetch('<?= BASE_URL ?>collaboration/request', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#29b471'
                    }).then(() => {
                        const modal = bootstrap.Modal.getInstance(downloadModal);
                        modal.hide();
                        downloadForm.reset();
                    });
                } else {
                    Swal.fire({
                        title: 'Oops!',
                        text: data.message,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem.',
                    icon: 'error'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            });
        });
    });
</script>
