<?php include 'admin_header.php';

if (isset($_POST['submit'])) {
    // Get the form data
    $reply = $_POST['reply'];
    $complaint_id = $_POST['compid'];

    // Insert the reply into the database
    $sql = "UPDATE `complaints` SET `reply` = '$reply' WHERE `complaint_id` = '$complaint_id'";
    $result = update($sql);

    alert("Successfully updated the reply.");

    // Optionally redirect to the complaints page
    // header("Location: admin_complaint.php");
}

// View complaints with user details
$ab = "SELECT * FROM `complaints` INNER JOIN `users` USING(user_id)";
$obj = select($ab);

?>
<section class="admin-complaint" style="height:100vh;">
    
<center>
    <h1>Complaints</h1>
</center>
<table align="center" border="1">
    <tr>
        <th>User Name</th>
        <th>Complaint</th>
        <th>Date</th>
        <th>Reply</th>
    </tr>
    <?php
    foreach ($obj as $i) {
        ?>
        <tr>
            <td><?php echo $i['fname'] . " " . $i['lname']; ?></td>
            <td><?php echo $i['complaint']; ?></td>
            <td><?php echo $i['date']; ?></td>
            <?php
            if ($i['reply'] == 'pending') {
                ?>
                <td>
                    <form action="" method="post">
                        <table>
                            <tr>
                                <td><textarea name="reply" placeholder="Reply here!"></textarea></td>
                                <td><input type="hidden" name="compid" value="<?php echo $i['complaint_id']; ?>"><input type="submit" value="Reply" name="submit"></td>
                            </tr>
                        </table>
                    </form>
                </td>
                <?php
            } else {
                ?>
                <td><?php echo $i['reply']; ?></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
</table>

</section>
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
