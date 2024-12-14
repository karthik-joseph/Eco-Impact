<?php include 'experthomeheader.php';




if (isset($_POST['submit'])) {
    extract($_POST);
    $eid = $_SESSION['eid'];
    $q = "insert into forum_topics values(null,'$title','$des','$eid',curdate())";
    $res = insert($q);
    alert("Added successfully");
    return redirect("expert_manage_forums.php");
}

// View categories
$eid = $_SESSION['eid'];
$ab = "select * from forum_topics where creator_id='$eid'";
$obj = select($ab);

// Update category
if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "select * from forum_topics where topic_id='$uid'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $q = "update forum_topics set title='$title',description='$des',creation_date=curdate() where topic_id='$uid'";
    update($q);
    alert("Added successfully");
    return redirect("expert_manage_forums.php");
}

// Delete category
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "delete from forum_topics where topic_id='$did'";
    delete($q);
    alert("Removed :(");
    return redirect("expert_manage_forums.php");
}
?>






<section class="expert-manage-forums" style="height:100vh;">
    <!-- Update form -->
<?php if (isset($_GET['uid'])) { ?>
    <center>
        <h1>UPDATE FORUMS</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Title</th>
                <td>
                    <input type="text" value="<?php echo $res[0]['title'] ?>" name="title">
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea name="des" id=""><?php echo $res[0]['description'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="update" value="Update">
                </td>
            </tr>
        </table>
    </form>
<?php } else { ?>




    <!-- Manage form -->
    <center>
        <h1>MANAGE FORUMS</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Title</th>
                <td>
                    <input type="text" name="title">
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea name="des" id=""></textarea>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
<?php } ?>



<!-- view -->

<table align="center" border="1">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>

    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['title'] ?></td>
            <td><?php echo $i['description'] ?></td>

            <td>
                <a class="btn btn-success" href="?uid=<?php echo $i['topic_id'] ?>">Update</a>
                <a class="btn btn-danger" href="?did=<?php echo $i['topic_id'] ?>">Delete</a>
                <a class="btn btn-danger" href="expert_view_forums_posts.php?tid=<?php echo $i['topic_id'] ?>">VIew POSTS</a>

            </td>
        </tr>
    <?php } ?>
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

<?php include 'footer.php' ?>