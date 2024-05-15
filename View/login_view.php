<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JOB Flash - Job Finder</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>

</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 px-lg-5 py-3 py-lg-0">
        <div class="container">
            <a href="" class="navbar-brand"><i class="fa fa-search me-2"></i>JOB<span class="fs-5">FLash</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="#" class="nav-item nav-link">Service</a>
                    <a href="#" class="nav-item nav-link">Project</a>
                    <a href="#" class="nav-item nav-link">Contact</a>
                </div>
                <!-- Bouton Login -->
                <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

<!-- Login Modal Start -->
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="login-form" action="login.php" method="post">
                    <div class="mb-3">
                        <input type="text" placeholder="Enter Email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <input type="password" placeholder="Enter Password" name="password" class="form-control">
                    </div>

                    <!-- Google reCAPTCHA button -->
                    <div class="g-recaptcha" data-sitekey="6LcVWdcpAAAAAGf7MKK64HMoxczcMstooWDmOeeu" data-callback="onSubmit"></div>

                    <div class="d-grid">
                        <button type="submit" name="login" class="btn btn-primary" id="submitBtn" disabled>Login</button>
                    </div>
                </form>
                        <!-- Reset Password Request Form -->
                    <form action="reset_password_request.php" method="post">
                        <input type="email" name="email" placeholder="Enter your email">
                        <button type="submit" name="reset_request">Reset Password</button>
                    </form>
            </div>
        </div>
    </div>
</div>
<!-- Login Modal End -->
<script>
    // Enable submit button when reCAPTCHA is successful
    function onSubmit(token) {
        document.getElementById("submitBtn").disabled = false;
    }
</script>




    <!-- Hero Start -->
    <div class="container-xxl py-5 bg-primary hero-header mb-5">
        <div class="container my-5 py-5 px-lg-5">
            <div class="row g-5 py-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="text-white mb-4">All in one SEO tool need to grow your business rapidly</h1>
                    <p class="text-white pb-3">Tempor rebum no at dolore lorem clita rebum rebum ipsum rebum stet dolor sed justo kasd. Ut dolor sed magna dolor sea diam. Sit diam sit justo amet ipsum vero ipsum clita lorem</p>
                    <a href="#" class="btn btn-light py-sm-3 px-sm-5 rounded-pill me-3">Free Quote</a>
                    <a href="#" class="btn btn-outline-light py-sm-3 px-sm-5 rounded-pill">Contact Us</a>
                </div>
                
                <div class="col-lg-6 text-center text-lg-start">
                    <img class="img-fluid" src="img/hero.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Choose Form Section Start -->
    <div class="container py-5">
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
    <!-- Choose Form Section End -->

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
                            <input type="text" class="form-control" id="add_c_nom" name="add_c_nom" placeholder="Company Name" >
                            <label for="add_c_nom">Company Name</label>
                        </div>
                        <p class="help-block" id="add_c_nomError"></p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_c_email" name="add_c_email" placeholder="Email" >
                            <label for="add_c_email">Email</label>
                        </div>
                        <p class="help-block" id="add_c_emailError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="add_c_password" name="add_c_password" placeholder="Password" >
                            <label for="add_c_password">Password</label>
                        </div>
                        <p class="help-block" id="add_c_passwordError"></p>
                    </div>
                    <div class="col-12">
                            <div class="form-floating">
                                <select class="form-select" id="add_c_type" name="add_c_type">
                                    <option value="" selected disabled>Choisissez un type</option>
                                    <option value="Technologie de l'information">Technologie de l'information</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Santé">Santé</option>
                                    <option value="Manufacture">Manufacture</option>
                                    <option value="Education">Éducation</option>
                                    <option value="Commerce">Commerce</option>
                                    <option value="Consulting">Consulting</option>
                                    <option value="Immobilier">Immobilier</option>
                                    <option value="Alimentation et boissons">Alimentation et boissons</option>
                                    <option value="Transport">Transport</option>
                                    <option value="Autres">Autres</option>
                                </select>
                                <label for="add_c_type">Type d'entreprise</label>
                            </div>
                    </div>

                        <p class="help-block" id="add_c_typeError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_c_numero" name="add_c_numero" placeholder="Numero" >
                            <label for="add_c_numero">Numero</label>
                        </div>
                        <p class="help-block" id="add_c_numeroError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_c_capital" name="add_c_capital" placeholder="Capital" >
                            <label for="add_c_capital">Capital</label>
                        </div>
                        <p class="help-block" id="add_c_capitalError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_c_localisation" name="add_c_localisation" placeholder="Localisation" >
                            <label for="add_c_localisation">Localisation</label>
                        </div>
                        <div id="map"></div>
                    <style>
                    #map { height: 300px; }
                    </style>

                        <p class="help-block" id="add_c_localisationError"></p>
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
    // Initialiser la carte
    var map = L.map('map').setView([46.603354, 1.888334], 5);

    // Charger les tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Ajouter un marqueur que l'utilisateur peut déplacer
    var marker = L.marker([46.603354, 1.888334], {
        draggable: true
    }).addTo(map);

    // Mettre à jour le champ de localisation lorsque le marqueur est déplacé
    marker.on('dragend', function(e) {
        document.getElementById('add_c_localisation').value = marker.getLatLng().lat + ', ' + marker.getLatLng().lng;
    });
