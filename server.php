<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class server{
  public $mail , $email;
  public function setvalue(){
    $this->email = $_POST['email'];
    $this->mail = new PHPMailer(true); 
  }
  public function settings(){
    try {
      //Server settings
      $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
      $this->mail->isSMTP();                                            
      $this->mail->Host       = 'smtp.gmail.com';                     
      $this->mail->SMTPAuth   = true;                                   
      $this->mail->Username   = 'testing3846@gmail.com';                     
      $this->mail->Password   = 'qekx okbf ityf cwkv';                               
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
      $this->mail->Port       = 587;                                    
  
      //Recipients
      $this->mail->setFrom('testing3846@gmail.com', 'Admin');
      $this->mail->addAddress($this->email, 'User');                    
      $this->mail->addReplyTo('info@example.com', 'Information');

      //Content
      $this->mail->isHTML(true);                                  
      $this->mail->Subject = 'Welcome Email';
      $this->mail->Body    = 'Thank you for your submission.';
      $this->mail->AltBody = 'Thank you for your submission.';
  
      $this->mail->send();
      echo '<div class="success">Message has been sent.</div>';
  } catch (Exception $e) {
      echo '<div class="error">Message could not be sent. Mailer Error:'. $this->mail->ErrorInfo. '</div>';
  }
 }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
  if(isset($_POST['email'])){
    $object = new server();
    $object->setvalue();
    $object->settings();
  }
  else{
    echo '<div class="error">Please provide an Email.</div>';
  }
}
?>
