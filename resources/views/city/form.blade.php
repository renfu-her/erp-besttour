@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ isset($city) ? '編輯城市' : '新增城市' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($city) ? route('city.update', $city['id']) : route('city.store') }}" 
                  method="POST">
                @csrf
                @if(isset($city))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">所屬國家</label>
                    <select class="form-select @error('country_id') is-invalid @enderror" 
                            name="country_id" required>
                        <option value="">請選擇國家</option>
                        @foreach($countries as $country)
                            <option value="{{ $country['id'] }}"
                                {{ old('country_id', $city['country_id'] ?? '') == $country['id'] ? 'selected' : '' }}>
                                {{ $country['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">名稱</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name', $city['name'] ?? '') }}" 
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
                           value="{{ old('en_name', $city['en_name'] ?? '') }}" 
                           required>
                    @error('en_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">代碼</label>
                    <input type="text" 
                           class="form-control @error('code') is-invalid @enderror" 
                           name="code" 
                           value="{{ old('code', $city['code'] ?? '') }}" 
                           required>
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">狀態</label>
                    <select class="form-select @error('use') is-invalid @enderror" 
                            name="use" required>
                        <option value="1" {{ old('use', $city['use'] ?? '') == 1 ? 'selected' : '' }}>啟用</option>
                        <option value="0" {{ old('use', $city['use'] ?? '') == 0 ? 'selected' : '' }}>停用</option>
                    </select>
                    @error('use')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <a href="{{ route('city.index') }}" class="btn btn-secondary">返回</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 