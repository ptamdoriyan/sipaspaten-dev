<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sipaspaten-dev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <?php
    $session = session();
    $message = $session->getFlashdata('message');
    ?>


    <div class="container-fluid">
        <div class="row mt-5">
            <section class="vh-100">
                <div class="container-fluid h-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-9 col-lg-6 col-xl-5">
                            <img src="img/sipas paten-solid.png" class="img-fluid rounded" alt="Sipaspaten Logo">
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                            <h3 class="mt-3 mb-2">Selamat Datang!</h3>
                            <h5 class="mt-3 mb-4">Sistem Informasi Pengiriman <br> Salinan Putusan Perwalian</h5>

                            <form method="POST" action="/login">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" name="email" />
                                    <!-- <label class="form-label" for="form3Example3">Email address</label> -->
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-3">
                                    <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" name="password" />
                                    <!-- <label class="form-label" for="form3Example4">Password</label> -->
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                        <label class="form-check-label" for="form2Example3">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#!" class="text-body">Forgot password?</a>
                                </div>

                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

                                    <!-- Error Message -->
                                    <div class="small fw-bold text-danger mt-4">
                                        <p><?= $message ?> </p>
                                    </div>
                                    <!-- end error message -->

                                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-warning">Please Contact Administrator</a></p>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>