<?php include 'admin_header.php';


if (isset($_POST['submit'])) {
    extract($_POST);


    $w1 = "insert into events values(null,'$eventname','$date','$time','$plc','$des','0')";
    $t1 = insert($w1);
    alert("inserted successfully");
    return redirect("admin_add_event.php");
}


$ab = "select * from events";
$obj = select($ab);

if (isset($_GET['uid'])) {
	extract($_GET);
	$q="select * from events where event_id='$uid'";
	$res=select($q);
}


if (isset($_POST['update'])) {
	extract($_POST);
	 $q="update  events set event_title='$eventname',event_date='$date',event_time='$time',location='$plc',description='$des',rsvp_count='$count' where event_id='$uid'";
	update($q);
	alert("updated");
	return redirect("admin_add_event.php");

}
if (isset($_GET['did'])) {
    extract($_GET);
	$q="delete from events where event_id='$did'";
	delete($q);
    alert("Deleted");
	return redirect("admin_add_event.php");
}
?>


<?php

if(isset($_GET['uid'])){

    ?>

    
<center>
    <h1>UPDATE EVENT</h1>
</center>

<form action="" method="post" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <th>Event Title</th>
            <td><input type="text" class="form-control" value="<?php echo $res[0]['event_title']?>" name="eventname" id=""></td>
        </tr>
        <tr>
            <th>Event Date</th>
            <td><input type="date" class="form-control" name="date" value="<?php echo $res[0]['event_date']?>" id=""></td>
        </tr>
        <tr>
            <th>Event Time</th>
            <td><input type="time" class="form-control" name="time" value="<?php echo $res[0]['event_time']?>" id=""></td>
        </tr>
        <tr>
            <th>Place</th>
            <td><input type="text" class="form-control" name="plc" value="<?php echo $res[0]['location']?>" id=""></td>
        </tr>

        <tr>
            <th>Description</th>
            <td><textarea name="des" class="form-control" id=""><?php echo $res[0]['event_date']?></textarea></td>
        </tr>
       

        <tr>
            <td align="center" colspan="2"><input class="btn" type="submit" value="UPDATE" name="update" id=""></td>
        </tr>
    </table>
</form>
<?php

}
else{

   ?> 

<center>
    <h1>MANAGE EVENT</h1>
</center>

<form action="" method="post" enctype="multipart/form-data">
    <table align="center">
        <tr>
            <th>Event Title</th>
            <td><input type="text" class="form-control" name="eventname" id=""></td>
        </tr>
        <tr>
            <th>Event Date</th>
            <td><input type="date" class="form-control" name="date" id=""></td>
        </tr>
        <tr>
            <th>Event Time</th>
            <td><input type="time" class="form-control" name="time" id=""></td>
        </tr>
        <tr>
            <th>Place</th>
            <td><input type="text" class="form-control" name="plc" id=""></td>
        </tr>

        <tr>
            <th>Description</th>
            <td><textarea name="des" class="form-control" id=""></textarea></td>
        </tr>
       

        <tr>
            <td align="center" colspan="2"><input class="btn" type="submit" value="ADD" name="submit" id=""></td>
        </tr>
    </table>
</form>
<?php
}
?>


<table align="center" border="1">
    <tr>
        <th>Event Title</th>
        <th>Event Date</th>
        <th>Event Date</th>
        <th>Place</th>
        <th>Description</th>
        <th>Rsvp_count</th>
        <th></th>
        <th></th>
        <th></th>

    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['event_title'] ?></td>
            <td><?php echo $i['event_date'] ?></td>
            <td><?php echo $i['event_time'] ?></td>
            <td><?php echo $i['location'] ?></td>
            <td><?php echo $i['description'] ?></td>
            <td><?php echo $i['rsvp_count'] ?></td>

            <td><a class="btn btn-success" href="?did=<?php echo $i['event_id'] ?>">Delete</a>
            <a class="btn btn-success" href="?uid=<?php echo $i['event_id'] ?>">Update</a></td>
            <td><a href="admin_view_event_attended.php?eid=<?php echo$i['event_id'] ?>">Attended Users</a></td>
        </tr>
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