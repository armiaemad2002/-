<?php
include 'db_connection.php';

// استعلام لجلب أسماء الطلاب والمجموع الكلي لكل طالب
$sql = "SELECT students.name, SUM(grade_details.total) AS total_score
        FROM grade_details
        JOIN students ON grade_details.student_id = students.student_id
        GROUP BY students.student_id, students.name
        ORDER BY total_score DESC"; // ترتيب تنازلي حسب المجموع الكلي

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;'>ترتيب الأطفال حسب المجموع الكلي</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='width: 50%; margin: auto;'>
            <tr style='background-color: #f2f2f2;'>
                <th>الترتيب</th>
                <th>اسم الطفل</th>
                <th>المجموع الكلي</th>
            </tr>";

    $rank = 1; // لترتيب الأطفال
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $rank . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . $row['total_score'] . " / 1000</td>
              </tr>";
        $rank++; // زيادة الترتيب
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>لا توجد بيانات للعرض</p>";
}

$conn->close();
?>
