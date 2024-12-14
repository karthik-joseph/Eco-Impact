<?php include 'admin_header.php';


$eid = $_GET['eid'];


// view
$ab = "SELECT * FROM user_rsvp
 INNER JOIN `events` USING(event_id)
 INNER JOIN users USING(user_id)
  WHERE event_id='$eid'";
$obj = select($ab);


if ($obj == null) {
    alert('There is NO response :(');
    return redirect('admin_add_event.php');
}



?>

<center>
    <h1>EVENT ATTENDED USERS</h1>
</center>
<table align="center" border="1">
    <tr>

        <th>Event Title</th>
        <th>Place</th>
        <th>Description</th>
        <th>User Name</th>
        <th>Status</th>
        <th>Date</th>
        <th>rsvp_count</th>







    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['event_title'] ?></td>
            <td><?php echo $i['location'] ?></td>
            <td><?php echo $i['description'] ?></td>
            <td><?php echo $i['fname'] ?> <?php echo $i['lname'] ?></td>
            <td><?php echo $i['rsvp_status'] ?></td>
            <td><?php echo $i['rsvp_date'] ?></td>
            <td><?php echo $i['rsvp_count'] ?></td>








        <?php
    }
        ?>
</table>







<script src="js/script.js"></script>

<?php include 'footer.php' ?>