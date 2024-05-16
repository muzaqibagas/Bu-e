<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard/style.css') }}">
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
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="toggleUserInfo()">
                    <div class="user"> <!-- Menggunakan div sebagai gantinya -->
                        <img src="{{ asset('asset/image/defaultProfile.png') }}" alt="Customer Image">
                    </div>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <ion-icon name="person-circle-outline" class="align-middle"></ion-icon>
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
                    <div class="table-wrap">
                        <table class="custom-table">
                            <thead class="custom-thead">
                                <tr>
                                    <th>No</th>
                                    <th>Quantity</th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $key => $cart)
                                <tr class="custom-alert" role="alert">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    <td>{{ $cart->product_id }}</td>
                                    <td>{{ $cart->product->name_product }}</td> <!-- Memanggil nama_produk dari relasi produk -->
                                    <td>{{ $cart->user_id }}</td>
                                    <td>{{ $cart->user->username }}</td> <!-- Memanggil username dari relasi pengguna -->
                                    <td>
                                        <button class="button" onclick="window.location.href='{{ route('carts.downloadPDF', ['id' => $cart->id]) }}'">
                                            <span class="button-content">Download </span>
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

    </script>
    {{-- <script>
        // Fungsi untuk menangani klik pada tombol "Tandai Selesai"
        function markAsFinished(id) {
            // Kirim permintaan AJAX untuk menghapus pesanan dari keranjang
            fetch(`/cart/${id}/finish`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Sesuaikan dengan cara Anda mendapatkan CSRF token
                }
            })
            .then(response => {
                if (response.ok) {
                    // Hapus baris pesanan dari tabel jika respons OK
                    document.getElementById(`row-${id}`).remove();
                    // Tampilkan pesan sukses (opsional)
                    alert('Pesanan berhasil ditandai sebagai selesai.');
                }
                else {
                    // Tangani kesalahan jika respons tidak OK (opsional)
                    console.error('Gagal menandai pesanan sebagai selesai:', response.statusText);
                    alert('Gagal menandai pesanan sebagai selesai. Silakan coba lagi.');
                }
            })
            .catch(error => {
                // Tangani kesalahan yang tidak terduga (opsional)
                console.error('Terjadi kesalahan:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    </script> --}}

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
