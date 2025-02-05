<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" class="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Dashboard</title>

    <style>
        .bg-subtle-dark {
            background-color:rgb(61, 64, 79) !important;
        }
    </style>

</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
         <nav class="text-white p-3" style="background-color:rgb(25, 32, 59); width: 250px; height: 100vh; position: fixed;">
            <h5 class="text-center" style="margin-top: 20px; margin-bottom: 40px">Training Management System</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                @if(Auth::user()->role == 'admin')
                    <li class="nav-item"><a href="#" class="nav-link text-white">Users</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Companies</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Banners</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Roles</a></li>
                @endif
                <li class="nav-item"><a href="#" class="nav-link text-white">Manual Books</a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100 mt-2">Logout</button>
                    </form>
                </li>
            </ul>
         </nav>
         
        <!-- Main Content -->
        <div class="container-fluid" style="margin-left: 280px; margin-right: 40px; padding-top: 20px;">
            <h2 style="margin-top: 30px; margin-bottom: 30px;">Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-subtle-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text" id="totalUsers">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-subtle-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Companies</h5>
                            <p class="card-text" id="totalCompanies">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-subtle-dark mb3">
                        <div class="card-body">
                            <h5 class="card-title">Total Banners</h5>
                            <p class="card-text" id="totalBanners">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#totalUsers').text({{ $totalUsers }});
        $('#totalCompanies').text({{ $totalCompanies }});
        $('#totalBanners').text({{ $totalBanners }});
    });
</script>

</html>