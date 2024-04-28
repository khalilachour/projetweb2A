
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact Us - SEO Master</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="#" class="navbar-brand"><i class="fa fa-search me-2"></i>SEO<span class="fs-5">Master</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto py-0">
                <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="service.html" class="nav-link">Service</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Project</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </li>
                <li class="nav-item"><a href="contact.php" class="nav-link active">Contact</a></li>
            </ul>
            <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
            <a href="#" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Pro Version</a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Modify User Form -->
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Modify User</h6>
                <h2 class="mt-2">Modify User Details</h2>
            </div>
            <form action="update_user.php" method="post">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select id="type" name="type" class="form-select">
                                <option value="normal">Normal</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label for="type">Type</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                            <label for="age">Age</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Localisation">
                            <label for="localisation">Localisation</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
        <form action="logoutu.php" method="post">
          <button type="submit" name="logout" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="color: white; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
         </form>
            <div class="row g-5 py-5">
                <div class="col-12 text-center">
                    <h1 class="text-white">Contact Us</h1>
                    <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <!-- Hero End -->
   
<!--
login companies
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="/projetweb2/login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>-->
<!-- Choose Form Start -->
<div class="container py-5">
<h2 class="mb-4 text-center">Login</h2>
        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="text" placeholder="Enter Email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <input type="password" placeholder="Enter Password" name="password" class="form-control">
            </div>
            <div class="d-grid">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="alert alert-danger mt-3">
            <p><?php echo isset($errorMessage) ? $errorMessage : ''; ?></p>
        </div>
        <div class="register-link">
            <p>Not registered yet? <a href="../projetweb2/Views/contact.php">Register Here</a></p>
        </div>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Choose Form</h6>
                <h2 class="mt-2">Select the form you want to fill</h2>
            </div>
            <div class="text-center">
                <button class="btn btn-primary me-3" onclick="showCompanyForm()">Add Company</button>
                <button class="btn btn-primary" onclick="showUserForm()">Add User</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showCompanyForm() {
        document.getElementById('companyForm').style.display = 'block';
        document.getElementById('userForm').style.display = 'none';
    }

    function showUserForm() {
        document.getElementById('companyForm').style.display = 'none';
        document.getElementById('userForm').style.display = 'block';
    }
</script>

<!-- Add Company Form Start -->
<div class="container py-5" id="companyForm" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Add Company</h6>
                <h2 class="mt-2">Enter Company Details</h2>
            </div>
            <form action="add_companies.php" method="POST" onsubmit="return validateCompanyForm();">

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Company Name" >
                            <label for="nom">Company Name</label>
                        </div>
                        <p class="help-block" id="nomError"></p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" >
                            <label for="email">Email</label>
                        </div>
                        <p class="help-block" id="emailError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                            <label for="password">Password</label>
                        </div>
                        <p class="help-block" id="passwordError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Type" >
                            <label for="type">Type</label>
                        </div>
                        <p class="help-block" id="typeError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero" >
                            <label for="numero">Numero</label>
                        </div>
                        <p class="help-block" id="numeroError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="capital" name="capital" placeholder="Capital" >
                            <label for="capital">Capital</label>
                        </div>
                        <p class="help-block" id="capitalError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Localisation" >
                            <label for="localisation">Localisation</label>
                        </div>
                        <p class="help-block" id="localisationError"></p>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Add Company</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function validateCompanyForm() {
        // Reset error messages
        document.getElementById('nomError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('passwordError').innerHTML = '';
        document.getElementById('typeError').innerHTML = '';
        document.getElementById('numeroError').innerHTML = '';
        document.getElementById('capitalError').innerHTML = '';
        document.getElementById('localisationError').innerHTML = '';

        // Get form values
        var nom = document.getElementById('nom').value.trim();
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value.trim();
        var type = document.getElementById('type').value.trim();
        var numero = document.getElementById('numero').value.trim();
        var capital = document.getElementById('capital').value.trim();
        var localisation = document.getElementById('localisation').value.trim();

        // Validate Company Name
        if (nom === '') {
            document.getElementById('nomError').innerHTML = 'Company Name is required';
            return false;
        } else if (nom.length < 3 || nom.length > 50) {
            document.getElementById('nomError').innerHTML = 'Company Name must be between 3 and 50 characters';
            return false;
        }

        // Validate Email
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required';
            return false;
        } else if (!emailPattern.test(email)) {
            document.getElementById('emailError').innerHTML = 'Invalid email format';
            return false;
        }

        // Validate Password
        if (password === '') {
            document.getElementById('passwordError').innerHTML = 'Password is required';
            return false;
        } else if (password.length < 8 || password.length > 20) {
            document.getElementById('passwordError').innerHTML = 'Password must be between 8 and 20 characters';
            return false;
        } else if (!/[a-z]/.test(password)) {
            document.getElementById('passwordError').innerHTML = 'Password must contain at least one lowercase letter';
            return false;
        } else if (!/[A-Z]/.test(password)) {
            document.getElementById('passwordError').innerHTML = 'Password must contain at least one uppercase letter';
            return false;
        } else if (!/[0-9]/.test(password)) {
            document.getElementById('passwordError').innerHTML = 'Password must contain at least one number';
            return false;
        } else if (!/[^a-zA-Z0-9]/.test(password)) {
            document.getElementById('passwordError').innerHTML = 'Password must contain at least one special character';
            return false;
        }

        // Validate Type
        if (type === '') {
            document.getElementById('typeError').innerHTML = 'Type is required';
            return false;
        }

        // Validate Numero
        if (numero === '') {
            document.getElementById('numeroError').innerHTML = 'Numero is required';
            return false;
        } else if (isNaN(numero)) {
            document.getElementById('numeroError').innerHTML = 'Numero must be a number';
            return false;
        }

        // Validate Capital
        if (capital === '') {
            document.getElementById('capitalError').innerHTML = 'Capital is required';
            return false;
        } else if (isNaN(capital)) {
            document.getElementById('capitalError').innerHTML = 'Capital must be a number';
            return false;
        }

        // Validate Localisation
        if (localisation === '') {
            document.getElementById('localisationError').innerHTML = 'Localisation is required';
            return false;
        }

        // If all validations pass
        return true;
    }
