<?php /** @noinspection AutoloadingIssuesInspection */
/** @noinspection PhpUnused */

/**
 * Pagination Component, responsible for managing the DATA required for pagination.
 * @property string $smtpServer
 * @property string $port
 * @property string $timeout
 * @property string $username
 * @property string $password
 * @property string $localhost
 * @property string $newLine
 * @package  cheeseCake
 */

class EmailComponent extends Object
{

// Configuration/Default variables
    /* * * * * * * * * * * * * * SEND EMAIL FUNCTIONS * * * * * * * * * * * * * */

    //SMTP + SERVER DETAILS
    /* * * * CONFIGURATION START * * * */
    /* * * * CONFIGURATION END * * * * */

    public function authSendEmail($from, $namefrom, $to, $nameto, $subject, $message)
    {
        // ini_set("display_errors", 1);
        // ini_set ('error_reporting', E_ALL);
        // error_reporting(1);
        // http://www.codewalkers.com/c/a/Email-Code/Smtp-Auth-Email-Script/

        $this->smtpServer = "localhost";
        $this->port = "25";
        $this->timeout = "30";
        $this->username = "";
        $this->password = "";
        $this->localhost = "localhost";
        $this->newLine = "\r\n";

        //$to = $_POST["data"]["User"]["username"];

        //Connect to the host on the specified port
        $smtpConnect = fsockopen($this->smtpServer, $this->port, $errno, $errstr, $this->timeout);
        $smtpResponse = fgets($smtpConnect, 515);

        if (empty($smtpConnect)) {
            $output = "Failed to connect: $smtpResponse";
            //return $output;
            echo $output;
        } else {
            $logArray['connection'] = "Connected: $smtpResponse";
            //echo "OK";
            //print "<pre>";   print_r($logArray); print "</pre>"; die();
        }

        //Request Auth Login
        fwrite($smtpConnect, "AUTH LOGIN" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authrequest'] = $smtpResponse;

        //Send username
        fwrite($smtpConnect, base64_encode($this->username) . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authusername'] = $smtpResponse;

        //Send password
        fwrite($smtpConnect, base64_encode($this->password) . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['authpassword'] = $smtpResponse;

        //Say Hello to SMTP
        fwrite($smtpConnect, "HELO $this->localhost" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['heloresponse'] = $smtpResponse;

        //Email From
        fwrite($smtpConnect, "MAIL FROM: $from" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['mailfromresponse'] = $smtpResponse;

        //Email To
        fwrite($smtpConnect, "RCPT TO: $to" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['mailtoresponse'] = $smtpResponse;

        //The Email
        fwrite($smtpConnect, "DATA" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['data1response'] = $smtpResponse;

        //Construct Headers
        $headers = "MIME-Version: 1.0" . $this->newLine;
        $headers .= "Content-type: text/html; charset=iso-8859-1" . $this->newLine;
        $headers .= "To: $nameto <$to>" . $this->newLine;
        $headers .= "From: $namefrom <$from>" . $this->newLine;

//		fputs($smtpConnect, "To: ".$to."\n From: ".$from."\n Subject: ".$subject."\n ".$headers."\n\n ".$message."\n\n");
        fwrite($smtpConnect, "To: $to\nFrom: $from\nSubject: $subject\n$headers\n\n$message\n.\n");
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['data2response'] = $smtpResponse;

        /*
    [connection] => Connected: xxx ESMTP Exim 4.69 #1 Tue, 08 Jun 2010 13:39:26 +0200
    [authrequest] => 220-We do not authorize the use of this system to transport unsolicited,
    [authusername] => 220 and/or bulk e-mail.
    [authpassword] => 503 AUTH command used when not advertised
    [heloresponse] => 500 unrecognized command
    [mailfromresponse] => 500 unrecognized command
    [mailtoresponse] => 250 nemesis.design-services.us Hello nobody at localhost [127.0.0.1]
    [data1response] => 250 OK
    [data2response] => 250 Accepted
    [quitresponse] => 354 Enter message, ending with "." on a line by itself
        */

        // Say Bye to SMTP
        fwrite($smtpConnect, "QUIT" . $this->newLine);
        $smtpResponse = fgets($smtpConnect, 515);
        $logArray['quitresponse'] = $smtpResponse;

        //mail($to, $subject, $message, "From: $from \n" ."MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1");
        //print "<pre>";   print_r($logArray); print "</pre>"; die("mmmmm");

    }

    public function SendEmail($from, $namefrom, $to, $nameto, $subject, $message)
    {
        //echo "SendEmail....";
        // mail($to , $subject, $content, "From: $from \n" ."MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1");
        $isentemail = mail($to, $subject, $message, "From: $from \n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1");

        if ($isentemail) {
            //echo 'Ja, email sent';
            return true;
        }

//echo 'Nein, email not sent';
        return false;
    }

}

