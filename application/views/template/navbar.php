<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-nav theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
                <a href="<?= base_url(); ?>Dashboard_Admin">
                    <img src="<?= base_url(); ?>app-assets/assets/img/logo.svg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <?php
            if ($this->session->userdata('level_user') == '1') {
                $home = base_url()."Dashboard_Admin";
            } else if ($this->session->userdata('level_user') == '2') {
                $home = base_url()."Dashboard_User";
            } else if ($this->session->userdata('level_user') == '3') {
                $home = base_url()."Dashboard_Kepala";
            } else {
                $home = "#";
            }
            ?>
            <li class="nav-item theme-text">
                <a href="<?= $home; ?>" class="nav-link" style="font-size: 20px;">My Perpus </a>
            </li>
            <li class="nav-item toggle-sidebar">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a>
            </li>
        </ul>

        <ul class="navbar-item flex-row search-ul">
            <?php
            if ($this->session->userdata('level_user') == '2') { ?>
                <li class="nav-item align-self-left search-animated">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <form action="<?php echo base_url(); ?>Dashboard_User/pencarian?page=1" class="form-inline search-full form-inline search" method="GET" role="search">
                        <div class="search-bar">
                            <input type="text" name="cari" class="form-control search-form-control  ml-lg-auto" placeholder="Search Buku...">
                        </div>
                    </form>
                </li>
            <?php } ?>
        </ul>

        <ul class="navbar-item flex-row navbar-dropdown">

            <?php 
            if ($this->session->userdata('level_user') == '1') { ?>
                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <?php if (!empty($pending)) { ?>
                            <div id="notif"><span class="badge badge-primary"></span></div>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu p-0 position-absolute animated fadeInUp" aria-labelledby="messageDropdown">
                        <div class="">
                            <?php if (empty($pending)) { ?>
                                <a href="#" class="dropdown-item">
                                    <div class="">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="">
                                                    <h5 class="usr-name">Tidak Ada Notifikasi</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } else { ?>
                                <a href="#" class="dropdown-item" id="notif-admin">
                                    <div class="">
                                        <div class="media">
                                            <div class="user-img">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle"><?= $pending; ?></span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="">
                                                    <h5 class="usr-name">Peminjaman</h5>
                                                    <p class="msg-title"><?= $pending; ?> TRANSAKSI PENDING</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
                <?php
            } else if ($this->session->userdata('level_user') == '2') { ?>
                <li class="nav-item dropdown message-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <?php if (!empty($approve)) { ?>
                            <div id="notif"><span class="badge badge-primary"></span></div>
                        <?php } ?>
                    </a>
                    <div class="dropdown-menu p-0 position-absolute animated fadeInUp" aria-labelledby="messageDropdown">
                        <div class="">
                            <?php if (empty($approve)) { ?>
                                <a href="#" class="dropdown-item">
                                    <div class="">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="">
                                                    <h5 class="usr-name">Tidak Ada Notifikasi</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php } else { ?>
                                <a href="#" class="dropdown-item" id="notif-user">
                                    <div class="">
                                        <div class="media">
                                            <div class="user-img">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle"><?= $approve; ?></span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="">
                                                    <h5 class="usr-name">Peminjaman</h5>
                                                    <p class="msg-title"><?= $approve; ?> TRANSAKSI TELAH DISETUJUI</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            <?php } ?>


            <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="userProfileDropdown">
                    <div class="user-profile-section">
                        <div class="media mx-auto">
                            <img src="<?= base_url(); ?>app-assets/assets/img/avatar.png" class="img-fluid mr-2" alt="avatar">
                            <div class="media-body">
                                <h5><?= $profile->nama; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <?php
                        if ($this->session->userdata('level_user') == '1') {
                            $base = base_url()."Dashboard_Admin/myProfile";
                        } else if ($this->session->userdata('level_user') == '2') {
                            $base = base_url()."Dashboard_User/myProfile";
                        } else if ($this->session->userdata('level_user') == '3') {
                            $base = base_url()."Dashboard_Kepala/myProfile";
                        } else {
                            $base = "#";
                        }
                        ?>
                        <a href="<?= $base; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> <span>My Profile</span>
                        </a>
                    </div>
                    <div class="dropdown-item">
                        <a href="<?= base_url(); ?>logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#messageDropdown").click(function(){
            $("#notif").html('');
        });

        $('#notif-admin').on('click', function () {
            var id =  '1';
            $.ajax({
                url:"<?php echo base_url(); ?>Dashboard_Admin/notifNull",
                method:"POST",
                data:{id:id},
                success:function(data) {
                    window.location = "<?php echo base_url();?>Dashboard_Admin/Peminjaman";
                }
            });
        });
        $('#notif-user').on('click', function () {
            var id =  '1';
            var no_anggota =  '<?= $this->session->userdata('no_anggota'); ?>';
            $.ajax({
                url:"<?php echo base_url(); ?>Dashboard_User/notifNull",
                method:"POST",
                data:{id:id, no_anggota:no_anggota,},
                success:function(data) {
                    window.location = "<?php echo base_url();?>Dashboard_User/Peminjaman";
                }
            });
        });
    });
</script>