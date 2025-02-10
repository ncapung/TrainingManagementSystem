<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Edit Company</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Company</h2>
        <form action="{{ route('companies.update', $company->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>Company name</label>
                <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}" required>
            </div>
            <div class="mb-2">
                <label>Company code</label>
                <input type="text" name="company_code" class="form-control" value="{{ $company->company_code }}" required>
            </div>
            <div class="mb-2">
                <label>Address</label>
                <input type="text" name="alamat" class="form-control" value="{{ $company->alamat }}" required>
            </div>
            <button type="submit" class="btn btn-success">Submit changes</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>