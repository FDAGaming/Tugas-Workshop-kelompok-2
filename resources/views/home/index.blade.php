 @extends('home.layout.main')
 @section('konten')
     <div class="site-blocks-cover" style="background-image: url('images/hero_1.jpg');">
         <div class="container">
             <div class="row">
                 <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
                     <div class="site-block-cover-content text-center">
                         <h2 class="sub-title">Effective Medicine, New Medicine Everyday</h2>
                         <h1>Welcome To Pharma</h1>
                         <p>
                             <a href="#" class="btn btn-primary px-5 py-3">Shop Now</a>
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="site-section">
         <div class="container">
             <div class="row align-items-stretch section-overlap">
                 <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                     <div class="banner-wrap bg-primary h-100">
                         <a href="#" class="h-100">
                             <h5>Free <br> Shipping</h5>
                             <p>
                                 Amet sit amet dolor
                                 <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                             </p>
                         </a>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                     <div class="banner-wrap h-100">
                         <a href="#" class="h-100">
                             <h5>Season <br> Sale 50% Off</h5>
                             <p>
                                 Amet sit amet dolor
                                 <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                             </p>
                         </a>
                     </div>
                 </div>
                 <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                     <div class="banner-wrap bg-warning h-100">
                         <a href="#" class="h-100">
                             <h5>Buy <br> A Gift Card</h5>
                             <p>
                                 Amet sit amet dolor
                                 <strong>Lorem, ipsum dolor sit amet consectetur adipisicing.</strong>
                             </p>
                         </a>
                     </div>
                 </div>

             </div>
         </div>
     </div>

     <div class="site-section">
         <div class="container mt-5">
             <div class="text-center mb-4">
                 <h2>Obat</h2>
             </div>

             <div class="text-center mb-4">
                 <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
                 @foreach ($kategoris as $kategori)
                     <button class="btn btn-outline-primary filter-btn" data-filter="{{ $kategori->id }}">
                         {{ $kategori->nama_kategori }}
                     </button>
                 @endforeach
             </div>

             <div class="row">
                 @foreach ($obats as $obat)
                     <div class="col-md-4 filter-item {{ $obat->kategori_id }}">
                         <div class="card">
                             <img src="{{ asset('storage/' . $obat->foto) }}" class="card-img-top"
                                 alt="{{ $obat->nama_obat }}">
                             <div class="card-body text-center">
                                 <h5 class="card-title">{{ $obat->nama_obat }}</h5>
                                 <p class="card-text">Rp{{ number_format($obat->harga, 0, ',', '.') }}</p>
                                 <form action="{{ url('/keranjang/' . $obat->id) }}" method="POST">
                                     @csrf
                                     <input type="hidden" name="kuantitas" value="1">
                                     <button type="submit" class="btn btn-primary">Masukkan Keranjang</button>
                                 </form>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </div>


     <div class="site-section bg-light">
         <div class="container">
             <div class="row">
                 <div class="title-section text-center col-12">
                     <h2 class="text-uppercase">New Products</h2>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 block-3 products-wrap">
                     <div class="nonloop-block-3 owl-carousel">

                         <div class="text-center item mb-4">
                             <a href="shop-single.html"> <img src="{{ asset('assets2/images/product_03.png') }}"
                                     alt="Image"></a>
                             <h3 class="text-dark"><a href="shop-single.html">Umcka Cold Care</a></h3>
                             <p class="price">$120.00</p>
                         </div>

                         <div class="text-center item mb-4">
                             <a href="shop-single.html"> <img src="{{ asset('assets2/images/product_01.png') }}"
                                     alt="Image"></a>
                             <h3 class="text-dark"><a href="shop-single.html">Umcka Cold Care</a></h3>
                             <p class="price">$120.00</p>
                         </div>

                         <div class="text-center item mb-4">
                             <a href="shop-single.html"> <img src="{{ asset('assets2/images/product_02.png') }}"
                                     alt="Image"></a>
                             <h3 class="text-dark"><a href="shop-single.html">Umcka Cold Care</a></h3>
                             <p class="price">$120.00</p>
                         </div>

                         <div class="text-center item mb-4">
                             <a href="shop-single.html"> <img src="{{ asset('assets2/images/product_04.png') }}"
                                     alt="Image"></a>
                             <h3 class="text-dark"><a href="shop-single.html">Umcka Cold Care</a></h3>
                             <p class="price">$120.00</p>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="site-section">
         <div class="container">
             <div class="row">
                 <div class="title-section text-center col-12">
                     <h2 class="text-uppercase">Testimonials</h2>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 block-3 products-wrap">
                     <div class="nonloop-block-3 no-direction owl-carousel">

                         <div class="testimony">
                             <blockquote>
                                 <img src="{{ asset('assets2/images/person_1.jpg') }}" alt="Image"
                                     class="img-fluid w-25 mb-4 rounded-circle">
                                 <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                     voluptatem consectetur quam tempore obcaecati maiores voluptate aspernatur iusto
                                     eveniet, placeat ab quod tenetur ducimus. Minus ratione sit quaerat unde.&rdquo;
                                 </p>
                             </blockquote>

                             <p>&mdash; Kelly Holmes</p>
                         </div>

                         <div class="testimony">
                             <blockquote>
                                 <img src="{{ asset('assets2/images/person_2.jpg') }}" alt="Image"
                                     class="img-fluid w-25 mb-4 rounded-circle">
                                 <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                     voluptatem consectetur quam tempore
                                     obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur
                                     ducimus. Minus ratione sit quaerat
                                     unde.&rdquo;</p>
                             </blockquote>

                             <p>&mdash; Rebecca Morando</p>
                         </div>

                         <div class="testimony">
                             <blockquote>
                                 <img src="{{ asset('assets2/images/person_3.jpg') }}" alt="Image"
                                     class="img-fluid w-25 mb-4 rounded-circle">
                                 <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                     voluptatem consectetur quam tempore
                                     obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur
                                     ducimus. Minus ratione sit quaerat
                                     unde.&rdquo;</p>
                             </blockquote>

                             <p>&mdash; Lucas Gallone</p>
                         </div>

                         <div class="testimony">
                             <blockquote>
                                 <img src="{{ asset('assets2/images/person_4.jpg') }}" alt="Image"
                                     class="img-fluid w-25 mb-4 rounded-circle">
                                 <p>&ldquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo omnis
                                     voluptatem consectetur quam tempore
                                     obcaecati maiores voluptate aspernatur iusto eveniet, placeat ab quod tenetur
                                     ducimus. Minus ratione sit quaerat
                                     unde.&rdquo;</p>
                             </blockquote>

                             <p>&mdash; Andrew Neel</p>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>

     <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
         <div class="container">
             <div class="row align-items-stretch">
                 <div class="col-lg-6 mb-5 mb-lg-0">
                     <a href="#" class="banner-1 h-100 d-flex"
                         style="background-image: url('{{ asset('assets2/images/bg_1.jpg') }}');">
                         <div class="banner-1-inner align-self-center">
                             <h2>Pharma Products</h2>
                             <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem
                                 odio voluptatem.
                             </p>
                         </div>
                     </a>
                 </div>
                 <div class="col-lg-6 mb-5 mb-lg-0">
                     <a href="#" class="banner-1 h-100 d-flex"
                         style="background-image: url('{{ asset('assets2/images/bg_2.jpg') }}');">
                         <div class="banner-1-inner ml-auto  align-self-center">
                             <h2>Rated by Experts</h2>
                             <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae ex ad minus rem
                                 odio voluptatem.
                             </p>
                         </div>
                     </a>
                 </div>
             </div>
         </div>
     </div>
 @endsection

 @section('script')
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             const filterButtons = document.querySelectorAll(".filter-btn");
             const filterItems = document.querySelectorAll(".filter-item");

             filterButtons.forEach((button) => {
                 button.addEventListener("click", function() {
                     const filter = this.getAttribute("data-filter");

                     filterButtons.forEach((btn) => btn.classList.remove("active"));
                     this.classList.add("active");

                     filterItems.forEach((item) => {
                         if (filter === "all" || item.classList.contains(filter)) {
                             item.style.display = "block";
                         } else {
                             item.style.display = "none";
                         }
                     });
                 });
             });
         });
     </script>
 @endsection
