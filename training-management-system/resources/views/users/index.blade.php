<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Users</title>

    <style>
        body {
            display: flex;
            margin: 0;
            overflow-x: hidden;
            width: 100%;
        }

        nav {
            width: 250px;
            height: 100vh;
            position: fixed;
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 20px;
            padding-left: 50px;
            padding-right: 50px;
        }

        @media (max-width: 768px) {
            nav {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
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
    <div class="d-flex w-100">
        <!-- Sidebar -->
        <nav class="text-white p-3" style="background-color:rgb(25, 32, 59); width: 250px; height: 100vh; position: fixed;">
            <h5 class="text-center" style="margin-top: 20px; margin-bottom: 40px">Training Management System</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link text-white">Users</a></li>
                    <li class="nav-item"><a href="{{ route('companies.index') }}" class="nav-link text-white">Companies</a></li>
                    <li class="nav-item"><a href="{{ route('banners.index') }}" class="nav-link text-white">Banners</a></li>
                    <li class="nav-item"><a href="{{ route('roles.index') }}" class="nav-link text-white">Roles</a></li>
                @endif
                <li class="nav-item"><a href="{{ route('manual_books.index') }}" class="nav-link text-white">Manual Books</a></li>
                <li class="nav-item"><a href="{{ route('rickandmorty.index') }}" class="nav-link text-white">Rick and Morty API</a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 mt-2">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            <h2 style="margin-top: 30px; margin-bottom: 20px;">Users Management</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table style="margin-bottom: 50px;" id="usersTable" class="table table-striped">
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
                        <td>{{ $user->company_name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit btn-sm text-white editUser">Edit</a>
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

            <!-- Add User Form -->
            <h3 class="mt-4" style="margin-bottom: 20px;">Add New User</h3>
            <form id="addUserForm" action="{{ route('users.store') }}" method="POST">
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
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
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
            <button type="submit" class="btn btn-primary mt-2">Add User</button>
            </form>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();

        $('.delete-btn').click(function() {
            let userId = $(this).data('id');
            let userName = $(this).data('name');

            if (confirm(`Are you sure to delete user?"${userName}"?`)) {
                $(this).closest('.delete-form').submit();
            }
        });

        $('#addUserForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('users.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert('User successfully added!');
                    location.reload();
                },
                error: function(response) {
                    alert('Fail to add user!');
                }
            });
        });
    });
</script>
</html>