<!DOCTYPE html>
<html>
<head>
    <title>Stored XSS - Manipulating and Closing Tags</title>
    <style>
        /* Basic CSS for XSS Challenge Pages */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    color: #333;
}

h2 {
    color: #444;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-family: Arial, sans-serif;
    font-size: 14px;
}

button {
    background-color: #5cb85c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #4cae4c;
}

/* Add any additional styles you need here */

    </style>
</head>
<body>
    <h2>Stored XSS Challenge 4: اقفلي باب المطبخ يا عبير</h2>
    <form method="post">
        <textarea name="comment" placeholder="Enter your comment"></textarea>
        <button type="submit">Post Comment</button>
    </form>
    <form method="post">
    <button type="submit" name="clear_comments">Clear Comments</button>
</form>

    <?php
session_start();
if (isset($_POST['clear_comments'])) {
    $_SESSION['comments4'] = [];  // Clear the comments
}
if (!isset($_SESSION['comments4'])) {
    $_SESSION['comments4'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    // Validate that every opened div is properly closed
    if (substr_count($comment, "<div>") === substr_count($comment, "</div>")) {
        $_SESSION['comments4'][] = $comment;
    } else {
        // Optionally, store an error message or handle invalid input as needed
        echo "ما قولنا باب المطبخ يا عبير";
    }
}

foreach ($_SESSION['comments4'] as $comment) {
    echo "<input class='user-comment' value='" .$comment."'" ."</input>";
}

    ?>
</body>
</html>


<!--</div><script>alert('XSS');</script><div>
-->
