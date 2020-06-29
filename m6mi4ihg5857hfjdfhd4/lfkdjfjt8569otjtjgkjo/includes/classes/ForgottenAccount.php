<?php 
    class ForgottenAccount{
        private $sqlConnection;
        private $errorArray;
        private $successArray;
        public $currentUserId = -1;
        public function __construct($sqlConnection){
            $this->sqlConnection = $sqlConnection;
            $this->errorArray = array();
            $this->successArray = array();
        }
        public function getCurrentUserId(){
            return $this->currentUserId;
        }
        public function sendToken($email){
            $isGoogleCheck = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND isGoogleConnected=1");
            if(mysqli_num_rows($isGoogleCheck) > 0){
                array_push($this->errorArray, Constants::$googleLinkedAccount);
                return false;
            }
            $this->checkEmail($email);
            if(empty($this->errorArray)){
				
                $userIdQuery = mysqli_query($this->sqlConnection, "SELECT id FROM users WHERE email='$email'");
                $userId = mysqli_fetch_array($userIdQuery)['id'];
				
				$deleteQuery = mysqli_query($this->sqlConnection, "DELETE FROM user_reset_tokens WHERE userId='$userId'");
                
                $dateNow = date("Y-m-d H:i:s");
                $permitted_chars = "0123456789abcdefghijklmnopqrstuvwxyz";
                $token = substr(str_shuffle($permitted_chars), 0, 20);
                $resetToken = $userId . $token;

                $query = mysqli_query($this->sqlConnection, "INSERT INTO user_reset_tokens (userId, token_code, token_email, token_date_added) VALUES('$userId', '$resetToken', '$email', '$dateNow')");
                
                array_push($this->successArray, Constants::$tokenSent);
                $to = $email;
                $subject = "Gainblox Password Reset";
                $message = "Click on the following link to Reset your Password: https://www.flashrobux.com/withdrawgg/reset-password.php?token=$resetToken";
                $headers = "From: noreply@flashrobux.com";
                
                if(mail($to, $subject, $message, $headers)){
                    array_push($this->successArray, Constants::$tokenSent);
                    return true;
                }else{
                    array_push($this->errorArray, Constants::$emailNotSent);
                    return false;
                }
            }else{
                return false;
            }
        }
        public function resetPassword($token, $password, $passwordConfirm){
            $this->validatePasswords($password, $passwordConfirm);
            if(empty($this->errorArray)){
                $password = md5($password);
                $userIdQuery = mysqli_query($this->sqlConnection, "SELECT userId FROM user_reset_tokens WHERE token_code='$token'");
                $userId = mysqli_fetch_array($userIdQuery)['userId'];
                $query = mysqli_query($this->sqlConnection, "UPDATE users SET password='$password' WHERE id='$userId'") or die(mysqli_error($this->sqlConnection));
                $deleteQuery = mysqli_query($this->sqlConnection, "DELETE FROM user_reset_tokens WHERE token_code='$token'");
                return true;
            }else{
                return false;
            }
        }
        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                $error = "";
            }
            return "<span class='error-message'>$error</span>";
        }
        public function getSuccess($success){
            if(!in_array($success, $this->successArray)){
                $success = "";
            }
            return "<span class='success-message'>$success</span>";
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
        private function checkEmail($email){
            if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                array_push($this->errorArray, Constants::$emailInvalidError);
                return;
            }
            $existsCheck = mysqli_query($this->sqlConnection, "SELECT email FROM users WHERE email='$email'");
            if(mysqli_num_rows($existsCheck) == 0){
                array_push($this->errorArray, Constants::$emailNotFound);
                return;
            }
        }
    }
?>