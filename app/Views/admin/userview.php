<?php
$session = session();
// dd($users);
?>

<?= $this->extend('layout/admin_layout') ?>



<?= $this->section('usercontent') ?>

<div class="flash-data" data-flashdata="<?= $session->getFlashdata('message'); ?>"></div>


<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h4 class="text-capitalize mb-3">Daftar User</h4>
            </div>
        </div>
    </div>

</div>
<div class="row mt-4" id="showdata">
    <div class="col mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-4">
                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a>
            </div>
            <div class=" table-responsive p-3">
                <table class="table align-item-center" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Whatsapp</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 1; ?>
                        <?php foreach ($users as $user) : ?>
                            <tr>
                                <td><?= $x ?></td>
                                <td>
                                    <a href="/admin/user_detail/<?= $user['id_user'] ?>"><?= $user['name'] ?></a>

                                </td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['whatsapp'] ?></td>
                                <td><?= $user['role_id'] == 1 ? 'admin' : ($user['role_id'] == 2 ? 'PTA' : ($user['role_id'] == 3 ? 'PA' : 'BHP')) ?></td>
                                <td><?= $user['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                            </tr>
                            <?php $x++ ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- addUserModal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- start form add user -->
                <form action="/admin/adduser" method="POST">
                    <input type="text" class="form-control mb-3" id="user_name" name="user_name" placeholder="Nama" required>
                    <input type="email" class="form-control mb-3" id="user_email" name="user_email" placeholder="email" required>
                    <input type="text" class="form-control mb-3" id="user_name" name="user_whatsapp" placeholder="Whatsapp (081xxxxxxxx)" required>
                    <select class="form-select required" aria-label="Default select example" id="user_role_id" name="user_role_id" required>
                        <option selected disabled value="">pilih salah satu</option>
                        <option value="1">Admin</option>
                        <option value="2">PTA</option>
                        <option value="3">PA Sewilayah</option>
                        <option value="4">BHP</option>
                    </select>
                    <!-- end form add user -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save_user">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    console.log('tes');
    let table = new DataTable('#myTable');

    //sweetalert add data
    const flasdata = $('.flash-data').data('flashdata');
    console.log(`flashdata ${flasdata}`);
    if (flasdata) {
        Swal.fire(
            'User Baru!',
            `berhasil ${flasdata}`,
            'success'
        );
    }
</script>
<?= $this->endSection() ?>