<?= $this->extend('layout/bhp_layout') ?>
<?= $this->section('usercontent') ?>

<div class="container mt-5">
    <div class="card bg-white p-4">
        <div class="card-header">
            <h3 class="mb-3">Upload Berita Acara satu</h3>
            <div class="informasiputusan">
                <ul class="list-group list-group-horizontal mb-2">
                    <li class="list-group-item fw-bold col-2 list-group-item-primary">Satker</li>
                    <li class="list-group-item col-4 list-group-item-primary "><?= $penetapan['name'] ?></li>
                </ul>
                <ul class="list-group list-group-horizontal">
                    <li class="list-group-item fw-bold col-2 list-group-item-success">No. Penetapan</li>
                    <li class="list-group-item col-4 list-group-item-success"><?= $penetapan['nomor_penetapan'] ?></li>
                </ul>
            </div>
        </div>
        <div class="card-body">

            <form class="row g-3" method="POST" enctype="multipart/form-data" action="/bhp/upload">
                <?= csrf_field() ?>
                <input type="hidden" name="id_penetapan" value="<?= $penetapan['id_penetapan'] ?>">
                <input type="hidden" name="whatsapp_user" value="<?= $penetapan['whatsapp'] ?>">
                <input type="hidden" name="nomor_penetapan" value="<?= $penetapan['nomor_penetapan'] ?>">
                <div class="col-md-6">
                    <label for="nomor_berita" class="form-label">Nomor Berita Acara</label>
                    <input type="text" class="form-control" id="nomor_berita" name="nomor_berita" required autofocus>
                </div>
                <div class="col-md-6">
                    <label for="file_berita" class="form-label">Upload Berita Acara</label>
                    <input class="form-control form-control-sm" id="file_berita" type="file" name="berita_acara">
                </div>

                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" required>
                        <label class="form-check-label" for="gridCheck">
                            Dengan ini saya Yakin bahwa data yang dikirimkan sudah benar !
                        </label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
    console.log('tes')
</script>

<?= $this->endSection() ?>