<?php
if(isset($_FILES['uploaded_file'])) {
    if($_FILES['uploaded_file']['error'] == 0) {
        $dbLink = new mysqli('localhost', 'root', '', 'cs306');
        if(mysqli_connect_errno()) {
            die("MySQL connection failed: ". mysqli_connect_error());
        }

        $name = $dbLink->real_escape_string($_FILES['uploaded_file']['name']);
        $data = $dbLink->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $query = "
            INSERT INTO `job_app_files` (
                `name`, `data`, `created`
            )
            VALUES (
                '{$name}', '{$data}', NOW()
            )";

        $result = $dbLink->query($query);

        header("Location: http://localhost/CS306/PHP/hiring.php");
    }
}
