<?php include 'admin_header.php';

if (isset($_POST['submit'])) {
    extract($_POST);
    $dir = "image/";
    $file = basename($_FILES['img']['name']);
    $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $target = $dir . uniqid("image_") . "." . $file_type;
    if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
        $q = "INSERT INTO educational_content VALUES(null, '$title', '$type', '$target', '$des', '$tag')";
        $res = insert($q);
        alert("Successfully added");
        return redirect("admin_manage_education_content.php");

        
    }
}

// View
$ab = "SELECT * FROM educational_content";
$obj = select($ab);

// Update
if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "SELECT * FROM educational_content WHERE content_id = '$uid'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $dir = "image/";
    $file = basename($_FILES['imgs']['name']);
    $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $target = $dir . uniqid("image_") . "." . $file_type;
    if (move_uploaded_file($_FILES['imgs']['tmp_name'], $target))
     {
        $q = "UPDATE educational_content SET title = '$title', content_type = '$type',file = '$target', description = '$des', tags = '$tag' WHERE content_id = '$uid'";
        update($q);
        alert("Updated successfully");
        return redirect("admin_manage_education_content.php");

        
    }
}

// Delete
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "DELETE FROM educational_content WHERE content_id = '$did'";
    delete($q);
    alert("Deleted successfully");
    return redirect("admin_manage_education_content.php");
}

?>

<!-- Update Form -->
<?php if (isset($_GET['uid'])) { ?>
    <center>
        <h1>UPDATE EDUCATIONAL CONTENT</h1>
    </center>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <th>Title</th>
                <td><input type="text" value="<?php echo $res[0]['title'] ?>" name="title"></td>
            </tr>
            <tr>
            <tr>
                <th>Content Type</th>
                <td>
                    <select name="type">
                        <option value="select">Select</option>
                        <option value="video" <?php echo ($res[0]['content_type'] == 'video') ? 'selected' : ''; ?>>Video</option>
                        <option value="Photo" <?php echo ($res[0]['content_type'] == 'Photo') ? 'selected' : ''; ?>>Photo</option>
                    </select>
                </td>
            </tr>

            </tr>
            <tr>
                <th>File</th>
                <td>
                    <input type="file" name="imgs"  required id="imgInput" onchange="previewImage(event)">

                    <br>
                    <img id="imgPreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px;">
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea name="des"><?php echo $res[0]['description'] ?></textarea></td>
            </tr>
            <tr>
                <th>Tags</th>
                <td><input type="text" value="<?php echo $res[0]['tags'] ?>" name="tag"></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="update" value="UPDATE"></td>
            </tr>
        </table>
    </form>
<?php } else { ?>

    <!-- Manage Form -->
    <center>
        <h1>MANAGE EDUCATIONAL CONTENT</h1>
    </center>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center">
            <tr>
                <th>Title</th>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <th>Content Type</th>
                <td>
                    <select name="type">
                        <option value="select">Select</option>
                        <option value="video">Video</option>
                        <option value="Photo">Photo</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>File</th>
                <td><input type="file" name="img"></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><textarea name="des"></textarea></td>
            </tr>
            <tr>
                <th>Tags</th>
                <td><input type="text" name="tag"></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="submit" value="Submit"></td>
            </tr>
        </table>
    </form>

<?php } ?>

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
                <a class="btn btn-success" href="?uid=<?php echo $i['content_id'] ?>">Update</a>
                <a class="btn btn-danger" href="?did=<?php echo $i['content_id'] ?>">Delete</a>
                <td><a href="admin_view_which_user.php?cid=<?php echo$i['content_id'] ?>">Saved</a></td>

            </td>
        </tr>
    <?php } ?>
</table>


<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var imgPreview = document.getElementById('imgPreview');
            imgPreview.src = reader.result;
            imgPreview.style.display = 'block';
        }

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
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