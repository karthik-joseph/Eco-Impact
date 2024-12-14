<?php include 'userhome_header.php';

// View public posts with users
$ab = "SELECT * FROM `forum_posts` INNER JOIN users USING(user_id)";
$obj = select($ab);
$uid  = $_SESSION['uid'];

if (isset($_POST['add'])) {
    extract($_POST);
    
    $w1 = "INSERT INTO forum_comments VALUES(null, '$post_id', '$uid', '$content', curdate())";
    insert($w1);
    alert("Comment added successfully");
    redirect("user_view_public_post.php");
}

?>

<center>
    <h1>PUBLIC POSTS</h1>
</center>

<table align="center" border="1">
    <tr>
        <th>Content</th>
        <th>Date</th>
        <th>User</th>
        <th>Action</th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['post_content'] ?></td>
            <td><?php echo $i['post_date'] ?></td>
            <td><?php echo $i['fname'] . " " . $i['lname'] ?></td>
            <td>
                <a class="btn btn-success show-comments-btn" href="javascript:void(0)" data-id="comment-section-<?php echo $i['post_id'] ?>">View/Add Comments</a>
            </td>
        </tr>

        <tr id="comment-section-<?php echo $i['post_id'] ?>" class="comment-section" style="display: none;">
            <td colspan="4">
                <strong>Comments:</strong>
                <div class="comments-list">
                    <?php
                    // Retrieve comments for the current post
                    $comments_query = "SELECT * FROM forum_comments INNER JOIN users ON forum_comments.user_id = users.user_id WHERE post_id = '{$i['post_id']}'";
                    $comments = select($comments_query);
                    
                    if (count($comments) > 0) {
                        foreach ($comments as $comment) { ?>
                            <p>
                                <strong><?php echo $comment['fname'] . " " . $comment['lname'] ?>:</strong> 
                                <?php echo $comment['comment_content'] ?>
                                <span style="font-size: smaller;">(<?php echo $comment['comment_date'] ?>)</span>
                            </p>
                    <?php }
                    } else {
                        echo "<p>No comments yet.</p>";
                    }
                    ?>
                </div>
                
                <!-- Add comment form -->
                <form action="" method="post">
                    <input type="hidden" value="<?php echo $i['post_id'] ?>" name="post_id">
                    <textarea name="content" placeholder="Add your comment here..." required></textarea>
                    <button type="submit" name="add">Add Comment</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<script>
    // Toggle the visibility of the comment section when the "View/Add Comments" button is clicked
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
</script>



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
