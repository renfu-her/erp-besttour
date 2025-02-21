@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">基本資料管理</div>

                    <div class="card-body">
                        <div class="row">
                            <!-- 大洲管理 -->
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">大洲管理</h5>
                                        <p class="card-text">管理大洲資料</p>
                                        <button type="button" class="btn btn-primary" onclick="loadContinents()">
                                            查看大洲列表
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- 國家管理 -->
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">國家管理</h5>
                                        <p class="card-text">管理國家資料</p>
                                        <button type="button" class="btn btn-primary" onclick="loadCountries()">
                                            查看國家列表
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- 城市管理 -->
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">城市管理</h5>
                                        <p class="card-text">管理城市資料</p>
                                        <button type="button" class="btn btn-primary" onclick="loadCities()">
                                            查看城市列表
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 數據顯示區域 -->
                        <div class="mt-4">
                            <div id="dataTable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // 修改 token 獲取方式
        function getToken() {
            // 直接返回完整的 Authorization header 值
            return 'Bearer {{ session('token') }}';
        }

        function loadContinents() {
            fetch('/information/continent', {
                    headers: {
                        'Authorization': getToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === '00') {
                        displayData(data.data, 'continents');
                    } else {
                        alert(data.msg);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadCountries() {
            fetch('/information/country', {
                    headers: {
                        'Authorization': getToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === '00') {
                        displayData(data.data, 'countries');
                    } else {
                        alert(data.msg);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function loadCities() {
            fetch('/information/city', {
                    headers: {
                        'Authorization': getToken(),
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === '00') {
                        displayData(data.data, 'cities');
                    } else {
                        alert(data.msg);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function displayData(data, type) {
            const tableDiv = document.getElementById('dataTable');
            let html = '<table class="table table-bordered">';

            switch (type) {
                case 'continents':
                    html += `
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>代碼</th>
                        <th>名稱</th>
                        <th>英文名稱</th>
                        <th>建立時間</th>
                    </tr>
                </thead>
                <tbody>
            `;
                    data.forEach(item => {
                        html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.code}</td>
                        <td>${item.name}</td>
                        <td>${item.en_name || '-'}</td>
                        <td>${item.created_at}</td>
                    </tr>
                `;
                    });
                    break;

                case 'countries':
                    html += `
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>國家代碼</th>
                        <th>名稱</th>
                        <th>英文名稱</th>
                        <th>電話區號</th>
                    </tr>
                </thead>
                <tbody>
            `;
                    data.forEach(continent => {
                        continent.country.forEach(item => {
                            html += `
                        <tr>
                            <td>${item.id}</td>
                            <td>${item.code.two}/${item.code.three}</td>
                            <td>${item.name}</td>
                            <td>${item.e_name}</td>
                            <td>${item.tel_area}</td>
                        </tr>
                    `;
                        });
                    });
                    break;

                case 'cities':
                    html += `
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名稱</th>
                        <th>英文名稱</th>
                        <th>代碼</th>
                    </tr>
                </thead>
                <tbody>
            `;
                    data.forEach(item => {
                        html += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.en_name}</td>
                        <td>${item.code}</td>
                    </tr>
                `;
                    });
                    break;
            }

            html += '</tbody></table>';
            tableDiv.innerHTML = html;
        }
    </script>
@endpush
