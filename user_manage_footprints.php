<?php
include 'userhome_header.php';

$userid = $_SESSION['uid'];

// Insert new carbon emission
if (isset($_POST['submit'])) {
    extract($_POST);

    $calculation_date = $_POST['calculation_date'];

    $q = "INSERT INTO carbon_emission (user_id, category_id, total_emmision, calculation_date) VALUES ('$userid', '$cate', '$emi', '$calculation_date')";
    $res = insert($q);
    alert("Emission added successfully");
    return redirect("user_manage_footprints.php");
}

// View categories
$ab = "SELECT * FROM category";
$obj = select($ab);

// View carbon emissions for the user
$kk = "SELECT * FROM carbon_emission INNER JOIN category ON carbon_emission.category_id = category.category_id WHERE user_id='$userid'";
$oo = select($kk);

// Check if updating emission
if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "SELECT * FROM carbon_emission INNER JOIN category ON carbon_emission.category_id = category.category_id WHERE emission_id='$uid'";
    $res = select($q);
}

// Update carbon emission
if (isset($_POST['update'])) {
    extract($_POST);

    $calculation_date = $_POST['calculation_date'];

    $q = "UPDATE carbon_emission SET category_id='$cate', total_emmision='$emi', calculation_date='$calculation_date' WHERE emission_id='$uid'";
    update($q);
    alert("Emission updated successfully");
    return redirect("user_manage_footprints.php");
}

// Delete carbon emission
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "DELETE FROM carbon_emission WHERE emission_id='$did'";
    delete($q);
    alert("Emission deleted successfully");
    return redirect("user_manage_footprints.php");
}

// Retrieve monthly emission data based on month name
$monthlyData = [];
$month_name = '';
if (isset($_POST['month_name'])) {
    $month_name = $_POST['month_name'];
    $month_number = date('m', strtotime($month_name)); // Convert month name to month number
    $year = date('Y'); // You can modify this to allow users to choose the year as well

    $q = "SELECT SUM(total_emmision) as total_emission, DATE_FORMAT(calculation_date, '%d') as day FROM carbon_emission WHERE user_id='$userid' AND MONTH(calculation_date)='$month_number' AND YEAR(calculation_date)='$year' GROUP BY day";
    $monthlyData = select($q);
}

if (isset($_GET['calc'])) {
    $emission_id = $_GET['calc'];
    $q = "SELECT * FROM carbon_emission INNER JOIN category ON carbon_emission.category_id = category.category_id WHERE emission_id='$emission_id'";
    $res = select($q);

    // Example calculation logic
    $category_id = $res[0]['category_id'];
    $current_emission = $res[0]['total_emmision'];
    $emissionFactor = $res[0]['emissionFactor'];

    $calculated_emission = $current_emission * $emissionFactor;

    // Update the calculated emission in the database
    $q = "UPDATE carbon_emission SET calculated_emission='$calculated_emission' WHERE emission_id='$emission_id'";
    update($q);
    alert("Emission calculated and updated successfully");
    return redirect("user_manage_footprints.php");
}
?>

<script src="js/script.js"></script>


<!-- Update form -->
<?php if (isset($_GET['uid'])) { ?>
    <center>
        <h1>UPDATE CARBON EMISSION</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Category</th>
                <td>
                    <select name="cate" id="">
                        <?php foreach ($obj as $i) { ?>
                            <option value="<?php echo $i['category_id']; ?>" <?php echo ($i['category_id'] == $res[0]['category_id']) ? 'selected' : ''; ?>>
                                <?php echo $i['category']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Total Emission</th>
                <td>
                    <input type="text" value="<?php echo $res[0]['total_emmision']; ?>" name="emi">
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>
                    <input type="date" name="calculation_date" value="<?php echo $res[0]['calculation_date']; ?>" required>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="update" value="Update">
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <!-- Manage form -->
    <center>
        <h1>MANAGE CARBON FOOTPRINTS</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Category</th>
                <td>
                    <select name="cate" id="">
                        <?php foreach ($obj as $i) { ?>
                            <option value="<?php echo $i['category_id']; ?>"><?php echo $i['category']; ?>(<?php echo $i['emissionFactor']; ?>)</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Emission</th>
                <td>
                    <input type="text" name="emi" required>
                </td>
            </tr>
            <tr>
                <th>Date</th>
                <td>
                    <input type="date" name="calculation_date" required>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>

    <!-- Monthly emission tracking form -->
    <center>
        <h1>TRACK CARBON EMISSIONS BY MONTH</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Enter Month (e.g., October)</th>
                <td>
                    <input type="text" name="month_name" placeholder="Enter month name" required>
                </td>
                <td>
                    <input type="submit" value="Search">
                </td>
            </tr>
        </table>
    </form>

    <!-- Chart for Monthly Emissions with Prediction -->
    <?php if (!empty($monthlyData)) { ?>
        <center>
            <h2>Carbon Emissions for <?php echo ucfirst($month_name); ?></h2>
            <canvas id="emissionChart" width="800" height="400"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('emissionChart').getContext('2d');
                var actualEmissions = <?php echo json_encode(array_column($monthlyData, 'total_emission')); ?>;
                var days = <?php echo json_encode(array_column($monthlyData, 'day')); ?>;
                var wantedEmissions = new Array(days.length).fill(25); // Desired threshold for carbon emissions
                
                // Generate chart with actual emissions (blue) and wanted emissions (red)
                var chart = new Chart(ctx, {
                    type: 'bar',  // Bar chart for better visual comparison
                    data: {
                        labels: days,
                        datasets: [
                            {
                                label: 'Actual Emissions',
                                data: actualEmissions,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Blue for actual emissions
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 2
                            },
                            {
                                label: 'Wanted Emission (25 units)',
                                data: wantedEmissions,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)', // Red for wanted emissions
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 2
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Day'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Emission (units)'
                                },
                                ticks: {
                                    // Ensure the chart scales appropriately for higher emissions
                                    stepSize: 5
                                }
                            }
                        }
                    }
                });

                // Provide feedback if any actual emission exceeds the wanted emission
                actualEmissions.forEach(function(emission, index) {
                    if (emission > 25) {
                        alert("On day " + days[index] + ", your emission (" + emission + ") exceeded the wanted limit of 25!");
                    }
                });
            </script>
        </center>
    <?php } ?>

    <!-- Table of Emissions -->
    <table border="1" align="center">
        <tr>
            <th>Category</th>
            <th>Total Emission</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($oo as $row) { ?>
            <tr>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['total_emmision']; ?></td>
                <td><?php echo $row['calculation_date']; ?></td>
                <td>
                    <a href="?uid=<?php echo $row['emission_id']; ?>">Update</a>
                    <a href="?did=<?php echo $row['emission_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
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

<?php



include 'footer.php';


