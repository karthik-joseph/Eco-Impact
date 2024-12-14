<?php include 'userhome_header.php';

if (isset($_GET['cnt_id'])) {
    extract($_GET);

    $uid  = $_SESSION['uid'];

    $ops = "select * from save where content_id='$cnt_id' and user_id='$uid'";
    $obj = select($ops);
    if ($obj) {

        alert('ALREADY SAVED :)');
        return redirect('user_view_education_contents.php');
    }
    else{
        $q = "insert into save values(null,'$cnt_id','$uid',curdate())";
        $res = insert($q);
        alert('SAVED :)');
        return redirect('user_view_education_contents.php');
    

    }

        
}


// View
$ab = "SELECT * FROM educational_content";
$obj = select($ab);

?>


<!-- Display Content -->
<table align="center" border="1">
    <tr>
        <th>Title</th>
        <th>Content Type</th>
        <th>Description</th>
        <th>Tags</th>
        <th>Media</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['title'] ?></td>
            <td><?php echo $i['content_type'] ?></td>
            <td><?php echo $i['description'] ?></td>
            <td><?php echo $i['tags'] ?></td>
            <td>
                <?php if ($i['content_type'] == 'Photo') { ?>
                    <img src="<?php echo $i['file'] ?>" width="200px" alt="Image">
                <?php } elseif ($i['content_type'] == 'video') { ?>
                    <video src="<?php echo $i['file'] ?>" controls></video>
                <?php } ?>
            </td>
            <td>
                <a class="btn btn-success" href="?cnt_id=<?php echo $i['content_id'] ?>">Save</a>
                

            </td>
        </tr>
    <?php } ?>
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