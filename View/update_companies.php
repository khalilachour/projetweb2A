<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set in the POST request
    if (isset($_POST['email'], $_POST['nom_societe'], $_POST['numero'], $_POST['capital'], $_POST['localisation'])) {
        // Retrieve form data from the POST request
        $email = $_POST['email'];
        $nom_societe = $_POST['nom_societe'];
        $numero = $_POST['numero'];
        $capital = $_POST['capital'];
        $localisation = $_POST['localisation'];

        // Include necessary files and initialize the database connection
        include_once __DIR__ . '/../Controller/CompanyC.php';
        $companyC = new CompanyC();

        // Call the method to update the company details
        $updateResult = $companyC->updateCompanyByEmail($email, $nom_societe, $numero, $capital, $localisation);

        // Check the result of the update operation
        if ($updateResult) {
            // Redirect to the page displaying the list of companies or perform another action
            header("Location: contact.php");
            exit(); // Ensure the script terminates after redirection
        } else {
            echo "Failed to update company. Please try again.";
        }
    } else {
        // Handle the case where the form fields are not set in the POST request
        echo "Missing form fields.";
    }
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
}
?>
