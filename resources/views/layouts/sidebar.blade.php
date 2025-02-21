<!-- 側邊欄 -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <h5 class="mb-0">
                <i class="bi bi-code-slash me-2"></i>
                <span class="nav-text">管理系統</span>
            </h5>
        </a>
        <button class="close-sidebar" id="closeSidebar">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="flex-grow-1">
        <div class="p-3 text-light">
            <span class="nav-text">基本資料管理</span>
        </div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                <span class="nav-text">儀表板</span>
            </a>

            <!-- 基本資料管理選單 -->
            <div class="nav-item">
                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                    href="#informationSubmenu">
                    <div>
                        <i class="bi bi-globe me-2"></i>
                        <span class="nav-text">基本資料</span>
                    </div>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse {{ request()->is('information/*') ? 'show' : '' }}" id="informationSubmenu">
                    <nav class="nav flex-column ms-3">
                        <!-- 大洲管理 -->
                        <div class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" href="#continentSubmenu">
                                <div>
                                    <i class="bi bi-diagram-3 me-2"></i>
                                    <span class="nav-text">大洲管理</span>
                                </div>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse" id="continentSubmenu">
                                <nav class="nav flex-column ms-3">
                                    <a class="nav-link" href="{{ route('continent.index') }}">
                                        <i class="bi bi-list me-2"></i>
                                        <span class="nav-text">列表</span>
                                    </a>
                                    <a class="nav-link" href="{{ route('continent.create') }}">
                                        <i class="bi bi-plus-lg me-2"></i>
                                        <span class="nav-text">新增</span>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <!-- 國家管理 -->
                        <div class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" href="#countrySubmenu">
                                <div>
                                    <i class="bi bi-flag me-2"></i>
                                    <span class="nav-text">國家管理</span>
                                </div>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse" id="countrySubmenu">
                                <nav class="nav flex-column ms-3">
                                    <a class="nav-link" href="#" onclick="showCountryList()">
                                        <i class="bi bi-list me-2"></i>
                                        <span class="nav-text">列表</span>
                                    </a>
                                    <a class="nav-link" href="#" onclick="showCountryForm()">
                                        <i class="bi bi-plus-lg me-2"></i>
                                        <span class="nav-text">新增</span>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        <!-- 城市管理 -->
                        <div class="nav-item">
                            <a class="nav-link d-flex justify-content-between align-items-center"
                                data-bs-toggle="collapse" href="#citySubmenu">
                                <div>
                                    <i class="bi bi-building me-2"></i>
                                    <span class="nav-text">城市管理</span>
                                </div>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="collapse" id="citySubmenu">
                                <nav class="nav flex-column ms-3">
                                    <a class="nav-link" href="#" onclick="showCityList()">
                                        <i class="bi bi-list me-2"></i>
                                        <span class="nav-text">列表</span>
                                    </a>
                                    <a class="nav-link" href="#" onclick="showCityForm()">
                                        <i class="bi bi-plus-lg me-2"></i>
                                        <span class="nav-text">新增</span>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>
                <span class="nav-text">登出</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>
</div>

@push('scripts')
    <script>
        // 側邊欄基本功能
        document.addEventListener('DOMContentLoaded', function() {
            const closeSidebarBtn = document.getElementById('closeSidebar');
            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', function() {
                    document.getElementById('sidebar').classList.toggle('collapsed');
                    document.getElementById('main-content').classList.toggle('expanded');
                });
            }
        });

        // 大洲管理功能
        function showContinentList() {
            fetch('/information/continent', {
                    headers: {
                        'Authorization': 'Bearer {{ session('token') }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === '00') {
                        const mainContent = document.querySelector('.container-fluid');
                        let html = `
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>大洲列表</span>
                        <button class="btn btn-primary btn-sm" onclick="showContinentForm()">
                            <i class="bi bi-plus-lg"></i> 新增
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>代碼</th>
                                    <th>名稱</th>
                                    <th>英文名稱</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
            `;

                        data.data.forEach(item => {
                            html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.code}</td>
                        <td>${item.name}</td>
                        <td>${item.en_name || '-'}</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="editContinent(${item.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteContinent(${item.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                        });

                        html += `
                            </tbody>
                        </table>
                    </div>
                </div>
            `;

                        mainContent.innerHTML = html;
                    }
                });
        }

        function showContinentForm(id = null) {
            const mainContent = document.querySelector('.container-fluid');
            let html = `
        <div class="card">
            <div class="card-header">
                ${id ? '編輯大洲' : '新增大洲'}
            </div>
            <div class="card-body">
                <form id="continentForm" onsubmit="saveContinent(event)">
                    <input type="hidden" name="id" value="${id || ''}">
                    <div class="mb-3">
                        <label class="form-label">代碼</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">名稱</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">英文名稱</label>
                        <input type="text" class="form-control" name="en_name">
                    </div>
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <button type="button" class="btn btn-secondary" onclick="showContinentList()">取消</button>
                </form>
            </div>
        </div>
    `;

            mainContent.innerHTML = html;

            // 如果是編輯，載入現有數據
            if (id) {
                // 實作載入現有數據的邏輯
            }
        }

        // 其他功能類似，需要實作：
        // - saveContinent()
        // - editContinent()
        // - deleteContinent()
        // - showCountryList()
        // - showCountryForm()
        // - showCityList()
        // - showCityForm()
    </script>
@endpush
