<?php
/**
 * file: email.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dymail-php
 * date: 12-mar-2014 wed
 * description: This file contains a sample example.
 *
 * MIT License
 *
 * Copyright (c) 2017 Yusuf Shakeel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

require_once 'src/DYMail/autoload.php';

$sender = array(
    'sender@example.com' => 'Sender'
);

$receivers = array(
    'receiver1@example.com' => 'Receiver 1',
    'receiver2@example.com' => 'Receiver 2',
    'receiver3@example.com' => 'Receiver 3'
);

$cc = array(
    'cc1@example.com' => 'Cc 1',
    'cc2@example.com' => 'Cc 2',
    'cc3@example.com' => 'Cc 3'
);

$bcc = array(
    'bcc1@example.com' => 'Bcc 1',
    'bcc2@example.com' => 'Bcc 2',
    'bcc3@example.com' => 'Bcc 3'
);

$subject = 'This is a sample subject.';

$message = <<<MSG
<!DOCTYPE html>
<html>
<head>
<title>DYMail</title>
</head>
<body>
<h1>Hello World!</h1>
<p>This is a sample email using dymail-php project.</p>
<p>Have a nice day :-)</p>
</body>
</html>
MSG;

$options = array(
    "emailType" => "HTML"
);

try {

    $obj = new DYMail\DYMail($sender, $receivers, $cc, $bcc, $subject, $message, $options);

    $obj->send();

} catch (\Exception $e) {

    die("Error: " . $e->getMessage());

}
?>