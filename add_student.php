<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $contact_info = $_POST['contact_info'];

    // الاتصال بقاعدة البيانات
    $conn = new mysqli('localhost', 'root', '', 'test_db');

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // إدخال بيانات الطفل
    $sql = "INSERT INTO students (name, age, class, contact_info) VALUES ('$name', $age, '$class', '$contact_info')";

    if ($conn->query($sql) === TRUE) {
        echo "تمت إضافة الطفل بنجاح";
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
    <title>إضافة طفل جديد</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 20px auto;
        }

        form input[type="text"],
        form input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
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
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>إضافة طفل جديد</h2>
    <form method="POST" action="add_student.php">
        الاسم: <input type="text" name="name" required><br>
        العمر: <input type="number" name="age" required><br>
        الصف: <input type="text" name="class" required><br>
        معلومات التواصل: <input type="text" name="contact_info" required><br>
        <input type="submit" value="إضافة">
    </form>
</body>
</html>
