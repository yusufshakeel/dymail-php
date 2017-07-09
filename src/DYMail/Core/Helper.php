<?php
/**
 * file: Config.php
 * author: yusuf shakeel
 * github: https://github.com/yusufshakeel/dymail-php
 * date: 12-mar-2014 wed
 * description: this is the helper file.
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

namespace DYMail\Core;

/**
 * The Helper class.
 */
class Helper
{

    /**
     * This function will merge default options with user defined options.
     *
     * @param array $option
     * @param array $defaultOption
     * @return array
     */
    public static function initOption($option, $defaultOption)
    {
        return array_merge($defaultOption, $option);
    }

    /**
     * this will convert the array of emails and names into a string
     * @param array $emailArr
     * @return string
     */
    public static function prepareEmailList($emailArr)
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

}