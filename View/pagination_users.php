<?php
// Include necessary files and initialize UserController
require_once "../Controller/UserC.php";
require_once "../Model/User.php";
require_once "../config.php";
$userC = new UserController();

// Pagination configuration
$results_per_page = 10; // Number of results per page
$start_from = 0; // Default starting index

// Calculate current page number
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $start_from = ($page - 1) * $results_per_page;
} else {
    $page = 1;
}

// Retrieve users for the current page
$users = $userC->listUsersPaginated($start_from, $results_per_page);

// Retrieve total number of users
$total_users = $userC->getTotalUsersCount();

// Calculate total number of pages
$total_pages = ceil($total_users / $results_per_page);
?>

<!-- Pagination Links -->
<div class="pagination justify-content-center mt-4">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>" class="page-link">&laquo; Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" class="page-link <?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>" class="page-link">Next &raquo;</a>
    <?php endif; ?>
</div>

<!-- Table of Users -->
<table id="usersTable" class="table table-striped mt-4">
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
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['type']; ?></td>
                <td><?php echo $user['age']; ?></td>
                <td><?php echo $user['localisation']; ?></td>
                <td>
                    <form action='/../../projet/View/delete_Users.php' method='post'>
                        <input type='hidden' name='user_id' value='<?php echo $user['user_id']; ?>'>
                        <button type='submit' class='btn btn-danger'>Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
