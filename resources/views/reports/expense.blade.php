@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Filters Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-dark">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="text-white mb-0">
                            <i class="fas fa-chart-pie me-2"></i>
                            Отчет по расходам
                        </h3>
                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filtersCollapse" aria-expanded="false">
                            <i class="fas fa-filter me-1"></i>
                            Фильтры
                        </button>
                    </div>
                    
                    <!-- Filters Panel -->
                    <div class="collapse {{ request()->hasAny(['date_from', 'date_to', 'category']) ? 'show' : '' }}" id="filtersCollapse">
                        <div class="card-body border-top">
                            <form method="GET" action="{{ route('reports.expense') }}" id="filterForm">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="date_from" class="form-label text-white">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Дата с
                                        </label>
                                        <input type="date" class="form-control text-white" id="date_from" name="date_from" 
                                               value="{{ $filters['date_from'] ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="date_to" class="form-label text-white">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Дата по
                                        </label>
                                        <input type="date" class="form-control text-white" id="date_to" name="date_to" 
                                               value="{{ $filters['date_to'] ?? '' }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="category" class="form-label text-white">
                                            <i class="fas fa-tags me-1"></i>
                                            Категория
                                        </label>
                                        <select class="form-select text-white" id="category" name="category">
                                            <option value="all" {{ ($filters['category'] ?? 'all') == 'all' ? 'selected' : '' }}>Все категории</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ ($filters['category'] ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <div class="d-flex gap-2 w-100">
                                            <button type="submit" class="btn btn-outline-primary btn-sm flex-fill">
                                                <i class="fas fa-search me-1"></i>
                                                Применить
                                            </button>
                                            <a href="{{ route('reports.expense') }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="row">
            <div class="col-12">
                <div class="card bg-dark">
                    <div class="card-body">
                        <div class="bg-dark text-white rounded w-100 p-3" id="piechart" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
@endsection

@section('scripts')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>	
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            const chartData = @json($transactions);
            var dataArray = [];

            dataArray.push(['Категория', 'Сумма']);

            chartData.forEach(element => {
                if (element.category && element.category.name) {
                    dataArray.push([element.category.name, parseFloat(element.category_sum)]);
                }
            });

            var data = google.visualization.arrayToDataTable(dataArray);

            var options = {
                title: 'Статистика по тратам {{ request()->hasAny(["date_from", "date_to"]) ? "(за выбранный период)" : "(за всё время)" }}',
                backgroundColor: 'transparent',
                titleTextStyle: {
                    color: '#ffffff',
                    fontSize: 18,
                    bold: true
                },
                legend: {
                    textStyle: {
                        color: '#ffffff',
                        fontSize: 14
                    }
                },
                pieSliceTextStyle: {
                    color: '#ffffff',
                    fontSize: 12,
                    bold: true
                },
                pieSliceBorderColor: '#495057',
                tooltip: {
                    textStyle: {
                        color: '#212529',
                        fontSize: 14
                    }
                },
                chartArea: { 
                    width: '90%', 
                    height: '80%',
                    left: '5%',
                    top: '10%',
                    backgroundColor: {
                        fill: 'transparent'
                    }
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

        // Автоматическое применение фильтров при изменении
        document.addEventListener('DOMContentLoaded', function() {
            const filterInputs = document.querySelectorAll('#filterForm input, #filterForm select');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });
            });
        });
    </script>
@endsection