<div class="row layout-top-spacing">
    <div class="col-md-12">
        <?=$this->session->flashdata('notif')?>
    </div>
</div>

<div class="row">
    <div id="counterIcon" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4 class="card-title">Statistik</h4>
                    </div>                 
                </div>
            </div>
            <div class="widget-content widget-content-area text-center">
                <div class="icon--counter-container">

                    <div class="counter-container">

                        <div class="counter-content">
                            <h1 class="ico-counter1 ico-counter"><?= $count_anggota; ?></h1>
                        </div>

                        <div class="">
                            <div class="icon-section">
                                <i data-feather="user" class="text-primary"></i>
                            </div>
                        </div>

                        <p class="ico-counter-text mt-2">Anggota</p>
                    </div>

                    <div class="counter-container">

                        <div class="counter-content">
                            <h1 class="ico-counter2 ico-counter"><?= $count_buku; ?></h1>
                        </div>

                        <div class="">
                            <div class="icon-section">
                                <i data-feather="book" class="text-primary"></i>
                            </div>
                        </div>

                        <p class="ico-counter-text mt-2">Buku</p>
                    </div>

                    <div class="counter-container">
                        <div class="counter-content">
                            <h1 class="ico-counter3 ico-counter"><?= $count_supplier; ?></h1>
                        </div>

                        <div class="">
                            <div class="icon-section">
                                <i data-feather="truck" class="text-primary"></i>
                            </div>
                        </div>

                        <p class="ico-counter-text mt-2">Supplier</p>
                    </div>

                    <div class="counter-container">
                        <div class="counter-content">
                            <h1 class="ico-counter4 ico-counter"><?= $count_pinjaman; ?></h1>
                        </div>

                        <div class="">
                            <div class="icon-section">
                                <i data-feather="log-out" class="text-primary"></i>
                            </div>
                        </div>

                        <p class="ico-counter-text mt-2">Pinjaman</p>
                    </div>

                    <div class="counter-container">
                        <div class="counter-content">
                            <h1 class="ico-counter5 ico-counter"><?= $count_pengembalian; ?></h1>
                        </div>

                        <div class="">
                            <div class="icon-section">
                                <i data-feather="log-in" class="text-primary"></i>
                            </div>
                        </div>

                        <p class="ico-counter-text mt-2">Pengembalian</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>