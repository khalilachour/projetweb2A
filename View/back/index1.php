<?php
include('config.php');

require_once('Controll/EventC.php');
require_once('Controll/FeedbackC.php');

try {
    $pdo = config::getConnexion();
} catch (PDOException $e) {
    die("Error: Could not connect. " . $e->getMessage());
}


$eventController = new EventC($pdo);
$feedbackController = new FeedbackC($pdo);

// Event CRUD Actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'createEvent':
                $eventController->createEvent();
                break;
            case 'updateEvent':
                $eventController->updateEvent($_POST['event_id']);
                break;
            case 'deleteEvent':
                $eventController->deleteEvent($_POST['event_id']);
                break;
            case 'searchEvent':
                $events = $eventController->searchEvent($_POST['event_name']);
                break;
            
        }
    }
}

// Feedback CRUD Actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch ($action) {
            case 'createFeedback':
                $feedbackController->createFeedback();
                break;
            case 'updateFeedback':
                $feedbackController->updateFeedback($_POST['feedback_id']);
                break;
            case 'deleteFeedback':
                $feedbackController->deleteFeedback($_POST['feedback_id']);
                break;
            case 'searchFeedback':
                if(isset($_POST['candidate_name'])) {
                    $candidateName = $_POST['candidate_name'];
                    $searchResults = $feedbackController->searchFeedbackByName($candidateName);
                }
                break;
                
                
                case 'reportFeedback':
                    if (isset($_POST['feedback_id'])) {
                        $feedbackId = $_POST['feedback_id'];
                        $result = $feedbackController->reportFeedback($feedbackId);
                       
                    } 
                   break;

            default:
                echo "Invalid action!";
                break;
        }
    }
}


// Retrieve all events and feedback entries
$events = $eventController->readAll();
$feedbackEntries = $feedbackController->readAllFeedback();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event and Feedback Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <style>
        body {
            /* Set the background image from the assets folder */
            background-image: url('assets/party.png');
            /* Set background size to cover the entire page */
            background-size: cover;
            /* Set background repeat to no-repeat */
            background-repeat: no-repeat;
            /* Center the background image */
            background-position: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Event and Feedback Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" onclick="showEventSection()">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showFeedbackSection()">Feedback</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div id="eventSection">
        <h2>Event </h2>
        <!-- Create Event Form -->
        <h3>Create Event</h3>
        <form action="index1.php?action=createEvent" method="post">
            <input type="text" name="event_name" placeholder="Event Name" required>
            <input type="text" name="event_type" placeholder="Event Type" required>
            <input type="date" name="event_date" required>
            <input type="text" name="event_place" placeholder="Event Place" required>
            <textarea name="event_description" placeholder="Event Description" required></textarea>
            <input type="number" name="ticket_price" placeholder="Ticket Price" required> 
            <input type="text" name="ticket_number" placeholder="Ticket Number" required> 
            
            <button type="submit">Create Event</button>
        </form>
        <!-- Search Event Form -->
    <h3>Search Event</h3>
    <form action="index1.php?action=searchEvent" method="post">
        <input type="text" name="event_name" placeholder="Event Name">
        <button type="submit">Search Event</button>
    </form>
    

        <h3> Events</h3>
        <!-- Display All Events -->
       <!-- Display All Events -->
<table id="eventTable" class="table">
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Type</th>
            <th>Event Date</th>
            <th>Event Place</th>
            <th>Event Description</th>
            <th>Ticket Price</th>
            <th>Ticket Number</th>
            <th>Actions</th>
            <th>
            <button type="button" class="btn btn-primary" onclick="sortEvents()">Sort Event Table</button>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($events as $event): ?>
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
                    <!-- Update Event Button -->
                    <button type="button" class="btn btn-primary" onclick="showUpdateEventForm(<?php echo $event['event_id']; ?>)">Update</button>
                    <!-- Delete Event Button -->
                    <form action="index1.php?action=deleteEvent" method="post" style="display: inline;">
                        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                    </form>
                    <!-- Create Feedback Button -->
                    <button type="button" class="btn btn-success" onclick="showCreateFeedbackForm(<?php echo $event['event_id']; ?>)">Create Feedback</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<button type="button" class="btn btn-primary" onclick="exportToPDF()">Export Events </button>

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
                    <form action="index1.php?action=createFeedback" method="post">
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

    <div id="feedbackSection" style="display: none;">
        <h2>Feedback </h2>
       
        
        <!-- Display All Feedback Entries -->
        <table id="feedbackTable" class="table">
            <thead>
                <tr>
                    <th>Feedback ID</th>
                    <th>Event ID </th>
                    <th>Candidate Name</th>
                    <th>Feedback Text</th>
                    <th>Satisfaction Rating</th>
                    <th>Feedback Date</th> 
                    <th>Actions</th>
                    <th>
                    <button type="button" class="btn btn-primary" onclick="sortFeedbacks()">Sort Feedback Table</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedbackEntries as $feedback): ?>
                    <tr>
                        <td><?php echo $feedback['feedback_id']; ?></td>
                        <td><?php echo $feedback['event_id']; ?></td>
                        <td><?php echo $feedback['candidate_name']; ?></td>
                        <td><?php echo $feedback['feedback_text']; ?></td>
                        <td><?php echo $feedback['satisfaction_rating']; ?></td>
                        <td><?php echo $feedback['date_feedback']; ?></td> <!-- Display Feedback Time -->
                        <td>
                            <!-- Update Feedback Button -->
                            <button type="button" class="btn btn-primary" onclick="showUpdateFeedbackForm(<?php echo $feedback['feedback_id']; ?>)">Update</button>
                            
                            <button type="button" class="btn btn-warning" onclick="reportFeedback(<?php echo $feedback['feedback_id']; ?>)">Report</button>





                            <!-- Delete Feedback Button -->
                            <form action="index1.php?action=deleteFeedback" method="post" style="display: inline;">
                                <input type="hidden" name="feedback_id" value="<?php echo $feedback['feedback_id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Update Event Form Modal -->
    <div class="modal" id="updateEventModal" tabindex="-1" aria-labelledby="updateEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateEventModalLabel">Update Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Update Event Form -->
                    <form id="updateEventForm" action="index1.php?action=updateEvent" method="post">
                        <input type="hidden" id="updateEventId" name="event_id">
                        <input type="text" id="updateEventName" name="event_name" placeholder="Event Name" required>
                        <input type="text" id="updateEventType" name="event_type" placeholder="Event Type" required>
                        <input type="date" id="updateEventDate" name="event_date" required>
                        <input type="text" id="updateEventPlace" name="event_place" placeholder="Event Place" required>
                        <textarea id="updateEventDescription" name="event_description" placeholder="Event Description" required></textarea>
                        <input type="number" id="updateTicketPrice" name="ticket_price" placeholder="Ticket Price" required> 
                        <input type="text" id="updateTicketNumber" name="ticket_number" placeholder="Ticket Number" required>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
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
                    <form id="updateFeedbackForm" action="index1.php?action=updateFeedback" method="post">
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
    
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    
    <script>

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

