<?php include 'experthomeheader.php';




$uid = $_GET['uid'];


// view
$ab = "SELECT * FROM user_response
INNER JOIN users USING(user_id)
INNER JOIN `category` USING(category_id)
WHERE user_id='$uid'";
$obj = select($ab);


if ($obj == null) {
    alert('There is NO response :(');
    return redirect('expert_view_users.php');
}



?>

<center>
    <h1>VIEW USERS RESPONSE</h1>
</center>
<table align="center" border="1">
    <tr>
       
        <th>Name</th>
        <th>Quest_date</th>
        <th>Category</th>
        <th>Response</th>
        


    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['fname'] ?> <?php echo $i['lname'] ?> </td>
            <td><?php echo $i['quest_date'] ?></td>
            <td><?php echo $i['category'] ?></td>
            <td><?php echo $i['response_data'] ?></td>



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