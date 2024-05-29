<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit User: {{ $user->name }}</h1>

    @if ($errors->has('role'))
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('role') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('name', $user->mobile_number) }}">
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
{{--                <div>--}}
{{--                    <label><input type="radio" name="role" value="User" {{ $user->role == 'User' ? 'checked' : '' }}> User</label>--}}
{{--                    <label><input type="radio" name="role" value="Manager" {{ $user->role == 'Manager' ? 'checked' : '' }}> Manager</label>--}}
{{--                    <label><input type="radio" name="role" value="Admin" {{ $user->role == 'Admin' ? 'checked' : '' }}> Admin</label>--}}

{{--                </div>--}}



        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <!-- Forma za brisanje korisnika -->
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
    </form>

    <div class="mt-3">
        <a href="{{ route('see-users')}}" class="btn btn-primary">Back</a>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>Edit User</title>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="container mt-5">--}}
{{--    <h1>Edit User: {{ $user->name }}</h1>--}}

{{--    @if ($errors->has('role'))--}}
{{--        <div class="alert alert-danger" role="alert">--}}
{{--            {{ $errors->first('role') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger" role="alert">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if (session('success'))--}}
{{--        <div class="alert alert-success" role="alert">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form action="{{ route('users.update', $user->id) }}" method="POST">--}}
{{--        @csrf--}}

{{--        <div class="form-group">--}}
{{--            <label for="name">Name:</label>--}}
{{--            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="mobile_number">Mobile Number:</label>--}}
{{--            <input type="text" id="mobile" name="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}" required>--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}
{{--            <label for="role">Role:</label>--}}
{{--            <select id="role" name="role" class="form-control">--}}
{{--                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>--}}
{{--                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>--}}
{{--                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary">Update User</button>--}}
{{--    </form>--}}

{{--    <div>{{$user->role}}</div>--}}

{{--    <!-- Dodajemo dugme koje vodi na dashboard -->--}}
{{--    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>--}}
{{--</div>--}}

{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}

{{--</body>--}}
{{--</html>--}}
