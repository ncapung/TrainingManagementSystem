<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            background-color: gray;
            font-size: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container profile-container">
        <h2>User Profile</h2>

        <!-- Profile Picture -->
        <div id="profile-pic" class="profile-pic">
            @if(Auth::user()->profile_picture)
                <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}" class="profile-pic">
            @else
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            @endif
        </div>
        
        <!-- Upload Profile Picture -->
        <form id="uploadProfilePicForm" action="{{ route('profile.updatePhoto') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="profile_picture" accept="image/jpeg, image/png, image/jpg, image/gif" class="form-control mt-3">
            <button type="submit" class="btn btn-primary mt-2">Upload New Photo</button>
        </form>

        <!-- User Info -->
        <table class="table mt-4">
            <tr><th>Name</th><td>{{ Auth::user()->name }}</td></tr>
            <tr><th>Email</th><td>{{ Auth::user()->email }}</td></tr>
            <tr><th>Password</th><td>********</td></tr>
            <tr><th>Phone Number</th><td>{{ Auth::user()->phone_number }}</td></tr>
            <tr><th>Company</th><td>{{ Auth::user()->company_name }}</td></tr>
            <tr><th>Role</th><td>{{ Auth::user()->role }}</td></tr>
            <tr><th>Birthday</th><td>{{ Auth::user()->birthday }}</td></tr>
        </table>

        <!-- Edit Profile Button -->
        <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-warning">Edit</a>
        
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </div>
        
    <script>
        $(document).ready(function() {
            $('#uploadProfilePicForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('profile.updatePhoto') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Profile picture updated!');
                        location.reload();
                    },
                    error: function(response) {
                        alert('Failed to update profile picture.');
                    }
                });
            });
        });
    </script>
</body>
</html>