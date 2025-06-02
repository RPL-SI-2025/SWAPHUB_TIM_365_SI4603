@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto">
    <!-- Welcome Section with Quick Stats -->
    <div class="mb-8 bg-gradient-to-r from-tertiary to-primary rounded-3xl p-8 text-white shadow-lg">
      <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
          <h2 class="text-4xl font-bold mb-2">Welcome Back, {{ Auth::user()->full_name }}
          </h2>
          <p class="text-blue-100 mb-4">{{ now()->format('l, d F Y') }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center gap-4 bg-white/10 rounded-2xl p-4">
          <div class="text-center">
            <p class="text-sm text-blue-200">Today's Trades</p>
            <p class="text-2xl font-bold">{{ $todayTradesCount ?? 0 }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Total Users Card -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
          <div class="bg-blue-100 rounded-xl p-3">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($totalUsers ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Total Users</p>
        <div class="mt-4 flex items-center text-xs text-gray-400">
          <span class="text-green-500 flex items-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
            {{ $newUsersThisWeek ?? 0 }}
          </span>
          <span class="ml-2">new this week</span>
        </div>
      </div>

      <!-- Trades Card -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
          <div class="bg-green-100 rounded-xl p-3">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
          </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($totalTrades ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Total Trades</p>
        <div class="mt-4">
          <div class="flex justify-between text-xs text-gray-400 mb-1">
            <span>Success Rate</span>
            <span class="text-green-500">{{ $tradeSuccessRate ?? '0' }}%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-1.5">
            <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $tradeSuccessRate ?? 0 }}%"></div>
          </div>
        </div>
      </div>

      <!-- Average Rating Card -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
          <div class="bg-purple-100 rounded-xl p-3">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $averageRating ?? 0 }}<span
            class="ms-1 text-2xl text-yellow-400">★</span></h3>
        <p class="text-sm text-gray-500">Average Web Rating</p>
      </div>

      <!-- Reports Card -->
      <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
          <div class="bg-red-100 rounded-xl p-3">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
        </div>
        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($totalReports ?? 0) }}</h3>
        <p class="text-sm text-gray-500">Active Reports</p>
        <div class="mt-4">
          <div class="space-y-2">
            <div class="flex justify-between text-xs">
              <span class="text-gray-500">Pending</span>
              <span class="text-yellow-500 font-medium">{{ $pendingReports ?? 0 }}</span>
            </div>
            <div class="flex justify-between text-xs">
              <span class="text-gray-500">Accepted</span>
              <span class="text-green-500 font-medium">{{ $acceptReports ?? 0 }}</span>
            </div>
            <div class="flex justify-between text-xs">
              <span class="text-gray-500">Rejected</span>
              <span class="text-red-500 font-medium">{{ $rejectReports ?? 0 }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
