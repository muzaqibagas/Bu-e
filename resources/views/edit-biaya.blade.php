<!DOCTYPE html>
<html>
<head>
    <title>Edit Biaya</title>
    <link rel="stylesheet" href="{{ asset('asset/css/edit-b/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Biaya</h1>
            <form id="edit-form" action="{{ route('biaya.update', ['id' => $biaya->id]) }}" method="post">
                @csrf
                @method('PUT')
                <!-- Formulir edit -->
                <div class="form-group">
                    <label for="name_product">Nama Produk:</label>
                    <input type="text" id="name_product" name="name_product" value="{{ $biaya->name_product }}">
                </div>
                <div class="form-group">
                    <label for="type">Tipe:</label>
                    <select name="type" id="type">
                        <option value="income" {{ $biaya->type == 'income' ? 'selected' : '' }}>Income</option>
                        <option value="expense" {{ $biaya->type == 'expense' ? 'selected' : '' }}>Expense</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="amount">Harga:</label>
                    <input type="text" id="amount" name="amount" value="{{ $biaya->amount }}">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description">{{ $biaya->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="start_date">Tanggal mulai:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ $biaya->start_date }}">
                </div>

                <div class="form-group">
                    <label for="end_date">Tanggal selesai:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ $biaya->end_date }}">
                </div>
                <!-- tambahkan formulir lainnya sesuai kebutuhan -->
                <button type="button" id="submit-button">Simpan Perubahan</button>
            </form>

            <!-- Formulir untuk tombol hapus -->
            <form id="form-delete" action="{{ route('biaya.delete', ['id' => $biaya->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="button" id="delete-biaya">Hapus</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
         document.getElementById('submit-button').addEventListener('click', function() {
            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById('edit-form').submit();
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });

        document.getElementById('delete-biaya').addEventListener('click', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#4caf50",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol konfirmasi ditekan
                    document.getElementById('form-delete').submit();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
