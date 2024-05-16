<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <!-- Tambahkan link ke CSS jika diperlukan -->
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Create New Admin</h1>
            <form action="{{ route('admins.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Create Admin</button>
            </form>
        </div>
    </div>
</body>
</html>
