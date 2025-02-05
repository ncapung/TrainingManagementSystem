<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh; position: fixed;">
            <h4 class="text-center">Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                </li>
                @if(Auth::user()->role === 'admin')
                    <li class="nav-item"><a href="#" class="nav-link text-white">Users</a></li>
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
        <div class="container-fluid" style="margin-left: 260px; padding-top: 20px;">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text" id="totalUsers">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Companies</h5>
                            <p class="card-text" id="totalCompanies">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
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
</html>
