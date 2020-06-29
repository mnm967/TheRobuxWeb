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
        public function login($email, $password){
            $isGoogleCheck = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND isGoogleConnected=1");
            if($isGoogleCheck && mysqli_num_rows($isGoogleCheck) > 0){
                array_push($this->errorArray, Constants::$googleLinkedAccount);
                return false;
            }

            /*$isSteamCheck = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND isSteamConnected=1");
            if(mysqli_num_rows($isSteamCheck) == 0){
                array_push($this->errorArray, Constants::$steamLinkedAccount);
                return false;
            }*/

            $password = md5($password);

            $result = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND password='$password'");
            if($result && mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                $this->currentUserId = $row['id'];
                return true;
            }else{
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function adminLogin($email, $password){
            $password = md5($password);

            $result = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND password='$password' AND id='3'");
            if($result && mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_array($result);
                $this->currentUserId = $row['id'];
                return true;
            }else{
                array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function changeUsername($userId, $username){
            $this->validateUsername($username);

            if(empty($this->errorArray)){
                $query = mysqli_query($this->sqlConnection, "UPDATE users SET username='$username' WHERE id='$userId'");
                return true;
            }else{
                return false;
            }
        }
        public function register($rID, $username, $email, $emailConfirm, $password, $passwordConfirm){
            $this->validateUsername($username);
            $this->validateEmails($email, $emailConfirm);
            $this->validatePasswords($password, $passwordConfirm);

            if(empty($this->errorArray)){
                if($rID == -1){
                    if($this->insertUser($username, $email, $password)){
                        $query = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND password='$password'");
                        $row = mysqli_fetch_array($query); 
                        $this->currentUserId = $row['id'];
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if($this->insertUserReffered($rID, $username, $email, $password)){
                        $query = mysqli_query($this->sqlConnection, "SELECT * FROM users WHERE email='$email' AND password='$password'");
                        $row = mysqli_fetch_array($query); 
                        $this->currentUserId = $row['id'];
                        return true;
                    }else{
                        return false;
                    }
                }
                
            }else{
                return false;
            }
        }
        public function registerSteam($rID, $steamId, $username){
            if(empty($this->errorArray)){
                if($rID == -1){
                    if($this->insertSteamUser($steamId, $username)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if($this->insertSteamUserReffered($rID, $steamId, $username)){
                        return true;
                    }else{
                        return false;
                    }
                }
                
            }else{
                return false;
            }
        }
        public function registerGoogle($rID, $googleId, $email){
            if(empty($this->errorArray)){
                if($rID == -1){
                    if($this->insertGoogleUser($googleId, $email)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    if($this->insertGoogleUserReffered($rID, $googleId, $email)){
                        return true;
                    }else{
                        return false;
                    }
                }
                
            }else{
                return false;
            }
        }
        private function validateUsername($username){
            if(strlen($username) > 25 || strlen($username) < 5){
                array_push($this->errorArray, Constants::$usernameLengthError);
                return;
            }
            $existsCheck = mysqli_query($this->sqlConnection, "SELECT username FROM users WHERE username='$username'");
            if($existsCheck && mysqli_num_rows($existsCheck) != 0){
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        private function insertUser($username, $email, $password){
            $encryptedPassword = md5($password);
            //$date = time();

            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(email, username, password) VALUES ('$email','$username','$encryptedPassword')");
            return $result;
        }

        private function insertSteamUser($id, $username){
            //$date = time();    
            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(username, steam_oauth_id, isSteamConnected) VALUES ('$username','$id','1')");
            
            $newUserId = mysqli_insert_id($this->sqlConnection);
            $this->currentUserId = $newUserId;

            return $result;
        }
        private function insertSteamUserReffered($rID, $id, $username){
            //$date = time();
            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(username, steam_oauth_id, isSteamConnected) VALUES ('$username','$id','1')");

            $newUserId = mysqli_insert_id($this->sqlConnection);
            $this->currentUserId = $newUserId;

            $refferInsert = mysqli_query($this->sqlConnection, "INSERT INTO referrals (referrerUserId, referredUserId) VALUES ('$rID', '$newUserId')");
            return $result;
        }

        private function insertGoogleUser($id, $email){
            //$date = time();    
            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(email, google_oauth_id, isGoogleConnected) VALUES ('$email','$id','1')");
            
            $newUserId = mysqli_insert_id($this->sqlConnection);
            $this->currentUserId = $newUserId;

            return $result;
        }
        private function insertGoogleUserReffered($rID, $id, $email){
            //$date = time();
            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(email, google_oauth_id, isGoogleConnected) VALUES ('$email','$id','1')");

            $newUserId = mysqli_insert_id($this->sqlConnection);
            $this->currentUserId = $newUserId;

            $refferInsert = mysqli_query($this->sqlConnection, "INSERT INTO referrals (referrerUserId, referredUserId) VALUES ('$rID', '$newUserId')");
            return $result;
        }
        private function insertUserReffered($rID, $username, $email, $password){
            $encryptedPassword = md5($password);
            //$date = time();
            
            $result = mysqli_query($this->sqlConnection, "INSERT INTO users(email, username, password) VALUES ('$email','$username','$encryptedPassword')");

            $newUserId = mysqli_insert_id($this->sqlConnection);
            $refferInsert = mysqli_query($this->sqlConnection, "INSERT INTO referrals (referrerUserId, referredUserId) VALUES ('$rID', '$newUserId')");
            return $result;
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
            if($existsCheck && mysqli_num_rows($existsCheck) != 0){
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