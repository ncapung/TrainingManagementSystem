<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <title>Rick and Morty</title>

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
            <h2 style="margin-top: 30px; margin-bottom: 20px;">Rick and Morty Characters</h2>

            <div class="mb-3">
                <input type="text" id="searchCharacter" class="form-control" placeholder="Search Character Name...">
            </div>
            <table id="charactersTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Species</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- data di js -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let table = $('#charactersTable').DataTable();
            let allCharacters = [];

            function fetchAllCharacters(page = 1) {
                $.ajax({
                    url: `https://rickandmortyapi.com/api/character/?page=${page}`,
                    method: 'GET',
                    success: function(response) {
                        allCharacters = allCharacters.concat(response.results);
                        if (response.info.next) {
                            fetchAllCharacters(page + 1);
                        } else {
                            displayCharacters(allCharacters);
                        }
                    },
                    error: function() {
                        console.error("Gagal mengambil data dari API");
                    }
                });
            }

            function displayCharacters(characters) {
                table.clear();
                characters.forEach(character => {
                    table.row.add([
                        `<img src="${character.image}" width="50" class="rounded-circle">`,
                        character.name,
                        character.status,
                        character.species,
                        character.gender
                    ]);
                });
                table.draw();
            }

            fetchAllCharacters();

            $('#searchCharacter').on('keyup', function() {
                let query = $(this).val().toLowerCase();
                let filteredCharacters = allCharacters.filter(character => 
                    character.name.toLowerCase().includes(query)
                );
                displayCharacters(filteredCharacters);
            });
        });
    </script>
</body>
</html>