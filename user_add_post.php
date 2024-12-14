<?php include 'userhome_header.php';
extract($_GET);
$uid  = $_SESSION['uid'];

if (isset($_POST['submit'])) {
    extract($_POST);
    
     $w1 = "insert into forum_posts values(null,'$topic_id','$uid', '$post_content', curdate())";
    insert($w1);
    alert("Inserted successfully");
    redirect("user_view_forums.php");
}

$ab = "select * from forum_posts where user_id='$uid'";
$obj = select($ab);

if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "select * from forum_posts where post_id='$uid'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $q = "update  forum_posts set post_content='$post_content',post_date=curdate() where post_id='$uid'";
    update($q);
    alert("updated");
    return redirect("user_add_post.php");
}
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "delete from forum_posts where post_id='$did'";
    delete($q);
    alert("Deleted");
    return redirect("user_add_post.php");
}
?>

<?php if (isset($_GET['uid'])) { ?>
    <center><h1>UPDATE POSTS</h1></center>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <th>Post Content</th>
                <td><textarea name="post_content" id=""><?php echo $res[0]['post_content'] ?></textarea></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" value="UPDATE" name="update" id=""></td>
            </tr>
        </table>
    </form>
<?php } else { ?>
    <center><h1>MANAGE POSTS</h1></center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Post Content</th>
                <td><textarea name="post_content" id=""></textarea></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" value="ADD" name="submit" id=""></td>
            </tr>
        </table>
    </form>
<?php } ?>

<table align="center" border="1">
    <tr>
        <th>Post Content</th>
        <th>Post Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['post_content'] ?></td>
            <td><?php echo $i['post_date'] ?></td>
            <td>
                <a class="btn btn-success" href="?did=<?php echo $i['post_id'] ?>">Delete</a>
                <a class="btn btn-success" href="?uid=<?php echo $i['post_id'] ?>&tid=<?php echo $i['topic_id'] ?>">Update</a>
                <a class="btn btn-success" href="userview_comments.php?pid=<?php echo $i['post_id'] ?>">Comments</a>

                <!-- <a class="btn btn-success show-comments-btn" href="javascript:void(0)" data-id="comment-section-<?php echo $i['post_id'] ?>">Comments</a> -->
            </td>
        </tr>
        <!-- Hidden comment section -->
        <tr id="comment-section-<?php echo $i['post_id'] ?>" class="comment-section" style="display: none;">
            <td colspan="3">
                <!-- Your comments form or section goes here -->
                <h4>Comments for Post ID: <?php echo $i['post_id'] ?></h4>
                <textarea placeholder="Add your comment here..."></textarea>
                <button>Submit Comment</button>
                <!-- Display comments here -->
            </td>
        </tr>
    <?php } ?>
</table>
<!-- 
<script>
    // Toggle the visibility of the comment section when the "Comments" button is clicked
    document.querySelectorAll('.show-comments-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var commentSection = document.getElementById(button.getAttribute('data-id'));
            if (commentSection.style.display === 'none') {
                commentSection.style.display = 'table-row';
            } else {
                commentSection.style.display = 'none';
            }
        });
    });
</script> -->


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
