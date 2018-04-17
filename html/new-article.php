<?php

require 'includes/database.php';

$errors = [];
$title = '';
$content = '';
$published_at = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    if ($title == '') {
        $errors[] = 'Title is required';
    }
    if ($content == '') {
        $errors[] = 'Content is required';
    }

    if (empty($errors)) {

        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {

            echo mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            if (mysqli_stmt_execute($stmt)) {
                $id = mysqli_insert_id($conn);
                echo "Inserted record with ID: $id";
            } else {
                echo mysqli_stmt_error($stmt);
            }

        }

    }

}

?>

<?php require 'includes/header.php'; ?>

<h2>New Article</h2>

<?php if (! empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">

    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placehlder="Article title" value="<?php echo $title; ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content" placeholder="Article content"><?php echo $content; ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at"
            value="<?php echo $published_at; ?>">
    </div>

    <button>Add</button>

</form>

<?php require 'includes/footer.php'; ?>

