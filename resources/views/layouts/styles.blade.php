<style>
    /* 側邊欄樣式 */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 260px;
        background-color: #2c3e50;
        color: #fff;
        transition: all 0.3s;
        z-index: 1000;
    }

    .sidebar.collapsed {
        margin-left: -260px;
    }

    .sidebar-header {
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .sidebar-brand {
        color: #fff;
        text-decoration: none;
    }

    .sidebar .nav-link {
        color: rgba(255,255,255,0.8);
        padding: 0.8rem 1rem;
        transition: all 0.3s;
    }

    .sidebar .nav-link:hover {
        color: #fff;
        background-color: rgba(255,255,255,0.1);
    }

    .sidebar .nav-link.active {
        color: #fff;
        background-color: rgba(255,255,255,0.2);
    }

    .main-content {
        margin-left: 260px;
        transition: all 0.3s;
    }

    .main-content.expanded {
        margin-left: 0;
    }

    .close-sidebar {
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
    }

    #informationSubmenu .nav-link {
        padding-left: 2rem;
        font-size: 0.9rem;
    }

    .nav-text {
        display: inline-block;
        vertical-align: middle;
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