<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Edit User</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
            </div>
            <div class="mb-2">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="mb-2">
                <label>Password (leave blank if not changing)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-2">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="mb-2">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
            </div>
            <div class="mb-2">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control" value="{{ $user->company_name }}">
            </div>
            <div class="mb-2">
                <label>Role</label><br>
                <input type="radio" name="role" value="admin" {{ $user->role == 'admin' ? 'checked' : '' }} required> Admin
                <input type="radio" name="role" value="guest" {{ $user->role == 'guest' ? 'checked' : '' }} required> Guest
            </div>
            <div class="mb-2">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control" value="{{ $user->birthday }}">
            </div>
            <button type="submit" class="btn btn-success">Submit changes</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>