<?php
include 'db_connection.php';

$sql = "SELECT students.name, lessons.lesson_name, grade_details.*
        FROM grade_details
        JOIN students ON grade_details.student_id = students.student_id
        JOIN lessons ON grade_details.lesson_id = lessons.lesson_id
        ORDER BY students.name, grade_details.lesson_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>
            <tr>
                <th>اسم الطفل</th>
                <th>اسم الدرس</th>
                <th>الحضور</th>
                <th>مزمور 14</th>
                <th>مزمور 2</th>
                <th>مزمور 103</th>
                <th>جلب شخص جديد</th>
                <th>استمرار الشخص الجديد</th>
                <th>المسابقة</th>
                <th>الآيات المحفوظة</th>
                <th>المجموع</th>
                <th>التعليقات</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['lesson_name']) . "</td>
                <td>" . $row['attendance'] . "</td>
                <td>" . $row['psalm_14'] . "</td>
                <td>" . $row['psalm_2'] . "</td>
                <td>" . $row['psalm_103'] . "</td>
                <td>" . $row['new_person'] . "</td>
                <td>" . $row['new_person_continued'] . "</td>
                <td>" . $row['competition'] . "</td>
                <td>" . $row['verses_recited'] . "</td>
                <td>" . $row['total'] . " / 1000</td>
                <td>" . htmlspecialchars($row['comments']) . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "لا توجد نتائج";
}

$conn->close();
?>