function sortFeedbacks() {
    // Get the table body
    var tableBody = document.querySelector('#feedbackTable tbody');

    // Get all rows in the table body
    var rows = Array.from(tableBody.querySelectorAll('tr'));

    // Sort the rows based on the event id (second column)
    rows.sort((rowA, rowB) => {
        var idA = parseInt(rowA.cells[1].textContent.trim());
        var idB = parseInt(rowB.cells[1].textContent.trim());
        return idA - idB;
    });

    // Remove existing rows from the table
    tableBody.innerHTML = '';

    // Append sorted rows to the table body
    rows.forEach(row => {
        tableBody.appendChild(row);
    });
}











        function showEventSection() {
            document.getElementById("eventSection").style.display = "block";
            document.getElementById("feedbackSection").style.display = "none";
        }

        function showFeedbackSection() {
            document.getElementById("eventSection").style.display = "none";
            document.getElementById("feedbackSection").style.display = "block";
        }

        function showUpdateEventForm(eventId) {
            // Fetch event details using AJAX or set values from existing elements
            // For demonstration, I'm assuming you have JavaScript variables for event details

            // Example JavaScript variables:
            var eventName = "Sample Event Name";
            var eventType = "Sample Event Type";
            var eventDate = "2024-04-27";
            var eventPlace = "Sample Event Place";
            var eventDescription = "Sample Event Description";
            var ticketPrice = "0.0";
            var ticketNumber = "0"; 

            // Set values in the update event form
            document.getElementById('updateEventId').value = eventId;
            document.getElementById('updateEventName').value = eventName;
            document.getElementById('updateEventType').value = eventType;
            document.getElementById('updateEventDate').value = eventDate;
            document.getElementById('updateEventPlace').value = eventPlace;
            document.getElementById('updateEventDescription').value = eventDescription;
            document.getElementById('updateTicketPrice').value = ticketPrice; 
            document.getElementById('updateTicketNumber').value = ticketNumber;
            

            // Show the modal
            var updateEventModal = new bootstrap.Modal(document.getElementById('updateEventModal'));
            updateEventModal.show();
        }

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


        function reportFeedback(feedbackId) {
        // Confirm with the user before reporting the feedback
        if (confirm("Are you sure you want to report this feedback?")) {
            // Create a form element
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'index1.php?action=reportFeedback'; // Set the action URL

            // Create an input element for the feedback ID
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'feedback_id';
            input.value = feedbackId;
            form.appendChild(input);

            // Append the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        }
    }

    function exportToPDF() {
        
        window.location.href = 'View/exportEventToPDF.php';
    }
    </script>
</body>
</html>
