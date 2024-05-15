<?php
include('config.php');

require_once('controller/EventC.php');
require_once('controller/FeedbackC.php');


try {
    $pdo = config::getConnexion();
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}


$eventController = new EventC($pdo);
$feedbackController = new FeedbackC($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'buyTicket':
                $eventId = $_POST['event_id'];
                $candidateName = $_POST['candidate_name'];
                if ($eventController->buyTicket($eventId, $candidateName)) {
                    
                    echo "Ticket bought successfully!";
                } else {
                    
                    echo "Error: Could not buy ticket.";
                }
                break;
            case 'createFeedback':
                 $feedbackController->createFeedback();
                break;
            case 'updateFeedback':
                $feedbackController->updateFeedback($_POST['feedback_id']);
                break;
            case 'deleteFeedback':
                $feedbackController->deleteFeedback($_POST['feedback_id']);
                break;
            default:
                echo "Invalid action!";
                break;
             case 'searchEvent':
                    $events = $eventController->searchEvent($_POST['event_name']);
                    break;
             case 'searchFeedback':
                        if(isset($_POST['candidate_name'])) {
                            $candidateName = $_POST['candidate_name'];
                            $searchResults = $feedbackController->searchFeedbackByName($candidateName);
                        }
                        break;
        }
    }
}
$ticketPurchases = $eventController->readAllTicketPurchases();

// Encode the data into JSON format
$ticketPurchasesJSON = json_encode($ticketPurchases);
$events = $eventController->readAll();

$feedbackEntries = $feedbackController->readAllFeedback();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SEO Master - SEO Agency Website </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-search me-2"></i>SEO<span class="fs-5">Master</span></h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.html" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="project.html" class="nav-item nav-link">Project</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item active">events</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <butaton type="button" class="btn text-secondary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
                    <a href="https://htmlcodex.com/startup-company-website-template" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">Pro Version</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header mb-5">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-12 text-center">
                            <h1 class="text-white animated zoomIn">Events</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                                    <li class="breadcrumb-item text-white active" aria-current="page">Events</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


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


      <!-- Event Table Start -->
<div class="container-xxl bg-primary testimonial py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin: 6rem 0;">
    <div class="container py-5 px-lg-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-white mb-4">Events </h2>
                <div class="table-responsive" style="background-color: white; border-radius: 10px; padding: 15px;">
                <table id="eventTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <button type="button" class="btn btn-primary" onclick="sortEvents()">Sort Event Table</button>
                                <th>Event ID</th>
                                <th>Event Name</th>
                                <th>Event Type</th>
                                <th>Event Date</th>
                                <th>Event Place</th>
                                <th>Event Description</th>
                                <th>Ticket Price</th>
                                <th>Ticket Number</th>
                                <th>Actions </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event) : ?>
                                <tr>
                                    <td><?php echo $event['event_id']; ?></td>
                                    <td><?php echo $event['event_name']; ?></td>
                                    <td><?php echo $event['event_type']; ?></td>
                                    <td><?php echo $event['event_date']; ?></td>
                                    <td><?php echo $event['event_place']; ?></td>
                                    <td><?php echo $event['event_description']; ?></td>
                                    <td><?php echo $event['ticket_price']; ?></td>
                                    <td><?php echo $event['ticket_number']; ?></td>
                                    <td>
                                        <!-- Buy Ticket button -->
                                        <button class="btn btn-success buy-ticket-btn" onclick="buyTicketform(<?php echo $event['event_id']; ?>)">Buy Ticket</button>


                                        <!-- Create Feedback button -->
                                        <button type="button" class="btn btn-warning" onclick="showCreateFeedbackForm(<?php echo $event['event_id']; ?>)">Create Feedback</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>
<h3>Search Event</h3>
    <form action="index2.php?action=searchEvent" method="post">
        <input type="text" name="event_name" placeholder="Event Name">
        <button type="submit" class="btn btn-primary">Search Event</button>
    </form>
    
<!-- Event Table End -->

<button type="button" class="btn btn-danger" onclick="exportToPDF()">Export to PDF</button>

<!-- Buy Ticket Modal -->
<div class="modal fade" id="buyTicketModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buy Ticket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="buyTicketForm" action="index2.php?action=buyTicket" method="post">
                    <div class="mb-3">
                        <label for="candidate_name" class="form-label">Candidate Name</label>
                        <input type="text" class="form-control" name="candidate_name" required>
                    </div>
                    <input type="hidden" id="event_id" name="event_id">
                    <button type="submit" class="btn btn-primary">Buy Ticket</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Feedback Modal -->
