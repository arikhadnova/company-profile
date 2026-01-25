<section class="section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <?php if (!empty($article)) : ?>
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>" class="text-decoration-none text-muted">Home</a></li>
                <?php if ($article->type == 'library') : ?>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>library" class="text-decoration-none text-muted">GoSirk Library</a></li>
                <?php else : ?>
                    <li class="breadcrumb-item"><a href="<?= BASE_URL ?>blog" class="text-decoration-none text-muted">Blog</a></li>
                <?php endif; ?>
                <li class="breadcrumb-item active text-dark fw-bold" aria-current="page">Detail</li>
              </ol>
            </nav>

            <!-- Article Header -->
            <div class="mb-5">
              <div class="d-flex align-items-center gap-3 mb-3">
                 <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase"><?= $article->category ?: 'Article'; ?></span>
                 <span class="text-muted small"><i class="far fa-calendar me-2"></i> <?= date('d F Y', strtotime($article->created_at)); ?></span>
              </div>
              <h1 class="fw-bold display-5 mb-4" data-lang-id="<?= $article->title_id; ?>" data-lang-en="<?= $article->title_en; ?>">
                  <?= $article->title_id; ?>
              </h1>
              
              <div class="d-flex align-items-center gap-3">
                  <img src="https://ui-avatars.com/api/?name=<?= urlencode($article->author ?: 'Admin'); ?>&background=random" class="rounded-circle" width="48" height="48" alt="Author">
                  <div>
                      <h6 class="fw-bold mb-0"><?= $article->author ?: 'Admin GoSirk'; ?></h6>
                      <small class="text-muted">Editorial Team</small>
                  </div>
              </div>
            </div>

            <!-- Featured Image -->
            <div class="mb-5 rounded-4 overflow-hidden shadow-sm">
                 <img src="<?= ASSETS_URL ?>img/blog/<?= $article->image ?>" onerror="this.src='https://images.unsplash.com/photo-1552664730-d307ca884978'" class="img-fluid w-100 object-fit-cover" style="max-height: 500px;" alt="<?= $article->title_id ?>">
            </div>

            <!-- Article Content -->
            <article class="blog-content fs-5 lh-lg text-dark mb-5" data-lang-id="<?= $article->content_id ?>" data-lang-en="<?= $article->content_en ?>">
              <?= $article->content_id ?>
            </article>

            <!-- Share & Tags -->
            <div class="d-flex flex-wrap justify-content-between align-items-center border-top border-bottom py-4 mb-5">
                <div class="mb-3 mb-md-0">
                    <span class="fw-bold me-2">Tags:</span>
                    <a href="#" class="badge bg-light text-secondary text-decoration-none border me-1">#<?= str_replace(' ', '', $article->category) ?></a>
                    <a href="#" class="badge bg-light text-secondary text-decoration-none border me-1">#Sustainability</a>
                    <a href="#" class="badge bg-light text-secondary text-decoration-none border">#GoSirk</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold me-2">Share:</span>
                    <?php 
                        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $encoded_url = urlencode($current_url);
                        $encoded_title = urlencode($article->title_id);
                    ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encoded_url ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center share-btn" style="width: 36px; height: 36px;"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?= $encoded_url ?>&text=<?= $encoded_title ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center share-btn" style="width: 36px; height: 36px;"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $encoded_url ?>" target="_blank" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center share-btn" style="width: 36px; height: 36px;"><i class="fab fa-linkedin-in"></i></a>
                    <a href="javascript:void(0)" onclick="copyLink()" class="btn btn-outline-secondary btn-sm rounded-circle d-flex align-items-center justify-content-center share-btn" style="width: 36px; height: 36px;" title="Copy Link"><i class="fas fa-link"></i></a>
                </div>
            </div>
        <?php else : ?>
            <div class="text-center py-5">
                <h2 class="text-muted">Article not found.</h2>
                <a href="<?= BASE_URL ?>blog" class="btn btn-primary mt-3">Back to Blog / Library</a>
            </div>
<?php endif; ?>

        <script>
        function copyLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('Link disalin ke clipboard!');
            }).catch(err => {
                console.error('Gagal menyalin link: ', err);
            });
        }
        </script>

        <style>
        .share-btn {
            transition: all 0.3s ease;
        }
        .share-btn:hover {
            background-color: #FF8F56 !important;
            border-color: #FF8F56 !important;
            color: white !important;
            transform: translateY(-3px);
        }
        .blog-content p { margin-bottom: 25px; }
        .blog-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 30px 0; }
        </style>
      </div>
    </div>
  </div>
</section>
