<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Biaya</title>
    <link rel="stylesheet" href="{{ asset('asset/css/create/style.css') }}"> <!-- Sesuaikan dengan lokasi CSS Anda -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Tambah Data Biaya</h1>
            <form action="{{ route('biaya.store') }}" method="POST">
                @csrf
                <label for="name_product">Nama Produk:</label><br>
                <input type="text" id="name_product" name="name_product"><br>

                <label for="amount">Harga:</label><br>
                <input type="text" id="amount" name="amount"><br>

                <label for="type">Type:</label> <br>
                <select name="type" id="type">
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select> <br>

                <label for="description">Deskripsi:</label><br>
                <textarea id="description" name="description"></textarea><br>

                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" id="start_date" name="start_date"><br>

                <label for="end_date">Tanggal Selesai:</label>
                <input type="date" id="end_date" name="end_date"><br>

                <button type="submit" id="create-Biaya">Simpan</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('create-Biaya').addEventListener('click', function() {
            Swal.fire({
                title: "Good job!",
                text: "Biaya created successfully!",
                icon: "success"
            });
        });
    </script>
</body>
</html>
