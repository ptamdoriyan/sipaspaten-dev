<?= $this->extend('layout/user_layout'); ?>

<?= $this->section('usercontent') ?>

<div class="container mt-5">
    <div class="card bg-white p-4">
        <div class="card-header">
            <h3>Upload Data Putusan</h3>
        </div>
        <div class="card-body">
            <form class="row g-3" method="POST">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nomor Putusan</label>
                    <input type="text" class="form-control" id="inputNomorPutusan" name="nomorputusan" required>
                </div>
                <div class="col-md-6">
                    <label for="formFileSm" class="form-label">Upload Putusan</label>
                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="uploadputusan">
                </div>
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