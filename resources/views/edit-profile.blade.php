<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('asset/css/edit-p/style.css') }}"> <!-- Panggil file CSS eksternal -->
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto">
            <div class="card-header text-center">
                <h2>Edit Profile</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update-profile') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                    </div>
                    <!-- Tambahkan form field lain jika diperlukan -->
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                    <br>
                    <button type="submit" class="btn btn-warning">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
