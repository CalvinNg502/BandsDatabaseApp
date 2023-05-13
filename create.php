<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
if (isset($_POST['submit'])) {
    require "connection.php";
    require "common.php";

    try {
        $new_band = array(
            "name" => $_POST['name'],
            "genre"  => $_POST['genre'],
            "date_of_formation"     => $_POST['date_of_formation'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "band",
            implode(", ", array_keys($new_band)),
            ":" . implode(", :", array_keys($new_band))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_band);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    > <?php echo escape($_POST['name']); ?> successfully added.
<?php } ?>

<h2>Add a band</h2>

<form method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre">
    <label for="date_of_formation">Date of Formation</label>
    <input type="text" name="date_of_formation" id="date_of_formation">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>