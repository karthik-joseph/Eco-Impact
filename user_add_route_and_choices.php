<?php 
include 'userhome_header.php';

if (isset($_POST['submit'])) {
    extract($_POST);
    
    // Check for duplicate route
    $checkRoute = "SELECT * FROM transportaion_routes WHERE start_location='$start' AND end_location='$end'";
    $existingRoute = select($checkRoute);
    
    if (!empty($existingRoute)) {
        alert("This route already exists. Please add a different route.");
    } else {
        $q = "INSERT INTO transportaion_routes VALUES (NULL, '$start', '$end', '$km', '$cr', '$mode')";
        $res = insert($q);
        alert("Successfully added route.");
        return redirect("user_add_route_and_choices.php");
    }
}

// View routes and associated choices
$ab = "SELECT tr.*, utc.choice_date 
       FROM transportaion_routes tr
       LEFT JOIN user_transportatoin_choices utc ON tr.route_id = utc.route_id
       ORDER BY tr.route_id";
$obj = select($ab);

if (isset($_GET['uids'])) {
    extract($_GET);
    $q = "SELECT * FROM transportaion_routes WHERE route_id='$uids'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $q = "UPDATE transportaion_routes SET start_location='$start', end_location='$end', distance_km='$km', carbon_emissions='$cr', transport_mode='$mode' WHERE route_id='$uids'";
    update($q);
    alert("Route updated successfully.");
    return redirect("user_add_route_and_choices.php");
}

if (isset($_GET['did'])) {
    extract($_GET);
    $q = "DELETE FROM transportaion_routes WHERE route_id='$did'";
    delete($q);
    alert("Route deleted successfully.");
    return redirect("user_add_route_and_choices.php");
}

// Handling adding a choice
if (isset($_POST['add_choice'])) {
    extract($_POST);
    
    // Check if session is set
    if (isset($_SESSION['uid'])) {
        $uu = $_SESSION['uid'];
        
        // Check for duplicate choice
        $checkChoice = "SELECT * FROM user_transportatoin_choices WHERE user_id='$uu' AND route_id='$route_id'";
        $existingChoice = select($checkChoice);
        
        if (!empty($existingChoice)) {
            alert("You have already added a choice for this route.");
        } else {
            $q = "INSERT INTO user_transportatoin_choices VALUES (NULL, '$uu', '$route_id', '$choice_date')";
            insert($q);
            alert("Choice added successfully.");
            return redirect("user_add_route_and_choices.php");
        }
    } else {
        alert("User session not found. Please log in again.");
        return redirect("login.php"); // Redirect to login if session is invalid
    }
}
?>

<?php if (isset($_GET['uids'])) { ?>
    <center><h1>UPDATE ROUTE</h1></center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Start Location</th>
                <td><input type="text" value="<?php echo $res[0]['start_location'] ?>" name="start"></td>
            </tr>
            <tr>
                <th>End Location</th>
                <td><input type="text" value="<?php echo $res[0]['end_location'] ?>" name="end"></td>
            </tr>
            <tr>
                <th>Distance (KM)</th>
                <td><input type="number" value="<?php echo $res[0]['distance_km'] ?>" name="km"></td>
            </tr>
            <tr>
                <th>Carbon Emission</th>
                <td><input type="text" value="<?php echo $res[0]['carbon_emissions'] ?>" name="cr"></td>
            </tr>
            <tr>
                <th>Mode</th>
                <td><input type="text" value="<?php echo $res[0]['transport_mode'] ?>" name="mode"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="update" value="Submit"></td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <center><h1>MANAGE ROUTE</h1></center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Start Location</th>
                <td><input type="text" name="start"></td>
            </tr>
            <tr>
                <th>End Location</th>
                <td><input type="text" name="end"></td>
            </tr>
            <tr>
                <th>Distance (KM)</th>
                <td><input type="number" name="km"></td>
            </tr>
            <tr>
                <th>Carbon Emission</th>
                <td><input type="text" name="cr"></td>
            </tr>
            <tr>
                <th>Mode</th>
                <td><input type="text" name="mode"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form>
<?php } ?>

<table align="center" border="1">
    <tr>
        <th>Start Location</th>
        <th>End Location</th>
        <th>Distance</th>
        <th>Carbon Emission</th>
        <th>Transport Mode</th>
        <th>Choice Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['start_location'] ?></td>
            <td><?php echo $i['end_location'] ?></td>
            <td><?php echo $i['distance_km'] ?></td>
            <td><?php echo $i['carbon_emissions'] ?></td>
            <td><?php echo $i['transport_mode'] ?></td>
            <td><?php echo !empty($i['choice_date']) ? $i['choice_date'] : 'No choice added' ?></td>
            <td>
                <a style="background-color: #000000;padding:10px 12px;border-radius:20px"  href="?uids=<?php echo $i['route_id'] ?>">Update</a>
                <a  style="background-color: #000000;padding:10px 12px;border-radius:20px"  href="?did=<?php echo $i['route_id'] ?>">Delete</a>
                <a style="background-color: #000000;padding:10px 12px;border-radius:20px"  href="?rit=<?php echo $i['route_id'] ?>">Add Choice</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php
if (isset($_GET['rit'])) {
    $route_id = $_GET['rit'];
    ?>
    <center><h1>ADD CHOICE</h1></center>
    <form action="" method="post">
        <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">
        <table align="center">
            <tr>
                <th>Choice Date</th>
                <td><input type="date" name="choice_date" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="add_choice" value="Add Choice"></td>
            </tr>
        </table>
    </form>
<?php } ?>



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

        form {
            width: 100%;
            overflow-x: auto;
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

        a {
            text-decoration: none;
            color: #3498db;
            transition: color 0.3s;
            font-weight: bold;
        }

        a:hover {
            color: #2980b9;
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

<?php include 'footer.php'; ?>
