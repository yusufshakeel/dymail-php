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
     * DYMail constructor.
     * @param array $sender
     * @param array $receivers
     * @param array $cc
     * @param array $bcc
     * @param string $subject
     * @param string $message
     * @param string $emailType
     */
    function __construct($sender = array(), $receivers = array(), $cc = array(), $bcc = array(), $subject = '', $message = '', $emailType = 'SIMPLE')
    {
        if (count($sender) === 0) {
            die('Sender email missing.');
        } else {
            $this->sender = $this->_prepareEmailList($sender);
        }

        if (count($receivers) === 0) {
            die('Receiver email missing');
        } else {
            $this->receivers = $this->_prepareEmailList($receivers);
        }

        if (count($cc) > 0) {
            $this->cc = $this->_prepareEmailList($cc);
        }

        if (count($bcc) > 0) {
            $this->bcc = $this->_prepareEmailList($bcc);
        }

        if (strlen($subject) === 0) {
            die('Subject missing');
        } else {
            $this->subject = $subject;
        }

        if (strlen($message) === 0) {
            die('Message missing');
        } else {
            $this->message = $message;
        }

        switch ($emailType) {
            case 'SIMPLE':
                $this->_sendSimpleEmail();
                break;

            case 'HTML':
                $this->_sendHTMLEmail();
                break;
        }
    }

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

        mail($this->receivers, $this->subject, $this->message, $headers);
    }

    private function _sendSimpleEmail()
    {
        $headers = 'From: ' . $this->sender . "\r\n";

        if (isset($this->cc)) {
            $headers .= 'Cc: ' . $this->cc . "\r\n";
        }

        if (isset($this->bcc)) {
            $headers .= 'Bcc: ' . $this->bcc . "\r\n";
        }

        mail($this->receivers, $this->subject, $this->message, $headers);
    }

}
?>