<?php

include 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $lesson_id = $_GET['id'];
} else {
    die("Invalid lesson ID");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lesson_name = $_POST['lesson_name'];
    $lesson_date = $_POST['lesson_date'];
    $topic = $_POST['topic'];

    $stmt = $conn->prepare("UPDATE lessons SET lesson_name=?, lesson_date=?, topic=? WHERE lesson_id=?");
    $stmt->bind_param('sssi', $lesson_name, $lesson_date, $topic, $lesson_id);

    if ($stmt->execute()) {
        echo "<p>تم تحديث الدرس بنجاح</p>";
    } else {
        echo "<p>خطأ: " . $stmt->error . "</p>";
    }

    $stmt->close();
}


$sql = "SELECT lesson_name, lesson_date, topic FROM lessons WHERE lesson_id=$lesson_id";
$result = $conn->query($sql);
$lesson = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث درس</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>تحديث درس</h2>
        <form method="POST" action="">
            <label for="lesson_name">اسم الدرس:</label>
            <input type="text" id="lesson_name" name="lesson_name" value="<?php echo htmlspecialchars($lesson['lesson_name']); ?>" required>

            <label for="lesson_date">تاريخ الدرس:</label>
            <input type="date" id="lesson_date" name="lesson_date" value="<?php echo htmlspecialchars($lesson['lesson_date']); ?>" required>

            <label for="topic">الموضوع:</label>
            <input type="text" id="topic" name="topic" value="<?php echo htmlspecialchars($lesson['topic']); ?>" required>

            <input type="submit" value="تحديث">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
