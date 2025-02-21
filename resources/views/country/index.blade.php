@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>國家列表</span>
            <a href="{{ route('country.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> 新增
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>大洲</th>
                        <th>代碼</th>
                        <th>名稱</th>
                        <th>英文名稱</th>
                        <th>電話區碼</th>
                        <th>建立時間</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                        <tr>
                            <td>{{ $country['id'] }}</td>
                            <td>{{ $country['continent']['name'] }}</td>
                            <td>{{ $country['code']['three'] }}</td>
                            <td>{{ $country['name'] }}</td>
                            <td>{{ $country['en_name'] }}</td>
                            <td>{{ $country['tel_area'] }}</td>
                            <td>{{ $country['created_at'] }}</td>
                            <td>
                                <a href="{{ route('country.edit', $country['id']) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="deleteCountry({{ $country['id'] }})">
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
function deleteCountry(id) {
    if (confirm('確定要刪除這筆資料嗎？')) {
        fetch(`/information/api/country/${id}`, {
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