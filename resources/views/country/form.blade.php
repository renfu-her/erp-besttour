@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            {{ isset($country) ? '編輯國家' : '新增國家' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($country) ? route('country.update', $country['id']) : route('country.store') }}" 
                  method="POST">
                @csrf
                @if(isset($country))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">所屬大洲</label>
                    <select class="form-select @error('continent_id') is-invalid @enderror" 
                            name="continent_id" required>
                        <option value="">請選擇大洲</option>
                        @foreach($continents as $continent)
                            <option value="{{ $continent['id'] }}"
                                {{ old('continent_id', $country['continent_id'] ?? '') == $continent['id'] ? 'selected' : '' }}>
                                {{ $continent['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('continent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">名稱</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           name="name" 
                           value="{{ old('name', $country['name'] ?? '') }}" 
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
                           value="{{ old('en_name', $country['en_name'] ?? '') }}" 
                           required>
                    @error('en_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">三位字母代碼</label>
                    <input type="text" 
                           class="form-control @error('code3') is-invalid @enderror" 
                           name="code3" 
                           value="{{ old('code3', $country['code']['three'] ?? '') }}" 
                           required>
                    @error('code3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">電話區碼</label>
                    <input type="text" 
                           class="form-control @error('tel_area') is-invalid @enderror" 
                           name="tel_area" 
                           value="{{ old('tel_area', $country['tel_area'] ?? '') }}" 
                           required>
                    @error('tel_area')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">儲存</button>
                    <a href="{{ route('country.index') }}" class="btn btn-secondary">返回</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 