<?php include 'admin_header.php';

    // view
    $ab = "SELECT * FROM expert INNER JOIN login USING(login_id)";
    $obj = select($ab);

    if (isset($_GET['aid'])) {
        extract($_GET);
        $q="update login set user_type='expert' where login_id='$aid'";
        update($q);
        alert("updated");
        return redirect("admin_view_expert.php");

    }
    if (isset($_GET['rid'])) {
        extract($_GET);
        $q="delete from login where login_id='$rid'";
        $qq="delete  from expert where login_id='$rid'";
        delete($q);
        delete($qq);
        alert("Deleted");
        return redirect("admin_view_expert.php");
    }
?>

<section class="admin-view-user" style="height:100vh;">
    <?php
    // view
    $ab = "SELECT * FROM expert INNER JOIN login USING(login_id)";
    $obj = select($ab);

    if (empty($obj)) {
        ?>
        <center>
            <h1>No experts found</h1>
        </center>
        <?php
    } else {
    ?>
        <center>
            <h1>VIEW Experts</h1>
        </center>
        <table align="center" border="1">
            <tr>
                <th>Name</th>
                <th>Place</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Dob</th>
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

                    <?php
                    if ($i['user_type'] == 'pending') {
                    ?>
                            <td><a href="?aid=<?php echo $i['login_id'] ?>">Approve</td>
                            <td><a href="?rid=<?php echo $i['login_id'] ?>">Reject</td>
                    <?php
                    } else {
                    ?>
                        <!-- <td> <a href="admin_view_user_response.php?uid=<?php echo $i['user_id'] ?>">RESPONSE</a></td>
                        <td> <a href="admin_view_carbon_emission.php?uid=<?php echo $i['user_id'] ?>">CARBON EMISSION </a></td>
                        <td> <a href="admin_view_users_recomment.php?uid=<?php echo $i['user_id'] ?>">RECOMMENTED</a></td>
                        <td> <a href="admin_user_assign_suggestions.php?uid=<?php echo $i['user_id'] ?>">ASSIGN </a></td>
                        <td> <a href="admin_view_route_and_choices.php?uid=<?php echo $i['user_id'] ?>">ROUTE & CHOICES </a></td> -->
                    <?php
                    }
                    ?>
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