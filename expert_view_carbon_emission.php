<?php include 'experthomeheader.php';



$uid = $_GET['uid'];

// Check if a date is selected
if (isset($_GET['date'])) {
    $selected_date = $_GET['date'];
    // Create an array of the next five dates including the selected date
    $dates = [];    
    for ($i = 0; $i < 8; $i++) {
        $dates[] = date('Y-m-d', strtotime("$selected_date +$i days"));
    }

    // Convert the array of dates to a string for the SQL IN clause
    $dates_string = "'" . implode("','", $dates) . "'";

    // View emissions data for the selected date range
    $ab = "SELECT * FROM carbon_emission
    INNER JOIN users USING(user_id)
    INNER JOIN `category` USING(category_id)
    WHERE user_id='$uid' AND calculation_date IN ($dates_string)";
    $obj = select($ab);

    if ($obj == null) {
        // Data is null for the selected date range
        $message = 'There is NO response for the selected date range :(';
    } else {
        $message = ''; // Reset message if data is found
    }
} else {
    $obj = null; // Initialize the $obj variable
}

?>

<center>
    <h1>CARBON EMISSION DETAILS</h1>
</center>

<!-- Date Picker Form -->
<center>
<form method="get" action="">
    <input type="hidden" name="uid" value="<?php echo $uid; ?>">
    <label for="date">Select a date:</label>
    <input type="date" id="date" name="date" required>
    <input type="submit" value="View Details">
</form>
<br><br>
<button id="viewStatsButton" class="btn btn-dark-outline" style="padding: 5px 10px;">STATISTICS</button>
</center>

<?php if (isset($message) && $message): ?>
    <p style="color: red; text-align: center;"><?php echo $message; ?></p>
<?php endif; ?>

<table align="center" border="1">
    <tr>
        <!-- <th>Name</th> -->
        <th>Category</th>
        <th>Total Emission</th>
        <th>Calculation Date</th>
    </tr>
    <?php if ($obj): ?>
        <?php foreach ($obj as $i): ?>
            <tr>
                <td><?php echo $i['category'] ?></td>
                <td><?php echo $i['total_emmision'] ?></td>
                <td><?php echo $i['calculation_date'] ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" style="text-align: center;">No data available. Please select a date.</td>
        </tr>
    <?php endif; ?>
</table>

<?php if ($obj): ?>
    <!-- Button to view statistics -->
    <center style="margin-top: 50px;margin-bottom:50px">
        
    </center>

    <!-- Canvas for Chart.js -->
    <canvas id="emissionChart" style="display:none;"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const emissionData = {
            labels: [],
            datasets: [{
                label: 'Total Emission',
                data: [],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Populate data from PHP into JavaScript
        <?php if ($obj): ?>
            const data = <?php echo json_encode($obj); ?>;
            data.forEach(item => {
                emissionData.labels.push(item.calculation_date);
                emissionData.datasets[0].data.push(item.total_emmision);
            });
        <?php endif; ?>

        // Initialize the chart
        const ctx = document.getElementById('emissionChart').getContext('2d');
        const emissionChart = new Chart(ctx, {
            type: 'bar',
            data: emissionData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Show chart when button is clicked
        document.getElementById('viewStatsButton').addEventListener('click', function() {
            const chartCanvas = document.getElementById('emissionChart');
            chartCanvas.style.display = 'block';
            emissionChart.update();
        });
    </script>
<?php endif; ?>




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

<?php include 'footer.php' ?>