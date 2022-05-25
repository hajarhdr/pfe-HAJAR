<?php
 
                session_start();
                if (isset($_POST['name'])) {

                    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['contact-email']) || empty($_POST['msg'])) {
                        $error = "All the field is required";
                        $_SESSION['error'] = $error;
                        header("Location: customize.php");
                    } else if (!filter_var($_POST['contact-email'], FILTER_VALIDATE_EMAIL)) {
                        $error = "Enter your valid email address";
                        $_SESSION['error'] = $error;
                        header("Location: customize.php");
                    } else if (strlen($_POST['msg']) < 10 && strlen($_POST['msg']) > 140) {
                        $error = "Message length should greater than 10 & less than 140 characters";
                        $_SESSION['error'] = $error;
                        header("Location: customize.php");
                    } else {

                    
                        $conn = mysqli_connect("localhost", "root", "", "luxgifts");
                        $name = $_POST['name'];
                        $email = $_POST['contact-email'];
                        $subject = $_POST['subject'];
                        $msg = $_POST['msg'];
                        $is_done = $conn->query("INSERT INTO `contact_us`( `name`, `email`, `subject`, `msg` ) VALUES( '$name','$email','$subject','$msg' )");
                        if ($is_done == TRUE) {
                            $success = "success";
                            $_SESSION['success'] = $success;
                            header("Location: customize.php");
                        }
                    }
                }
?>