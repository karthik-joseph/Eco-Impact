<?php
include 'admin_header.php';

$uid = $_GET['uid'] ;

// Check if a suggestion already exists for the user
function checkIfSuggestionExists($user_id, $suggestion_id) {
    $query = "SELECT * FROM user_suggestion WHERE user_id='$user_id' AND suggestions_id='$suggestion_id'";
    $result = select($query);
    return count($result) > 0;
}

// Insert or update based on existence
if (isset($_POST['submit'])) {
    extract($_POST);
    
    if (checkIfSuggestionExists($uid, $suggestions)) {
        // Update existing record
        $updateQuery = "UPDATE user_suggestion SET implemented='$imple', implementation_date=CURDATE() WHERE user_id='$uid' AND suggestions_id='$suggestions'";
        update($updateQuery);
        alert("Updated successfully");
    } else {
        // Insert new record
        $insertQuery = "INSERT INTO user_suggestion (user_id, suggestions_id, implemented, implementation_date) VALUES ('$uid', '$suggestions', '$imple', CURDATE())";
        insert($insertQuery);
        alert("Inserted successfully");
    }
    redirect("admin_view_user.php");
}

// Load existing data for updating
if (isset($_GET['uids'])) {
    $suggestion_id = $_GET['uids'];
    $query = "SELECT * FROM suggestions INNER JOIN user_suggestion USING(suggestions_id) WHERE suggestions_id='$suggestion_id' AND user_id='$uid'";
    $res = select($query);
}

// Delete data
if (isset($_GET['did'])) {
    $delete_id = $_GET['did'];
    $deleteQuery = "DELETE FROM user_suggestion WHERE suggestions_id='$delete_id' AND user_id='$uid'";
    delete($deleteQuery);
    alert("Deleted successfully");
    redirect("admin_view_user.php");
}

// Fetch assigned suggestions for the user
$assignedSuggestionsQuery = "SELECT * FROM suggestions INNER JOIN user_suggestion USING(suggestions_id) WHERE user_id='$uid'";
$assignedSuggestions = select($assignedSuggestionsQuery);

// Fetch all suggestions for dropdown
$allSuggestionsQuery = "SELECT * FROM suggestions";
$allSuggestions = select($allSuggestionsQuery);

?>

<center>
    <h1>ASSIGN FORM</h1>
</center>

<!-- Assign/Update Form -->
<form action="" method="post">
    <table align="center">
        <tr>
            <th>Implemented</th>
            <td>
                <input type="text" class="form-control" name="imple" value="<?= isset($res) ? $res[0]['implemented'] : '' ?>">
            </td>
        </tr>
        <tr>
            <th>Suggestions</th>
            <td>
                <select name="suggestions" id="suggestions">
                    <option value="">Select Suggestion</option>
                    <?php foreach ($allSuggestions as $row): ?>
                        <option value="<?= $row['suggestions_id'] ?>" <?= isset($res) && $res[0]['suggestions_id'] == $row['suggestions_id'] ? 'selected' : '' ?>>
                            <?= $row['suggestion_text'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="submit" name="submit" class="btn" value="Save">
            </td>
        </tr>
    </table>
</form>

<!-- Assigned Suggestions Table -->
<table align="center" border="1">
    <tr>
        <th>Suggestions</th>
        <th>Impact Score</th>
        <th>Ease of Implementation</th>
        <th>Implemented</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($assignedSuggestions as $item): ?>
        <tr>
            <td><?= $item['suggestion_text'] ?></td>
            <td><?= $item['impact_score'] ?></td>
            <td><?= $item['ease_of_implementation'] ?></td>
            <td><?= $item['implemented'] ?></td>
            <td><?= $item['implementation_date'] ?></td>
            <td>
                <a class="btn btn-success" href="?uid=<?= $uid ?>&uids=<?= $item['suggestions_id'] ?>">Update</a>
                <a class="btn btn-danger" href="?uid=<?= $uid ?>&did=<?= $item['suggestions_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
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

    form, table {
        width: 85%;
        margin-top: 20px;
    }

    table {
        border-collapse: collapse;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
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

    .btn {
        text-decoration: none;
        color: #3498db;
        transition: color 0.3s;
        font-weight: bold;
    }

    .btn:hover {
        color: #2980b9;
    }
</style>
<script src="js/script.js"></script>

<?php include 'footer.php' ?>
