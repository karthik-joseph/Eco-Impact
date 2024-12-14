<?php include 'admin_header.php';

    // view
    $ab = "SELECT * FROM users INNER JOIN login USING(login_id)";
    $obj = select($ab);
?>

<section class="admin-view-user" style="height:100vh;">
    <?php
        if (empty($obj)) {
            ?>
            <center>
                <h1>No Users found</h1>
            </center>
            <?php
        } else {
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
                <td><img src="<?php echo $i['photo'] ?>" height="100px" width="150px" alt=""></td>


                <td> <a href="admin_view_user_response.php?uid=<?php echo $i['user_id'] ?>">RESPONSE</a></td>
                <td> <a href="admin_view_carbon_emission.php?uid=<?php echo $i['user_id'] ?>">CARBON EMISSION </a></td>
                <td> <a href="admin_view_users_recomment.php?uid=<?php echo $i['user_id'] ?>">RECOMMENDED</a></td>
                <td> <a href="admin_user_assign_suggestions.php?uid=<?php echo $i['user_id'] ?>">ASSIGN </a></td>
                <td> <a href="admin_view_route_and_choices.php?uid=<?php echo $i['user_id'] ?>">ROUTE & CHOICES </a></td>
        <?php
        }
            ?>
    </table>
    <?php
    }
?> 
</section>

<script src="js/script.js"></script>
<?php include 'footer.php' ?>