<div class="modal" id="createFeedbackModal" tabindex="-1" aria-labelledby="createFeedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFeedbackModalLabel">Create Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Create Feedback Form -->
                    <form action="index2.php?action=createFeedback" method="post">
                        <input type="hidden" id="createFeedbackEventId" name="event_id">
                        <input type="text" name="candidate_name" placeholder="Your Name" required>
                        <textarea name="feedback_text" placeholder="Feedback" required></textarea>
                        <label for="satisfaction_rating">Satisfaction Rating:</label>
                        <input type="number" name="satisfaction_rating" id="satisfaction_rating" min="1" max="5" required>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Section Start -->
<div class="container-xxl bg-primary testimonial py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin: 6rem 0;">
    <div class="container py-5 px-lg-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-white mb-4">Feedback</h2>
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($feedbackEntries as $feedbackEntry) : ?>
                        <div class="col">
                            <div class="card text-white bg-dark">
                                <div class="card-body">
                                    <p class="card-title"><?php echo $feedbackEntry['candidate_name']; ?></p>
                                    <p class="card-text"><?php echo $feedbackEntry['feedback_text']; ?></p>
                                    <p class="card-text">
                                        <?php 
                                            $rating = $feedbackEntry['satisfaction_rating'];
                                            $stars = str_repeat('<i class="bi bi-star-fill"></i>', $rating);
                                            echo $stars;
                                        ?>
                                    </p>
                                    <p class="card-text"><?php echo $feedbackEntry['date_feedback']; ?></p>
                                    <!-- Update Feedback button -->
                                    
                                    <button type="button" class="btn btn-primary" onclick="showUpdateFeedbackForm(<?php echo $feedbackEntry['feedback_id']; ?>)">Update</button>

                                   <!-- Delete Feedback button -->
                                  <form action="index2.php?action=deleteFeedback" method="post" style="display: inline;">
                                  <input type="hidden" name="feedback_id" value="<?php echo $feedbackEntry['feedback_id']; ?>">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                                  </form>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Update Feedback Form Modal -->
<div class="modal" id="updateFeedbackModal" tabindex="-1" aria-labelledby="updateFeedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateFeedbackModalLabel">Update Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update Feedback Form -->
                    <form id="updateFeedbackForm" action="index2.php?action=updateFeedback" method="post">
                        <input type="hidden" id="updateFeedbackId" name="feedback_id">
                        <input type="text" id="updateCandidateName" name="candidate_name" placeholder="Your Name" required>
                        <textarea id="updateFeedbackText" name="feedback_text" placeholder="Feedback" required></textarea>
                        <label for="updateSatisfactionRating">Satisfaction Rating:</label>
                        <input type="number" id="updateSatisfactionRating" name="satisfaction_rating" min="1" max="5" required>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                    
            </div>
        </div>
    </div>
</div>
<h3>Search Feedback</h3>
    <form action="index2.php?action=searchFeedback" method="post">
        <input type="text" name="candidate_name" placeholder="Candidate Name">
        <button type="submit" class="btn btn-success" >Search Feedback</button>
    </form>
