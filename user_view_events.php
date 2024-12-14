<?php include 'userhome_header.php';





$ab = "select * from events";
$obj = select($ab);

if (isset($_GET['eid'])) {
    extract($_GET);
    
    // Fetch the event details
    $sel = "SELECT * FROM EVENTS WHERE event_id='$eid'";
    $event = select($sel);  // Assuming select() fetches the event data as an associative array
    
    if ($event) {
        $uid  = $_SESSION['uid'];  // Assuming user is logged in and session is active
        
        // Check if the user has already RSVP'd to this event
        $checkRSVP = "SELECT * FROM user_rsvp 
                      WHERE event_id='$eid' AND user_id='$uid' AND rsvp_status='attended'";
        $rsvpRecord = select($checkRSVP);

        if ($rsvpRecord) {
            // User has already RSVP'd, show an alert and redirect
            alert('You have already attended this event.');
            return redirect('user_view_events.php');
        } else {
            // Increment RSVP count and add a record for the user
            $currentRSVPCount = $event[0]['rsvp_count'];
            $newRSVPCount = $currentRSVPCount + 1;
            
            // Update the event RSVP count
            $updateRSVP = "UPDATE EVENTS SET rsvp_count='$newRSVPCount' WHERE event_id='$eid'";
            update($updateRSVP);
            
            // Insert into user_rsvp for this user
            $insertRSVP = "INSERT INTO user_rsvp (user_id, event_id, rsvp_status, rsvp_date) 
                           VALUES ('$uid', '$eid', 'attended', CURDATE())";
            insert($insertRSVP);
            
            alert('Successfully  Added.');
            return redirect('user_view_events.php');
        }
    }
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

            <!-- <td><a class="btn btn-success" href="?did=<?php echo $i['event_id'] ?>">Delete</a>
            <a class="btn btn-success" href="?uid=<?php echo $i['event_id'] ?>">Update</a></td> -->
            <td><a href="?eid=<?php echo $i['event_id'] ?>">Attend</a></td>
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