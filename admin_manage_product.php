<?php include 'admin_header.php';

// Check if 'cid' is set and assign it
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
} else {
    alert("Category ID is missing");
    return redirect("admin_manage_category.php");
}

if (isset($_POST['submit'])) {
    extract($_POST);
    $q = "insert into products values(null,'$pro','$cid','$des','$avg')";
    $res = insert($q);
    alert("Product added successfully");
    return redirect("admin_manage_product.php?cid=$cid");
}

// View products
$ab = "select * from products where category_id='$cid'";
$obj = select($ab);

// Update product
if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "select * from products where product_id='$uid'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $q = "update products set product_name='$pro', description='$des' ,average_rating='$avg' where product_id='$uid'";
    update($q);
    alert("Product updated successfully");
    return redirect("admin_manage_product.php?cid=$cid");
}

// Delete product
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "delete from products where product_id='$did'";
    delete($q);
    alert("Product deleted successfully");
    return redirect("admin_manage_product.php?cid=$cid");
}

?>

<!-- Update form -->
<?php if (isset($_GET['uid'])) { ?>
    <center>
        <h1>UPDATE PRODUCT</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Product Name</th>
                <td>
                    <input type="text" value="<?php echo $res[0]['product_name'] ?>" name="pro">
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea name="des"><?php echo $res[0]['description'] ?></textarea>
                </td>
            </tr>
            <tr>
                <th>Average Rating</th>
                <td>
                    <input type="text" name="avg" pattern="^\d(\.\d)?/5$" value="<?php echo $res[0]['average_rating'] ?>" title="Enter a rating like 4.7/5" required>
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
        <h1>MANAGE PRODUCT</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Product Name</th>
                <td>
                    <input type="text" class="form-control" name="pro">
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td>
                    <textarea name="des" class="form-control"></textarea>
                </td>
            </tr>
            <tr>
                <th>Average Rating</th>
                <td>
                    <input type="text" class="form-control" name="avg" pattern="^\d(\.\d)?/5$" title="Enter a rating like 4.7/5" required>
                </td>
            </tr>

            <tr>
                <td align="center" colspan="2">
                    <input type="submit" name="submit" class="btn" value="Add">
                </td>
            </tr>
        </table>
    </form>
<?php } ?>

<table align="center" border="1">
    <tr>
        <th>Product Name</th>
        <th>Description</th>
        <th>Avg Rating</th>
        <th>Actions</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['product_name'] ?></td>
            <td><?php echo $i['description'] ?></td>
            <td><?php echo $i['average_rating'] ?></td>
            <td> <a class="btn btn-success" href="?uid=<?php echo $i['product_id'] ?>&cid=<?php echo $cid ?>">Update</a>
            </td>
            <td>
                <a class="btn btn-danger" href="?did=<?php echo $i['product_id'] ?>&cid=<?php echo $cid ?>">Delete</a>

            </td>
            <td><a class="btn btn-danger" href="admin_view_review.php?pid=<?php echo $i['product_id'] ?>&cid=<?php echo $cid ?>">Review</a>
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