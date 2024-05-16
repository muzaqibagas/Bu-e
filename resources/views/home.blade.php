<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bu' E Cookies and Pastry</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard-u/style.css') }}">

</head>
<body>

<!-- header section starts      -->
<header>

    <a href="#" class="logo">Bu'E Cookies and Bakery.</a>

    <nav class="navbar">
        <a class="active" href="{{url('/home')}}">home</a>
        <a href="{{url('/menu')}}">Product</a>
        <a href="#about">About</a>
        <a href="#contact">Contact Us</a>
        <a href="#review">Testimoni</a>
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

<!-- header section ends-->

<!-- search form  -->

<form action="" id="search-form">
    <input type="search" placeholder="search here..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>

<!-- home section starts  -->

<section class="home" id="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our Special cookies</span>
                    <h3>Nastar</h3>
                    <p>Temukan beragam varian kue kering lezat dengan hanya beberapa kali klik, dan nikmati kemudahan belanja tanpa harus keluar rumah!</p>
                    <a href="https://wa.me/+62895372499072" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="{{"/images" .asset('Nastar.jpg') }}" alt="">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our Special menu</span>
                    <h3>Bolen</h3>
                    <p>Dengan keharuman lembut pisang segar yang melonjak dari setiap putaran pastri yang lembut dan renyah, Bolen Pisang Premium kami adalah simbol autentik dari kelezatan tropis. Dibuat dengan teliti menggunakan pisang pilihan dan bahan-bahan berkualitas tinggi, setiap gigitan membawa Anda ke surga rasa yang tak terlupakan.</p>
                    <a href="#" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="{{ asset('images/1714732579.jpg') }}" alt="Bolen">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <span>Our Special menu</span>
                    <h3>Bluder</h3>
                    <p>Bawa pengalaman roti yang tak tertandingi ke dalam hidangan Anda dengan Roti Bluder kami. Dipanggang dengan hati-hati untuk mencapai keseimbangan sempurna antara kerenyahan luar dan kelembutan dalam, setiap gigitan Roti Bluder adalah perpaduan yang menggugah selera dan memuaskan hasrat akan rasa yang autentik</p>
                    <a href="#" class="btn">order now</a>
                </div>
                <div class="image">
                    <img src="{{"/images" .asset('bluder.jpeg') }}" alt="">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home section ends -->

<!-- dishes section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading">our specials</h3>
    <h1 class="heading">popular</h1>

    <div class="box-container">
        @foreach($products->take(5) as $product)
        <div class="box">
            <!-- <a href="#" class="fas fa-heart"></a>
            <a href="#" class="fas fa-eye"></a> -->
            <a href="{{ route('product.detail', ['product' => $product->id]) }}" class="fas fa-eye" data-product-id="{{ $product->id }}"></a>
            <img src="{{"/images". asset($product->image) }}" alt="{{ $product->name_product }}">
            <h3>{{ $product->name_product }}</h3>
            <span>IDR {{ number_format($product->price, 2) }}</span>
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
        @endforeach
    </div>

</section>

<!-- dishes section ends -->

<!-- about section starts  -->

<section class="about" id="about">
    <h3 class="sub-heading">about us</h3>
    <h1 class="heading">why choose us?</h1>

    <div class="row">
        <div class="image">
            <img src="{{ asset('asset/images/Logo.png') }}" alt="Bluder">
        </div>
        <div class="content">
            <h3>best Cookies in the city</h3>
            <p>Produk kami sangatlah terjangkau dengan untuk setiap kue kering dan berkesan disetiap gigitan </p>
            <p>Dibuat oleh tangan dan dibikin sepenuh hati dalam membuat kue kering </p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>easy payments</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
            </div>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- Contact Us Start -->

<section class="contact" id="contact">
    <div class="container">
      <h3 class="custom-heading">Contact <span>Us</span></h3>
      <div class="content">
        <div class="formbox">
          <form id="contact-form">
            <div class="form-group">
              <input name="name" type="text" class="short" placeholder="Name" required>
            </div>
            <div class="form-group">
              <input name="email" type="email" class="short" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input name="subject" type="text" class="feedback-input" placeholder="Subject" required>
            </div>
            <div class="form-group">
              <textarea name="message" class="feedback-input" placeholder="Message" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="SEND" class="btn">
            </div>
          </form>
        </div>
        <div class="map">
          <!-- Embed your map code here -->
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3220223642156!2d107.02203597428263!3d-6.221199860929704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698eb9fed99b83%3A0x67f0a0cc8142441b!2sJl.%20Taman%20Wisma%20Asri%20Blok%20N.%2036%20No.2%2C%20RT.002%2FRW.032%2C%20Tlk.%20Pucung%2C%20Kec.%20Bekasi%20Utara%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017121!5e0!3m2!1sid!2sid!4v1715508615067!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>
      </div>
    </div>
  </section>

