<?php 
class Constants{
    public static $usernameLengthError = "Your username must be between 5 and 25 characters";
    public static $usernameTaken = "This Username already exists";

    public static $emailsDontMatchError = "Your Emails don't match";
    public static $emailInvalidError = "Email is invalid";
    public static $emailTaken = "This Email is already in use";
    public static $passwordsDontMatchError = "Your Passwords don't match";
    public static $passwordLengthError = "Your Password must be between 5 and 30 characters";

    public static $loginFailed = "Your Email or Password is incorrect";
    public static $googleLinkedAccount = "This Account is Linked with Google. Please Use Google Login";
    public static $steamLinkedAccount = "This Account is Linked with Steam. Please Use Steam Login";

    public static $emailNotFound = "This Email does not exist in our Database";
    public static $tokenSent = "We've sent a reset token to your email which will expire in 2 hours.";
    public static $emailNotSent = "Unfortunately we were unable to send your Reset Token. Please try again later.";

    public static $passwordIncorrect = "You have entered the incorrect password.";
}
?>