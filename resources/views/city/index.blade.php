@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>城市列表</span>
                <a href="{{ route('city.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg"></i> 新增
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>國家</th>
                            <th>代碼</th>
                            <th>網站代碼</th>
                            <th>名稱</th>
                            <th>英文名稱</th>
                            <th>狀態</th>
                            <th>州/省</th>
                            <th>區域</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td>{{ $city['id'] }}</td>
                                <td>{{ $city['country_id'] }}</td>
                                <td>{{ $city['code'] }}</td>
                                <td>{{ $city['webbed_code'] ?: '-' }}</td>
                                <td>{{ $city['name'] }}</td>
                                <td>{{ $city['en_name'] }}</td>
                                <td>{{ $city['use'] ? '啟用' : '停用' }}</td>
                                <td>{{ $city['state_id'] }}</td>
                                <td>{{ $city['state_zone_id'] }}</td>
                                <td>
                                    <a href="{{ route('city.edit', $city['id']) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="deleteCity({{ $city['id'] }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deleteCity(id) {
            if (confirm('確定要刪除這筆資料嗎？')) {
                fetch(`/information/api/city/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer {{ session('token') }}',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code === '00') {
                            window.location.reload();
                        } else {
                            alert(data.msg);
                        }
                    });
            }
        }
    </script>
@endpush
