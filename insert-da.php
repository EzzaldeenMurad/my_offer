<?php
// إعدادات قاعدة البيانات
$host = 'localhost';
$dbname = 'co_project2';
$username = 'root';
$password = '';

// إنشاء اتصال
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
  die("فشل الاتصال: " . $conn->connect_error);
}

if(isset($_POST['submit'])){

  $fristname = $_POST['Fristname']; // احتمال وجود خطأ مطبعي (يجب أن تكون firstname)
  $lastname = $_POST['lastname'];
  $email = $_POST['Email'];
  $password = $_POST['Password'];
}

// التحقق من إرسال البيانات بطريقة POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // استقبال البيانات من النموذج
  $firstName = $conn->real_escape_string($_POST['first-name']);
  $lastName = $conn->real_escape_string($_POST['last-name']);
  $email = $conn->real_escape_string($_POST['email']);
  $password = $conn->real_escape_string($_POST['psw']);

  // تشفير كلمة المرور
  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  // استعلام SQL
  // إدراج البيانات في قاعدة البيانات
  $sql = "INSERT INTO users (first_name, last_name, email, password)
          VALUES ('$firstName', '$lastName', '$email', '$passwordHash')";

  // تنفيذ الاستعلام (وظيفة مصححة)
  if ($conn->query($sql) === TRUE) {
    echo "تم إنشاء سجل جديد بنجاح";
    header('location:home.php'); // إعادة توجيه مع فاصلة منقوطة
  } else {
    echo "خطأ: " . $sql . "<br>" . $conn->error;
  }
} else {
  include('first.php'); // تضمين النموذج أو محتوى آخر
}

// إغلاق الاتصال
$conn->close();
?>
