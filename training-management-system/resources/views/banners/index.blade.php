<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Banners Management</title>

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
                <li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link text-white"><i class="fas fa-user-circle"></i> Profile</a></li>
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
            <h2 style="margin-top: 30px; margin-bottom: 20px;">Banners Management</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table style="margin-bottom: 50px;" id="bannersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td><img src="{{ asset('storage/' . $banner->image) }}?timestamp={{ time() }}" width="100" class="banner-img"></td>
                        <td>{{ $banner->name }}</td>
                        <td>{{ $banner->description }}</td>
                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-edit btn-sm text-white editBanner">Edit</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Add Company Form -->
            <h3 class="mt-4" style="margin-bottom: 20px;">Add New Banner</h3>
            <form id="addBannerForm" action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label>Banners</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Add Banner</button>
            </form>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bannersTable').DataTable();

        $('.delete-btn').click(function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this banner?')) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
</html>
