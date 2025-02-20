<div class="navbar border-bottom py-2">
    <div class="container-fluid">
        <button class="btn btn-link" id="sidebarToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
        <h4 class="mb-0"></h4>
        <div class="d-flex align-items-center">
            <button class="btn btn-link" id="themeToggle">
                <i class="bi bi-moon-stars"></i>
            </button>
            <div class="dropdown">
                <button class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-circle-user fs-4"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <h6 class="dropdown-header">使用者內容</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>登出
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
