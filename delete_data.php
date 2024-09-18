<?php
// بدء جلسة لتخزين حالة المصادقة
session_start();

// إعداد كلمة المرور الصحيحة
$correct_password = "armiaemad"; // استبدل بكلمة المرور التي تريدها

// التحقق مما إذا تم إدخال كلمة المرور من قبل المستخدم
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entered_password = $_POST['password'];

    // التحقق من كلمة المرور
    if ($entered_password === $correct_password) {
        // إذا كانت كلمة المرور صحيحة، تنفيذ حذف البيانات
        include 'db_connection.php';

        // استعلام لمسح جميع البيانات من الجدول
        $sql = "DELETE FROM grade_details";  // تعديل الجدول المراد مسحه

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green; text-align: center;'>تم مسح قاعدة البيانات بنجاح!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>حدث خطأ أثناء مسح البيانات: " . $conn->error . "</p>";
        }

        $conn->close();
    } else {
        echo "<p style='color: red; text-align: center;'>كلمة المرور غير صحيحة!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مسح قاعدة البيانات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding-top: 50px;
        }
        form {
            display: inline-block;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="password"] {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<h2>مسح قاعدة البيانات</h2>
<p>يرجى إدخال كلمة المرور لمسح جميع البيانات.</p>

<form method="POST" action="">
    <input type="password" name="password" placeholder="أدخل كلمة المرور" required><br><br>
    <input type="submit" value="مسح البيانات">
</form>

</body>
</html>
