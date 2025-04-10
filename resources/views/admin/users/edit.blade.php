@extends ('layouts.app')

@section ('title', 'Edit User')

@section ('content')
<div class="container mt-4">
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->id }}" method="POST">
        @method('PUT')
        @include('admin.users._form')
    </form>
</div>
@endsection