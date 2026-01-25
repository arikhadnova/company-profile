<?php
require_once dirname(dirname(__DIR__)) . '/app/core/Translator.php';

class Admin extends Controller {
    private $portfolioModel;
    private $articleModel;
    private $publicationModel;
    private $serviceModel;
    private $impactModel;
    private $partnerModel;
    private $userModel;
    private $settingModel;
    private $serviceItemModel;
    private $collaborationModel;
    private $heroModel;
    private $testimonialModel;
    private $contactModel;
    private $giServiceModel;
    private $faqModel;
    private $giVideoModel;

    public function __construct() {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: ' . BASE_URL . 'auth');
            exit;
        }
        $this->portfolioModel = $this->model('Portfolio_model');
        $this->articleModel = $this->model('Article_model');
        $this->publicationModel = $this->model('Publication_model');
        $this->serviceModel = $this->model('Service_model');
        $this->impactModel = $this->model('Impact_model');
        $this->partnerModel = $this->model('Partner_model');
        $this->userModel = $this->model('User_model');
        $this->settingModel = $this->model('Setting_model');
        $this->serviceItemModel = $this->model('ServiceItem_model');
        $this->collaborationModel = $this->model('Collaboration_model');
        $this->heroModel = $this->model('Hero_model');
        $this->testimonialModel = $this->model('Testimonial_model');
        $this->contactModel = $this->model('Contact_model');
        $this->giServiceModel = $this->model('GiService_model');
        $this->faqModel = $this->model('Faq_model');
        $this->giVideoModel = $this->model('GiVideo_model');

        // Auto-initialize settings table
        $db = new Database();
        $db->query("CREATE TABLE IF NOT EXISTS `settings` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `setting_key` varchar(100) NOT NULL,
          `setting_value` text DEFAULT NULL,
          `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
          PRIMARY KEY (`id`),
          UNIQUE KEY `setting_key` (`setting_key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        $db->execute();
    }

    public function index() {
        $contactModel = $this->model('Contact_model');
        
        // Fetch document requests (Limit 10)
        $requests = $this->collaborationModel->getAllRequests();
        $requests = array_slice($requests, 0, 10);
        foreach($requests as $r) {
            $r->activity_type = 'request';
            $r->timestamp = strtotime($r->requested_at);
        }

        // Fetch recent articles (Limit 5)
        $articles = $this->articleModel->getAll();
        $articles = array_slice($articles, 0, 5);
        foreach($articles as $a) {
            $a->activity_type = 'article';
            $a->timestamp = strtotime($a->created_at);
        }

        // Fetch recent messages (Limit 5)
        $messages = $contactModel->getAll();
        $messages = array_slice($messages, 0, 5);
        foreach($messages as $m) {
            $m->activity_type = 'message';
            $m->timestamp = strtotime($m->created_at);
        }

        // Merge and sort activities
        $activities = array_merge($requests, $articles, $messages);
        usort($activities, function($a, $b) {
            return $b->timestamp - $a->timestamp;
        });
        
        // Take top 15
        $activities = array_slice($activities, 0, 15);

        $data = [
            'title' => 'Admin Dashboard',
            'active' => 'dashboard',
            'activities' => $activities,
            'counts' => [
                'doc_requests' => count($this->collaborationModel->getAllRequests()),
                'articles' => count($this->articleModel->getAll()),
                'publications' => count($this->publicationModel->getAll()),
                'partners' => count($this->partnerModel->getAll()),
                'documents' => count($this->collaborationModel->getAllDocuments()),
                'unread_messages' => $contactModel->getUnreadCount(),
                'total_visitors' => $this->model('Visitor_model')->getTotalCount(),
                'visitor_stats' => $this->model('Visitor_model')->getMonthlyStats()
            ]
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/dashboard', $data);
        $this->views('layouts/admin_footer');
    }

    public function profile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_SESSION['user_id'];
            $user = $this->userModel->getUserById($user_id);

            // Check if it's personal info or security update
            if (isset($_POST['name']) && isset($_POST['username'])) {
                // Personal Information Update
                $data = [
                    'name' => $_POST['name'],
                    'username' => $_POST['username']
                ];

                if ($this->userModel->updateProfile($user_id, $data)) {
                    $_SESSION['user_name'] = $data['name']; // Update session name
                    Flasher::setFlash('Profil', 'berhasil diperbarui', 'success');
                } else {
                    Flasher::setFlash('Profil', 'gagal diperbarui', 'danger');
                }
            } elseif (isset($_POST['current_password'])) {
                // Security Update
                $current = $_POST['current_password'];
                $new = $_POST['new_password'];
                $confirm = $_POST['confirm_password'];

                if (password_verify($current, $user->password)) {
                    if ($new === $confirm) {
                        if (strlen($new) >= 8) {
                            $data = [
                                'name' => $user->name,
                                'username' => $user->username,
                                'password' => $new
                            ];
                            if ($this->userModel->updateProfile($user_id, $data)) {
                                Flasher::setFlash('Password', 'berhasil diperbarui', 'success');
                            } else {
                                Flasher::setFlash('Password', 'gagal diperbarui', 'danger');
                            }
                        } else {
                            Flasher::setFlash('Password baru', 'minimal 8 karakter', 'danger');
                        }
                    } else {
                        Flasher::setFlash('Konfirmasi password', 'tidak cocok', 'danger');
                    }
                } else {
                    Flasher::setFlash('Password saat ini', 'salah', 'danger');
                }
            }
            header('Location: ' . BASE_URL . 'admin/profile');
            exit;
        }

        $data = [
            'title' => 'Manage Profile',
            'active' => 'profile',
            'user' => $this->userModel->getUserById($_SESSION['user_id'])
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/profile', $data);
        $this->views('layouts/admin_footer');
    }

