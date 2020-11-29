<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('assetsAdmin/images/users/avatar-1.png') }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">Admin FST</a>
                {{-- <p class="text-body mt-1 mb-0 font-size-13">UI/UX Designer</p> --}}

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('matkul.index') }}" class="waves-effect">
                        <i class="bx bx-food-menu"></i>
                        <span>Matkul</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ruang.index') }}" class="waves-effect">
                        <i class="bx bx-cuboid"></i>
                        <span>Ruang</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dosen.index') }}" class="waves-effect">
                        <i class="bx bxs-spa"></i>
                        <span>Dosen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tools.index') }}" class="waves-effect">
                        <i class="bx bx-filter-alt"></i>
                        <span>Staf</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('prasyarat.index') }}" class="waves-effect">
                        <i class="bx bx-filter-alt"></i>
                        <span>Matkul Prasyarat</span>
                    </a>
                </li>
                <li id="liJadwal">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-flip-horizontal"></i>
                        <span>Jadwal</span>
                    </a>
                    <ul class="sub-menu" id="menuJadwal" aria-expanded="false">
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
