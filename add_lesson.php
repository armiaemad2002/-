<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lesson_name = $_POST['lesson_name'];
    $lesson_date = $_POST['lesson_date'];
    $topic = $_POST['topic'];

    $conn = new mysqli('localhost', 'root', '', 'test_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO lessons (lesson_name, lesson_date, topic) VALUES ('$lesson_name', '$lesson_date', '$topic')";

    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة الدرس بنجاح";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة درس جديد</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: auto;
        }

        form input[type="text"],
        form input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #5cb85c;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 8px 0;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <h2>إضافة درس جديد</h2>
    <form method="POST" action="add_lesson.php">
        اسم الدرس: <input type="text" name="lesson_name" required><br>
        تاريخ الدرس: <input type="date" name="lesson_date" required><br>
        الموضوع: <input type="text" name="topic" required><br>
        <input type="submit" value="إضافة">
    </form>
</body>
</html>
