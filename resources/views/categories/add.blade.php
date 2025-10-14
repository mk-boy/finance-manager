@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card bg-dark">
                <div class="card-header">
                    <h3 class="text-white mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Добавить новую категорию
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.add') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        
                        <div class="mb-3">
                            <label for="name" class="form-label text-white">
                                <i class="fas fa-tag me-2"></i>
                                Название категории
                            </label>
                            <input type="text" 
                                   class="form-control text-white @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   placeholder="Введите название категории"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label text-white">
                                <i class="fas fa-align-left me-2"></i>
                                Описание
                            </label>
                            <textarea class="form-control text-white @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      maxlength="255"
                                      placeholder="Введите описание категории (необязательно)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="type_id" class="form-label text-white">
                                <i class="fas fa-list me-2"></i>
                                Тип категории
                            </label>
                            <select class="form-select text-white @error('type_id') is-invalid @enderror" 
                                    id="type_id" 
                                    name="type_id" 
                                    required>
                                <option value="" disabled {{ old('type_id') == '' ? 'selected' : '' }}>Выберите тип категории</option>
                                <option value="{{ \App\Models\Category::INCOME_TYPE_ID }}" {{ old('type_id') == \App\Models\Category::INCOME_TYPE_ID ? 'selected' : '' }}>Доход</option>
                                <option value="{{ \App\Models\Category::EXPENSE_TYPE_ID }}" {{ old('type_id') == \App\Models\Category::EXPENSE_TYPE_ID ? 'selected' : '' }}>Расход</option>
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="tag_color" class="form-label text-white">
                                <i class="fas fa-palette me-2"></i>
                                Цвет категории
                            </label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color" 
                                       class="d-none @error('tag_color') is-invalid @enderror" 
                                       id="tag_color" 
                                       name="tag_color" 
                                       value="{{ old('tag_color', '#ff0000') }}">
                                <div class="color-preview" 
                                     style="width: 30px; height: 30px; background-color: {{ old('tag_color', '#ff0000') }}; border-radius: 50%; transition: all 0.3s ease; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.3);" 
                                     title="Нажмите для выбора цвета"></div>
                            </div>
                            @error('tag_color')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-success">
                                <i class="fas fa-save me-2"></i>
                                Создать категорию
                            </button>
                            <a href="{{ route('categories') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('tag_color');
        const colorPreview = document.querySelector('.color-preview');
        
        colorInput.addEventListener('input', function() {
            colorPreview.style.backgroundColor = this.value;
        });
        
        colorInput.addEventListener('change', function() {
            colorPreview.style.backgroundColor = this.value;
        });
        
        colorPreview.style.backgroundColor = colorInput.value;
        
        colorPreview.addEventListener('click', function() {
            colorInput.click();
        });
        
        colorInput.addEventListener('blur', function() {
            // Небольшая задержка для корректной работы
            setTimeout(() => {
                if (document.activeElement !== colorInput) {
                    colorInput.blur();
                }
            }, 100);
        });
        
        document.addEventListener('click', function(event) {
            if (!colorInput.contains(event.target) && !colorPreview.contains(event.target)) {
                colorInput.blur();
            }
        });
        
        colorPreview.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 0 10px rgba(255, 255, 255, 0.3)';
        });
        
        colorPreview.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
    });
</script>
@endsection