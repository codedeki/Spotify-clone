<?php 

class User {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }
}

?>