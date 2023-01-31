<?php
    include('./loginValidation.php');
?>
<head>
    <link rel="stylesheet" href="loginRegister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<div class="form-container">
    <form action="" method="POST">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login information</p>
                                    <!--Place the error message here nonexisting account-->
                                    <?php
                                    if(isset($error))
                                    {
                                        foreach($error as $error)
                                        {
                                            echo '<span class="error-message">' . $error . '</span>';
                                        }
                                    }                                    
                                    ?>                                    
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" name="typeEmailL" class="form-control form-control-lg" required placeholder="Enter your email" />
                                        <label class="form-label" for="typeEmailL">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="typePasswordL" class="form-control form-control-lg" required placeholder="Enter your password" />
                                        <label class="form-label" for="typePasswordL">Password</label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" name="submitL" type="submit">Login</button>
                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account? <a href="register.php" class="text-white-50 fw-bold">Sign-up</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>