<!-- Contact Us End -->


<!-- review section starts  -->

<section class="review" id="review">

    <h3 class="sub-heading">customer's review</h3>
    <h1 class="heading">what they say</h1>

    <div class="swiper review-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <br>
                <br>
                <br>
                <br>
                <p>
                    Saya baru pertama kali mencoba kue kering dari Bu'E ,
                    dan saya langsung jatuh cinta! Rasanya enak dan bahan-bahannya terasa berkualitas.
                    Ini pasti akan menjadi langganan tetap untuk kue kering di rumah saya. Terima kasih, Bu'E!
                </p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <br>
                <br>
                <br>
                <br>
                <p>
                    Saya sangat terkesan dengan kualitas kue kering dari Bu'E.
                    Rasa dan teksturnya benar-benar sempurna, seperti buatan rumah.
                    Ini adalah pengalaman belanja online terbaik saya untuk kue kering. Pasti akan membeli lagi!
                </p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <br>
                <br>
                <br>
                <br>
                <p>
                    saya udah beberapa kali pesan kue dari Bu'E
                    saya sangat kagum dengan rasa kue disini sangatlah menggugah selera.
                    saya sangat merekomendasikan kue disini untuk kalian yang ingin mencoba kue yang enak dan lezat.
                    keluarga saya sangat suka dengan kue Bu'E
                </p>
            </div>

            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <br>
                <br>
                <br>
                <br>
                <p>
                    Saya sangat suka dengan kue kering dari Bu'E.
                    Rasanya enak dan bahan-bahannya berkualitas.
                    Saya pasti akan merekomendasikan kue kering dari Bu'E kepada teman-teman saya.
                    Terima Kasih Bue Selalu Ada Buat Kamu
                </p>
            </div>

        </div>

    </div>
</section>

<!-- review section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">
        <div class="box">
            <h3>locations</h3>
            <a href="#">Indonesia</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#dishes">Menu</a>
            <a href="#about">About</a>
            <a href="#contact">Contact Us</a>
            <a href="#review">Testimoni</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="https://wa.me/+6285891088920">Whatsapp</a>
            <a href="mailto: buepastry@gmail.com">Email</a>
            <a href="#">Bekasi, Indonesia - 17121</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.instagram.com/bukeprasto?igsh=eHpkMWM3MGpzampi">instagram</a>
        </div>

    </div>

    <div class="credit"> copyright @ 2024 by <span>Nova Nexus</span> </div>

</section>

<!-- Sertakan JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const contactForm = document.getElementById('contact-form');
      contactForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir secara default

        // Dapatkan nilai dari input formulir
        const name = contactForm.querySelector('input[name="name"]').value;
        const email = contactForm.querySelector('input[name="email"]').value;
        const subject = contactForm.querySelector('input[name="subject"]').value;
        const message = contactForm.querySelector('textarea[name="message"]').value;

        // Buat pesan yang akan dikirim ke WhatsApp
        const whatsappMessage = `Name: ${name}
                                Email: ${email}
                                Subject: ${subject}
                                Message: ${message}`;

        // Kirim pesan WhatsApp
        const whatsappLink = `https://wa.me/+6285891088920?text=${encodeURIComponent(whatsappMessage)}`;
        window.open(whatsappLink, '_blank');

        // Atau, jika Anda ingin mengarahkan pengguna ke aplikasi WhatsApp di perangkat mobile, gunakan kode di bawah ini
        // window.location.href = whatsappLink;
      });
    });
  </script>


<!-- footer section ends -->
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

<!-- loader part  -->
<div class="loader-container">
    <img src="{{ asset('asset/images/loader.gif') }}" alt="">
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="{{ asset('asset/js/home/script.js') }}"></script>
<script src="{{ asset('asset/js/map.js') }}"></script>
</body>
</html>
