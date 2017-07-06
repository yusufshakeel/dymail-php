# dymail-php
This is a mail project in php.

# Getting started
- [Download the latest release.](https://github.com/yusufshakeel/dymail-php/releases)
- Clone the repo: `git clone https://github.com/yusufshakeel/dymail-php.git`

# Requirement
* PHP version 5.4 or higher.
* Sendmail (other mail server) installed on your server.

# What's inside
```
dymail-php/
├── src/
│   └── DYMail/
│       ├── autoload.php
│       └── DYMail.php
└── index.php

```

# How to use?

Include the DYMail class and instantiate it. Pass the required parameters and it will send the email to the recipients.

```
require_once 'path/to/DYMail/DYMail.php';

try {

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
<p>This is a sample message.</p>
MSG;

    $emailType = 'HTML';

    $obj = new DYMail\DYMail($sender, $receivers, $cc, $bcc, $subject, $message, $emailType);

} catch (\Exception $e) {
    die("Error: " . $e->getMessage());
}
```

# MIT License

Copyright (c) 2017 Yusuf Shakeel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