    public function settings() {
        $data = [
            'title' => 'Layout Settings',
            'active' => 'settings',
            'settings' => $this->settingModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/settings_layout', $data);
        $this->views('layouts/admin_footer');
    }

    public function update_header() {
        $site_title = $_POST['site_title'] ?? '';
        $this->settingModel->update('site_title', $site_title);
        
        // Handle Logo Upload if any
        if (!empty($_FILES['logo_file']['name'])) {
            $newLogo = Upload::file($_FILES['logo_file'], 'img');
            if ($newLogo) {
                // Optional: Delete old logo if it's not the default one
                $oldLogo = $this->settingModel->getByKey('site_logo');
                if ($oldLogo && $oldLogo != 'Logo-GoSirk-01.png') {
                    Upload::delete($oldLogo, 'img');
                }
                $this->settingModel->update('site_logo', $newLogo);
            }
        }
        
        Flasher::setFlash('Header', 'berhasil diperbarui', 'success');
        header('Location: ' . BASE_URL . 'admin/settings');
        exit;
    }

    public function update_footer() {
        $footer_data = [
            'footer_copyright' => $_POST['footer_text'] ?? '',
            'address_hq' => $_POST['address_hq'] ?? '',
            'address_branch' => $_POST['address_branch'] ?? '',
            'contact_email' => $_POST['contact_email'] ?? '',
            'social_facebook' => $_POST['social_facebook'] ?? '',
            'social_instagram' => $_POST['social_instagram'] ?? '',
            'social_linkedin' => $_POST['social_linkedin'] ?? '',
            'social_youtube' => $_POST['social_youtube'] ?? ''
        ];
        
        foreach ($footer_data as $key => $value) {
            $this->settingModel->update($key, $value);
        }
        
        Flasher::setFlash('Footer', 'berhasil diperbarui', 'success');
        header('Location: ' . BASE_URL . 'admin/settings');
        exit;
    }

    public function hero() {
        $heroes = $this->heroModel->getAll();
        $hero_data = [];
        foreach ($heroes as $h) {
            $hero_data[$h->page_name] = $h;
        }

        $data = [
            'title' => 'Manage Hero',
            'active' => 'hero',
            'heroes' => $hero_data
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/hero', $data);
        $this->views('layouts/admin_footer');
    }

    public function update_hero() {
        $page = $_POST['page_name'] ?? '';
        if (!$page) {
            header('Location: ' . BASE_URL . 'admin/hero');
            exit;
        }

        $data = [
            'tag_id' => $_POST['tag_id'] ?? '',
            'tag_en' => ($_POST['tag_en'] ?? '') ?: Translator::translate($_POST['tag_id'] ?? ''),
            'title_id' => $_POST['title_id'] ?? '',
            'title_en' => ($_POST['title_en'] ?? '') ?: Translator::translate($_POST['title_id'] ?? ''),
            'subtitle_id' => $_POST['subtitle_id'] ?? '',
            'subtitle_en' => ($_POST['subtitle_en'] ?? '') ?: Translator::translate($_POST['subtitle_id'] ?? '')
        ];

        // Handle Image Upload
        if (!empty($_FILES['hero_image']['name'])) {
            $newImage = Upload::file($_FILES['hero_image'], 'img');
            if ($newImage) {
                // Delete old image if it's not a URL and not a default asset
                $oldHero = $this->heroModel->getByPage($page);
                if ($oldHero && $oldHero->image && !filter_var($oldHero->image, FILTER_VALIDATE_URL)) {
                    // Check if it's not a seeded default image that might be shared
                    $defaults = ['hero-bg.jpg', 'IMG_8084.jpg', 'IMG_8082.jpg'];
                    if (!in_array($oldHero->image, $defaults)) {
                        Upload::delete($oldHero->image, 'img');
                    }
                }
                $data['image'] = $newImage;
            }
        }

        if ($this->heroModel->update($page, $data)) {
            Flasher::setFlash('Hero ' . ucfirst($page), 'berhasil diperbarui', 'success');
        } else {
            Flasher::setFlash('Hero ' . ucfirst($page), 'gagal diperbarui', 'danger');
        }

        header('Location: ' . BASE_URL . 'admin/hero');
        exit;
    }

    public function portfolio($action = null, $id = null) {
        if ($action === 'create') return $this->portfolio_create();
        if ($action === 'edit' && $id) return $this->portfolio_edit($id);
        $data = [
            'title' => 'Manage Portfolio',
            'active' => 'portfolio',
            'portfolios' => $this->portfolioModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/portfolio', $data);
        $this->views('layouts/admin_footer');
    }

    public function portfolio_create() {
        $data = [
            'title' => 'Tambah Portofolio Baru',
            'active' => 'portfolio'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/portfolio_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function portfolio_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'title_id' => ['required', 'min:5'],
                'main_category' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input portofolio', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $cover_image = Upload::file($_FILES['cover_image'], 'img/portfolio');

            $data = [
                'title_id' => $_POST['title_id'],
                'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                'subtitle_id' => $_POST['subtitle_id'],
                'subtitle_en' => $_POST['subtitle_en'] ?: Translator::translate($_POST['subtitle_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'icon_name' => $_POST['icon_name'],
                'cover_image' => $cover_image ?: '',
                'main_category' => $_POST['main_category'],
                'home_category' => $_POST['home_category'] ?? NULL,
                'partnership_category' => $_POST['partnership_category'] ?? NULL,
                'gi_category' => $_POST['gi_category'] ?? NULL,
                'partner_type' => $_POST['partner_type'],
                'year_start' => $_POST['year_start'],
                'year_end' => $_POST['year_end'],
                'show_home' => isset($_POST['show_home']) ? 1 : 0,
                'show_partnership' => isset($_POST['show_partnership']) ? 1 : 0,
                'show_gi' => isset($_POST['show_gi']) ? 1 : 0,
                'client_name' => $_POST['client_name'],
                'tags' => $_POST['tags']
            ];

            if ($this->portfolioModel->add($data)) {
                Flasher::setFlash('Portofolio', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/portfolio');
            } else {
                Flasher::setFlash('Portofolio', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/portfolio');
            }
        }
    }

    public function portfolio_edit($id) {
        $data = [
            'title' => 'Edit Portofolio',
            'active' => 'portfolio',
            'portfolio' => $this->portfolioModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/portfolio_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function portfolio_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $old_portfolio = $this->portfolioModel->getById($id);
            $cover_image = $old_portfolio->cover_image;

            if (!empty($_FILES['cover_image']['name'])) {
                $new_image = Upload::file($_FILES['cover_image'], 'img/portfolio');
                if ($new_image) {
                    Upload::delete($old_portfolio->cover_image, 'img/portfolio');
                    $cover_image = $new_image;
                }
            }

            $data = [
                'id' => $id,
                'title_id' => $_POST['title_id'],
                'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                'subtitle_id' => $_POST['subtitle_id'],
                'subtitle_en' => $_POST['subtitle_en'] ?: Translator::translate($_POST['subtitle_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'icon_name' => $_POST['icon_name'],
                'cover_image' => $cover_image,
                'main_category' => $_POST['main_category'],
                'home_category' => $_POST['home_category'] ?? NULL,
                'partnership_category' => $_POST['partnership_category'] ?? NULL,
                'gi_category' => $_POST['gi_category'] ?? NULL,
                'partner_type' => $_POST['partner_type'],
                'year_start' => $_POST['year_start'],
                'year_end' => $_POST['year_end'],
                'show_home' => isset($_POST['show_home']) ? 1 : 0,
                'show_partnership' => isset($_POST['show_partnership']) ? 1 : 0,
                'show_gi' => isset($_POST['show_gi']) ? 1 : 0,
                'client_name' => $_POST['client_name'],
                'tags' => $_POST['tags']
            ];

            if ($this->portfolioModel->update($data)) {
                Flasher::setFlash('Portofolio', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/portfolio');
            } else {
                Flasher::setFlash('Portofolio', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/portfolio');
            }
        }
    }

    public function portfolio_delete($id) {
        $portfolio = $this->portfolioModel->getById($id);
        if ($portfolio) {
            Upload::delete($portfolio->cover_image, 'img/portfolio');
        }

        if ($this->portfolioModel->delete($id)) {
            Flasher::setFlash('Portofolio', 'berhasil dihapus', 'success');
            header('Location: ' . BASE_URL . 'admin/portfolio');
        } else {
            Flasher::setFlash('Portofolio', 'gagal dihapus', 'danger');
            header('Location: ' . BASE_URL . 'admin/portfolio');
        }
    }

    public function articles($action = null, $id = null) {
        if ($action === 'create') return $this->articles_create('blog');
        if ($action === 'edit' && $id) return $this->articles_edit($id);
        $data = [
            'title' => 'Manage Blog Articles',
            'active' => 'articles',
            'articles' => $this->articleModel->getByType('blog')
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/articles', $data);
        $this->views('layouts/admin_footer');
    }

    public function library($action = null, $id = null) {
        if ($action === 'create') return $this->articles_create('library');
        if ($action === 'edit' && $id) return $this->articles_edit($id);
        $data = [
            'title' => 'Manage Library Resources',
            'active' => 'library',
            'articles' => $this->articleModel->getByType('library')
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/articles', $data);
        $this->views('layouts/admin_footer');
    }

    public function articles_create($type = 'blog') {
        $data = [
            'title' => ($type == 'blog' ? 'Tambah Artikel Blog' : 'Tambah Library Resource'), 
            'active' => ($type == 'blog' ? 'articles' : 'library'),
            'type' => $type
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/articles_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function articles_edit($id) {
        $article = $this->articleModel->getById($id);
        $data = [
            'title' => 'Edit Artikel',
            'active' => ($article->type == 'blog' ? 'articles' : 'library'),
            'article' => $article
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/articles_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function articles_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $id = $_POST['id'];

                // Validation
                $rules = [
                    'title_id' => ['required', 'min:5'],
                    'content_id' => ['required']
                ];
                $errors = Validator::validate($_POST, $rules);

                if (!empty($errors)) {
                    Flasher::setFlash('input artikel', 'tidak valid', 'danger', $errors);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                $old_article = $this->articleModel->getById($id);
                if (!$old_article) {
                    Flasher::setFlash('Artikel', 'tidak ditemukan', 'danger');
                    header('Location: ' . BASE_URL . 'admin/articles');
                    exit;
                }

                $image = $old_article->image;

                if (!empty($_FILES['image']['name'])) {
                    $new_image = Upload::file($_FILES['image'], 'img/blog');
                    if ($new_image) {
                        Upload::delete($old_article->image, 'img/blog');
                        $image = $new_image;
                    } else {
                        Flasher::setFlash('Gambar', 'gagal diunggah (Cek ukuran maks 2MB)', 'warning');
                    }
                }

                // Handle Translation safely
                $title_en = $_POST['title_en'];
                if (empty($title_en)) {
                    $title_en = Translator::translate($_POST['title_id']);
                }

                $content_en = $_POST['content_en'];
                if (empty($content_en)) {
                    // Only auto-translate if content is not too long to avoid API failures
                    if (strlen($_POST['content_id']) < 3000) {
                        $content_en = Translator::translate($_POST['content_id']);
                    } else {
                        $content_en = $_POST['content_id']; // Fallback to ID content
                    }
                }

                $data = [
                    'id' => $id,
                    'title_id' => $_POST['title_id'],
                    'title_en' => $title_en,
                    'content_id' => $_POST['content_id'],
                    'content_en' => $content_en,
                    'image' => $image,
                    'category' => $_POST['category'],
                    'tags' => $_POST['tags'],
                    'slug' => str_replace([' ', '/', '\\', '?', '#', '&'], '-', strtolower($title_en)),
                    'author' => 'Admin',
                    'status' => $_POST['status'],
                    'type' => $_POST['type']
                ];

                if ($this->articleModel->update($data)) {
                    $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                    Flasher::setFlash('Artikel', 'berhasil diperbarui', 'success');
                    header('Location: ' . BASE_URL . $redirect);
                    exit;
                } else {
                    throw new Exception("Database update returned false.");
                }
            } catch (Exception $e) {
                $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                Flasher::setFlash('Gagal memperbarui artikel', $e->getMessage(), 'danger');
                header('Location: ' . BASE_URL . $redirect);
                exit;
            }
        }
    }

    public function articles_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Validation
                $rules = [
                    'title_id' => ['required', 'min:5'],
                    'content_id' => ['required']
                ];
                $errors = Validator::validate($_POST, $rules);

                if (!empty($errors)) {
                    Flasher::setFlash('input artikel', 'tidak valid', 'danger', $errors);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                $image = '';
                if (!empty($_FILES['image']['name'])) {
                    $image = Upload::file($_FILES['image'], 'img/blog');
                    if (!$image) {
                        Flasher::setFlash('Gambar', 'gagal diunggah (Cek ukuran maks 2MB)', 'warning');
                    }
                }

                $title_en = $_POST['title_en'];
                if (empty($title_en)) {
                    $title_en = Translator::translate($_POST['title_id']);
                }

                $content_en = $_POST['content_en'];
                if (empty($content_en)) {
                    if (strlen($_POST['content_id']) < 3000) {
                        $content_en = Translator::translate($_POST['content_id']);
                    } else {
                        $content_en = $_POST['content_id'];
                    }
                }

                $data = [
                    'title_id' => $_POST['title_id'],
                    'title_en' => $title_en,
                    'content_id' => $_POST['content_id'],
                    'content_en' => $content_en,
                    'image' => $image ?: '',
                    'category' => $_POST['category'],
                    'tags' => $_POST['tags'],
                    'slug' => str_replace([' ', '/', '\\', '?', '#', '&'], '-', strtolower($title_en)),
                    'status' => $_POST['status'],
                    'type' => $_POST['type']
                ];

                if ($this->articleModel->add($data)) {
                    $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                    Flasher::setFlash('Artikel', 'berhasil ditambahkan', 'success');
                    header('Location: ' . BASE_URL . $redirect);
                    exit;
                } else {
                    throw new Exception("Database insert returned false.");
                }
            } catch (Exception $e) {
                $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                Flasher::setFlash('Gagal menambahkan artikel', $e->getMessage(), 'danger');
                header('Location: ' . BASE_URL . $redirect);
                exit;
            }
        }
    }

    public function articles_delete($id) {
        $article = $this->articleModel->getById($id);
        $type = $article->type ?? 'blog';
        if ($article) {
            Upload::delete($article->image, 'img/blog');
        }

        if ($this->articleModel->delete($id)) {
            Flasher::setFlash('Artikel', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Artikel', 'gagal dihapus', 'danger');
        }
        $redirect = ($type == 'blog' ? 'admin/articles' : 'admin/library');
        header('Location: ' . BASE_URL . $redirect);
        exit;
    }

    public function publications($action = null, $id = null) {
        if ($action === 'create') return $this->publications_create();
        if ($action === 'edit' && $id) return $this->publications_edit($id);
        $data = [
            'title' => 'Manage Publications',
            'active' => 'publications',
            'publications' => $this->publicationModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/publications', $data);
        $this->views('layouts/admin_footer');
    }

    public function publications_create() {
        $data = ['title' => 'Tambah Publikasi Baru', 'active' => 'publications'];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/publications_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function publications_edit($id) {
        $data = [
            'title' => 'Edit Publikasi',
            'active' => 'publications',
            'publication' => $this->publicationModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/publications_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function publications_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            // Validation
            $rules = [
                'title_id' => ['required', 'min:5'],
                'type' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input publikasi', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $old = $this->publicationModel->getById($id);
            $thumbnail = $old->thumbnail;
            $file_path = $old->file_path;
            $preview_path = $old->preview_path;

            if (!empty($_FILES['thumbnail']['name'])) {
                $new_thumb = Upload::file($_FILES['thumbnail'], 'img/publications');
                if ($new_thumb) {
                    Upload::delete($old->thumbnail, 'img/publications');
                    $thumbnail = $new_thumb;
                }
            }

            if (!empty($_FILES['file_path']['name'])) {
                $new_file = Upload::file($_FILES['file_path'], 'docs', ['pdf']);
                if ($new_file) {
                    Upload::delete($old->file_path, 'docs');
                    $file_path = $new_file;
                }
            }

            if (!empty($_FILES['preview_path']['name'])) {
                $new_preview = Upload::file($_FILES['preview_path'], 'docs', ['pdf']);
                if ($new_preview) {
                    Upload::delete($old->preview_path, 'docs');
                    $preview_path = $new_preview;
                }
            }

            $data = [
                'id' => $id,
                'title_id' => $_POST['title_id'],
                'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                'type' => $_POST['type'],
                'file_path' => $file_path,
                'preview_path' => $preview_path,
                'thumbnail' => $thumbnail,
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'external_link' => $_POST['external_link'] ?? '',
                'is_paid' => isset($_POST['is_paid']) ? 1 : 0,
                'price' => $_POST['price'] ?? 0
            ];

            if ($this->publicationModel->update($data)) {
                Flasher::setFlash('Publikasi', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/publications');
                exit;
            } else {
                Flasher::setFlash('Publikasi', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/publications');
                exit;
            }
        }
    }

    public function publications_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'title_id' => ['required', 'min:5'],
                'type' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input publikasi', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $thumbnail = Upload::file($_FILES['thumbnail'], 'img/publications');
            $file_path = Upload::file($_FILES['file_path'], 'docs', ['pdf']);
            $preview_path = Upload::file($_FILES['preview_path'], 'docs', ['pdf']);

            $data = [
                'title_id' => $_POST['title_id'],
                'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                'type' => $_POST['type'],
                'file_path' => $file_path ?: '',
                'preview_path' => $preview_path ?: '',
                'thumbnail' => $thumbnail ?: '',
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'external_link' => $_POST['external_link'] ?? '',
                'is_paid' => isset($_POST['is_paid']) ? 1 : 0,
                'price' => $_POST['price'] ?? 0
            ];

            if ($this->publicationModel->add($data)) {
                Flasher::setFlash('Publikasi', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/publications');
                exit;
            } else {
                Flasher::setFlash('Publikasi', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/publications');
                exit;
            }
        }
    }

    public function publications_delete($id) {
        $pub = $this->publicationModel->getById($id);
        if ($pub) {
            Upload::delete($pub->thumbnail, 'img/publications');
            Upload::delete($pub->file_path, 'docs');
        }

        if ($this->publicationModel->delete($id)) {
            Flasher::setFlash('Publikasi', 'berhasil dihapus', 'success');
            header('Location: ' . BASE_URL . 'admin/publications');
            exit;
        } else {
            Flasher::setFlash('Publikasi', 'gagal dihapus', 'danger');
            header('Location: ' . BASE_URL . 'admin/publications');
            exit;
        }
    }

    public function services($action = null, $id = null) {
        if ($action === 'create') return $this->services_create();
        if ($action === 'edit' && $id) return $this->services_edit($id);
        $data = [
            'title' => 'Manage Services',
            'active' => 'services',
            'services' => $this->serviceModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/services', $data);
        $this->views('layouts/admin_footer');
    }

    public function services_create() {
        $data = ['title' => 'Tambah Layanan Baru', 'active' => 'services'];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/services_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function services_edit($id) {
        $data = [
            'title' => 'Edit Layanan',
            'active' => 'services',
            'service' => $this->serviceModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/services_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function services_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'name_id' => ['required'],
                'name_en' => ['required'],
                'icon' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input layanan', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $data = [
                'name_id' => $_POST['name_id'],
                'name_en' => $_POST['name_en'] ?: Translator::translate($_POST['name_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'icon' => $_POST['icon'],
                'order_priority' => $_POST['order_priority']
            ];

            if ($this->serviceModel->add($data)) {
                Flasher::setFlash('Layanan', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/services');
            } else {
                Flasher::setFlash('Layanan', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/services');
            }
        }
    }

    public function services_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'name_id' => ['required'],
                'name_en' => ['required'],
                'icon' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input layanan', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $data = [
                'id' => $_POST['id'],
                'name_id' => $_POST['name_id'],
                'name_en' => $_POST['name_en'] ?: Translator::translate($_POST['name_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'icon' => $_POST['icon'],
                'order_priority' => $_POST['order_priority']
            ];

            if ($this->serviceModel->update($data)) {
                Flasher::setFlash('Layanan', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/services');
            } else {
                Flasher::setFlash('Layanan', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/services');
            }
        }
    }

    public function services_delete($id) {
        if ($this->serviceModel->delete($id)) {
            Flasher::setFlash('Layanan', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Layanan', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/services');
        exit;
    }

    // --- GRANULAR SERVICE ITEMS (CB, PD, CS) ---

    public function services_cb() {
        return $this->gi_services();
    }

    public function services_pd() {
        $data['title'] = 'Program Development & Implementation';
        $data['category'] = 'pd';
        $data['items'] = $this->serviceItemModel->getByCategory('pd');
        $this->views('layouts/admin_header', $data);
        $this->views('admin/service_items', $data);
        $this->views('layouts/admin_footer');
    }

    public function services_cs() {
        $data['title'] = 'Consultancy & Strategic Advisory';
        $data['category'] = 'cs';
        $data['items'] = $this->serviceItemModel->getByCategory('cs');
        $this->views('layouts/admin_header', $data);
        $this->views('admin/service_items', $data);
        $this->views('layouts/admin_footer');
    }

    public function service_item_create($category) {
        $data['title'] = 'Tambah Item Layanan';
        $data['category'] = $category;
        $this->views('layouts/admin_header', $data);
        $this->views('admin/service_item_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function service_item_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['title_en'] = $_POST['title_en'] ?: Translator::translate($_POST['title_id']);
            $_POST['description_en'] = $_POST['description_en'] ?: Translator::translate($_POST['description_id']);
            
            if ($this->serviceItemModel->add($_POST)) {
                Flasher::setFlash('Item layanan', 'berhasil ditambahkan', 'success');
            } else {
                Flasher::setFlash('Item layanan', 'gagal ditambahkan', 'danger');
            }
            $category = $_POST['category'];
            header('Location: ' . BASE_URL . 'admin/services_' . $category);
            exit;
        }
    }

    public function service_item_edit($id) {
        $data['item'] = $this->serviceItemModel->getById($id);
        $data['title'] = 'Edit Item Layanan';
        $this->views('layouts/admin_header', $data);
        $this->views('admin/service_item_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function service_item_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['title_en'] = $_POST['title_en'] ?: Translator::translate($_POST['title_id']);
            $_POST['description_en'] = $_POST['description_en'] ?: Translator::translate($_POST['description_id']);

            if ($this->serviceItemModel->update($_POST)) {
                Flasher::setFlash('Item layanan', 'berhasil diperbarui', 'success');
            } else {
                Flasher::setFlash('Item layanan', 'gagal diperbarui', 'danger');
            }
            $category = $_POST['category'];
            header('Location: ' . BASE_URL . 'admin/services_' . $category);
            exit;
        }
    }

    public function service_item_delete($id) {
        $item = $this->serviceItemModel->getById($id);
        $category = $item->category;
        if ($this->serviceItemModel->delete($id)) {
            Flasher::setFlash('Item layanan', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Item layanan', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/services_' . $category);
        exit;
    }

    public function impact($action = null, $id = null) {
        if ($action === 'create') return $this->impact_create();
        if ($action === 'edit' && $id) return $this->impact_edit($id);

        // Auto-Sync Slots (Ensure 4 per page)
        $pagesList = ['home', 'gi', 'ggc', 'partnership', 'implementasi', 'konsultan'];
        foreach ($pagesList as $p) {
            $existingCount = count($this->impactModel->getByPage($p));
            if ($existingCount < 4) {
                $needed = 4 - $existingCount;
                for ($i = 0; $i < $needed; $i++) {
                    $this->impactModel->add([
                        'label_id' => 'Data Kosong',
                        'label_en' => 'Empty Slot',
                        'value' => '0',
                        'unit' => '',
                        'icon' => 'fas fa-info-circle',
                        'page' => $p
                    ]);
                }
            }
        }
        
        $allImpacts = $this->impactModel->getAll();
        $grouped = [
            'home' => [],
            'gi' => [],
            'ggc' => [],
            'partnership' => [],
            'implementasi' => [],
            'konsultan' => []
        ];
        
        foreach ($allImpacts as $imp) {
            if (isset($grouped[$imp->page])) {
                $grouped[$imp->page][] = $imp;
            }
        }

        $data = [
            'title' => 'Manage Impact Data',
            'active' => 'impact',
            'grouped_impacts' => $grouped
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/impact', $data);
        $this->views('layouts/admin_footer');
    }

    public function impact_create() {
        $data = [
            'title' => 'Add Impact Data',
            'active' => 'impact',
            'selected_page' => $_GET['page'] ?? 'home'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/impact_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function impact_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check limit (max 4 per page)
            $existing = $this->impactModel->getByPage($_POST['page']);
            if (count($existing) >= 4) {
                Flasher::setFlash('Gagal', 'Halaman ' . $_POST['page'] . ' sudah mencapai batas maksimal 4 data dampak', 'danger');
                header('Location: ' . BASE_URL . 'admin/impact');
                exit;
            }

            $rules = [
                'label_id' => ['required'],
                'value' => ['required'],
                'icon' => ['required'],
                'page' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input data dampak', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $data = [
                'label_id' => $_POST['label_id'],
                'label_en' => $_POST['label_en'] ?: Translator::translate($_POST['label_id']),
                'value' => $_POST['value'],
                'unit' => $_POST['unit'],
                'icon' => $_POST['icon'],
                'page' => $_POST['page']
            ];

            if ($this->impactModel->add($data)) {
                Flasher::setFlash('Data Dampak', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/impact');
            } else {
                Flasher::setFlash('Data Dampak', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/impact');
            }
        }
    }

    public function impact_edit($id) {
        $data = [
            'title' => 'Edit Data Dampak',
            'active' => 'impact',
            'impact' => $this->impactModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/impact_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function impact_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if page is changing and if new page is full
            $oldData = $this->impactModel->getById($_POST['id']);
            if ($oldData->page != $_POST['page']) {
                $existing = $this->impactModel->getByPage($_POST['page']);
                if (count($existing) >= 4) {
                    Flasher::setFlash('Gagal Pindah', 'Halaman tujuan ' . $_POST['page'] . ' sudah penuh (maksimal 4 data dampak)', 'danger');
                    header('Location: ' . BASE_URL . 'admin/impact');
                    exit;
                }
            }

            // Validation
            $rules = [
                'label_id' => ['required'],
                'value' => ['required'],
                'icon' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input data dampak', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $data = [
                'id' => $_POST['id'],
                'label_id' => $_POST['label_id'],
                'label_en' => $_POST['label_en'] ?: Translator::translate($_POST['label_id']),
                'value' => $_POST['value'],
                'unit' => $_POST['unit'],
                'icon' => $_POST['icon'],
                'page' => $_POST['page']
            ];

            if ($this->impactModel->update($data)) {
                Flasher::setFlash('Data Dampak', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/impact');
            } else {
                Flasher::setFlash('Data Dampak', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/impact');
            }
        }
    }

    public function impact_delete($id) {
        if ($this->impactModel->delete($id)) {
            Flasher::setFlash('Data Dampak', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Data Dampak', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/impact');
    }

    public function partners($action = null, $id = null) {
        if ($action === 'create') return $this->partners_create();
        if ($action === 'edit' && $id) return $this->partners_edit($id);
        $data = [
            'title' => 'Manage Partners',
            'active' => 'partners',
            'partners' => $this->partnerModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/partners', $data);
        $this->views('layouts/admin_footer');
    }

    public function partners_create() {
        $data = ['title' => 'Tambah Partner Baru', 'active' => 'partners'];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/partners_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function partners_edit($id) {
        $data = [
            'title' => 'Edit Partner',
            'active' => 'partners',
            'partner' => $this->partnerModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/partners_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function partners_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'name' => ['required', 'min:3'],
                'type' => ['required'],
                'category' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input partner', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $logo = '';
            if (!empty($_FILES['logo']['name'])) {
                $uploadResult = Upload::file($_FILES['logo'], 'img/partners');
                if ($uploadResult) {
                    $logo = $uploadResult;
                }
            }

            $data = [
                'name' => $_POST['name'],
                'logo' => $logo,
                'type' => $_POST['type'],
                'category' => $_POST['category']
            ];

            if ($this->partnerModel->add($data)) {
                Flasher::setFlash('Partner', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/partners');
            } else {
                Flasher::setFlash('Partner', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/partners');
            }
        }
    }

    public function partners_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            // Validation
            $rules = [
                'name' => ['required', 'min:3'],
                'type' => ['required'],
                'category' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input partner', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $old = $this->partnerModel->getById($id);
            $logo = $old->logo;

            if (!empty($_FILES['logo']['name'])) {
                $new_logo = Upload::file($_FILES['logo'], 'img/partners');
                if ($new_logo) {
                    Upload::delete($old->logo, 'img/partners');
                    $logo = $new_logo;
                }
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'logo' => $logo,
                'type' => $_POST['type'],
                'category' => $_POST['category']
            ];

            if ($this->partnerModel->update($data)) {
                Flasher::setFlash('Partner', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/partners');
            } else {
                Flasher::setFlash('Partner', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/partners');
            }
        }
    }

    public function partners_delete($id) {
        $partner = $this->partnerModel->getById($id);
        if ($partner) {
            Upload::delete($partner->logo, 'img/partners');
        }

        if ($this->partnerModel->delete($id)) {
            Flasher::setFlash('Partner', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Partner', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/partners');
    }

    /* --- Collaboration Documents --- */

    public function collaboration($action = null, $id = null) {
        $data = [
            'title' => 'Manage Collaboration Documents',
            'active' => 'collaboration',
            'docs' => $this->collaborationModel->getAllDocuments()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/collaboration/index', $data);
        $this->views('layouts/admin_footer');
    }

    public function collaboration_create() {
        $data = [
            'title' => 'Add Collaboration Document',
            'active' => 'collaboration'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/collaboration/create', $data);
        $this->views('layouts/admin_footer');
    }

    public function collaboration_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $file = $_FILES['document'];
            $file_name = Upload::file($file, 'documents', ['pdf'], realpath(__DIR__ . '/../storage'));

            if ($file_name) {
                $data = [
                    'title_id' => $_POST['title_id'],
                    'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                    'type' => $_POST['type'],
                    'file_path' => $file_name,
                    'status' => $_POST['status']
                ];

                if ($this->collaborationModel->addDocument($data)) {
                    Flasher::setFlash('Dokumen', 'berhasil ditambahkan', 'success');
                    header('Location: ' . BASE_URL . 'admin/collaboration');
                    exit;
                }
            }
            
            Flasher::setFlash('Dokumen', 'gagal ditambahkan', 'danger');
            header('Location: ' . BASE_URL . 'admin/collaboration');
        }
    }

    public function collaboration_edit($id) {
        $data = [
            'title' => 'Edit Collaboration Document',
            'active' => 'collaboration',
            'doc' => $this->collaborationModel->getDocumentById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/collaboration/edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function collaboration_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $old_file = $_POST['old_file'];
            $file = $_FILES['document'];

            if ($file['error'] === 0) {
                $file_name = Upload::file($file, 'documents', ['pdf'], realpath(__DIR__ . '/../storage'));
                if ($file_name) {
                    Upload::delete($old_file, 'documents', realpath(__DIR__ . '/../storage'));
                }
            } else {
                $file_name = $old_file;
            }

            $data = [
                'id' => $id,
                'title_id' => $_POST['title_id'],
                'title_en' => $_POST['title_en'] ?: Translator::translate($_POST['title_id']),
                'type' => $_POST['type'],
                'file_path' => $file_name,
                'status' => $_POST['status']
            ];

            if ($this->collaborationModel->updateDocument($data)) {
                Flasher::setFlash('Dokumen', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/collaboration');
                exit;
            }

            Flasher::setFlash('Dokumen', 'gagal diperbarui', 'danger');
            header('Location: ' . BASE_URL . 'admin/collaboration');
        }
    }

    public function collaboration_delete($id) {
        $doc = $this->collaborationModel->getDocumentById($id);
        if ($doc) {
            Upload::delete($doc->file_path, 'documents', realpath(__DIR__ . '/../storage'));
        }

        if ($this->collaborationModel->deleteDocument($id)) {
            Flasher::setFlash('Dokumen', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Dokumen', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/collaboration');
    }


    public function collaboration_requests() {
        $data = [
            'title' => 'Collaboration Request Logs',
            'active' => 'collaboration_requests',
            'requests' => $this->collaborationModel->getAllRequests()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/collaboration/requests', $data);
        $this->views('layouts/admin_footer');
    }

    public function users($action = null, $id = null) {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        $data = [
            'title' => 'Account Management',
            'active' => 'users',
            'users' => $this->userModel->getAllUsers()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/users', $data);
        $this->views('layouts/admin_footer');
    }

    public function users_create() {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        $data = [
            'title' => 'Add New User',
            'active' => 'users'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/users_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function users_store() {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        if ($this->userModel->createUser($_POST)) {
            Flasher::setFlash('Berhasil', 'Akun baru telah ditambahkan.', 'success');
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan saat menambahkan akun.', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/users');
    }

    public function users_edit($id) {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        $data = [
            'title' => 'Edit User',
            'active' => 'users',
            'user' => $this->userModel->getUserById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/users_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function users_update() {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        if ($this->userModel->updateUser($_POST['id'], $_POST)) {
            Flasher::setFlash('Berhasil', 'Data akun telah diperbarui.', 'success');
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan saat memperbarui akun.', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/users');
    }

    public function users_delete($id) {
        if ($_SESSION['user_role'] != 'admin') {
            Flasher::setFlash('Akses Ditolak', 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'danger');
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        if ($id == $_SESSION['user_id']) {
            Flasher::setFlash('Gagal', 'Anda tidak dapat menghapus akun sendiri.', 'danger');
            header('Location: ' . BASE_URL . 'admin/users');
            exit;
        }

        if ($this->userModel->deleteUser($id)) {
            Flasher::setFlash('Berhasil', 'Akun telah dihapus.', 'success');
        } else {
            Flasher::setFlash('Gagal', 'Terjadi kesalahan saat menghapus akun.', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/users');
    }
    public function profile_upload() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['photo'])) {
            $user_id = $_SESSION['user_id'];
            $user = $this->userModel->getUserById($user_id);
            $file = $_FILES['photo'];

            $file_name = Upload::file($file, 'profile', ['jpg', 'png', 'jpeg'], realpath(__DIR__ . '/../../public/assets/img'));

            if ($file_name) {
                // Delete old photo if exists
                if ($user->photo) {
                    Upload::delete($user->photo, 'profile', realpath(__DIR__ . '/../../public/assets/img'));
                }

                $data = [
                    'name' => $user->name,
                    'username' => $user->username,
                    'photo' => $file_name
                ];

                if ($this->userModel->updateProfile($user_id, $data)) {
                    // Update session if needed
                    $_SESSION['user_photo'] = $file_name;
                    echo json_encode(['status' => 'success', 'photo' => $file_name, 'url' => ASSETS_URL . 'img/profile/' . $file_name]);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update database']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Upload failed or invalid file type']);
            }
            exit;
        }
    }

    public function profile_photo_delete() {
        $user_id = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($user_id);

        if ($user && $user->photo) {
            // Delete physical file
            Upload::delete($user->photo, 'profile', realpath(__DIR__ . '/../../public/assets/img'));

            // Update database
            $data = [
                'name' => $user->name,
                'username' => $user->username,
                'photo' => NULL
            ];

            if ($this->userModel->updateProfile($user_id, $data)) {
                // Update session
                $_SESSION['user_photo'] = NULL;
                echo json_encode(['status' => 'success', 'message' => 'Foto profil berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui database']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada foto untuk dihapus']);
        }
        exit;
    }

    // --- TESTIMONIALS ---

    public function testimonials() {
        $page = isset($_GET['page']) ? $_GET['page'] : null;
        
        $testimonials = ($page) ? $this->testimonialModel->getByPage($page, false) : $this->testimonialModel->getAll();

        $data = [
            'title' => 'Manajemen Testimoni',
            'active' => 'testimonials',
            'testimonials' => $testimonials
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/testimonials', $data);
        $this->views('layouts/admin_footer');
    }

    public function testimonials_create() {
        $data = [
            'title' => 'Tambah Testimoni',
            'active' => 'testimonials'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/testimonials_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function testimonials_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            $data['image'] = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file_name = Upload::file($_FILES['image'], 'testimonials', ['jpg', 'png', 'jpeg'], realpath(__DIR__ . '/../../public/assets/img'));
                if ($file_name) {
                    $data['image'] = $file_name;
                }
            }

            // Auto-translate
            $data['role_en'] = $data['role_en'] ?: Translator::translate($data['role_id']);
            $data['content_en'] = $data['content_en'] ?: Translator::translate($data['content_id']);

            if ($this->testimonialModel->add($data)) {
                Flasher::setFlash('Testimoni', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/testimonials');
                exit;
            } else {
                Flasher::setFlash('Testimoni', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/testimonials');
                exit;
            }
        }
    }

    public function testimonials_edit($id) {
        $data = [
            'title' => 'Edit Testimoni',
            'active' => 'testimonials',
            'testimonial' => $this->testimonialModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/testimonials_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function testimonials_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            $old_data = $this->testimonialModel->getById($data['id']);
            $data['image'] = $old_data->image;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $file_name = Upload::file($_FILES['image'], 'testimonials', ['jpg', 'png', 'jpeg'], realpath(__DIR__ . '/../../public/assets/img'));
                if ($file_name) {
                    if ($old_data->image) {
                        Upload::delete($old_data->image, 'testimonials', realpath(__DIR__ . '/../../public/assets/img'));
                    }
                    $data['image'] = $file_name;
                }
            }

            // Auto-translate
            $data['role_en'] = $data['role_en'] ?: Translator::translate($data['role_id']);
            $data['content_en'] = $data['content_en'] ?: Translator::translate($data['content_id']);

            if ($this->testimonialModel->update($data)) {
                Flasher::setFlash('Testimoni', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/testimonials');
                exit;
            } else {
                Flasher::setFlash('Testimoni', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/testimonials');
                exit;
            }
        }
    }

    public function testimonials_delete($id) {
        $testimonial = $this->testimonialModel->getById($id);
        if ($testimonial->image) {
            Upload::delete($testimonial->image, 'testimonials', realpath(__DIR__ . '/../../public/assets/img'));
        }

        if ($this->testimonialModel->delete($id)) {
            Flasher::setFlash('Testimoni', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Testimoni', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/testimonials');
        exit;
    }

    // --- FAQS ---

    public function faqs() {
        $page = isset($_GET['page']) ? $_GET['page'] : null;
        $faqs = ($page) ? $this->faqModel->getByPage($page, false) : $this->faqModel->getAll();

        $data = [
            'title' => 'Manajemen FAQ',
            'active' => 'faqs',
            'faqs' => $faqs
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/faqs', $data);
        $this->views('layouts/admin_footer');
    }

    public function faqs_create() {
        $data = [
            'title' => 'Tambah FAQ',
            'active' => 'faqs'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/faqs_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function faqs_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['question_en'] = $_POST['question_en'] ?: Translator::translate($_POST['question_id']);
            $_POST['answer_en'] = $_POST['answer_en'] ?: Translator::translate($_POST['answer_id']);

            if ($this->faqModel->add($_POST)) {
                Flasher::setFlash('FAQ', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/faqs');
                exit;
            } else {
                Flasher::setFlash('FAQ', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/faqs');
                exit;
            }
        }
    }

    public function faqs_edit($id) {
        $data = [
            'title' => 'Edit FAQ',
            'active' => 'faqs',
            'faq' => $this->faqModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/faqs_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function faqs_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['question_en'] = $_POST['question_en'] ?: Translator::translate($_POST['question_id']);
            $_POST['answer_en'] = $_POST['answer_en'] ?: Translator::translate($_POST['answer_id']);

            if ($this->faqModel->update($_POST)) {
                Flasher::setFlash('FAQ', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/faqs');
                exit;
            } else {
                Flasher::setFlash('FAQ', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/faqs');
                exit;
            }
        }
    }

    public function faqs_delete($id) {
        if ($this->faqModel->delete($id)) {
            Flasher::setFlash('FAQ', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('FAQ', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/faqs');
        exit;
    }

    // --- GI SERVICES ---

    public function gi_services($action = null, $id = null) {
        if ($action === 'create') return $this->gi_services_create();
        if ($action === 'edit' && $id) return $this->gi_services_edit($id);
        
        $data = [
            'title' => 'Manage Capacity Building (GI Services)',
            'active' => 'services_cb',
            'services' => $this->giServiceModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_services', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_services_create() {
        $data = [
            'title' => 'Tambah Layanan GI Baru',
            'active' => 'gi_services'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_services_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_services_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = Upload::file($_FILES['image'], 'img/gi');
            $data = $_POST;
            $data['image'] = $image ?: '';
            
            // Auto-translate
            $data['title_en'] = $data['title_en'] ?: Translator::translate($data['title_id']);
            $data['small_subtitle_en'] = $data['small_subtitle_en'] ?: Translator::translate($data['small_subtitle_id']);
            $data['description_en'] = $data['description_en'] ?: Translator::translate($data['description_id']);
            $data['outputs_en'] = $data['outputs_en'] ?: Translator::translate($data['outputs_id']);
            $data['detail_content_en'] = $data['detail_content_en'] ?: Translator::translate($data['detail_content_id']);

            $data['slug'] = str_replace(' ', '-', strtolower($data['title_en']));

            if ($this->giServiceModel->add($data)) {
                Flasher::setFlash('Layanan GI', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/services_cb');
            } else {
                Flasher::setFlash('Layanan GI', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/services_cb');
            }
        }
    }

    public function gi_services_edit($id) {
        $data = [
            'title' => 'Edit Layanan GI',
            'active' => 'gi_services',
            'service' => $this->giServiceModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_services_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_services_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $old = $this->giServiceModel->getById($id);
            $image = $old->image;

            if (!empty($_FILES['image']['name'])) {
                $new_image = Upload::file($_FILES['image'], 'img/gi');
                if ($new_image) {
                    Upload::delete($old->image, 'img/gi');
                    $image = $new_image;
                }
            }

            $data = $_POST;
            $data['image'] = $image;

            // Auto-translate
            $data['title_en'] = $data['title_en'] ?: Translator::translate($data['title_id']);
            $data['small_subtitle_en'] = $data['small_subtitle_en'] ?: Translator::translate($data['small_subtitle_id']);
            $data['description_en'] = $data['description_en'] ?: Translator::translate($data['description_id']);
            $data['outputs_en'] = $data['outputs_en'] ?: Translator::translate($data['outputs_id']);
            $data['detail_content_en'] = $data['detail_content_en'] ?: Translator::translate($data['detail_content_id']);

            $data['slug'] = str_replace(' ', '-', strtolower($data['title_en']));

            if ($this->giServiceModel->update($data)) {
                Flasher::setFlash('Layanan GI', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/services_cb');
            } else {
                Flasher::setFlash('Layanan GI', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/services_cb');
            }
        }
    }

    public function gi_services_delete($id) {
        $service = $this->giServiceModel->getById($id);
        if ($service && $service->image) {
            Upload::delete($service->image, 'img/gi');
        }

        if ($this->giServiceModel->delete($id)) {
            Flasher::setFlash('Layanan GI', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Layanan GI', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/services_cb');
        exit;
    }

    // --- GI VIDEOS ---

    public function gi_videos() {
        $data = [
            'title' => 'Manajemen Video GI',
            'active' => 'gi_videos',
            'videos' => $this->giVideoModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_videos/index', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_videos_create() {
        $data = [
            'title' => 'Tambah Video GI',
            'active' => 'gi_videos'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_videos/create', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_videos_store() {
        if ($_POST) {
            $data = $_POST;
            $data['thumbnail'] = null;

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name']) {
                $upload = Upload::file($_FILES['thumbnail'], 'img/gi/videos');
                if ($upload) {
                    $data['thumbnail'] = $upload;
                }
            }

            if ($this->giVideoModel->add($data)) {
                Flasher::setFlash('Video GI', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/gi_videos');
            } else {
                Flasher::setFlash('Video GI', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/gi_videos');
            }
        }
    }

    public function gi_videos_edit($id) {
        $data = [
            'title' => 'Edit Video GI',
            'active' => 'gi_videos',
            'video' => $this->giVideoModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/gi_videos/edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function gi_videos_update() {
        if ($_POST) {
            $data = $_POST;
            $video = $this->giVideoModel->getById($data['id']);
            $data['thumbnail'] = $video->thumbnail;

            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name']) {
                if ($video->thumbnail) {
                    Upload::delete($video->thumbnail, 'img/gi/videos');
                }
                $upload = Upload::file($_FILES['thumbnail'], 'img/gi/videos');
                if ($upload) {
                    $data['thumbnail'] = $upload;
                }
            }

            if (empty($data['title_en'])) {
                $data['title_en'] = $data['title_id'];
            }
            if (empty($data['description_en'])) {
                $data['description_en'] = $data['description_id'];
            }

            if ($this->giVideoModel->update($data)) {
                Flasher::setFlash('Video GI', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/gi_videos');
            } else {
                Flasher::setFlash('Video GI', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/gi_videos');
            }
        }
    }

    public function gi_videos_delete($id) {
        $video = $this->giVideoModel->getById($id);
        if ($video && $video->thumbnail) {
            Upload::delete($video->thumbnail, 'img/gi/videos');
        }

        if ($this->giVideoModel->delete($id)) {
            Flasher::setFlash('Video GI', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Video GI', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/gi_videos');
        exit;
    }

    // --- CONTACTS ---

    public function contacts() {
        $data = [
            'title' => 'Kotak Masuk Kontak',
            'active' => 'contacts',
            'contacts' => $this->contactModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/contacts', $data);
        $this->views('layouts/admin_footer');
    }

    public function contacts_read($id) {
        $this->contactModel->markAsRead($id);
        $contact = $this->contactModel->getById($id);
        echo json_encode($contact);
        exit;
    }

    public function contacts_delete($id) {
        if ($this->contactModel->delete($id)) {
            Flasher::setFlash('Pesan', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Pesan', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/contacts');
        exit;
    }
}
