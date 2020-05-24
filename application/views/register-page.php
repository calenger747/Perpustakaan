<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>My Perpus - Register Page</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>app-assets/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="<?= base_url(); ?>app-assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>app-assets/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>app-assets/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>app-assets/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>app-assets/assets/css/forms/switches.css">
    <link href="<?= base_url(); ?>app-assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>app-assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>app-assets/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
</head>
<body class="form">


    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Register</h1>
                        <p class="signup-link register">Already have an account? <a href="<?= base_url(); ?>Login">Log in</a></p>
                        <form class="text-left" method="POST" id="formRegister">
                            <div class="form">
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">TIPE IDENTITAS</label>
                                    <select class="form-control" name="add_tipe" required="">
                                        <option value="">Pilih Tipe Identitas</option>
                                        <option value="KTP">KTP</option>
                                        <option value="SIM">SIM</option>
                                        <option value="Paspor">Paspor</option>
                                        <option value="KTM">KTM</option>
                                    </select>
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">NO. IDENTITAS</label>
                                    <input type="text" name="add_no_identitas" class="form-control" required="">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">NAMA</label>
                                    <input type="text" name="add_nama" class="form-control" required="">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">KELAS</label>
                                    <select class="form-control kelas" name="add_kelas" id="add_kelas" required="">
                                        <option value="">Pilih Kelas</option>
                                        <option value="-">-</option>
                                        <option value="Reguler 1">Reguler 1</option>
                                        <option value="Reguler 2">Reguler 2</option>
                                        <option value="Reguler 3">Reguler 3</option>
                                        <option value="Pascasarjana">Pascasarjana</option>
                                    </select>
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">FAKULTAS</label>
                                    <input type="text" name="add_fakultas" id="add_fakultas" class="form-control">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">PROGRAM STUDI</label>
                                    <input type="text" name="add_prodi" id="add_prodi" class="form-control">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">EMAIL</label>
                                    <input type="text" name="add_email" class="form-control">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">NO. TELP</label>
                                    <input type="text" name="add_telp" class="form-control">
                                </div>
                                <div class="field-wrapper form-group">
                                    <label class="text-dark">ALAMAT</label>
                                    <textarea name="add_alamat" class="form-control"></textarea>
                                </div>
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username" required="">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                    </div>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>

                                <div id="confirm-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="confirm">CONFIRM PASSWORD</label>
                                    </div>
                                    <input id="confirm" name="confirm" type="password" class="form-control" placeholder="Confirm Password" required="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-confirm" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>

                                <div class="field-wrapper terms_condition">
                                    <div class="n-chk">
                                        <label class="new-control new-checkbox checkbox-primary">
                                          <input type="checkbox" class="new-control-input" required="">
                                          <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);">  terms and conditions </a></span>
                                      </label>
                                  </div>

                              </div>

                              <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value=""><span id="textDaftar"></span></button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>                    
            </div>
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?= base_url(); ?>app-assets/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?= base_url(); ?>app-assets/bootstrap/js/popper.min.js"></script>
<script src="<?= base_url(); ?>app-assets/bootstrap/js/bootstrap.min.js"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="<?= base_url(); ?>app-assets/assets/js/authentication/form-2.js"></script>
<script src="<?= base_url(); ?>app-assets/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="<?= base_url(); ?>app-assets/plugins/sweetalerts/custom-sweetalert.js"></script>
<?php if ($this->session->flashdata('notif')): ?>
<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Login Failed !",
            text: "<?php echo $this->session->flashdata('notif'); ?>",
            type: "error",
            timer: 10000
        });
    });
</script>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function(){
        var base = '<?= base_url(); ?>';

        $('#add_fakultas').val("");
        $('#add_prodi').val("");
        $('#add_fakultas').prop("readonly", true);
        $('#add_prodi').prop("readonly", true);
        $('#add_kelas').change(function(){
            var kelas = $(this).val();

            if (kelas == '-' || kelas == '') {
                $('#add_fakultas').val("");
                $('#add_prodi').val("");
                $('#add_fakultas').prop("readonly", true);
                $('#add_prodi').prop("readonly", true);
            } else {
                $('#add_fakultas').prop("readonly", false);
                $('#add_prodi').prop("readonly", false);
            }
        });

        $("#password").keyup(function(){

            var confirm = $("#confirm").val();
            var password = $(this).val();

            if (confirm == password) {
                $("#confirm").css("border-color", "green");
                $("#password").css("border-color", "green");
            } else {
                $("#confirm").css("border-color", "red");
                $("#password").css("border-color", "red");
            }
        });

        $("#confirm").keyup(function(){

            var password = $("#password").val();
            var confirm = $(this).val();

            if (confirm == password) {
                $("#confirm").css("border-color", "green");
                $("#password").css("border-color", "green");
            } else {
                $("#confirm").css("border-color", "red");
                $("#password").css("border-color", "red");
            }
        });

        // Register
        $('#textDaftar').html('Get Started!');
        $('#formRegister').on('submit', function(e){  
            e.preventDefault(); 

            $('#textDaftar').html('<div class="spinner-border text-white align-self-center loader-sm "></div>');

            var password = $("#password").val();
            var confirm = $("#confirm").val();

            if (confirm == password) {
                $.ajax({  
                    url: base + "Login/daftar",   
                    method:"POST",  
                    data:new FormData(this),  
                    contentType: false,  
                    cache: false,  
                    processData:false,  
                    dataType: "json",
                    success:function(res)  
                    {  
                        console.log(res.error);
                        $('#textDaftar').html('Get Started!');
                        if(res.error == false){  
                            swal({
                                title: "Success!",
                                text: res.message,
                                type: "success",
                                timer: 1000,
                                button: false,
                            });
                            $('#formRegister')[0].reset();
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
            } else {
                swal({
                    title: "Failed!",
                    text: "Konfirmasi Password Tidak Sama!",
                    type: "error",
                });
                $('#textDaftar').html('Get Started!');
            }
        });
    });
</script>

</body>

</html>