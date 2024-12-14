<?php include 'admin_header.php';




if (isset($_POST['submit'])) {
    extract($_POST);
    $q = "insert into suggestions values(null,'$sugtxt','$score','$imple')";

    $res = insert($q);
    alert("successfully");

    return redirect("admin_manage_suggestions.php");
}

// view
$ab = "select * from suggestions";
$obj = select($ab);

// update & delete

if (isset($_GET['uid'])) {
    extract($_GET);
    $q = "select * from suggestions where suggestions_id='$uid'";
    $res = select($q);
}



if (isset($_POST['update'])) {
    extract($_POST);
    $q = "update  suggestions set suggestion_text='$sugtxt',impact_score='$score',ease_of_implementation='$imple' where suggestions_id='$uid'";
    update($q);
    alert("updated");
    return redirect("admin_manage_suggestions.php");
}
if (isset($_GET['did'])) {
    extract($_GET);
    $q = "delete from suggestions where suggestions_id='$did'";
    delete($q);
    alert("Deleted");
    return redirect("admin_manage_suggestions.php");
}

?>

<!-- updateform -->

<?php

if (isset($_GET['uid'])) {

?>
    <center>
        <h1>UPDATE SUGGESTIONS</h1>
    </center>
    <form action="" method="post">

        <table align="center">
            <tr>
                <th>
                    Suggestion Text
                </th>
                <td>
                    <textarea name="sugtxt" class="form-control" id=""><?php echo $res[0]['suggestion_text'] ?></textarea>
                </td>
            </tr>
            <tr>
                <th>
                   Imapact Score
                </th>
                <td><input type="text" class="form-control" name="score" value="<?php echo $res[0]['impact_score'] ?>" id=""></td>
                
            </tr>
            <tr>
                <th>
                    Ease of Implementation
                </th>
                <td>
                    <textarea name="imple" class="form-control" id=""><?php echo $res[0]['ease_of_implementation'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" class="btn" name="update" value="submit">
                </td>
            </tr>
        </table>
    </form>
<?php
} else {

?>


    <!-- manageform -->







    <center>
        <h1>MANAGE SUGGESTIONS</h1>
    </center>
    <form action="" method="post">

        <table align="center">
            <tr>
                <th>
                    Suggestion Text
                </th>
                <td>
                    <textarea name="sugtxt" class="form-control" id=""></textarea>
                </td>
            </tr>
            <tr>
                <th>
                   Imapact Score
                </th>
                <td><input type="text"  class="form-control" name="score" id=""></td>
                
            </tr>
            <tr>
                <th>
                    Ease of Implementation
                </th>
                <td>
                    <textarea name="imple"  class="form-control" id=""></textarea>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <input type="submit" class="btn" name="submit" value="submit">
                </td>
            </tr>
        </table>
    </form>

<?php
}
?>










<table align="center" border="1">
    <tr>
       
        <th>Suggestion Text</th>
        <th>Impact Score</th>
        <th>Ease of Implentations</th>

        <th></th>
        <th></th>
        <th></th>

    </tr>
    <?php
    foreach ($obj as $i) {
    ?>
        <tr>
            <td><?php echo $i['suggestion_text'] ?></td>
            <td><?php echo $i['suggestion_text'] ?></td>
            <td><?php echo $i['impact_score'] ?></td>
            <td><?php echo $i['ease_of_implementation'] ?></td>


            <td><a class="btn btn-success" href="?did=<?php echo $i['suggestions_id'] ?>">Delete</a>
            <td><a class="btn btn-success" href="?uid=<?php echo $i['suggestions_id'] ?>">Update</a>
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