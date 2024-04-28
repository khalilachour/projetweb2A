<?php
// Include the UserController
include __DIR__ . '/../Controllers/UserC.php';

// Create an instance of the UserController
$userC = new UserController();

// Check if the method listUsers exists in the UserController
if (method_exists($userC, 'listUsers')) {
    // Call the listUsers method to retrieve the list of users
    $result = $userC->listUsers();
} else {
    // If the method doesn't exist, initialize $result as an empty array
    $result = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>
    <style>
        /* Styles for the table */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        td {
            color: #666;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Styles for the actions buttons */
        .actionsHeader button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .actionsHeader button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>List of Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Type</th>
            <th>Age</th>
            <th>Localisation</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['user_id'] ?></td>
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['type'] ?></td>
                <td><?php echo $row['age'] ?></td>
                <td><?php echo $row['localisation'] ?></td>
                <td class="actionsHeader">
                    <button><a href="../../updateUser.php?id=<?php echo $row['user_id'] ?>">Update</a></button>
                    <button><a href="../../deleteUser.php?id=<?php echo $row['user_id'] ?>">Delete</a></button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
