<?php
$session = session();

?>

<?= $this->extend('layout/admin_layout_copy') ?>



<?= $this->section('usercontent') ?>

<div class="flash-data" data-flashdata="<?= $session->getFlashdata('message'); ?>"></div>


<div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Detail User</h6>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table" id="detailuser">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <td><?= $user['name'] ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= $user['email'] ?></td>
                            </tr>
                            <tr>
                                <th>Whatsapp</th>
                                <td><?= $user['whatsapp'] ?></td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td><?= $user['role_id'] == 1 ? 'admin' : ($user['role_id'] == 2 ? 'PTA' : ($user['role_id'] == 3 ? 'PA' : 'BHP')) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?= $user['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                            </tr>
                            <tr>
                                <th>Tgl Regist</th>
                                <td><?= $user['date_creted'] ?></td>
                            </tr>

                        </thead>
                    </table>
                    <a href="#" class="btn btn-warning" id="resetPassword">Reset Password</a>
                    <?php if ($user['is_active'] == 1) : ?>
                        <a href="#" class="btn btn-danger" id="userOff">Nonaktif User</a>
                    <?php else : ?>
                        <a href="#" class="btn btn-danger" id="userOn">Aktif User</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card overflow-hidden h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Log User</h6>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table" id="logUser">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log) : ?>
                                <tr>
                                    <td><?= $log['date'] ?></td>
                                    <td><?= $log['action'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-5">
    <div class="card card-carousel overflow-hidden h-100 p-0">

    </div>
</div>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script>
    let table = new DataTable('#logUser');
    let iduser = <?= $user['id_user'] ?>;

    //reset password
    $('#resetPassword').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/admin/reset",
                    data: {
                        id_user: iduser
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.response === true) {
                            Swal.fire(
                                'Reseted!',
                                'Password has been reseted.',
                                'success'
                            )
                        }
                    }
                });

            }
        })




    });

    //nonaktif user
    $('#userOff').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Deactif the User!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/admin/useroff",
                    data: {
                        id_user: iduser
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.response === true) {
                            Swal.fire(
                                'Deactive!',
                                'User has been Deactivated.',
                                'success'
                            )
                        }
                    }
                });

            }
        })




    });

    //aktiv user
    $('#userOn').on('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Activ the User!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/admin/useron",
                    data: {
                        id_user: iduser
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.response === true) {
                            Swal.fire(
                                'Deactive!',
                                'User has been Activated.',
                                'success'
                            )
                        }
                    }
                });

            }
        })




    });
</script>

<?= $this->endSection() ?>