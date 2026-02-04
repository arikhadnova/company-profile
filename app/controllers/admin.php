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
    private $founderModel;
    private $activityLogModel;

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
        $this->giVideoModel = $this->model('GiVideo_model');
        $this->founderModel = $this->model('Founder_model');
        $this->activityLogModel = $this->model('ActivityLog_model');

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
        
        // Fetch activity logs
        $activities = $this->activityLogModel->getRecent(15);
        
        // Format for view compatibility if needed, but view will change to use this structure directly
        // The view expects objects with: user_name, action_type, target_type, description, created_at

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
                    $this->activityLogModel->log('UPDATE', 'Profile', "Memperbarui informasi profil pengguna {$data['username']}");
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
                                $this->activityLogModel->log('UPDATE', 'Profile', "Mengubah password pengguna {$user->username}");
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
        $site_description = $_POST['site_description'] ?? '';
        $this->settingModel->update('site_title', $site_title);
        $this->settingModel->update('site_description', $site_description);
        
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
        $this->activityLogModel->log('UPDATE', 'Settings', "Memperbarui Pengaturan Header Website");
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
        $this->activityLogModel->log('UPDATE', 'Settings', "Memperbarui Pengaturan Footer Website");
        header('Location: ' . BASE_URL . 'admin/settings');
        exit;
    }

    public function partnership_settings() {
        $data = [
            'title' => 'Partnership Settings',
            'active' => 'partnership_settings',
            'settings' => $this->settingModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/partnership_settings', $data);
        $this->views('layouts/admin_footer');
    }

    public function update_partnership_settings() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($_POST as $key => $value) {
                // Update the Indonesian version
                $this->settingModel->update($key, $value);

                // Auto-translate to English if it's an _id field
                if (strpos($key, '_id') !== false) {
                    $en_key = str_replace('_id', '_en', $key);
                    $en_value = Translator::translate($value);
                    $this->settingModel->update($en_key, $en_value);
                }
            }
            Flasher::setFlash('Settings Partnership', 'berhasil diperbarui', 'success');
            $this->activityLogModel->log('UPDATE', 'Settings', "Memperbarui Pengaturan Partnership");
            header('Location: ' . BASE_URL . 'admin/partnership_settings');
            exit;
        }
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
            $this->activityLogModel->log('UPDATE', 'Hero Section', "Memperbarui Hero Section halaman '{$page}'");
            Flasher::setFlash('Hero ' . ucfirst($page), 'berhasil diperbarui', 'success');
        } else {
            Flasher::setFlash('Hero ' . ucfirst($page), 'gagal diperbarui', 'danger');
        }

        header('Location: ' . BASE_URL . 'admin/hero');
        exit;
    }

    // Founders Management
    public function founders($action = null, $id = null) {
        if ($action === 'create') return $this->founders_create();
        if ($action === 'edit' && $id) return $this->founders_edit($id);
        if ($action === 'delete' && $id) return $this->founders_delete($id);

        $data = [
            'title' => 'Kelola Founders',
            'active' => 'founders',
            'founders' => $this->founderModel->getAll()
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/founders', $data);
        $this->views('layouts/admin_footer');
    }

    public function founders_create() {
        $data = [
            'title' => 'Tambah Founder',
            'active' => 'founders'
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/founders_create', $data);
        $this->views('layouts/admin_footer');
    }

    public function founders_store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = '';
            if (!empty($_FILES['image']['name'])) {
                $image = Upload::file($_FILES['image'], 'img');
            }

            $data = [
                'name' => $_POST['name'],
                'role_id' => $_POST['role_id'],
                'role_en' => Translator::translate($_POST['role_id']),
                'quote_id' => $_POST['quote_id'],
                'quote_en' => Translator::translate($_POST['quote_id']),
                'linkedin_url' => $_POST['linkedin_url'],
                'display_order' => $_POST['display_order'] ?? 0,
                'image' => $image
            ];

            if ($this->founderModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'Founder', "Menambahkan founder baru '{$_POST['name']}'");
                Flasher::setFlash('Founder', 'berhasil ditambahkan', 'success');
            } else {
                Flasher::setFlash('Founder', 'gagal ditambahkan', 'danger');
            }
            header('Location: ' . BASE_URL . 'admin/founders');
            exit;
        }
    }

    public function founders_edit($id) {
        $data = [
            'title' => 'Edit Founder',
            'active' => 'founders',
            'founder' => $this->founderModel->getById($id)
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/founders_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function founders_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $old_founder = $this->founderModel->getById($id);
            $image = $old_founder->image;

            if (!empty($_FILES['image']['name'])) {
                $new_image = Upload::file($_FILES['image'], 'img');
                if ($new_image) {
                    // Upload::delete($old_founder->image, 'img'); // Optional: delete old image
                    $image = $new_image;
                }
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'role_id' => $_POST['role_id'],
                'role_en' => Translator::translate($_POST['role_id']),
                'quote_id' => $_POST['quote_id'],
                'quote_en' => Translator::translate($_POST['quote_id']),
                'linkedin_url' => $_POST['linkedin_url'],
                'display_order' => $_POST['display_order'] ?? 0,
                'image' => $image
            ];

            if ($this->founderModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'Founder', "Memperbarui founder '{$_POST['name']}'");
                Flasher::setFlash('Founder', 'berhasil diperbarui', 'success');
            } else {
                Flasher::setFlash('Founder', 'gagal diperbarui', 'danger');
            }
            header('Location: ' . BASE_URL . 'admin/founders');
            exit;
        }
    }

    public function founders_delete($id) {
        $founder = $this->founderModel->getById($id);
        if ($this->founderModel->delete($id)) {
            $name = $founder ? $founder->name : 'Unknown';
            $this->activityLogModel->log('DELETE', 'Founder', "Menghapus founder '{$name}'");
            Flasher::setFlash('Founder', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Founder', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/founders');
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

        // Process Project Logos
        $project_logos = [];
        if (!empty($_FILES['project_logos']['name'][0])) {
            foreach ($_FILES['project_logos']['name'] as $key => $val) {
                if (!empty($val)) {
                    $file_data = [
                        'name' => $_FILES['project_logos']['name'][$key],
                        'type' => $_FILES['project_logos']['type'][$key],
                        'tmp_name' => $_FILES['project_logos']['tmp_name'][$key],
                        'error' => $_FILES['project_logos']['error'][$key],
                        'size' => $_FILES['project_logos']['size'][$key]
                    ];
                    
                    $uploaded_file = Upload::file($file_data, 'img/portfolio');
                    if ($uploaded_file) {
                        $project_logos[] = $uploaded_file;
                    }
                }
            }
        }

            $highlights = [];
            if (!empty($_FILES['highlight_imgs']['name'][0])) {
                foreach ($_FILES['highlight_imgs']['name'] as $key => $val) {
                    if (!empty($val)) {
                        $file_data = [
                            'name' => $_FILES['highlight_imgs']['name'][$key],
                            'type' => $_FILES['highlight_imgs']['type'][$key],
                            'tmp_name' => $_FILES['highlight_imgs']['tmp_name'][$key],
                            'error' => $_FILES['highlight_imgs']['error'][$key],
                            'size' => $_FILES['highlight_imgs']['size'][$key]
                        ];
                        
                        $uploaded_file = Upload::file($file_data, 'img/portfolio');
                        if ($uploaded_file) {
                            $highlights[] = [
                                'image' => $uploaded_file,
                                'caption' => $_POST['highlight_captions'][$key] ?? ''
                            ];
                        }
                    }
                }
            }

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
                'tags' => $_POST['tags'],
                'detail_content_id' => $_POST['detail_content_id'] ?? '',
                'detail_content_en' => ($_POST['detail_content_en'] ?? '') ?: Translator::translate($_POST['detail_content_id'] ?? ''),
                'targets_id' => $_POST['targets_id'] ?? '',
                'targets_en' => ($_POST['targets_en'] ?? '') ?: Translator::translate($_POST['targets_id'] ?? ''),
                'metrics_id' => $_POST['metrics_id'] ?? '',
                'metrics_en' => ($_POST['metrics_en'] ?? '') ?: Translator::translate($_POST['metrics_id'] ?? ''),
                'approach_id' => $_POST['approach_id'] ?? '',
                'approach_en' => ($_POST['approach_en'] ?? '') ?: Translator::translate($_POST['approach_id'] ?? ''),
                'highlights' => json_encode($highlights),
                'project_logos' => json_encode($project_logos)
            ];

            if ($this->portfolioModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'Portfolio', "Menambahkan portofolio baru '{$_POST['title_id']}'");
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

        // Process Project Logos
        $project_logos = [];
        
        // Existing logos
        if (isset($_POST['existing_project_logos'])) {
            foreach ($_POST['existing_project_logos'] as $logo) {
                if (!empty($logo)) {
                    $project_logos[] = $logo;
                }
            }
        }

        // New logos
        if (!empty($_FILES['project_logos']['name'][0])) {
            foreach ($_FILES['project_logos']['name'] as $key => $val) {
                if (!empty($val)) {
                    $file_data = [
                        'name' => $_FILES['project_logos']['name'][$key],
                        'type' => $_FILES['project_logos']['type'][$key],
                        'tmp_name' => $_FILES['project_logos']['tmp_name'][$key],
                        'error' => $_FILES['project_logos']['error'][$key],
                        'size' => $_FILES['project_logos']['size'][$key]
                    ];
                    
                    $uploaded_file = Upload::file($file_data, 'img/portfolio');
                    if ($uploaded_file) {
                        $project_logos[] = $uploaded_file;
                    }
                }
            }
        }

        // Process Highlights
            $highlights = [];
            
            // Existing highlights
            if (isset($_POST['existing_highlight_imgs'])) {
                foreach ($_POST['existing_highlight_imgs'] as $key => $img) {
                    if (!empty($img)) {
                        $highlights[] = [
                            'image' => $img,
                            'caption' => $_POST['existing_highlight_captions'][$key] ?? ''
                        ];
                    }
                }
            }

            // New highlights
            if (!empty($_FILES['highlight_imgs']['name'][0])) {
                foreach ($_FILES['highlight_imgs']['name'] as $key => $val) {
                    if (!empty($val)) {
                        $file_data = [
                            'name' => $_FILES['highlight_imgs']['name'][$key],
                            'type' => $_FILES['highlight_imgs']['type'][$key],
                            'tmp_name' => $_FILES['highlight_imgs']['tmp_name'][$key],
                            'error' => $_FILES['highlight_imgs']['error'][$key],
                            'size' => $_FILES['highlight_imgs']['size'][$key]
                        ];
                        
                        $uploaded_file = Upload::file($file_data, 'img/portfolio');
                        if ($uploaded_file) {
                            $highlights[] = [
                                'image' => $uploaded_file,
                                'caption' => $_POST['highlight_captions'][$key] ?? ''
                            ];
                        }
                    }
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
                'tags' => $_POST['tags'],
                'detail_content_id' => $_POST['detail_content_id'] ?? '',
                'detail_content_en' => ($_POST['detail_content_en'] ?? '') ?: Translator::translate($_POST['detail_content_id'] ?? ''),
                'targets_id' => $_POST['targets_id'] ?? '',
                'targets_en' => ($_POST['targets_en'] ?? '') ?: Translator::translate($_POST['targets_id'] ?? ''),
                'metrics_id' => $_POST['metrics_id'] ?? '',
                'metrics_en' => ($_POST['metrics_en'] ?? '') ?: Translator::translate($_POST['metrics_id'] ?? ''),
                'approach_id' => $_POST['approach_id'] ?? '',
                'approach_en' => ($_POST['approach_en'] ?? '') ?: Translator::translate($_POST['approach_id'] ?? ''),
                'highlights' => json_encode($highlights),
                'project_logos' => json_encode($project_logos)
            ];

            if ($this->portfolioModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'Portfolio', "Memperbarui portofolio '{$_POST['title_id']}'");
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
            $name = $portfolio ? $portfolio->title_id : 'Unknown Portfolio';
            $this->activityLogModel->log('DELETE', 'Portfolio', "Menghapus portofolio '{$name}'");
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
                    'author' => $_SESSION['user_name'] ?? 'Admin',
                    'status' => $_POST['status'],
                    'type' => $_POST['type']
                ];

                if ($this->articleModel->update($data)) {
                    $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                    $type_label = ($data['type'] == 'blog') ? 'Artikel' : 'Pustaka';
                    $this->activityLogModel->log('UPDATE', $type_label, "Memperbarui {$type_label} '{$_POST['title_id']}'");
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
                    'author' => $_SESSION['user_name'] ?? 'Admin',
                    'status' => $_POST['status'],
                    'type' => $_POST['type']
                ];

                if ($this->articleModel->add($data)) {
                    $redirect = ($_POST['type'] == 'blog' ? 'admin/articles' : 'admin/library');
                    $type_label = ($data['type'] == 'blog') ? 'Artikel' : 'Pustaka';
                    $this->activityLogModel->log('CREATE', $type_label, "Membuat {$type_label} baru '{$_POST['title_id']}'");
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
            $name = $article ? $article->title_id : 'Unknown Article';
            $type_label = ($type == 'blog') ? 'Artikel' : 'Pustaka';
            $this->activityLogModel->log('DELETE', $type_label, "Menghapus {$type_label} '{$name}'");
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
            // Unset icon rule and check for image
            $rules = [
                'name_id' => ['required'],
                'name_en' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input layanan', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $image = Upload::file($_FILES['image'], 'img/services');

            $data = [
                'name_id' => $_POST['name_id'],
                'name_en' => $_POST['name_en'] ?: Translator::translate($_POST['name_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'image' => $image ?: '',
                'order_priority' => $_POST['order_priority']
            ];

            if ($this->serviceModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'Services', "Menambahkan kategori layanan baru '{$_POST['name_id']}'");
                Flasher::setFlash('Kategori Layanan', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/services');
            } else {
                Flasher::setFlash('Kategori Layanan', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/services');
            }
        }
    }

    public function services_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $old_data = $this->serviceModel->getById($id);
            
            $rules = [
                'name_id' => ['required'],
                'name_en' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input layanan', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $image = $old_data->image;
            if (!empty($_FILES['image']['name'])) {
                $new_image = Upload::file($_FILES['image'], 'img/services');
                if ($new_image) {
                    if ($image) {
                        Upload::delete($image, 'img/services');
                    }
                    $image = $new_image;
                }
            }

            $data = [
                'id' => $id,
                'name_id' => $_POST['name_id'],
                'name_en' => $_POST['name_en'] ?: Translator::translate($_POST['name_id']),
                'description_id' => $_POST['description_id'],
                'description_en' => $_POST['description_en'] ?: Translator::translate($_POST['description_id']),
                'image' => $image,
                'order_priority' => $_POST['order_priority']
            ];

            if ($this->serviceModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'Services', "Memperbarui kategori layanan '{$_POST['name_id']}'");
                Flasher::setFlash('Kategori Layanan', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/services');
            } else {
                Flasher::setFlash('Kategori Layanan', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/services');
            }
        }
    }

    public function services_delete($id) {
        $service = $this->serviceModel->getById($id);
        if ($service && $service->image) {
            Upload::delete($service->image, 'img/services');
        }

        if ($this->serviceModel->delete($id)) {
            $name = $service ? $service->name_id : 'Unknown Service';
            $this->activityLogModel->log('DELETE', 'Services', "Menghapus kategori layanan '{$name}'");
            Flasher::setFlash('Kategori Layanan', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Kategori Layanan', 'gagal dihapus', 'danger');
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
            $image = Upload::file($_FILES['image'], 'img/services');
            
            $data = $_POST;
            $data['image'] = $image ?: '';
            $data['title_en'] = $_POST['title_en'] ?: Translator::translate($_POST['title_id']);
            $data['description_en'] = $_POST['description_en'] ?: Translator::translate($_POST['description_id']);
            
            if ($this->serviceItemModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'Service Items', "Menambahkan item layanan baru '{$_POST['title_id']}'");
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
            $id = $_POST['id'];
            $old = $this->serviceItemModel->getById($id);
            $image = $old->image;

            if (!empty($_FILES['image']['name'])) {
                $new_image = Upload::file($_FILES['image'], 'img/services');
                if ($new_image) {
                    if ($old->image) {
                        Upload::delete($old->image, 'img/services');
                    }
                    $image = $new_image;
                }
            }

            $data = $_POST;
            $data['image'] = $image;
            $data['title_en'] = $_POST['title_en'] ?: Translator::translate($_POST['title_id']);
            $data['description_en'] = $_POST['description_en'] ?: Translator::translate($_POST['description_id']);

            if ($this->serviceItemModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'Service Items', "Memperbarui item layanan '{$_POST['title_id']}'");
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
        
        if ($item->image) {
            Upload::delete($item->image, 'img/services');
        }

        if ($this->serviceItemModel->delete($id)) {
            $name = $item ? $item->title_id : 'Unknown Item';
            $this->activityLogModel->log('DELETE', 'Service Items', "Menghapus item layanan '{$name}'");
            Flasher::setFlash('Item layanan', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Item layanan', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/services_' . $category);
        exit;
    }

    public function impact($page_target = 'home', $action = null, $id = null) {
        // Handle nested actions if called like admin/impact/home/edit/1
        if ($page_target === 'create') return $this->impact_create();
        if ($page_target === 'edit' && $action) return $this->impact_edit($action);

        $allImpacts = $this->impactModel->getByPage($page_target);
        
        $data = [
            'title' => 'Manage Impact: ' . strtoupper($page_target),
            'active' => 'impact_' . $page_target,
            'page_target' => $page_target,
            'impacts' => $allImpacts
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
            $rules = [
                'label_id' => ['required'],
                'value' => ['required'],
                'page' => ['required'],
                'section' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input data dampak', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }
            $page = $_POST['page'] ?? 'home';
            $data = [
                'label_id' => $_POST['label_id'],
                'label_en' => $_POST['label_en'] ?: Translator::translate($_POST['label_id']),
                'value' => $_POST['value'],
                'unit' => $_POST['unit'],
                'icon' => '', // Icon removed as per request
                'page' => $page,
                'section' => $_POST['section'],
                'section_title_id' => $_POST['section_title_id'] ?? '',
                'section_title_en' => ($_POST['section_title_en'] ?? '') ?: (($_POST['section_title_id'] ?? '') ? Translator::translate($_POST['section_title_id']) : ''),
                'note_id' => $_POST['note_id'] ?? '',
                'note_en' => ($_POST['note_en'] ?? '') ?: (($_POST['note_id'] ?? '') ? Translator::translate($_POST['note_id']) : ''),
                'order_num' => $_POST['order_num'] ?? 0
            ];

            if ($this->impactModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'Impact', "Menambahkan metrik dampak baru '{$_POST['label_id']}' pada halaman {$page}");
                Flasher::setFlash('Metrik', 'berhasil ditambahkan', 'success');
                header('Location: ' . BASE_URL . 'admin/impact/' . $page);
            } else {
                Flasher::setFlash('Metrik', 'gagal ditambahkan', 'danger');
                header('Location: ' . BASE_URL . 'admin/impact/' . $page);
            }
            exit;
        }
    }

    public function impact_edit($id) {
        $impact = $this->impactModel->getById($id);
        $data = [
            'title' => 'Edit Impact Data',
            'active' => 'impact_' . ($impact->page ?? 'home'),
            'impact' => $impact
        ];
        $this->views('layouts/admin_header', $data);
        $this->views('admin/impact_edit', $data);
        $this->views('layouts/admin_footer');
    }

    public function impact_update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validation
            $rules = [
                'label_id' => ['required'],
                'value' => ['required'],
                'page' => ['required'],
                'section' => ['required']
            ];
            $errors = Validator::validate($_POST, $rules);

            if (!empty($errors)) {
                Flasher::setFlash('input data dampak', 'tidak valid', 'danger', $errors);
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $page = $_POST['page'] ?? 'home';
            $data = [
                'id' => $_POST['id'],
                'label_id' => $_POST['label_id'],
                'label_en' => $_POST['label_en'] ?: Translator::translate($_POST['label_id']),
                'value' => $_POST['value'],
                'unit' => $_POST['unit'],
                'icon' => '', // Icon removed
                'page' => $page,
                'section' => $_POST['section'],
                'section_title_id' => $_POST['section_title_id'] ?? '',
                'section_title_en' => ($_POST['section_title_en'] ?? '') ?: (($_POST['section_title_id'] ?? '') ? Translator::translate($_POST['section_title_id']) : ''),
                'note_id' => $_POST['note_id'] ?? '',
                'note_en' => ($_POST['note_en'] ?? '') ?: (($_POST['note_id'] ?? '') ? Translator::translate($_POST['note_id']) : ''),
                'order_num' => $_POST['order_num'] ?? 0
            ];

            if ($this->impactModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'Impact', "Memperbarui metrik dampak '{$_POST['label_id']}' pada halaman {$page}");
                Flasher::setFlash('Metrik', 'berhasil diperbarui', 'success');
                header('Location: ' . BASE_URL . 'admin/impact/' . $page);
            } else {
                Flasher::setFlash('Metrik', 'gagal diperbarui', 'danger');
                header('Location: ' . BASE_URL . 'admin/impact/' . $page);
            }
            exit;
        }
    }

    public function impact_delete($id) {
        $impact = $this->impactModel->getById($id);
        $page = $impact ? $impact->page : 'home';
        
        if ($this->impactModel->delete($id)) {
            $label = $impact ? $impact->label_id : 'Unknown Metric';
            $this->activityLogModel->log('DELETE', 'Impact', "Menghapus metrik dampak '{$label}' dari halaman {$page}");
            Flasher::setFlash('Metrik', 'berhasil dihapus', 'success');
        } else {
            Flasher::setFlash('Metrik', 'gagal dihapus', 'danger');
        }
        header('Location: ' . BASE_URL . 'admin/impact/' . $page);
        exit;
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
                $this->activityLogModel->log('CREATE', 'Partner', "Menambahkan partner baru '{$_POST['name']}'");
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
                $this->activityLogModel->log('UPDATE', 'Partner', "Memperbarui partner '{$_POST['name']}'");
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
            $name = $partner ? $partner->name : 'Unknown Partner';
            $this->activityLogModel->log('DELETE', 'Partner', "Menghapus partner '{$name}'");
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
                    $this->activityLogModel->log('CREATE', 'Collaboration', "Menambahkan dokumen kolaborasi baru '{$_POST['title_id']}'");
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
                $this->activityLogModel->log('UPDATE', 'Collaboration', "Memperbarui dokumen kolaborasi '{$_POST['title_id']}'");
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
            $name = $doc ? $doc->title_id : 'Unknown Document';
            $this->activityLogModel->log('DELETE', 'Collaboration', "Menghapus dokumen kolaborasi '{$name}'");
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
            $this->activityLogModel->log('CREATE', 'Users', "Menambahkan pengguna baru '{$_POST['username']}'");
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
            $this->activityLogModel->log('UPDATE', 'Users', "Memperbarui data pengguna '{$_POST['username']}'");
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
            $this->activityLogModel->log('DELETE', 'Users', "Menghapus pengguna (ID: {$id})");
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
                    $this->activityLogModel->log('UPDATE', 'Profile', "Mengganti foto profil");
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
                $this->activityLogModel->log('UPDATE', 'Profile', "Menghapus foto profil");
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
                $this->activityLogModel->log('CREATE', 'Testimonials', "Menambahkan testimoni baru dari '{$data['client_name']}'");
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
                $this->activityLogModel->log('UPDATE', 'Testimonials', "Memperbarui testimoni dari '{$data['client_name']}'");
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
                $this->activityLogModel->log('CREATE', 'FAQ', "Menambahkan FAQ baru '{$_POST['question_id']}'");
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
                $this->activityLogModel->log('UPDATE', 'FAQ', "Memperbarui FAQ '{$_POST['question_id']}'");
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
        $faq = $this->faqModel->getById($id);
        if ($this->faqModel->delete($id)) {
            $question = $faq ? $faq->question_id : 'Unknown FAQ';
            $this->activityLogModel->log('DELETE', 'FAQ', "Menghapus FAQ '{$question}'");
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
            
            // Process Highlights
            $highlights = [];
            if (!empty($_FILES['highlight_imgs']['name'][0])) {
                foreach ($_FILES['highlight_imgs']['name'] as $key => $val) {
                    if (!empty($val)) {
                        $file_data = [
                            'name' => $_FILES['highlight_imgs']['name'][$key],
                            'type' => $_FILES['highlight_imgs']['type'][$key],
                            'tmp_name' => $_FILES['highlight_imgs']['tmp_name'][$key],
                            'error' => $_FILES['highlight_imgs']['error'][$key],
                            'size' => $_FILES['highlight_imgs']['size'][$key]
                        ];
                        $uploaded_file = Upload::file($file_data, 'img/gi');
                        if ($uploaded_file) {
                            $highlights[] = [
                                'image' => $uploaded_file,
                                'caption' => $_POST['highlight_captions'][$key] ?? ''
                            ];
                        }
                    }
                }
            }

            $data = $_POST;
            $data['image'] = $image ?: '';
            $data['highlights'] = json_encode($highlights);
            
            // Auto-translate
            $data['title_en'] = $data['title_en'] ?: Translator::translate($data['title_id']);

            $data['description_en'] = $data['description_en'] ?: Translator::translate($data['description_id']);
            $data['detail_content_en'] = $data['detail_content_en'] ?: Translator::translate($data['detail_content_id']);
            
            // Handle JSON Translation for Program Points
            if (empty($data['program_points_en']) && !empty($data['program_points_id'])) {
                $points_id = json_decode($data['program_points_id'], true);
                if (is_array($points_id)) {
                    $points_en = [];
                    foreach ($points_id as $point) {
                        $points_en[] = [
                            'title' => Translator::translate($point['title'] ?? ''),
                            'desc' => Translator::translate($point['desc'] ?? '')
                        ];
                    }
                    $data['program_points_en'] = json_encode($points_en);
                } else {
                     $data['program_points_en'] = $data['program_points_id']; // Fallback
                }
            }
            
            $data['location_en'] = $data['location_en'] ?: Translator::translate($data['location_id'] ?: '');
            $data['service_type_en'] = $data['service_type_en'] ?: Translator::translate($data['service_type_id'] ?: '');

            $data['slug'] = str_replace(' ', '-', strtolower($data['title_en']));

            // Ensure unique slug
            $base_slug = $data['slug'];
            $counter = 1;
            while ($this->giServiceModel->getBySlug($data['slug'])) {
                $data['slug'] = $base_slug . '-' . $counter;
                $counter++;
            }

            if ($this->giServiceModel->add($data)) {
                $this->activityLogModel->log('CREATE', 'GI Services', "Menambahkan layanan GI baru '{$data['title_id']}'");
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

            // Process Highlights
            $highlights = [];
            
            // Existing highlights
            if (isset($_POST['existing_highlight_imgs'])) {
                foreach ($_POST['existing_highlight_imgs'] as $key => $img) {
                    if (!empty($img)) {
                        $highlights[] = [
                            'image' => $img,
                            'caption' => $_POST['existing_highlight_captions'][$key] ?? ''
                        ];
                    }
                }
            }

            // New highlights
            if (!empty($_FILES['highlight_imgs']['name'][0])) {
                foreach ($_FILES['highlight_imgs']['name'] as $key => $val) {
                    if (!empty($val)) {
                        $file_data = [
                            'name' => $_FILES['highlight_imgs']['name'][$key],
                            'type' => $_FILES['highlight_imgs']['type'][$key],
                            'tmp_name' => $_FILES['highlight_imgs']['tmp_name'][$key],
                            'error' => $_FILES['highlight_imgs']['error'][$key],
                            'size' => $_FILES['highlight_imgs']['size'][$key]
                        ];
                        
                        $uploaded_file = Upload::file($file_data, 'img/gi');
                        if ($uploaded_file) {
                            $highlights[] = [
                                'image' => $uploaded_file,
                                'caption' => $_POST['highlight_captions'][$key] ?? ''
                            ];
                        }
                    }
                }
            }

            $data = $_POST;
            $data['image'] = $image;
            $data['highlights'] = json_encode($highlights);

            // Auto-translate
            $data['title_en'] = $data['title_en'] ?: Translator::translate($data['title_id']);

            $data['description_en'] = $data['description_en'] ?: Translator::translate($data['description_id']);
            $data['detail_content_en'] = $data['detail_content_en'] ?: Translator::translate($data['detail_content_id']);

            // Handle JSON Translation for Program Points
            if (empty($data['program_points_en']) && !empty($data['program_points_id'])) {
                $points_id = json_decode($data['program_points_id'], true);
                if (is_array($points_id)) {
                    $points_en = [];
                    foreach ($points_id as $point) {
                        $points_en[] = [
                            'title' => Translator::translate($point['title'] ?? ''),
                            'desc' => Translator::translate($point['desc'] ?? '')
                        ];
                    }
                    $data['program_points_en'] = json_encode($points_en);
                } else {
                     $data['program_points_en'] = $data['program_points_id']; // Fallback
                }
            }

            $data['location_en'] = $data['location_en'] ?: Translator::translate($data['location_id']);
            $data['service_type_en'] = $data['service_type_en'] ?: Translator::translate($data['service_type_id']);

            $data['slug'] = str_replace(' ', '-', strtolower($data['title_en']));

            // Ensure unique slug for update
            $base_slug = $data['slug'];
            $counter = 1;
            $existing = $this->giServiceModel->getBySlug($data['slug']);
            while ($existing && $existing->id != $id) {
                $data['slug'] = $base_slug . '-' . $counter;
                $counter++;
                $existing = $this->giServiceModel->getBySlug($data['slug']);
            }

            if ($this->giServiceModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'GI Services', "Memperbarui layanan GI '{$data['title_id']}'");
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
            $name = $service ? $service->title_id : 'Unknown GI Service';
            $this->activityLogModel->log('DELETE', 'GI Services', "Menghapus layanan GI '{$name}'");
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

            if ($this->giVideoModel->add($data)) {
                // Get the ID of the newly added video
                $newVideo = $this->db->lastInsertId();
                if ($newVideo) {
                    $videoData = $this->giVideoModel->getById($newVideo);
                    $updateData = [
                        'id' => $newVideo,
                        'title_id' => $videoData->title_id,
                        'title_en' => Translator::translate($videoData->title_id),
                        'description_id' => $videoData->description_id,
                        'description_en' => Translator::translate($videoData->description_id),
                        'url' => $videoData->url,
                        'type' => $videoData->type,
                        'thumbnail' => $videoData->thumbnail,
                        'order_priority' => $videoData->order_priority
                    ];
                    $this->giVideoModel->update($updateData);
                }
                $this->activityLogModel->log('CREATE', 'GI Videos', "Menambahkan video GI baru '{$data['title_id']}'");
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

            // Automatically translate to English
            $data['title_en'] = Translator::translate($data['title_id']);
            $data['description_en'] = Translator::translate($data['description_id']);

            if ($this->giVideoModel->update($data)) {
                $this->activityLogModel->log('UPDATE', 'GI Videos', "Memperbarui video GI '{$data['title_id']}'");
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
            $name = $video ? $video->title_id : 'Unknown GI Video';
            $this->activityLogModel->log('DELETE', 'GI Videos', "Menghapus video GI '{$name}'");
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
