<?php include 'experthomeheader.php';


// view
$ab = "SELECT * FROM users INNER JOIN login USING(login_id) where user_type='user'";
$obj = select($ab);






?>

<center>
    <h1>VIEW USERS</h1>
</center>
<table align="center" border="1">
    <tr>

        <th>Name</th>
        <th>Place</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Dob</th>
        <th>Photo</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>

      

    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['fname'] ?> <?php echo $i['lname'] ?> </td>
            <td><?php echo $i['place'] ?></td>
            <td><?php echo $i['phone'] ?></td>
            <td><?php echo $i['email'] ?></td>
            <td><?php echo $i['dob'] ?></td>
            <td><a href="<?php echo $i['photo'] ?>"><img src="<?php echo $i['photo'] ?>" height="200px" width="200px" alt="image of user?"></a></td>
            <td> <a href="expert_view_user_response.php?uid=<?php echo $i['user_id'] ?>">RESPONSE</a></td>
                <td> <a href="expert_view_carbon_emission.php?uid=<?php echo $i['user_id'] ?>">CARBON EMISSION DETAILS</a></td>

                 <!-- <a href="admin_view_user_response.php?uid=<?php echo $i['user_id'] ?>">RESPONSE</a></td>
                <td> <a href="admin_view_carbon_emission.php?uid=<?php echo $i['user_id'] ?>">CARBON EMISSION </a></td> -->
                <td> <a href="expert_view_users_recomment.php?uid=<?php echo $i['user_id'] ?>">RECOMMENTED</a></td>
                <!-- <td> <a href="expert_user_assign_suggestions.php?uid=<?php echo $i['user_id'] ?>">ASSIGN </a></td> -->
                <td> <a href="expert_view_route_and_choices.php?uid=<?php echo $i['user_id'] ?>">ROUTE & CHOICES </a></td>

          




        <?php
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