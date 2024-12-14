<?php include 'admin_header.php';


$cid = $_GET['cid'];

// view
$ab = "SELECT * FROM `educational_content` AS ed INNER JOIN `save` AS sa
ON ed.content_id = sa.content_id INNER JOIN users AS us ON sa.user_id = us.user_id WHERE ed.content_id='$cid'
 ";
$obj = select($ab);

if ($obj == null) {
    alert('There is NO data found :(');
    return redirect('admin_manage_education_content.php');
}




// if (isset($_GET['aid'])) {
// 	extract($_GET);
//      $q="update  login set user_type='user'where login_id='$aid'";
// 	update($q);
// 	alert("updated");
// 	return redirect("admin_view_user.php");

// }
// if (isset($_GET['rid'])) {
// 	extract($_GET);
//     $q="delete from login where login_id='$rid'";
//     $qq="delete  from users where login_id='$rid'";
// 	delete($q);
// 	delete($qq);
// 	alert("Deleted");
// 	return redirect("admin_view_user.php");

// }


?>

<center>
    <h1>VIEW USERS</h1>
</center>
<table align="center" border="1">
    <tr>

        <th>Title</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Media</th>
        <th>user name</th>
        <th>Photo</th>
      

    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['title'] ?></td>
            <td><?php echo $i['description'] ?></td>
            <td><?php echo $i['tags'] ?></td>
            <td>
                <?php if ($i['content_type'] == 'Photo') { ?>
                    <img src="<?php echo $i['file'] ?>" width="200px" alt="Image">
                <?php } elseif ($i['content_type'] == 'video') { ?>
                    <video src="<?php echo $i['file'] ?>" controls></video>
                <?php } ?>
            </td>
            <td><?php echo $i['fname'] ?> <?php echo $i['lname'] ?></td>

            <td><a href="<?php echo $i['photo'] ?>"><img src="<?php echo $i['photo'] ?>" height="200px" width="200px" alt="image of user?"></a></td>
            




        </tr>

    <?php
    }
    ?>
</table>

<script src="js/script.js"></script>

<?php include 'footer.php' ?>