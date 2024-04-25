
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
                <li class="nav-item"><a href="project.html" class="nav-link">Project</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </li>
                <li class="nav-item"><a href="contact.html" class="nav-link active">Contact</a></li>
            </ul>
            <button type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
            <a href="#" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Pro Version</a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
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
   <!-- List of Companies Start -->

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h2 class="mt-2">List of Companies</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Numero</th>
                            <th>Capital</th>
                            <th>Localisation</th>
                            <th>Actions</th> <!-- Added Actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include __DIR__ . '/../Controllers/CompanyC.php';

                        $companyC = new CompanyC();

                        if (method_exists($companyC, 'listCompanies') && true) {
                            $result = $companyC->listCompanies();
                        } else {
                            $result = [];
                        }

                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>{$row['societe_id']}</td>";
                            echo "<td>{$row['nom_societe']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['type']}</td>";
                            echo "<td>{$row['numero']}</td>";
                            echo "<td>{$row['capital']}</td>";
                            echo "<td>{$row['localisation']}</td>";
                            // Add Actions column with Delete button
                            echo "<td><form action='delete_companies.php' method='post'><input type='hidden' name='companyId' value='{$row['societe_id']}'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</script>
<!-- List of Companies End -->
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
</body>

<!-- Add Company Form Start -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Add Company</h6>
                <h2 class="mt-2">Enter Company Details</h2>
            </div>
            <form action="add_companies.php" method="POST" onsubmit="return validateForm();">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Company Name" >
                            <label for="nom">Company Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" >
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="type">Type</label>
                        <select id="type" name="type" class="form-control">
                            <option value="company">Company</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero" >
                            <label for="numero">Numero</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="capital" name="capital" placeholder="Capital" >
                            <label for="capital">Capital</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="localisation" name="localisation" placeholder="Localisation" >
                            <label for="localisation">Localisation</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Add Company</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Company Form End -->
<script>
    function validateForm() {
        var nom = document.getElementById('nom').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var type = document.getElementById('type').value;
        var numero = document.getElementById('numero').value;
        var capital = document.getElementById('capital').value;
        var localisation = document.getElementById('localisation').value;

        // Validation de chaque champ
        if (nom == '' || email == '' || password == '' || type == '' || numero == '' || capital == '' || localisation == '') {
            alert('Veuillez remplir tous les champs.');
            return false; // Empêche la soumission du formulaire
        }
        

        // Vous pouvez ajouter d'autres validations selon vos besoins, par exemple pour le format de l'email ou d'autres contraintes.

        return true; // Soumet le formulaire si tous les champs sont valides
    }
</script>
<div class="container">
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            </div>
            <div class="for-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
            </div>
        </form>
        <div>
            <p>Not registered yet <a href="../Views/contact.php">Register Here</a></p>
            <button type="submit" class="btn btn-primary">login</button>
        </div>
    </div>
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
