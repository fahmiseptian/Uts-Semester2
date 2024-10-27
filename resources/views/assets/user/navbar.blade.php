 <!-- Header Section -->
 <header class="bg-white py-2 border-bottom">
     <div class="container">
         <nav class="navbar navbar-expand-lg navbar-light">
             <div class="d-flex align-items-center w-100">
                 <!-- Logo -->
                 <div id="navbar-logo" class="me-3">
                     <a href="#">
                         <img src="{{ asset('img/logo-store.png') }}" alt="Logo" height="40">
                     </a>
                 </div>

                 <!-- Search bar (centered) -->
                 <div class="navbar-search flex-grow-1">
                     <form class="d-flex">
                         <input id="input-searching" type="text" class="form-control me-2"
                             placeholder="Cari di Lalana">
                         <button class="btn btn-success" type="submit">Cari</button>
                     </form>
                 </div>

                 <!-- Cart and Login icons (desktop) -->
                 <div id="navbar-icons" class="d-flex align-items-center ms-3 d-none d-lg-flex">
                     <a href="#" class="me-3">
                         <span class="material-icons google-icon" style="font-size: 24px;">shopping_cart</span>
                     </a>
                     <a href="#" class="text-dark">Masuk</a>
                 </div>

                 <!-- Toggle button (mobile) -->
                 <button id="mobile-toggle" class="btn btn-outline-secondary d-lg-none" onclick="toggleMobileMenu()">
                     <span class="material-icons">menu</span>
                 </button>
             </div>
         </nav>

         <!-- Mobile menu (keranjang & login) -->
         <div id="mobile-menu">
             <a href="#" class="d-block mb-2 google-icon" style="font-size: smaller">
                 <span class="material-icons me-1 google-icon">shopping_cart</span> Keranjang
             </a>
             <a href="#" class="d-block google-icon" style="font-size: smaller">
                 <span class="material-icons me-1 google-icon">account_circle</span> Masuk
             </a>
         </div>
     </div>
 </header>

 <!-- Offcanvas Menu for Mobile -->
 <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
     <div class="offcanvas-header">
         <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
         <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         <!-- Cart Icon -->
     </div>
     <div class="offcanvas-body">
         <ul class="navbar-nav">
             <li class="nav-item">
                 <a class="nav-link" href="#">
                     <span class="material-icons google-icon">shopping_cart</span> Keranjang
                 </a>
             </li>
             <!-- Login -->
             <li class="nav-item">
                 <a class="nav-link" href="#">Masuk</a>
             </li>
         </ul>
     </div>

     <!-- Carousel Section -->
 </div>
