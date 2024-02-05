<!DOCTYPE html>
<html>
<head>
    <title>Stored XSS </title>
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
    <h2>Stored XSS Challenge 6: h4ppy h4cking</h2>
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
    $_SESSION['comments6'] = [];  // Clear the comments
}

function sanitizeComment($input) {
    // Allow only <img> tags, strip all others
    return strip_tags($input, '<img>');
}

if (!isset($_SESSION['comments6'])) {
    $_SESSION['comments6'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $sanitizedComment = sanitizeComment($_POST['comment']);
    $_SESSION['comments6'][] = $sanitizedComment;
}

foreach ($_SESSION['comments6'] as $comment) {
    echo "<div>" . $comment . "</div>";
}
?>

</body>
</html>

