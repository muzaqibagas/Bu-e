<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Bu'e</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet"href="{{ asset('asset/css/dashboard/style.css') }}">
     <!-- ======= Charts Styles ====== -->
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            <ion-icon name="person-circle-outline" class="align-middle"></ion-icon>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small align-middle">{{ session('admin')->username }}</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <ion-icon name="mail-outline" class="align-middle"></ion-icon>
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small align-middle">{{ session('admin')->email }}</span>
                        </a>
                    </div>
                </div>
            </div>

           <!-- ================ Order Details List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Selamat Datang, Di Dashboard Admin Kami</h2>
        </div>
        <div class="cardBox">
            <div class="card" id="sales-card">
                <div>
                    <div class="numbers" id="total-sales">Loading...</div>
                    <div class="cardName">Sales</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cart-outline"></ion-icon>
                </div>
            </div>
        </div>
        <h3>Grafik Penjualan dan Pembelian </h3>
        <!-- Tambahkan div untuk menampilkan grafik di sini -->
        <canvas id="myChart"></canvas>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script>
    // Mengambil data dari controller
    var income = @json($income);
    var expense = @json($expense);
    var labels = @json($labels);

    // Mengatur data untuk grafik
    var data = {
        labels: labels,
        datasets: [{
            label: 'Income',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: Object.values(income)
        }, {
            label: 'Expense',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: Object.values(expense)
        }]
    };

    // Konfigurasi opsi grafik
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Membuat grafik dengan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

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
function updateTotalSales() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/total-sales", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                document.getElementById("total-sales").textContent = data.totalSales;
            }
        };
        xhr.send();
    }

    updateTotalSales(); // Panggil fungsi saat halaman dimuat

    setInterval(updateTotalSales, 5000); // Panggil fungsi setiap 5 detik untuk memperbarui data secara real-time

</script>
    <!-- =========== Scripts =========  -->
    <script src="{{ asset('asset/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <footer class="custom-footer">
        <div class="custom-container">
            <p>&copy; 2024 Bu'e Cookies and pastry. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
