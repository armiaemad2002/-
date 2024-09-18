<?php
include 'db_connection.php';

// استعلام لجلب أسماء الأطفال
$sql = "SELECT student_id, name FROM students ORDER BY name ASC"; // ترتيب تصاعدي حسب الاسم

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;'>أسماء الأطفال</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 60%; margin: auto;'>
            <tr style='background-color: #f2f2f2;'>
                <th>رقم الطفل</th>
                <th>اسم الطفل</th>
                <th>حذف</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['student_id']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>
                    <form method='POST' action='delete_student.php' style='display:inline;'>
                        <input type='hidden' name='student_id' value='" . htmlspecialchars($row['student_id']) . "'>
                        <input type='submit' value='حذف' onclick='return confirm(\"هل أنت متأكد أنك تريد حذف هذا الطالب؟\");'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>لا توجد بيانات للعرض</p>";
}

$conn->close();
?>
