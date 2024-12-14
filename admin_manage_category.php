<?php include 'admin_header.php';

if (isset($_POST['submit'])) {
    extract($_POST);
    $q = "insert into category values(null,'$category','$fact')";
    $res = insert($q);
    alert("Category added successfully");
    return redirect("admin_manage_category.php");
}

// View categories
$ab = "select * from category";
$obj = select($ab);

// Update category
if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "select * from category where category_id='$uid'";
    $res = select($q);
}

if (isset($_POST['update'])) {
    extract($_POST);
    $q = "update category set category='$category', emissionFactor='$fact' where category_id='$uid'";
    update($q);
    alert("Category updated successfully");
    return redirect("admin_manage_category.php");
}

// Delete category
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "delete from category where category_id='$did'";
    delete($q);
    alert("Category deleted successfully");
    return redirect("admin_manage_category.php");
}

?>

<!-- Update form -->
<?php if (isset($_GET['uid'])) { ?>
    <center>
        <h1>UPDATE CATEGORY</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Category Name</th>
                <td>
                    <input type="text" value="<?php echo $res[0]['category'] ?>" name="category">
                </td>
            </tr>
            <tr>
                <th>Emission Factor</th>
                <td>
                    <input type="text" value="<?php echo $res[0]['emissionFactor'] ?>" name="fact">
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
        <h1>MANAGE CATEGORY</h1>
    </center>
    <form action="" method="post">
        <table align="center">
            <tr>
                <th>Category Name</th>
                <td>
                    <input type="text" name="category">
                </td>
            </tr>
            <tr>
                <th>Emission Factor</th>
                <td>
                    <input type="text" name="fact">
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

<table align="center" border="1">
    <tr>
        <th>Category Name</th>
        <th>Emission Factor</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($obj as $i) { ?>
        <tr>
            <td><?php echo $i['category'] ?></td>
            <td><?php echo $i['emissionFactor'] ?></td>

            <td>
                <a class="btn btn-success" href="?uid=<?php echo $i['category_id'] ?>">Update</a>
                <a class="btn btn-danger" href="?did=<?php echo $i['category_id'] ?>">Delete</a>
                <a class="btn btn-primary" href="admin_manage_product.php?cid=<?php echo $i['category_id'] ?>">Add Product</a>
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