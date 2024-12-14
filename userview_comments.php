<?php include 'userhome_header.php';

extract($_GET);
// view
$ab = "select * from forum_comments where post_id='$pid'";
$obj = select($ab);



?>

<center>
    <h1>POST COMMENTS</h1>
</center>
<table align="center" border="1">
    <tr>

        <th>Comment</th>
        <th>Date</th>
        

    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['comment_content'] ?></td>
            <td><?php echo $i['comment_date'] ?></td>
            


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