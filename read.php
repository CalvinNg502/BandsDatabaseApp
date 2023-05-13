<?php

/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submit'])) {
    try {
        require "connection.php";
        require "common.php";

        $sql = "SELECT *
        FROM band
        WHERE genre = :genre";

        $genre = $_POST['genre'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':genre', $genre, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <h2>Results</h2>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Genre</th>
                    <th>Date of Formation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td><?php echo escape($row["name"]); ?></td>
                        <td><?php echo escape($row["genre"]); ?></td>
                        <td><?php echo escape($row["date_of_formation"]); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        > No results found for <?php echo escape($_POST['genrez']); ?>.
<?php }
} ?>

<h2>Find band based on genre</h2>

<form method="post">
    <label for="genre">Genre</label>
    <input type="text" id="genre" name="genre">
    <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>