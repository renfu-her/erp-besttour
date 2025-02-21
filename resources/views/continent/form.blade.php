@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ isset($continent) ? '編輯大洲' : '新增大洲' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($continent) ? route('continent.update', $continent->id) : route('continent.store') }}" 
                  method="POST">
                @csrf
                @if(isset($continent))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">代碼</label>
                    <input type="text" 
                           class="form-control @error('code') is-invalid @enderror" 
                           name="code" 
                           value="{{ old('code', $continent->code ?? '') }}" 
                           required>
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">名稱</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name', $continent->name ?? '') }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">英文名稱</label>
                    <input type="text" 
                           class="form-control @error('en_name') is-invalid @enderror" 
                           name="en_name" 
                           value="{{ old('en_name', $continent->en_name ?? '') }}">
                    @error('en_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <a href="{{ route('continent.index') }}" class="btn btn-secondary">返回</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 