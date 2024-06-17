<?php
include "../lib/dbconfig.php";
header('Content-Type: application/json');
$data = [];

$data['res'] = 0;
$data['msg'] = 'Invalid action';
$data['data'] = [];

$action = isset($_GET['action']) ? $_GET['action'] : '';
if (!empty($action)) {
    switch ($action) {
        case 'Register':
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (empty($name)) {
                $data['msg'] = "Name can't be empty.";
            } else if (empty($email)) {
                $data['msg'] = "Email can't be empty.";
            } else if (empty($password)) {
                $data['msg'] = "Password can't be empty.";
            } else {
                $sql = "INSERT INTO `tbl_user`(`name`, `email`, `password`) VALUES ('$name','$email','$password')";
                if ($mysqli->query($sql) === TRUE) {
                    $data['res'] = 1;
                    $data['msg'] = "user successfully created.";
                    $data['data'] = [];
                } else {
                    $data['msg'] = "Something went wrong.";
                }
            }


            break;

        case 'Login':
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (empty($email)) {
                $data['msg'] = "Email can't be empty.";
            } else if (empty($password)) {
                $data['msg'] = "Password can't be empty.";
            } else {
                $sql = "select * from `tbl_user` where email='$email' and password='$password'";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    $udata = mysqli_fetch_assoc($result);
                    $data['res'] = 1;
                    $data['msg'] = "user successfully login.";
                    $data['data'] = $udata;
                } else {
                    $data['msg'] = "Invalid Id or password.";
                }
            }

            break;


        case 'UserList':
            $sql = "SELECT * FROM `tbl_user`";
            $result = $mysqli->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    $data['res'] = 1;
                    $data['msg'] = "User's found.";
                    $data['data'] = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as an associative array
                } else {
                    $data['res'] = 0;
                    $data['msg'] = "No users found.";
                }
            } else {
                $data['res'] = 0;
                $data['msg'] = "something went wrong.";
            }

            break;
    }
}

echo json_encode($data);
