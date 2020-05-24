<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="<?= base_url(); ?>app-assets/assets/img/avatar.png" alt="avatar">
                <h6 class=""><?= $profile->nama; ?></h6>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu active">
                <a href="<?= base_url(); ?>Dashboard_Admin" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="home"></i><span class="icon-name"> Dashboard</span>
                        </div>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>MASTER</span></div>
            </li>

            <li class="menu">
                <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="box"></i><span class="icon-name"> Data Master</span>
                        </div>
                    </div>
                    <div>
                        <div class="icon-section">
                            <i data-feather="chevron-right"></i>
                        </div>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/Anggota"> Anggota </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/Buku"> Buku  </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/kategoriBuku"> Kategori Buku </a>
                    </li>                            
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/Supplier"> Supplier </a>
                    </li>
                </ul>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>TRANSAKSI</span></div>
            </li>

            <li class="menu">
                <a href="<?= base_url(); ?>Dashboard_Admin/Peminjaman" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="log-out"></i><span class="icon-name"> Peminjaman</span>
                        </div>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="<?= base_url(); ?>Dashboard_Admin/Pengembalian" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="log-in"></i><span class="icon-name"> Pengembalian</span>
                        </div>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>MANAJEMEN USER</span></div>
            </li>

            <li class="menu">
                <a href="<?= base_url(); ?>Dashboard_Admin/listUser" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="user"></i><span class="icon-name"> List User</span>
                        </div>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus"><line x1="5" y1="12" x2="19" y2="12"></line></svg><span>LAPORAN</span></div>
            </li>

            <li class="menu">
                <a href="#laporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <div class="icon-section">
                            <i data-feather="book"></i><span class="icon-name"> Laporan</span>
                        </div>
                    </div>
                    <div>
                        <div class="icon-section">
                            <i data-feather="chevron-right"></i>
                        </div>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="laporan" data-parent="#accordionExample">
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/laporanAnggota"> Anggota </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/laporanBuku"> Buku  </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/laporanSupplier"> Supplier </a>
                    </li>                            
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/laporanPeminjaman"> Peminjaman </a>
                    </li>
                    <li>
                        <a href="<?= base_url(); ?>Dashboard_Admin/laporanPengembalian"> Pengembalian </a>
                    </li>
                </ul>
            </li>

        </ul>

    </nav>

</div>
<!--  END SIDEBAR  -->