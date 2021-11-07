        <?php
        include('config/database.php');
  
        if(!empty($_POST["send"])) {
          $name = $_POST["name"];
          $email = $_POST["email"];
          $phone = $_POST["phone"];
          $message = $_POST["message"];
  
          // Recipient email
          $toMail = "mridulmr@outlook.com";
          
          // Build email header
          $header = "From: " . $name . "<". $email .">\r\n";
  
          // Send email
          if(mail($toMail, $message, $header)) {
  
              // Store contactor data in database
              $sql = $connection->query("INSERT INTO contacts_list(name, email, phone, message, sent_date)
              VALUES ('{$name}', '{$email}', '{$phone}', '{$message}', now())");
  
              if(!$sql) {
                die("MySQL query failed.");
              } else {
                $response = array(
                  "status" => "alert-success",
                  "message" => "We have received your query and stored your information. We will contact you shortly."
                );              
              }
          } else {
              $response = array(
                  "status" => "alert-danger",
                  "message" => "Message coudn't be sent, try again"
              );
          }
        }  
      ?>
  
      <!-- Messge -->
      <?php if(!empty($response)) {?>
        <div class="alert text-center <?php echo $response['status']; ?>" role="alert">
          <?php echo $response['message']; ?>
        </div>
      <?php }?>