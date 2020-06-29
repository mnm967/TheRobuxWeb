<?php 
    class Account{
        private $sqlConnection;
        private $errorArray;
        public $currentUserId = -1;
        public function __construct($sqlConnection){
            $this->sqlConnection = $sqlConnection;
            $this->errorArray = array();
        }
        public function getCurrentUserId(){
            return $this->currentUserId;
        }
        public function login($sqlConnection, $email, $password){
            $password = md5($password);

            $result = mysqli_query($sqlConnection, "SELECT * FROM adminusers WHERE email='$email' AND password='$password'") or die(mysqli_error($sqlConnection));
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                $this->currentUserId = $row['id'];
                return true;
            }else{
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        private function validateUsername($username){
            if(strlen($username) > 25 || strlen($username) < 5){
                array_push($this->errorArray, Constants::$usernameLengthError);
                return;
            }
            $existsCheck = mysqli_query($this->sqlConnection, "SELECT username FROM users WHERE username='$username'");
            if(mysqli_num_rows($existsCheck) != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";
            }
            return "<span class='error-message'>$error</span>";
        }
        private function validateEmails($email, $email2){
            if($email != $email2){
                array_push($this->errorArray, Constants::$emailsDontMatchError);
                return;
            }
            if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                array_push($this->errorArray, Constants::$emailInvalidError);
                return;
            }
            $existsCheck = mysqli_query($this->sqlConnection, "SELECT email FROM users WHERE email='$email'");
            if(mysqli_num_rows($existsCheck) != 0){
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
        }
        private function validatePasswords($password, $password2){
            if($password != $password2){
                array_push($this->errorArray, Constants::$passwordsDontMatchError);
                return;
            }
            if(strlen($password) > 30 || strlen($password) < 5){
                array_push($this->errorArray, Constants::$passwordLengthError);
                return;
            }
        }
    }
?>