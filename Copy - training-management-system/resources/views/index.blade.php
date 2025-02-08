<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            display: flex;
            margin: 0;
            overflow-x: hidden;
        }

        nav {
            width: 250px;
            height: 100vh;
            position: fixed;
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            flex: 1;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            nav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
        .btn-edit{
            background-color:rgb(78, 145, 189) !important;
        }
        .btn-delete{
            background-color:rgb(189, 78, 78) !important;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3">
        <h4 class="text-center">Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
            </li>
            @if(Auth::user()->role === 'admin')
            <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link text-white">Users</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Companies</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Banners</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Roles</a></li>
            @endif
            <li class="nav-item"><a href="#" class="nav-link text-white">Manual Book</a></li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 mt-2">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
    
    <!-- Main Content -->
    <div class="main-content">
        <h2>Users Management</h2>
        
        <!-- Tampilkan pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="usersTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Role</th>
                    <th>Birthday</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->company }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->birthday }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm editUser" data-id="{{ $user->id }}">Edit</button>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add User -->
        <h3 class="mt-4">Add New User</h3>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control">
            </div>
            <div class="mb-2">
                <label>Role</label><br>
                <input type="radio" name="role" value="admin" required> Admin
                <input type="radio" name="role" value="guest" required> Guest
            </div>
            <div class="mb-2">
                <label>Birthday</label>
                <input type="date" name="birthday" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
        </form>
    </div>
</body>
</html>