</script>
<!-- User Form -->
<div class="container py-5" id="userForm" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Add User</h6>
                <h2 class="mt-2">Enter User Details</h2>
            </div>
            <form action="add_Users.php" method="post" onsubmit="return validateFormUser();">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            <label for="username">Username</label>
                        </div>
                        <p class="help-block" id="usernameError"></p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            <label for="email">Email</label>
                        </div>
                        <p class="help-block" id="emailError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <p class="help-block" id="passwordError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select" id="type" name="type">
                                <option value="normal">Normal</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label for="type">Type</label>
                        </div>
                        <p class="help-block" id="typeError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                            <label for="age">Age</label>
                        </div>
                        <p class="help-block" id="ageError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Localisation">
                            <label for="localisation">Localisation</label>
                        </div>
                        <p class="help-block" id="localisationError"></p>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Controle
<script>
    function validateFormUser() {
        // Reset error messages
        document.getElementById('usernameError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('passwordError').innerHTML = '';
        document.getElementById('typeError').innerHTML = '';
        document.getElementById('ageError').innerHTML = '';
        document.getElementById('localisationError').innerHTML = '';

        // Get form values
        var username = document.getElementById('username').value.trim();
        var email = document.getElementById('email').value.trim();
        var password = document.getElementById('password').value.trim();
        var type = document.getElementById('type').value.trim();
        var age = document.getElementById('age').value.trim();
        var localisation = document.getElementById('localisation').value.trim();

        // Validate username
        if (username === '') {
            document.getElementById('usernameError').innerHTML = 'Username is required';
            return false;
        } else if (username.length < 3 || username.length > 20) {
            document.getElementById('usernameError').innerHTML = 'Username must be between 3 and 20 characters';
            return false;
        }

        // Validate email
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            document.getElementById('emailError').innerHTML = 'Email is required';
            return false;
        } else if (!emailPattern.test(email)) {
            document.getElementById('emailError').innerHTML = 'Invalid email format';
            return false;
        }

        // Validate password
        if (password === '') {
            document.getElementById('passwordError').innerHTML = 'Password is required';
            return false;
        } else if (password.length < 6) {
            document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters';
            return false;
        }

        // Validate age
        if (age === '') {
            document.getElementById('ageError').innerHTML = 'Age is required';
            return false;
        } else if (isNaN(age) || parseInt(age) <= 0 || parseInt(age) > 150) {
            document.getElementById('ageError').innerHTML = 'Invalid age';
            return false;
        }

        // Validate localisation (optional)
        // You can add additional validation rules for localisation if needed

        // If all validations pass, return true to submit the form
        return true;
    }
</script>


<!-- Update Company Form -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Update Company</h6>
                <h2 class="mt-2">Enter Company Details</h2>
            </div>
            <form action="update_companies.php" method="POST" >
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" >
                </div>
                <div class="mb-3">
                    <label for="nom_societe" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="nom_societe" name="nom_societe" >
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Numero</label>
                    <input type="text" class="form-control" id="numero" name="numero" >
                </div>
                <div class="mb-3">
                    <label for="capital" class="form-label">Capital</label>
                    <input type="text" class="form-control" id="capital" name="capital" >
                </div>
                <div class="mb-3">
                    <label for="localisation" class="form-label">Localisation</label>
                    <input type="text" class="form-control" id="localisation" name="localisation" >
                </div>
                <button type="button" class="btn btn-primary" onclick="showCompanyDetails()">Show</button>
                <button type="submit" class="btn btn-primary">Update Company</button>
            </form>
        </div>
    </div>
</div>
<!-- End Update Company Form -->
<!--
<script>
    function validateForm() {
         var email = document.getElementById('email').value;
        var nom_societe = document.getElementById('nom_societe').value;
        var numero = document.getElementById('numero').value;
        var capital = document.getElementById('capital').value;
        var localisation = document.getElementById('localisation').value;

        // Check if any of the fields are empty
        if (email.trim() === '' || nom_societe.trim() === '' || numero.trim() === '' || capital.trim() === '' || localisation.trim() === '') {
            alert('Please fill in all fields.');
            return false; // Prevent form submission
        }

        // If all fields have valid input, return true to allow form submission
        return true;
    }
</script>
-->


    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(29, 29, 39, 0.7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-light p-3" placeholder="Type search keyword">
                        <button class="btn btn-light px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
