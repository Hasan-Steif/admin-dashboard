@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8 lg:px-6 space-y-10 fade-in">

        <!-- Welcome -->
        <div class="relative gradient-bg text-white p-8 rounded-2xl shadow-lg overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-pattern"></div>
            <h2 class="text-3xl font-extrabold mb-2 flex items-center">
                <i class="fas fa-hand-sparkles mr-2"></i> Welcome, {{ Auth::user()->name }}
            </h2>
            <p class="text-sm text-white/90">Manage your system with insights and control.</p>
            <div class="absolute right-6 top-6 opacity-20 text-8xl"><i class="fas fa-chart-line"></i></div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Users -->
            <div class="p-5 bg-white rounded-xl border border-gray-100 shadow card-hover">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-sm text-gray-500 uppercase tracking-wide">Total Users</h4>
                        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalUsers }}</p>
                        <span class="text-xs text-green-500 mt-1 block">+12% from last week</span>
                    </div>
                    <div class="text-3xl text-blue-600"><i class="fas fa-users"></i></div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="p-5 bg-white rounded-xl border border-gray-100 shadow card-hover">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-sm text-gray-500 uppercase tracking-wide">Revenue</h4>
                        <p class="text-3xl font-bold text-green-600 mt-1">${{ number_format($revenue) }}</p>
                        <span class="text-xs text-green-500 mt-1 block">+8.4% this month</span>
                    </div>
                    <div class="text-3xl text-green-600"><i class="fas fa-dollar-sign"></i></div>
                </div>
            </div>

            <!-- Orders -->
            <div class="p-5 bg-white rounded-xl border border-gray-100 shadow card-hover">
                <div class="flex justify-between items-center">
                    <div>
                        <h4 class="text-sm text-gray-500 uppercase tracking-wide">Orders</h4>
                        <p class="text-3xl font-bold text-purple-600 mt-1">{{ $orders }}</p>
                        <span class="text-xs text-red-500 mt-1 block">-2.1% compared to last week</span>
                    </div>
                    <div class="text-3xl text-purple-600"><i class="fas fa-box"></i></div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class="fas fa-chart-bar mr-2"></i> Performance Overview
                </h3>
                <select id="time-range"
                    class="text-sm bg-gray-100 px-4 py-1 rounded hover:bg-gray-200 transition focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
            </div>
            <canvas id="chart" class="h-64"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Visitors',
                    data: [120, 190, 170, 220, 150, 200, 230],
                    fill: true,
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
