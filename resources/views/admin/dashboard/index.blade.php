@extends('layouts.admin.app')

@section('content')
  <div class="container mx-auto">
    <div class="mb-6">
      <h2 class="text-3xl font-bold text-gray-800">Welcome <span class="text-blue-500">{{ Auth::user()->full_name }}</span>
      </h2>
    </div>
  </div>
@endsection
