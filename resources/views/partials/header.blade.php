

<nav class="sb-topnav navbar navbar-expand navbar-light shadow-sm" style="background-color: green">
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn order-1 order-lg-0 me-4 me-lg-0 ps-4" 
            style="color: white; text-decoration:none" 
            id="sidebarToggle" href="#!">
        <i class="fa-solid fa-qrcode text-white"></i>
        <span class="ms-2 fw-bold text-white">Menu</span>
    </button>

    <!-- Spacer biar user info selalu di kanan -->
    <div class="ms-auto"></div>

    <!-- Navbar-->
    <ul class="navbar-nav d-flex align-items-center me-3">
        <img src="https://cdn-icons-png.flaticon.com/512/9385/9385289.png" 
             alt="user" 
             class="rounded-circle me-2" 
             width="30px">
        <span class="fw-bold text-white">{{ auth()->user()->name }}</span>
    </ul>    
</nav>
