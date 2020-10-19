<?php

$connect = mysqli_connect('localhost', 'root', 'root', 'sandbox');

$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';

$email_error = '';
$message_error = '';

if (count($_POST))
{ 
    $errors = 0;

    if ($_POST['email'] == '')
    {
        $email_error = 'Please enter an email address';
        $errors ++;
    }

    if ($_POST['message'] == '')
    {
        $message_error = 'Please enter a message';
        $errors ++;
    }

    if ($errors == 0)
    {

        $query = 'INSERT INTO contact (
                email,
                message
            ) VALUES (
                "'.addslashes($_POST['email']).'",
                "'.addslashes($_POST['message']).'"
            )';
        mysqli_query($connect, $query);

        $message = 'You have received a contact form submission:
            
Email: '.$_POST['email'].'
Message: '.$_POST['email'];

        mail( 'thomasadam83@hotmail.com', 
            'Contact Form Cubmission',
            $message );

        header('Location: thankyou.html');
        die();

    }
}

?>
<!doctype html>
<html>
    <head>
        <title>PHP Contact Form</title>
    </head>
    <body>
    
        <h1>PHP Contact Form</h1>

        <form method="post" action="">
        
            Email Address:
            <br>
            <input type="text" name="email" value="<?php echo $email; ?>">
            <?php echo $email_error; ?>

            <br><br>

            Message:
            <br>
            <textarea name="message"><?php echo $message; ?></textarea>
            <?php echo $message_error; ?>

            <br><br>

            <input type="submit" value="Submit">
        
        </form>
    
    </body>
</html>
