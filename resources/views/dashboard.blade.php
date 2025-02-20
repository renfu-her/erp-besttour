<!DOCTYPE html>
<html lang="zh-TW" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>控制台</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* 側邊欄樣式 */
        .sidebar {
            min-height: 100vh;
            background-color: var(--bs-dark);
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 1rem;
            min-height: 60px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            color: var(--bs-light);
            text-decoration: none;
            flex: 1;
        }

        .close-sidebar {
            display: none;
            color: var(--bs-light);
            background: none;
            border: none;
            padding: 0.5rem;
        }

        .sidebar .nav-link {
            color: var(--bs-light);
            padding: 0.5rem 1rem;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar .nav-text {
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            display: none;
        }

        /* 主要內容區域 */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 60px;
        }

        /* 卡片樣式 */
        .welcome-card {
            background-color: var(--bs-primary-bg-subtle);
            border: none;
        }

        .earnings-card {
            background-color: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
        }

        /* RWD 調整 */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar.expanded {
                width: 250px;
            }

            .main-content {
                margin-left: 60px;
            }

            .main-content.collapsed {
                margin-left: 250px;
            }

            .sidebar .nav-text {
                opacity: 0;
                display: none;
            }

            .sidebar.expanded .nav-text {
                opacity: 1;
                display: inline;
            }

            .welcome-card img {
                height: 80px !important;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                margin-left: 0;
            }

            .sidebar {
                transform: translateX(-100%);
                background-color: var(--bs-dark);
            }

            .sidebar.expanded {
                transform: translateX(0);
            }

            .close-sidebar {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- 側邊欄 -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                <h5 class="mb-0">
                    <i class="bi bi-code-slash me-2"></i>
                    <span class="nav-text">CodzSword</span>
                </h5>
            </a>
            <button class="close-sidebar" id="closeSidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="flex-grow-1">
            <div class="p-3 text-light">
                <span class="nav-text">Tools & Components</span>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="#">
                    <i class="bi bi-link me-2"></i>
                    <span class="nav-text">No Link</span>
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-file-text me-2"></i>
                    <span class="nav-text">Pages</span>
                </a>
                <a class="nav-link active" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-person me-2"></i>
                    <span class="nav-text">Auth</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- 主要內容區 -->
    <div class="main-content" id="main-content">
        <div class="navbar border-bottom py-2">
            <div class="container-fluid">
                <button class="btn btn-link" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h4 class="mb-0">E-Commerce Dashboard</h4>
                <div class="d-flex align-items-center">
                    <button class="btn btn-link" id="themeToggle">
                        <i class="bi bi-moon-stars"></i>
                    </button>
                    <img src="https://via.placeholder.com/32" class="rounded-circle ms-2" alt="User">
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row g-4">
                <!-- 歡迎卡片 -->
                <div class="col-12 col-md-8">
                    <div class="card welcome-card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Welcome Back, Chris!</h5>
                                <p class="mb-0">AppStack Dashboard</p>
                            </div>
                            <img src="https://via.placeholder.com/150" alt="Welcome" style="height: 120px;">
                        </div>
                    </div>
                </div>

                <!-- 收益卡片 -->
                <div class="col-12 col-md-4">
                    <div class="card earnings-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3>$ 24,300</h3>
                                <span class="text-success">$</span>
                            </div>
                            <div>Total Earnings</div>
                            <div class="mt-2">
                                <span class="badge bg-success">+5.35%</span>
                                <span class="text-muted ms-2">Since last week</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 表格區域 -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Basic Table</h5>
                            <p class="text-muted">Using the most basic table markup, here's how table-based tables look
                                in Bootstrap.</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First</th>
                                            <th>Last</th>
                                            <th>Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry the Bird</td>
                                            <td>@twitter</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 頁尾 -->
        <footer class="footer mt-auto py-3 border-top">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <span>AdminKit ©</span>
                    <div>
                        <a href="#" class="text-muted me-2">Support</a>
                        <a href="#" class="text-muted me-2">Help Center</a>
                        <a href="#" class="text-muted me-2">Privacy</a>
                        <a href="#" class="text-muted">Terms</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // 側邊欄切換
            $('#sidebarToggle').click(function() {
                const sidebar = $('#sidebar');
                const mainContent = $('#main-content');

                if ($(window).width() <= 576) {
                    sidebar.toggleClass('expanded');
                } else {
                    sidebar.toggleClass('collapsed');
                    mainContent.toggleClass('expanded');
                }
            });

            // 移動裝置關閉側邊欄
            $('#closeSidebar').click(function() {
                $('#sidebar').removeClass('expanded');
            });

            // 深色/淺色模式切換
            $('#themeToggle').click(function() {
                const html = $('html');
                const icon = $(this).find('i');

                if (html.attr('data-bs-theme') === 'dark') {
                    html.attr('data-bs-theme', 'light');
                    icon.removeClass('bi-sun').addClass('bi-moon-stars');
                } else {
                    html.attr('data-bs-theme', 'dark');
                    icon.removeClass('bi-moon-stars').addClass('bi-sun');
                }
            });

            // 視窗大小改變時的處理
            $(window).resize(function() {
                const width = $(window).width();
                const sidebar = $('#sidebar');
                const mainContent = $('#main-content');

                if (width <= 576) {
                    sidebar.removeClass('collapsed');
                    mainContent.removeClass('expanded');
                }
            });
        });
    </script>
</body>

</html>
