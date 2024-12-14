<?php include 'experthomeheader.php';


$uid = $_GET['uid'];

// view
$ab = "SELECT * FROM `transportaion_routes` 
INNER JOIN `user_transportatoin_choices` USING(route_id)
INNER JOIN users USING(user_id) WHERE user_id='$uid'";
$obj = select($ab);

?>

<center>
    <h1>VIEW ROUTE & CHOICES</h1>
</center>
<table align="center" border="1">
    <tr>
        <th>Start Location</th>
        <th>End Location</th>
        <th>Distance</th>
        <th>Carbon Emission</th>
        <th>Transport Mode</th>
        <th>Choice Date</th>
    </tr>
    <?php
    if (empty($obj)) {
        echo "<tr><td colspan='6' style='text-align:center; color:red;'>No data available.</td></tr>";
        // echo "<script>alert('There are no values to display.');</script>";
    } else {
        foreach ($obj as $i) {
            echo "<tr>
                <td>{$i['start_location']}</td>
                <td>{$i['end_location']}</td>
                <td>{$i['distance_km']}</td>
                <td>{$i['carbon_emissions']}</td>
                <td>{$i['transport_mode']}</td>
                <td>{$i['choice_date']}</td>
            </tr>";
        }
    }
    ?>
</table>

<style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    table {
        width: 85%;
        margin-top: 20px;
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    th {
        background-color: #1b1750;
        color: #ffffff;
    }

    tr:hover {
        background-color: rgba(34, 31, 70, 0.108);
    }

    /* Responsive styles */
    @media only screen and (max-width: 600px) {
        table {
            width: 1200px;
        }

        th,
        td {
            display: block;
            width: 100%;
        }
    }
</style>
<script src="js/script.js"></script>

<?php include 'footer.php' ?>
