<?php
$session = session();
?>

<?= $this->extend('layout/user_layout'); ?>

<?= $this->section('usercontent') ?>

<div class="flash-data" data-flashdata="<?= $session->getFlashdata('message'); ?>"></div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card bg-white p-4">
                <div class="card-header">
                    <img src="../img/profile.jpg" class="img-fluid img-thumbnail rounded-circle" width="10%" alt="">
                    <h3 class="d-inline">Profiles</h3>

                </div>
                <div class="card-body">

                    <form action="profile/editprofile" class="row g-3" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id_user" value="<?= $user[0]['id_user'] ?>">
                        <div class="col-md-6">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" disabled value="<?= $user[0]['nama'] ?>">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">email</label>
                            <input type="text" class="form-control" id="inputEmail" name="email" value="<?= $user[0]['email'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputWhatsApp" class="form-label">Whatsapp</label>
                            <input type="number" class="form-control" id="inputWhatsApp" name="whatsapp" value="<?= $user[0]['whatsapp'] ?>" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gantipassword">
                                <label class="form-check-label" for="gantipassword">Ganti Password</label>
                            </div>
                        </div>
                        <div class="col-md-6 password">
                            <label for="inputPassword" class="form-label">Password Lama</label>
                            <input type="password" class="form-control old_password" id="inputPassword" name="old_password">
                        </div>
                        <div class="col-md-6 password">
                            <label for="confirmPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control new_password" id="confirmPassword" name="new_password">
                        </div>

                        <div class="col-12">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btnubahData">Ubah Data</button>
                            <button type="submit" class="btn btn-primary btnubahPassword">Ubah Password</button>
                            <a href="/" class="btn btn-warning">Kembali</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $('.password').hide();
    $('.btnubahPassword').hide();

    $('#gantipassword').change(function(e) {
        if ($('#gantipassword').is(':checked')) {
            $('.password').show();
            $('.old_password').attr('required', 'true');
            $('.new_password').attr('required', 'true');
            $('.new_password').attr('min_length', '6');
            $('.btnubahPassword').show();
            $('.btnubahData').hide();
            $('#inputWhatsApp').attr('disabled', 'true');
            $('#inputEmail').attr('disabled', 'true');
            $('form').attr('action', 'profile/editpassword');

        } else {
            $('.password').hide();
            $('.btnubahPassword').hide();
            $('.btnubahData').show();
            $('#inputWhatsApp').removeAttr('disabled');
            $('#inputEmail').removeAttr('disabled');
            $('form').attr('action', 'profile/editprofile');

            $('.old_password').removeAttr('required');
            $('.new_password').removeAttr('required');
            $('.new_password').removeAttr('min_length');

        }

    });

    //sweetalert editprofile
    const flasdata = $('.flash-data').data('flashdata');
    console.log(`flashdata ${flasdata}`);
    if (flasdata) {

        if (flasdata == 'Diubah') {
            console.log(flasdata);
            Swal.fire(
                'Data Profile',
                `berhasil ${flasdata}`,
                'success'
            );
        } else {
            Swal.fire(
                'ERROR',
                `Periksa kembali ${flasdata}`,
                'error'
            );
        }

    }
</script>

<?= $this->endSection() ?>