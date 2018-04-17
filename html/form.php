<?php require "includes/header.php"; ?>
<?php var_dump($_POST); ?>

<form method="post">

    <p>Which colors do you like?</p>

    <input type="checkbox" name="red">Red
    <br>
    <input type="checkbox" name="green">Green
    <br>
    <input type="checkbox" name="blue">Blue

</form>

<?php require "includes/footer.php"; ?>