<div class="row layout-top-spacing">
    <div class="col-md-12">
        <?php if (empty($buku)) { ?>
            <div class="alert alert-danger mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                <h5 class="text-white"><strong>Hasil Pencarian</strong> <?= $this->input->GET('cari', TRUE); ?> Tidak Ditemukan</h5>
            </div>
        <?php } else { ?>
            <div class="alert alert-success mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                <h5 class="text-white"><strong>Hasil Pencarian: </strong><?= $this->input->GET('cari', TRUE); ?></h5>
            </div> 
        <?php } ?>
    </div>
</div>

<div class="row">
    <?php foreach ($buku as $buku) { ?>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing">
            <div class="card component-card_2">
                <img src="<?= base_url(); ?>app-assets/upload/<?= $buku->gambar; ?>" class="card-img-top" style="height: 300px;" alt="widget-card-2">
                <div class="card-body">
                    <h6 class="card-title"><?= $buku->nama_buku; ?></h6>
                    <p class="card-text"><?= word_limiter($buku->deskripsi, 10)?></p>
                    <a href="#" class="btn btn-primary btn-sm" data-id_buku="<?= $buku->id_buku; ?>" data-nama="<?= $buku->nama_buku; ?>" data-nama_kategori="<?= $buku->nama_kategori; ?>" data-pengarang="<?= $buku->pengarang; ?>" data-tahun_terbit="<?= $buku->tahun_terbit; ?>" data-deskripsi="<?= $buku->deskripsi; ?>" data-gambar="<?= $buku->gambar; ?>" data-stok="<?= $buku->stok; ?>" data-toggle="modal" data-target="#myMore">More</a>
                    <button type="button" class="btn btn-primary btn-sm add-cart" data-id_buku="<?= $buku->id_buku; ?>" data-nama="<?= $buku->nama_buku; ?>" data-nama_kategori="<?= $buku->nama_kategori; ?>" data-pengarang="<?= $buku->pengarang; ?>" data-tahun_terbit="<?= $buku->tahun_terbit; ?>" data-deskripsi="<?= $buku->deskripsi; ?>" data-gambar="<?= $buku->gambar; ?>" data-stok="<?= $buku->stok; ?>">Add Cart</button>
                </div>
            </div>
        </div>


    <?php } ?>

</div>

<!-- More Modal -->
<div class="modal fade" id="myMore" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="judul"></span> - <span id="edit_tahun"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="edit_id" class="form-control" id="edit_id">
                <div class="form-group text-center">
                    <img id="foto" alt="gallery-img" width="55%">
                </div>
                <div class="form-group border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-dark"><strong>Genre</strong></label>
                            <p class="text-justify"><span class="badge badge-primary" id="kategori"></span></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-dark"><strong>Status</strong></label>
                            <p id="status" class="text-justify"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group border-top">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark"><strong>Pengarang</strong></label>
                            <p id="pengarang" class="text-justify"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group border-top border-bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-dark"><strong>Deskripsi</strong></label>
                            <p id="deskripsi" class="text-justify"></p>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->

<script type="text/javascript">
    $(document).ready(function(){
        var base = '<?= base_url(); ?>';
        
        $('#myMore').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            var supplier = div.data('id_supplier');
            var dokumen = div.data('gambar');
            var stok = div.data('stok');

            var status = '';
            if (stok < 1) {
                status = '<span class="badge badge-danger">Tidak Tersedia</span>';
            } else {
                status = '<span class="badge badge-success">Tersedia</span>';
            }

            // Isi nilai pada field
            modal.find('#judul').html(div.data('nama'));

            modal.find('#kategori').html(div.data('nama_kategori'));
            modal.find('#pengarang').html(div.data('pengarang'));
            modal.find('#edit_tahun').html(div.data('tahun_terbit'));
            modal.find('#status').html(status);

            modal.find('#deskripsi').html(div.data('deskripsi'));

            // $('#edit_kategori option[value="'+kategori+'"]').attr('selected','selected');

            modal.find('#foto').attr("src", "<?php echo base_url(); ?>app-assets/upload/" + dokumen);
            
        });

        $(".add-cart").click(function(){
            var no_anggota = '<?= $this->session->userdata('no_anggota'); ?>';
            var id_buku = $(this).data('id_buku');
            var qty = '1';
            var stok = $(this).data('stok');

            if(stok < 1) {
                swal({
                    title: "Failed!",
                    text: "Stok Buku Tidak Tersedia atau Kosong!",
                    type: "error",
                });
            } else {
                $.ajax({  
                    url: base + "Dashboard_User/addCart",   
                    method:"POST",  
                    data: {
                        id_buku : id_buku,
                        no_anggota : no_anggota,
                        qty : qty,
                        stok : stok,
                    },    
                    dataType: "json",
                    success:function(res)  
                    {  
                        console.log(res.error);
                        if(res.error == false){  
                            swal({
                             title: "Success!",
                             text: "Berhasil Ditambahkan ke Keranjang",
                             type: "success",
                             timer: 1000,
                             buttons: false,
                            });
                        }
                        else if(res.error == true){
                            swal({
                                title: "Failed!",
                                text: res.message,
                                type: "error",
                            });
                        }
                    }  
                });
            }
        });
    });
</script>