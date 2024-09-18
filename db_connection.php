<?php
// إعدادات الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";  // اسم المستخدم الخاص بـ MySQL
$password = "";      // كلمة المرور الخاصة بـ MySQL (اتركه فارغًا إذا لم يكن لديك كلمة مرور)
$dbname = "test_db";  // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
} else {
    echo "تم الاتصال بقاعدة البيانات بنجاح";
}
?>
