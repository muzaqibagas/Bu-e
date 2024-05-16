<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name_product }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard-u/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard-u/style.css') }}">
</head>
<body>
  <!-- Header Section Start -->
  <header>
    <a href="#" class="logo">Bu'E Cookies and Bakery.</a>

    <nav class="navbar">
        <a href="{{url('/home')}}">home</a>
        <a class="active"  href="{{url('/menu')}}">Product</a>
        <a href="{{url('/home')}}">About</a>
        <a href="{{url('/home')}}">Contact Us</a>
        <a href="{{url('/home')}}">Testimoni</a>
    </nav>

    <div class="icons">
        <i class="fas fa-bars" id="menu-bars"></i>
        <i class="fas fa-search" id="search-icon"></i>
        <a href="#" class="fab fa-whatsapp"></a>
        {{-- <a href="#" class="fas fa-shopping-cart"></a> --}}
        <a href="{{ route('user.profile') }}" class="fas fa-user"></a>
    </div>
    @if (auth()->check())
        <!-- Jika pengguna sudah login, tampilkan tombol logout -->
        <form action="{{ route('user.logout') }}" method="Get">
            @csrf
            <button type="submit" class="btn">Logout</button>
        </form>
    @else
        <!-- Jika pengguna belum login, tampilkan tombol login -->
        <a href="{{ route('user-login') }}" class="btn">Login</a>
    @endif
  </header>
  <!-- Header Section End -->
  <!-- Search Form Start -->
  <form action="" id="search-form">
    <input type="search" placeholder="search..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
  </form>
  <!-- Search Form End -->
  <!-- product section -->
  <section class="product-container">
    <!-- left side -->
    <div class="img-card">
        <img src="{{"/images". asset($product->image) }}" alt="" id="featured-image">
        <!-- small img -->
        <div class="small-Card">
            <img src="{{"/images". asset($product->image) }}" alt="" class="small-Img">
            <img src="{{"/images". asset($product->image) }}" alt="" class="small-Img">
            <img src="{{"/images". asset($product->image) }}" alt="" class="small-Img">
            <img src="{{"/images". asset($product->image) }}" alt="" class="small-Img">
        </div>
    </div>
    <!-- Right side -->
    <div class="product-info">
        <h3>{{ $product->name_product }}</h3>
        <h5>IDR {{ number_format($product->price, 2) }}</h5>
        <p>{{ $product->description }}</p>
        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="quantity">
                <label for="quantity{{ $product->id }}">Quantity:</label>
                <input type="number" id="quantity{{ $product->id }}" name="quantity" value="1" min="1">
            </div>
            <button type="button" class="btn add-to-cart-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name_product }}">Add to Cart</button>
        </form>
     </div>
  </section>
  <!-- script tags -->
  <script src="{{ asset('asset/js/home/script.js') }}"></script>
  <script>
    // JavaScript to handle the "Add to Cart" button click event
 const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
 addToCartButtons.forEach(button => {
     button.addEventListener('click', () => {
         const productId = button.getAttribute('data-product-id');
         const productName = button.getAttribute('data-product-name');
         const productQuantity = document.getElementById(`quantity${productId}`).value;

         // Kirim data produk ke endpoint Laravel
         fetch('{{ route("cart.add") }}', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
             },
             body: JSON.stringify({
                 product_id: productId,
                 quantity: productQuantity
             })
         }).then(response => {
             if (response.ok) {
                 // Langsung arahkan pengguna ke percakapan WhatsApp
                 const message = `Saya mau pesan ini ${productName} - Quantity: ${productQuantity}`;
                 const whatsappLink = `whatsapp://send?phone=+6285891088920&text=${encodeURIComponent(message)}`;
                 window.location.href = whatsappLink;
             } else {
                 console.error('Failed to add product to cart');
             }
         }).catch(error => {
             console.error('Error:', error);
         });
     });
 });
 </script>
</body>
</html>
