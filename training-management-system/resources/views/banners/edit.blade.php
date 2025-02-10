<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Banner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Banner</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Banner Display -->
        <div class="mb-3">
            <label>Current Banner Image:</label>
            <img id="bannerImage" src="{{ asset('storage/banners/' . $banner->image) }}" alt="Banner Image" class="img-fluid d-block mt-2" width="300">
        </div>

        <!-- Edit Data Form -->
        <form id="uploadBannerPicForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Upload New Banner Image:</label>
                <input type="file" name="image" id="imageInput" accept="image/jpeg, image/png, image/jpg, image/gif" class="form-control mt-2" required>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-bottom: 20px">Upload New Photo</button>
        </form>

        <!-- Form untuk update name & description -->
        <form id="editBannerForm" action="{{ route('banners.update', $banner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Banner Title</label>
                <input type="text" name="name" class="form-control" value="{{ $banner->name }}" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" required>{{ $banner->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-success" style="margin-bottom: 30px">Submit Changes</button>
            <a href="{{ route('banners.index') }}" class="btn btn-secondary" style="margin-bottom: 30px">Cancel</a>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#uploadBannerPicForm").submit(function (e) {
                e.preventDefault();

                let formData = new FormData();
                formData.append("_token", "{{ csrf_token() }}");
                formData.append("image", $("#imageInput")[0].files[0]);

                $.ajax({
                    url: "{{ route('banners.updateImage', $banner->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            $("#bannerImage").attr("src", response.image_url + "?" + new Date().getTime());
                        } else {
                            alert("Failed to upload image.");
                        }
                    },
                    error: function () {
                        alert("An error occurred while uploading the image.");
                    }
                });
            });
        });
    </script>
</body>
</html>
