<div class="admin-header-section mb-4">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <span class="admin-header-badge d-inline-block text-uppercase">DASHBOARD / CAPACITY BUILDING / VIDEOS</span>
            <h1 class="fw-bold mb-0">Belajar Bersama GoSirk (GI Videos)</h1>
            <p class="text-muted small mb-0">Kelola video dan playlist yang ditampilkan di bagian "Belajar Bersama GoSirk".</p>
        </div>
        <a href="<?= BASE_URL; ?>admin/gi_videos_create" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
            <i class="fas fa-plus-circle me-2"></i> Tambah Video GI
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?php Flasher::flash(); ?>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4" style="width: 150px;">Thumbnail</th>
                    <th>Judul Video/Playlist</th>
                    <th>Tipe</th>
                    <th>URL YouTube</th>
                    <th class="text-center">Prioritas</th>
                    <th class="text-end pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($videos)) : ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted">Belum ada video GI.</div>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($videos as $v) : ?>
                        <tr>
                            <td class="ps-4">
                                <div class="rounded-3 overflow-hidden bg-light" style="width: 120px; height: 67px; position: relative;">
                                    <?php 
                                    $thumb_url = '';
                                    if ($v->thumbnail) {
                                        $thumb_url = ASSETS_URL . 'img/gi/videos/' . $v->thumbnail;
                                    } else {
                                        // Attempt to get YouTube thumbnail
                                        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $v->url, $match);
                                        $yt_id = isset($match[1]) ? $match[1] : null;
                                        if ($yt_id) {
                                            $thumb_url = "https://img.youtube.com/vi/$yt_id/mqdefault.jpg";
                                        }
                                    }
                                    ?>
                                    <?php if ($thumb_url) : ?>
                                        <img src="<?= $thumb_url; ?>" class="w-100 h-100 object-fit-cover">
                                    <?php else : ?>
                                        <div class="d-flex h-100 align-items-center justify-content-center text-muted">
                                            <i class="fas fa-play-circle fs-4"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="position-absolute bottom-0 end-0 p-1">
                                        <span class="badge bg-dark bg-opacity-75 extra-small">YT</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark"><?= $v->title_id; ?></div>
                                <div class="extra-small text-muted"><?= $v->title_en; ?></div>
                            </td>
                            <td>
                                <span class="badge <?= $v->type == 'highlight' ? 'bg-warning text-dark' : 'bg-info text-white' ?> border-0 px-2">
                                    <?= ucfirst($v->type); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= $v->url; ?>" target="_blank" class="small text-truncate d-inline-block" style="max-width: 200px;"><?= $v->url; ?></a>
                            </td>
                            <td class="text-center">
                                <?= $v->order_priority; ?>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= BASE_URL; ?>admin/gi_videos_edit/<?= $v->id; ?>" class="btn btn-sm btn-light text-primary rounded-circle" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Edit"><i class="fas fa-edit small"></i></a>
                                    <a href="<?= BASE_URL; ?>admin/gi_videos_delete/<?= $v->id; ?>" class="btn btn-sm btn-light text-danger rounded-circle btn-delete-confirm" style="width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" title="Hapus"><i class="fas fa-trash small"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
