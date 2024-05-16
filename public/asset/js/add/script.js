document.addEventListener('DOMContentLoaded', function() {
    // Ambil semua tombol "Add To Cart"
    var addToCartButtons = document.querySelectorAll('.btn');

    // Loop melalui setiap tombol "Add To Cart" dan tambahkan event listener
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tombol

            // Ambil ID produk dari atribut data
            var productId = button.parentElement.querySelector('.fas.fa-eye').getAttribute('data-product-id');

            // Kirim permintaan AJAX untuk menambahkan produk ke keranjang belanja
            fetch('/cart/add/' + productId, {
                method: 'POST', // Metode permintaan POST
                headers: {
                    'Content-Type': 'application/json', // Jenis konten JSON
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF Laravel
                }
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parse respons JSON
            })
            .then(function(data) {
                // Tampilkan pesan sukses atau melakukan tindakan lain yang sesuai
                alert('Product added to cart successfully!');
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    });
});
