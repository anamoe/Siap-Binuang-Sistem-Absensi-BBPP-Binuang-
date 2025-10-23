<div id="layoutSidenav_nav" style="z-index: 9999">
    <nav class="sb-sidenav accordion sb-sidenav-blue" style="background-color: green;" id="sidenavAccordion">

        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="mb-4 mt-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/54/Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg/2072px-Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg.png" alt="" width="40px">
                    <span class="text-white fw-bold">BBPP BINUANG</span>
                </div>
                <!-- <div class="pb-1">
                    <a class="nav-link {{ Request::is('dashboards*') ? 'active' : '' }}" href="">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card-clip"></i></div>

                        Dashboard
                    </a>
                </div> -->
                <div class="pb-1">
                    <a class="nav-link {{ Request::is('bmn/import') ? 'active' : '' }}" href="{{url('bmn/import')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Import Data Aset
                    </a>
                </div>

                <div class="pb-1">
                    <a class="nav-link {{ Request::is('dashboard-aset*') ? 'active' : '' }}" href="{{url('dashboard-aset')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-qrcode"></i></div>
                        Data Aset
                    </a>
                </div>
            </div>
              <div class="sb-sidenav-footer ms-3">
            <a href="{{url('logout')}}" style="text-decoration: none">
                <i class="fa-solid fa-right-from-bracket text-white"></i><span class="text-white"> Logout</span>
            </a>
        </div>
        </div>
      
    </nav>
</div>