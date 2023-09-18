<?php //dd($putusan[0]['link_putusan']) 

// var_dump($putusan);
// die;


?>

<?= $this->extend('layout/user_layout') ?>



<?= $this->section('usercontent') ?>

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Uploaded</p>
                            <h5 class="font-weight-bolder">
                                <?= count($putusan) ?> Putusan
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Approved</p>
                            <h5 class="font-weight-bolder">
                                <?= count($putusan_aproved) ?> Putusan
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <a href="#showdata" class="btn btn-warning">Show Table</a>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <a href="user/add" class="btn btn-primary">Add Data</a>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
        <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Ringkasan Upload Putusan</h6>
                <p class="text-sm mb-0">
                    <span class="font-weight-bold"><?= date('Y'); ?></span>
                </p>
            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">

        </div>
    </div>
</div>
<div class="row mt-4" id="showdata">
    <div class="col mb-lg-0 mb-4">
        <div class="card ">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-2">Daftar Putusan</h6>
                    <a href="user/add" class="btn btn-primary">Add Data</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-item-center" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Description</th>
                            <th>Upload Date</th>
                            <th>Action</th>
                            <th>Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($putusan as $p) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $p['nomor_putusan'] ?></td>
                                <td><?= $p['tgl_upload'] ?></td>
                                <td>
                                    <a href="file/<?= $p['link_putusan'] ?>" class="btn btn-sm btn-outline-warning">View</a>
                                    <?php if ($p['status'] == 1) : ?>
                                        <a href="<?= 'file/' . $p['link_putusan'] . '/delete' ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin Mendelete Data?')">Delete</a>
                                    <?php endif ?>
                                </td>l
                                <td>
                                    <?= $p['status'] == 1 ? 'Uploaded' : 'Confirmed' ?>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    let table = new DataTable('#myTable');

    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    // ajax



    let myChart = new Chart(ctx1, {
        type: "line",
        data: {
            labels: [],
            datasets: [{
                label: "Upload Putusan",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    $.ajax({
        type: "GET",
        url: "http://localhost:8080/user/view",
        data: "data",
        dataType: "json",
        success: function(response) {
            console.log(response);
            $.each(response, function(i, val) {
                myChart.data.labels.push(i);
                myChart.data.datasets[0].data.push(val);
                myChart.update();
            });
        }
    });
</script>
<?= $this->endSection() ?>