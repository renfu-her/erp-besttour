@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>大洲列表</span>
            <a href="{{ route('continent.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> 新增
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>代碼</th>
                        <th>名稱</th>
                        <th>英文名稱</th>
                        <th>建立時間</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($continents as $continent)
                    <tr>
                        <td>{{ $continent->id }}</td>
                        <td>{{ $continent->code }}</td>
                        <td>{{ $continent->name }}</td>
                        <td>{{ $continent->en_name ?? '-' }}</td>
                        <td>{{ $continent->created_at }}</td>
                        <td>
                            <a href="{{ route('continent.edit', $continent->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" 
                                    class="btn btn-danger btn-sm"
                                    onclick="deleteContinent({{ $continent->id }})">
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
function deleteContinent(id) {
    if (confirm('確定要刪除這筆資料嗎？')) {
        fetch(`/information/api/continent/${id}`, {
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