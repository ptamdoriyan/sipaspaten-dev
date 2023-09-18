<?php
// dd($user[0]);
?>

<?= $this->extend('layout/user_layout'); ?>

<?= $this->section('usercontent') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card bg-white p-4">
                <div class="card-header">
                    <img src="../img/profile.jpg" class="img-fluid img-thumbnail rounded-circle" width="10%" alt="">
                    <h3 class="d-inline">Profiles</h3>

                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="col-md-6">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" disabled value="<?= $user[0]['nama'] ?>">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">email</label>
                            <input type="text" class="form-control" id="inputEmail" name="email" value="<?= $user[0]['nama'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="inputWhatsApp" class="form-label">Whatsapp</label>
                            <input type="text" class="form-control" id="inputWhatsApp" name="whatsapp" value="<?= $user[0]['whatsapp'] ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="inputPassword" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="inputWhatsApp" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="confirmPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="confirmPassword" name="repassword">
                        </div>

                        <div class="col-12">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Ganti Passoword</button>
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
    console.log('tes')
</script>

<?= $this->endSection() ?>