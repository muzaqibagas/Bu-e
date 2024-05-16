<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link rel="stylesheet" href="{{ asset('asset/css/category-c/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Create New Category</h1>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_kategori">Category Name:</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" required>
                </div>
                <button type="submit" id="create-category">Create Category</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('create-category').addEventListener('click', function() {
            Swal.fire({
                title: "Good job!",
                text: "Category created successfully!",
                icon: "success"
            });
        });
    </script>
</body>

</html>
