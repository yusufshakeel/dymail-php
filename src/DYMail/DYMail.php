<?php
/**
 * file: DYMail.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dymail-php
 * date: 12-mar-2014 wed
 * description: This file contains the DYMail class.
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

namespace DYMail;

use DYMail\Core\Config as Config;
use DYMail\Core\Helper as Helper;

class DYMail
{

    /**
     * sender email address and name
     * @var string
     */
    private $sender = '';

    /**
     * receivers email address and name
     * @var string
     */
    private $receivers = '';

    /**
     * CC email address and name
     * @var null|void
     */
    private $cc = null;

    /**
     * Bcc email address and name
     * @var null|void
     */
    private $bcc = null;

    /**
     * subject of the email
     * @var
     */
    private $subject;

    /**
     * message or body of the email
     * @var
     */
    private $message;

    /**
     * options
     * @var array
     */
    private $options = array();

    /**
     * DYMail constructor.
     * @param array $sender
     * @param array $receivers
     * @param array $cc
     * @param array $bcc
     * @param string $subject
     * @param string $message
     * @param array $options
     */
    function __construct($sender = array(), $receivers = array(), $cc = array(), $bcc = array(), $subject = '', $message = '', $options = array())
    {
        $this->setSender($sender);

        $this->setReceivers($receivers);

        $this->setCc($cc);

        $this->setBcc($bcc);

        $this->setSubject($subject);

        $this->options = $options;
    }

    /**
     * this will set the sender
     * @param array $sender
     */
    public function setSender($sender = array())
    {
        if (count($sender) === 0) {
            throw new \Exception('Sender email address missing.');
        } else {
            $this->sender = $this->_prepareEmailList($sender);
        }
    }

    /**
     * this will set the receivers
     * @param array $receivers
     */
    public function setReceivers($receivers = array())
    {
        if (count($receivers) === 0) {
            throw new \Exception('Receiver(s) email address missing.');
        } else {
            $this->receivers = $this->_prepareEmailList($receivers);
        }
    }

    /**
     * this will set the cc
     * @param array $cc
     */
    public function setCc($cc = array())
    {
        if (count($cc) > 0) {
            $this->cc = $this->_prepareEmailList($cc);
        }
    }

    /**
     * this will set the bcc
     * @param array $bcc
     */
    public function setBcc($bcc = array())
    {
        if (count($bcc) > 0) {
            $this->bcc = $this->_prepareEmailList($bcc);
        }
    }

    /**
     * this will set the subject of the email
     * @param string $subject
     */
    public function setSubject($subject = '')
    {
        if (strlen($subject) === 0) {
            throw new \Exception('Subject of the email missing.');
        } else {
            $this->subject = $subject;
        }
    }

    /**
     * this will set the message body of the email
     * @param string $message
     */
    public function setMessage($message = '')
    {
        if (strlen($message) === 0) {
            throw new \Exception('Message body of the email missing.');
        } else {
            $this->message = $message;
        }
    }

    /**
     * this will send email
     */
    public function send()
    {
        $this->init();

        switch ($this->options['emailType']) {
            case 'SIMPLE':
                $this->_sendSimpleEmail();
                break;
            case 'HTML':
                $this->_sendHTMLEmail();
                break;
            default:
                throw new \Exception('Invalid emailType');
        }
    }

    /**
     * this will initialize for sending email
     */
    private function init()
    {
        // init options
        $this->options = Helper::initOption($this->options, Config::$defaultOption);
    }

    /**
     * this will convert the array of emails and names into a string
     * @param array $emailArr
     * @return string
     */
    private function _prepareEmailList($emailArr)
    {
        $emailStr = '';
        $keys = array_keys($emailArr);
        $lastkey = end($keys);
        foreach ($emailArr as $email => $name) {
            $emailStr .= $name . ' <' . $email . '>';
            if ($lastkey !== $email) {
                $emailStr .= ', ';
            }
        }
        return $emailStr;
    }

    /**
     * this will send html email
     */
    private function _sendHTMLEmail()
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $this->sender . "\r\n";

        if (isset($this->cc)) {
            $headers .= 'Cc: ' . $this->cc . "\r\n";
        }

        if (isset($this->bcc)) {
            $headers .= 'Bcc: ' . $this->bcc . "\r\n";
        }

        echo "<textarea>" . $headers . "</textarea>";
        echo "<textarea>" . $this->sender . "</textarea>";
        echo "<textarea>" . $this->cc . "</textarea>";
        echo "<textarea>" . $this->bcc . "</textarea>";
        echo "<textarea>" . $this->subject . "</textarea>";
        echo "<textarea>" . $this->message . "</textarea>";

//        mail($this->receivers, $this->subject, $this->message, $headers);
    }

    /**
     * this will send simple email
     */
    private function _sendSimpleEmail()
    {
        $headers = 'From: ' . $this->sender . "\r\n";

        if (isset($this->cc)) {
            $headers .= 'Cc: ' . $this->cc . "\r\n";
        }

        if (isset($this->bcc)) {
            $headers .= 'Bcc: ' . $this->bcc . "\r\n";
        }

        echo "<textarea>" . $headers . "</textarea>";
        echo "<textarea>" . $this->sender . "</textarea>";
        echo "<textarea>" . $this->cc . "</textarea>";
        echo "<textarea>" . $this->bcc . "</textarea>";
        echo "<textarea>" . $this->subject . "</textarea>";
        echo "<textarea>" . $this->message . "</textarea>";

//        mail($this->receivers, $this->subject, $this->message, $headers);
    }

}

?>