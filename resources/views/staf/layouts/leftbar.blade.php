<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('assetsAdmin/images/users/avatar-2.jpg') }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">Patrick Becker</a>
                <p class="text-body mt-1 mb-0 font-size-13">UI/UX Designer</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('staf') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mhs.index') }}" class="waves-effect">
                        <i class="bx bx-run"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('perwalian.index') }}" class="waves-effect">
                        <i class="bx bx-run"></i>
                        <span>Perwalian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kelas.index') }}" class="waves-effect">
                        <i class="bx bx-store-alt"></i>
                        <span>Kelas</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('khs.index') }}" class="waves-effect">
                        <i class="bx bx-food-menu"></i>
                        <span>KHS</span>
                    </a>
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
