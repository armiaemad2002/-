<?php
include 'db_connection.php';

// التحقق مما إذا تم إرسال معرف الطالب عبر POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['student_id'])) {
    $student_id = intval($_POST['student_id']); // تأمين القيمة باستخدام intval

    // حذف السجلات المرتبطة في جدول grades
    $sql = "DELETE FROM grades WHERE student_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $student_id);
        
        if ($stmt->execute()) {
            // حذف الطالب من جدول students
            $sql = "DELETE FROM students WHERE student_id = ?";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param('i', $student_id);
                
                if ($stmt->execute()) {
                    echo "<p style='text-align:center; color: green;'>تم حذف الطالب بنجاح!</p>";
                } else {
                    echo "<p style='text-align:center; color: red;'>حدث خطأ أثناء حذف الطالب: " . $stmt->error . "</p>";
                }
            } else {
                echo "<p style='text-align:center; color: red;'>حدث خطأ أثناء إعداد استعلام حذف الطالب: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='text-align:center; color: red;'>حدث خطأ أثناء حذف السجلات المرتبطة: " . $stmt->error . "</p>";
        }
        
        $stmt->close();
    } else {
        echo "<p style='text-align:center; color: red;'>حدث خطأ أثناء إعداد استعلام حذف السجلات المرتبطة: " . $conn->error . "</p>";
    }

    $conn->close();
} else {
    echo "<p style='text-align:center; color: red;'>معرف الطالب غير محدد!</p>";
}
?>

<p style='text-align:center;'><a href='view_students_with_delete.php'>العودة إلى قائمة الأطفال</a></p>
