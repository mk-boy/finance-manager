@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="alert alert-dismissible fade" role="alert" style="display: none;">
                <span class="alert-message"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @if (!empty($categories))
                <div class="card bg-dark border-secondary mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-tags me-2"></i>
                            Ваши категории
                        </h3>
                        <a href="{{ route('categories.add') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Добавить категорию
                        </a>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-light border-0">Название</th>
                                        <th scope="col" class="text-light border-0">Тип</th>
                                        <th scope="col" class="text-light border-0">Описание</th>
                                        <th scope="col" class="text-light border-0">Цвет</th>
                                        <th scope="col" class="text-center text-light border-0">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="category-{{ $category->id }}">
                                            <td class="fw-bold text-light">{{ $category->name }}</td>
                                            <td>
                                                @if ($category->type_id == \App\Models\Category::INCOME_TYPE_ID)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-arrow-up me-1"></i>
                                                        Доход
                                                    </span>
                                                @elseif ($category->type_id == \App\Models\Category::EXPENSE_TYPE_ID)
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-arrow-down me-1"></i>
                                                        Расход
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-light opacity-75">{{ $category->description }}</td>
                                            <td>
                                                <div style="width: 30px; height: 30px; background-color: {{ $category->tag_color }}; border-radius: 50%; border: 2px solid #2a2a2a;"></div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm delete_btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    <input type="hidden" class="category_id" value="{{ $category->id }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="card bg-dark border-secondary">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-tags text-muted fs-1 mb-3"></i>
                        <h3 class="text-white mb-3">Пока нет категорий</h3>
                        <p class="text-light mb-4">Добавьте свою первую категорию для организации финансов</p>
                        <a href="{{ route('categories.add') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>
                            Добавить категорию
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete_btn').on('click', function () {
            let category_id = $(this).siblings('.category_id').val();
            let categoryRow = $(`.category-${category_id}`);

            $.ajax({
                url: '/categories/delete',
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: category_id
                },
                success: function (response) {
                    if (response.success) {
                        categoryRow.fadeOut(300, function () {
                            $(this).remove();
                        });
                        showAlert(response.message, 'success');
                    }
                },
                error: function(xhr) {
                    showAlert('Ошибка при удалении категории', 'danger');
                }
            });
        });

        function showAlert(message, type) {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let alert = $('.alert');
            
            alert.removeClass('alert-success alert-danger');
            alert.addClass(alertClass);
            alert.find('.alert-message').text(message);
            
            alert.show().addClass('show');

            setTimeout(function () {
                alert.removeClass('show').fadeOut();
            }, 3000);
        }
    });
</script>
@endsection