<!-- Feedback Section End -->
<div class="container-xxl bg-primary testimonial py-5 wow fadeInUp" data-wow-delay="0.1s" style="margin: 6rem 0;">
    <div class="container py-5 px-lg-5">
        <div class="row">
            <div class="col-12">
                <h2 class="text-white mb-4">Search Feedback Results</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php 
                    if (!empty($searchResults)) {
                        foreach ($searchResults as $feedbackEntry) : ?>
                            <div class="col">
                                <div class="card text-white bg-dark">
                                    <div class="card-body">
                                        <p class="card-title"><?php echo $feedbackEntry['candidate_name']; ?></p>
                                        <p class="card-text"><?php echo $feedbackEntry['feedback_text']; ?></p>
                                        <p class="card-text">
                                            <?php 
                                                $rating = $feedbackEntry['satisfaction_rating'];
                                                $stars = str_repeat('<i class="bi bi-star-fill"></i>', $rating);
                                                echo $stars;
                                            ?>
                                        </p>
                                        <p class="card-text"><?php echo $feedbackEntry['date_feedback']; ?></p>
                                        <!-- Update Feedback button -->
                                        <button type="button" class="btn btn-primary" onclick="showUpdateFeedbackForm(<?php echo $feedbackEntry['feedback_id']; ?>)">Update</button>
                                        <!-- Delete Feedback button -->
                                        <form action="index2.php?action=deleteFeedback" method="post" style="display: inline;">
                                            <input type="hidden" name="feedback_id" value="<?php echo $feedbackEntry['feedback_id']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } else { ?>
                        <div class="col">
                            <p>No feedback entries found matching the search criteria.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Search Feedback Results End -->

            

        


        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Popular Link</h5>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">Career</a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Project Gallery</h5>
                        <div class="row g-2">
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-1.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-2.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-3.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-4.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-5.jpg" alt="Image">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid" src="img/portfolio-6.jpg" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulpu</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                            <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-paper-plane text-primary fs-4"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
    </div>

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

    <script src="jspdf.min.js"></script>

    <!-- Add JavaScript to trigger the modal -->
<script>
 function showCreateFeedbackForm(eventId) {
            // Set the event ID in the create feedback form
            document.getElementById("createFeedbackEventId").value = eventId;

            // Show the modal
            var createFeedbackModal = new bootstrap.Modal(document.getElementById('createFeedbackModal'));
            createFeedbackModal.show();
        }  

        function showUpdateFeedbackForm(feedbackId) {
            // Fetch feedback details using AJAX or set values from existing elements
            // For demonstration, I'm assuming you have JavaScript variables for feedback details

            // Example JavaScript variables:
            var candidateName = "John Doe";
            var feedbackText = "Sample Feedback Text";
            var satisfactionRating = 5;

            // Set values in the update feedback form
            document.getElementById('updateFeedbackId').value = feedbackId;
            document.getElementById('updateCandidateName').value = candidateName;
            document.getElementById('updateFeedbackText').value = feedbackText;
            document.getElementById('updateSatisfactionRating').value = satisfactionRating;

            // Show the modal
            var updateFeedbackModal = new bootstrap.Modal(document.getElementById('updateFeedbackModal'));
            updateFeedbackModal.show();
        }

        function buyTicketform(eventId) {
        // Set the event ID in the buy ticket form
        document.getElementById("event_id").value = eventId;

        // Show the modal
        var buyTicketModal = new bootstrap.Modal(document.getElementById('buyTicketModal'));
        buyTicketModal.show();
    }


    function sortEvents() {
    // Get the table body
    var tableBody = document.querySelector('#eventTable tbody');

    // Get all rows in the table body
    var rows = Array.from(tableBody.querySelectorAll('tr'));

    // Sort the rows based on the event name (second column)
    rows.sort((rowA, rowB) => {
        var nameA = rowA.cells[1].textContent.trim().toLowerCase();
        var nameB = rowB.cells[1].textContent.trim().toLowerCase();
        return nameA.localeCompare(nameB);
    });

    // Remove existing rows from the table
    tableBody.innerHTML = '';

    // Append sorted rows to the table body
    rows.forEach(row => {
        tableBody.appendChild(row);
    });
}

function sortFeedbackByEventId() {
    // Get the table body
    var tableBody = document.querySelector('#feedbackTable tbody');

    // Get all rows in the table body
    var rows = Array.from(tableBody.querySelectorAll('tr'));

    // Sort the rows based on the event ID (assuming it's in the first column)
    rows.sort((rowA, rowB) => {
        var eventIdA = parseInt(rowA.cells[0].textContent.trim());
        var eventIdB = parseInt(rowB.cells[0].textContent.trim());
        return eventIdA - eventIdB;
    });

    // Remove existing rows from the table
    tableBody.innerHTML = '';

    // Append sorted rows to the table body
    rows.forEach(row => {
        tableBody.appendChild(row);
    });
}

var ticketPurchases = <?php echo $ticketPurchasesJSON; ?>;

    function exportToPDF() {
        // Initialize jsPDF
        var doc = new jsPDF();

        // Define columns and rows
        var columns = ['Candidate Name', 'Event ID', 'Receipt'];
        var rows = [];

        // Populate rows with ticket purchase data
        ticketPurchases.forEach(function (purchase) {
            var rowData = [];
            rowData.push(purchase.candidate_name);
            rowData.push(purchase.event_id);
            rowData.push(purchase.receipt);
            rows.push(rowData);
        });

        // Set table margin and font size
        var margin = {
            top: 20,
            right: 20,
            bottom: 20,
            left: 20
        };
        var fontSize = 12;

        // Set initial y position
        var y = margin.top;

        // Calculate cell width
        var cellWidth = (doc.internal.pageSize.width - margin.left - margin.right) / columns.length;

        // Set font size
        doc.setFontSize(fontSize);

        // Add header row
        doc.text(margin.left, y, columns.join(','));
        y += fontSize / 2;

        // Add table rows
        rows.forEach(function (rowData) {
            rowData.forEach(function (cellData, index) {
                doc.text(margin.left + index * cellWidth, y, cellData);
            });
            y += fontSize;
        });

        // Save the PDF
        doc.save('ticket_purchases.pdf');
    }
    function exportToPDF() {
        
        window.location.href = 'View/exportEventToPDF.php';
    }

</script>

   
</body>

</html>
