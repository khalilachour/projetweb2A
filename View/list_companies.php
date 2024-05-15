<?php
include __DIR__ . '/../Controller/CompanyC.php';

$companyC = new CompanyC();

if (method_exists($companyC, 'listCompanies')) {
    $result = $companyC->listCompanies();
} else {
    $result = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Companies</title>
    <style>
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
    <h2>List of Companies</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Numero</th>
            <th>Capital</th>
            <th>Localisation</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row['societe_id'] ?></td>
                <td><?php echo $row['nom_societe'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['type'] ?></td>
                <td><?php echo $row['numero'] ?></td>
                <td><?php echo $row['capital'] ?></td>
                <td><?php echo $row['localisation'] ?></td>
                <td class="actionsHeader">
                    <button><a href="../../updateCompany.php?id=<?php echo $row['societe_id'] ?>">Update</a></button>
                    <button><a href="../../deleteCompany.php?id=<?php echo $row['societe_id'] ?>">Delete</a></button>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
