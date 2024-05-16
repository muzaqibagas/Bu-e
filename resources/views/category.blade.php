<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bu'e</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet"href="{{ asset('asset/css/dashboard/style.css') }}">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="title">Bu'e Cookies and pastry</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/dashboard') }}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/biaya') }}">
                        <span class="icon">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </span>
                        <span class="title">Biaya</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/product') }}">
                        <span class="icon">
                            <ion-icon name="pricetags-outline"></ion-icon>
                        </span>
                        <span class="title">Product</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/category') }}">
                        <span class="icon">
                            <ion-icon name="copy-outline"></ion-icon>
                        </span>
                        <span class="title">Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/admin') }}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Account</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/cart') }}">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Cart</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        onClick="toggleUserInfo()">
                        <div class="user"> <!-- Menggunakan div sebagai gantinya -->
                            <img src="{{ asset('asset/image/defaultProfile.png') }}" alt="Customer Image">
                        </div>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('admin')->username }}</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <ion-icon name="mail-outline"></ion-icon>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('admin')->email }}</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-container">
                <div class="row">
                    <div class="col-md-12">
                        <button class="insert-button" onclick="window.location.href='{{ route('categories.create') }}'">
                            <ion-icon name="add-circle-outline"></ion-icon> Insert
                        </button>
                        <div class="table-wrap">
                            <table class="custom-table">
                                <thead class="custom-thead">
                                    <tr>
                                        <th>no</th>
                                        <th>category</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key => $category)
                                    <tr class="custom-alert" role="alert">
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="email">
                                                <span>{{ $category->nama_kategori }}</span> <!-- Ganti dengan nama kolom yang sesuai -->
                                            </div>
                                        </td>
                                        <td>
                                            <button class="Btn" onclick="window.location.href='{{ route('categories.edit', ['id' => $category->id]) }}'">
                                                <svg viewBox="0 0 512 512" class="svg">
                                                    <path
                                                      d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                                    ></path>
                                                  </svg>
                                                <span class="edit-text">Edit</span>
                                              </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="custom-footer">
                <div class="custom-container">
                    <p>&copy; 2024 Bu'e Cookies and pastry. All rights reserved.</p>
                </div>
            </footer>

    <!-- =========== Scripts =========  -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script>
        function toggleUserInfo() {
    var userInfo = document.querySelector(".dropdown-menu");
    userInfo.classList.toggle("show");
}

// Menambahkan event listener untuk menutup dropdown saat klik di luar dropdown
window.addEventListener("click", function(event) {
    var dropdownMenu = document.querySelector(".dropdown-menu");
    var userDropdown = document.querySelector(".dropdown-toggle");
    if (!userDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove("show");
    }
});

// Fungsi untuk menutup dropdown saat modal signout ditutup
$('#logoutModal').on('hidden.bs.modal', function (e) {
    var dropdownMenu = document.querySelector(".dropdown-menu");
    dropdownMenu.classList.remove("show");
});

    </script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
