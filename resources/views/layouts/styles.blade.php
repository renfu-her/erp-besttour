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
        position: absolute;
        right: 0.5rem;
        top: 0.5rem;
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
            margin-left: 0 !important;
            width: 100%;
        }

        .sidebar {
            transform: translateX(-100%);
            width: 250px !important;
            height: 100vh;
            position: fixed;
        }

        .sidebar.expanded {
            transform: translateX(0);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        #sidebarToggle {
            position: fixed;
            left: 1rem;
            top: 1rem;
            z-index: 900;
        }

        .close-sidebar {
            display: block !important;
            z-index: 1001;
        }
    }

    /* 新增樣式 */
    .btn-link {
        color: inherit;
        text-decoration: none;
    }

    .btn-link:hover {
        color: inherit;
        opacity: 0.8;
    }
</style> 