</script>

<script>
const mapOptions = {
    center: [46.225, 0.132],
    zoom: 5
}

const locationOptions = {
    maximumAge: 10000,
    timeout: 5000,
    enableHighAccuracy: true
};

var map = new L.map("map", mapOptions);

var layer = new L.TileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

map.addLayer(layer);

if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(handleLocation, handleLocationError, locationOptions);
} else {
    alert("Géolocalisation indisponible");
}

function handleLocation(position) {
    map.setZoom(16);
    map.panTo(new L.LatLng(position.coords.latitude, position.coords.longitude));
}

function handleLocationError(msg) {
    alert("Erreur lors de la géolocalisation");
}
</script>


<script>
    // Function to validate the form fields
    function validateCompanyForm() {
        // Retrieve form field values
        var nom = document.getElementById('add_c_nom').value.trim();
        var email = document.getElementById('add_c_email').value.trim();
        var password = document.getElementById('add_c_password').value.trim();
        var type = document.getElementById('add_c_type').value.trim();
        var numero = document.getElementById('add_c_numero').value.trim();
        var capital = document.getElementById('add_c_capital').value.trim();
        var localisation = document.getElementById('add_c_localisation').value.trim();

        // Reset error messages and field styles
        resetErrorsAndStyles();

        var isValid = true;

        // Validate company name
        if (nom === "") {
            showErrorAndStyle('add_c_nomError', 'add_c_nom', "Please enter company name");
            isValid = false;
        }

        // Validate email
        if (email === "") {
            showErrorAndStyle('add_c_emailError', 'add_c_email', "Please enter email");
            isValid = false;
        } else if (!isValidEmail(email)) {
            showErrorAndStyle('add_c_emailError', 'add_c_email', "Invalid email format");
            isValid = false;
        }

        // Validate password
        if (password === "") {
            showErrorAndStyle('add_c_passwordError', 'add_c_password', "Please enter password");
            isValid = false;
        } else if (password.length < 6) {
            showErrorAndStyle('add_c_passwordError', 'add_c_password', "Password must be at least 6 characters");
            isValid = false;
        }

        // Validate type
        if (type === "") {
            showErrorAndStyle('add_c_typeError', 'add_c_type', "Please select a type");
            isValid = false;
        }

        // Validate numero
        if (numero === "") {
            showErrorAndStyle('add_c_numeroError', 'add_c_numero', "Please enter numero");
            isValid = false;
        } else if (!isValidNumber(numero)) {
            showErrorAndStyle('add_c_numeroError', 'add_c_numero', "Invalid numero format");
            isValid = false;
        }

        // Validate capital
        if (capital === "") {
            showErrorAndStyle('add_c_capitalError', 'add_c_capital', "Please enter capital");
            isValid = false;
        } else if (!isValidCapital(capital)) {
            showErrorAndStyle('add_c_capitalError', 'add_c_capital', "Invalid capital format");
            isValid = false;
        }

        // Validate localisation
        if (localisation === "") {
            showErrorAndStyle('add_c_localisationError', 'add_c_localisation', "Please enter localisation");
            isValid = false;
        }

        return isValid;
    }

    // Function to validate email format
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Function to validate numeric input
    function isValidNumber(input) {
        var numberRegex = /^\d+$/;
        return numberRegex.test(input);
    }

    // Function to validate capital format
    function isValidCapital(input) {
        var capitalRegex = /^\d+(\.\d{1,2})?$/; // Allows up to 2 decimal places
        return capitalRegex.test(input);
    }

    // Function to reset error messages and field styles
    function resetErrorsAndStyles() {
        var errorFields = document.querySelectorAll('.error-message');
        errorFields.forEach(function(element) {
            element.innerHTML = "";
        });

        var formFields = document.querySelectorAll('.form-control');
        formFields.forEach(function(element) {
            element.style.border = "";
        });
    }

    // Function to show error message and style invalid field
    function showErrorAndStyle(errorId, fieldId, errorMessage) {
        document.getElementById(errorId).innerHTML = errorMessage;
        document.getElementById(fieldId).style.border = "2px solid red";
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
                            <input type="text" class="form-control" id="add_u_username" name="add_u_username" placeholder="Username">
                            <label for="add_u_username">Username</label>
                        </div>
                        <p class="help-block" id="add_u_usernameError"></p>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_u_email" name="add_u_email" placeholder="Email">
                            <label for="add_u_email">Email</label>
                        </div>
                        <p class="help-block" id="add_u_emailError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_u_password" name="add_u_password" placeholder="Password">
                            <label for="add_u_password">Password</label>
                        </div>
                        <p class="help-block" id="add_u_passwordError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select" id="add_u_type" name="add_u_type">
                                <option value="normal">Normal</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label for="add_u_type">Type</label>
                        </div>
                        <p class="help-block" id="add_u_typeError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="add_u_age" name="add_u_age" placeholder="Age">
                            <label for="add_u_age">Age</label>
                        </div>
                        <p class="help-block" id="add_u_ageError"></p>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="add_u_localisation" name="add_u_localisation" placeholder="Localisation">
                            <label for="add_u_localisation">Localisation</label>
                    <div id="map1"></div>
                    <style>
                    #map1 { height: 300px; }
                    </style>
                    </div>
                        </div>
                        <p class="help-block" id="add_u_localisationError"></p>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Add User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Initialiser la carte
    var map1 = L.map('map1').setView([46.603354, 1.888334], 5);

    // Charger les tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map1);

    // Ajouter un marqueur que l'utilisateur peut déplacer
    var markeru = L.marker([46.603354, 1.888334], {
        draggable: true
    }).addTo(map1);

    // Mettre à jour le champ de localisation lorsque le marqueur est déplacé
    markeru.on('dragend', function(e) {
        document.getElementById('add_u_localisation').value = markeru.getLatLng().lat + ', ' + markeru.getLatLng().lng;
    });
</script>
<script>
    // Function to validate the form fields
    function validateFormUser() {
        // Retrieve form field values
        var username = document.getElementById('add_u_username').value.trim();
        var email = document.getElementById('add_u_email').value.trim();
        var password = document.getElementById('add_u_password').value.trim();
        var type = document.getElementById('add_u_type').value.trim();
        var age = document.getElementById('add_u_age').value.trim();
        var localisation = document.getElementById('add_u_localisation').value.trim();

        // Reset error messages
        document.getElementById('add_u_usernameError').innerHTML = "";
        document.getElementById('add_u_emailError').innerHTML = "";
        document.getElementById('add_u_passwordError').innerHTML = "";
        document.getElementById('add_u_typeError').innerHTML = "";
        document.getElementById('add_u_ageError').innerHTML = "";
        document.getElementById('add_u_localisationError').innerHTML = "";

        var isValid = true;

        // Validate username
        if (username === "") {
            document.getElementById('add_u_usernameError').innerHTML = "Please enter username";
            isValid = false;
        }

        // Validate email
        if (email === "") {
            document.getElementById('add_u_emailError').innerHTML = "Please enter email";
            isValid = false;
        } else if (!isValidEmail(email)) {
            document.getElementById('add_u_emailError').innerHTML = "Invalid email format";
            isValid = false;
        }

        // Validate password
        if (password === "") {
            document.getElementById('add_u_passwordError').innerHTML = "Please enter password";
            isValid = false;
        } else if (password.length < 6) {
            document.getElementById('add_u_passwordError').innerHTML = "Password must be at least 6 characters";
            isValid = false;
        }

        // Validate age
        if (age === "") {
            document.getElementById('add_u_ageError').innerHTML = "Please enter age";
            isValid = false;
        } else if (isNaN(age) || age < 0 || age > 150) {
            document.getElementById('add_u_ageError').innerHTML = "Invalid age";
            isValid = false;
        }

        // Validate localisation
        if (localisation === "") {
            document.getElementById('add_u_localisationError').innerHTML = "Please enter localisation";
            isValid = false;
        }

        return isValid;
    }

    // Function to validate email format
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

    <!-- Services Section Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2">
                <h6 class="position-relative d-inline text-primary ps-4">Our Services</h6>
                <h2 class="mt-2">What Solutions We Provide</h2>
            </div>
            <div class="row g-4">
                <!-- Service items here -->
            </div>
        </div>
    </div>
    <!-- Services Section End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for toggling forms -->
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
    <script>
window.embeddedChatbotConfig = {
chatbotId: "QXZBKRn1sccJnRl58KRIP",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="QXZBKRn1sccJnRl58KRIP"
domain="www.chatbase.co"
defer>
</script>
</body>

</html>
