<?php include 'userhome_header.php';

if (isset($_GET['pid'])) {
    extract($_POST);
    echo $pid = $_GET['pid'];
    echo $uid  = $_SESSION['uid'];

    $sql = "SELECT * FROM `user_product_recommendation` WHERE product_id='$pid' AND user_id='$uid'";

    $check = select($sql);

    if ($check) {
        echo "<script>alert('Already Recommended'); window.location.href='user_view_products.php';</script>";
    } else {
        $t = "INSERT INTO user_product_recommendation (user_id, product_id, recommendation_date) VALUES ('$uid', '$pid', CURDATE())";

        insert($t);

        echo "<script>alert('Successful :)'); window.location.href='user_view_products.php';</script>";
    }
}

// Retrieve search query if it exists
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Base query
$query = "SELECT * FROM `products`
          INNER JOIN `category` USING(category_id)
          INNER JOIN `product_review` USING(product_id)";

// Add search condition if a search term is provided
if (!empty($search)) {
    // $query .= " WHERE product_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
    $query = "SELECT * FROM `products`
          INNER JOIN `category` USING(category_id)
          INNER JOIN `product_review` USING(product_id) WHERE product_name LIKE '%$search%'";
}

// Execute the query
$obj = select($query);




?>

<center>
    <h1>PRODUCT </h1>
    <!-- Search Form -->
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search by product name" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn" style="padding: 5px 10px;">Search</button>
    </form>
</center>

<table align="center" border="1">
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <!-- <th>Price</th> -->
        <th>Description</th>
        <th>Review</th>
        <th>Date</th>
        <th>Rating</th>
    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo htmlspecialchars($i['product_name']); ?></td>
            <td><?php echo htmlspecialchars($i['category']); ?></td>
            <td><?php echo htmlspecialchars($i['description']); ?></td>
            <td><?php echo htmlspecialchars($i['review_text']); ?></td>
            <td><?php echo htmlspecialchars($i['review_date']); ?></td>
            <td><?php echo htmlspecialchars($i['rating']); ?></td>
            <td>

                <a class="btn btn-danger" href="?pid=<?php echo $i['product_id'] ?>">Recommend</a>

            </td>
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

<?php include 'footer.php'; ?>