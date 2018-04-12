# attendance-system
this is an attendance system using the technology, finger print scanner.

# Requirements
- To use this system you must have a finger print scanner (U.are.U scanner)
- Php 5+
- A server (xampp/wamp for windows, lamp for linux)
- Flexcode Sdk and a purchased licence key

# Installation and usage
After cloning the repository into your server,
1. Run this project in a browser form your server or you can make a virtual host,
    you can also check out "https://github.com/therealSMAT/vhost-manager"
    - P.S: root file is (index.php)
2. Import the db in the database directory into your mysql database.
3. Edit the include/DB.php and input your Correct details.
    
    - $servername = "localhost";
    - $username = "DB_USERNAME";
    - $password = "DB_PASSWORD";
    - $dbname = "DB_NAME";
    
4. Edit the "$path" variable in the "getPath" function in includes/queries.php 
    to the path of the application directory on your server. e.g "localhost/attendance-system/"
5. Add the new finger print device by clicking the "add" on the device page
6. Add a User on the User Page
7. Register the user on the User Page
8. Login with a user Id
9. Check Log to use Login Information

# New Feature 
- You can also send notification with each user Log-in
     > To do this you need to edit the include/queries.php file.. 
         
 1. Edit the "message" function, shown below with your message, and the number to send the notification to. By default it takes the telephone number of the staff that logged in
 2. You also need to add the details of  your sms service provider to the "sendMessage" function in include/queries.php. Here i used "[Ebulksms.com](ebulksms.com)"

``` php
function message($user_name, $time){
        $dbconn = DB::getInstance();
        $sql1 = "SELECT * FROM users WHERE user_name= '".$user_name."' ";

        $final1 = $dbconn->pdo->prepare($sql1);
        $final1->execute();

        $result1 = $final1->fetch();

        $to = $result1['telephone'];
        $message = 'This user "'.$user_name.'"Logged in at '.$time;
        return $messageStatus = $this->sendMessage('Att-System',$to,$message);

    }

    
   public function sendMessage($senderName, $phoneNumbers, $message){
            $apikey = 'API_KEY';
            $url = "YOUR SMS PROVIDER API";
            $username = 'USER_NAME';
            $flash = 0 ;
            $message = stripslashes($message);
            $phoneArray = explode(',', $phoneNumbers);

             ...............
```

# Contributing
All contributions are welcomed and can be made in form of pull requests

# Security Vulnerabilities
If you discover a security vulnerability within RMS, please send an e-mail to Fadayini Timothy at timothy33.tf@gmail.com

# License
attendance-system is open-sourced software licensed under the MIT license.
