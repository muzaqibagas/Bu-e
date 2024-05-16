<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="{{ asset('asset/css/login-u/style.css') }}">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form id="loginForm" action="{{ route('user-login') }}" method="POST">
                @csrf
                <h1>Sign In</h1>
                <span>Use your email and password</span>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <button type="submit">Sign In</button>
                <div id="error-message" style="color: red; margin-top: 10px; display: none;"></div>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register" onclick="window.location.href='{{ route('user-signup') }}';">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('asset/js/login-u/script.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Tangkap elemen formulir login
            var loginForm = document.getElementById("loginForm");
            // Tangkap elemen pesan kesalahan
            var errorMessage = document.getElementById("error-message");

            // Tambahkan event listener untuk menangani submit form
            loginForm.addEventListener("submit", function(event) {
                // Hilangkan pesan kesalahan jika ada
                errorMessage.style.display = "none";
                // Validasi di sisi client juga bisa ditambahkan jika diperlukan
            });

            // Tampilkan pesan kesalahan jika terjadi kesalahan saat login
            @if($errors->has('email') || $errors->has('password'))
                errorMessage.innerHTML = "Invalid email or password.";
                errorMessage.style.display = "block";
            @endif
        });
    </script>
</body>
</html>
