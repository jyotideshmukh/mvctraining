<?php

namespace App\Controllers;

use App\Application;
use App\Controller;
use App\DBConnection;

class SiteController extends Controller
{

    /**
     * @return array|false|string|string[]
     */
    public function contact(){
        return $this->render('contacts');
    }

    /**
     * @return string
     */
    public function submitContact(){

        $dbObj= new DBConnection('localhost', 'username','password','dbname');
        $conn = $dbObj->getConnection();
        $firstname = $_POST['username'];
        $lastname = $_POST['username'];
        $email = $_POST['email'];
        $gender ='F';
        $comment = addslashes(strip_tags($_POST['comment']));
        $sql = "INSERT INTO contacts (firstname, lastname, email, gender,comment)
        VALUES ('".$firstname."', '".$lastname."', '".$email."', '" .$gender."', '".$comment."')";

        if ($conn->query($sql) === TRUE) {
            return  "New record created successfully";
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}