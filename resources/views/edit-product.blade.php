<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="{{ asset('asset/css/edit-pr/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Edit Produk</h1>
            <form id="edit-form" action="{{ route('products.update', ['id' => $product->id]) }}" method="post"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Formulir edit -->
                <div class="form-group">
                    <label for="name_product">Nama Produk:</label>
                    <input type="text" id="name_product" name="name_product" value="{{ $product->name_product }}">
                </div>

                <div class="form-group">
                    <label for="price">Harga:</label>
                    <input type="text" id="price" name="price" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" name="description">{{ $product->description }}</textarea>
                    <p class="text-muted">Total kalimat: {{ str_word_count($product->description) }}</p>
                </div>
                <div class="form-group">
                    <label for="image">Gambar:</label>
                    <input type="file" id="image" name="image" value="{{ $product->image }}">
                </div>

                <div class="form-group">
                    <label for="stock">Stok:</label>
                    <input type="number" id="stock" name="stock" value="{{ $product->stock }}">
                </div>

                <div class="form-group">
                    <label for="date">Tanggal:</label>
                    <input type="date" id="date" name="date" value="{{ $product->date }}">
                </div>

                <!-- tambahkan formulir lainnya sesuai kebutuhan -->

                <button type="button" id="submit-button">Simpan Perubahan</button>
            </form>
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            <!-- Formulir untuk tombol hapus -->
            <form id="delete-form" action="{{ route('products.delete', ['id' => $product->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="button" id="delete-product">Hapus</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <script>
        document.getElementById('delete-product').addEventListener('click', function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol konfirmasi ditekan
                    document.getElementById('delete-form').submit();
                }
            });
        });

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
                    // Jika tombol konfirmasi ditekan
                    document.getElementById('edit-form').submit();
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
