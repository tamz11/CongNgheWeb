<?php
if(isset($_POST['upload'])){
    if(isset($_FILES['quizfile']) && $_FILES['quizfile']['error'] == 0){
        $file = $_FILES['quizfile']['tmp_name'];
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Kết nối MySQL
        $conn = new mysqli("localhost", "root", "", "congnghewebb");
        if($conn->connect_error){
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        $question = $a = $b = $c = $d = $answer = "";

        foreach($lines as $line){
            $line = trim($line);

            if(strpos($line, "A.") === 0){
                $a = trim(substr($line, 2));
            } elseif(strpos($line, "B.") === 0){
                $b = trim(substr($line, 2));
            } elseif(strpos($line, "C.") === 0){
                $c = trim(substr($line, 2));
            } elseif(strpos($line, "D.") === 0){
                $d = trim(substr($line, 2));
            } elseif(strpos($line, "ANSWER:") === 0){
                $answer = trim(str_replace("ANSWER:", "", $line));

                // Lưu vào MySQL
                $stmt = $conn->prepare("INSERT INTO questions (question, option_a, option_b, option_c, option_d, answer) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $question, $a, $b, $c, $d, $answer);
                $stmt->execute();

                // Reset biến cho câu hỏi tiếp theo
                $question = $a = $b = $c = $d = $answer = "";
            } else {
                // Nếu dòng không phải đáp án hoặc ANSWER, coi là câu hỏi
                $question = $line;
            }
        }

        echo "<p>Upload và lưu vào MySQL thành công!</p>";
        $conn->close();
    } else {
        echo "<p>Lỗi khi upload file!</p>";
    }
}
?>
