
<!DOCTYPE html>
<html lang="en">
    


    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Static Navigation - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch">
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Logout button -->
        <form action="/../../projetweb2/Views/logoutu.php" method="post" class="me-3">
            <button type="submit" name="logout" class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" style="color: white; text-decoration: none;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        <!-- User's name -->
        <div class="me-3 text-white">
            <?php
            session_start();
            if (isset($_SESSION["user"])) {
                echo "Welcome, " . $_SESSION["user"];
            }
            ?>
        </div>
    </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <?php
require_once __DIR__ . '/../../Controllers/CompanyC.php';
?>



                    <!-- Update Company Form -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Update Company</h6>
                <h2 class="mt-2">Enter Company Details</h2>
            </div>
            <form action="/../../projetweb2/Views/update_companies.php" method="POST" >
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
</script>
<!-- End Update Company Form -->
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
                        require_once __DIR__ . '/../../Controllers/CompanyC.php';

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
                            echo "<td><form action='/../../projetweb2/Views/delete_companies.php' method='post'><input type='hidden' name='companyId' value='{$row['societe_id']}'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h2 class="mt-2">List of Users</h2>
            </div>
            <div class="table-responsive_Users">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Age</th>
                            <th>Localisation</th>
                            <th>Actions</th> <!-- You can add actions here -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include necessary files and initialize UserController
                        require_once __DIR__ . '/../../Controllers/UserC.php';
                        $userC = new UserController();

                        // Call listUsers method to fetch users
                        $result = $userC->listUsers();

                        // Loop through the result and display each user
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td>{$row['user_id']}</td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['type']}</td>";
                            echo "<td>{$row['age']}</td>";
                            echo "<td>{$row['localisation']}</td>";
                            // You can add actions here, like edit and delete buttons
                            echo "<td><form action='/../../projetweb2/Views/delete_Users.php' method='post'><input type='hidden' name='user_id' value='{$row['user_id']}'><button type='submit' class='btn btn-danger'>Delete</button></form></td>";// Example: echo "<td><a href='/edit_user.php?id={$row['id']}' class='btn btn-primary'>Edit</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- List of Users Start -->


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Static Navigation</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Static Navigation</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p class="mb-0">
                                    This page is an example of using static navigation. By removing the
                                    <code>.sb-nav-fixed</code>
                                    class from the
                                    <code>body</code>
                                    , the top navigation and side navigation will become static on scroll. Scroll down this page to see an example.
                                </p>
                            </div>
                        </div>
                        <div style="height: 100vh"></div>
                        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
