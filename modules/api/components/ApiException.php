<?php
/**
 * Created by Navatech.
 * @project jav2u-org-frontend
 * @author  Phuong
 * @email   phuong17889[at]gmail.com
 * @date    6/15/2016
 * @time    3:11 PM
 */
namespace app\modules\api\components;

use yii\base\Exception;

class ApiException extends Exception {

	/**
	 * RestfulException constructor.
	 *
	 * @param int         $status
	 * @param null|string $message
	 * @param \Exception  $previous
	 */
	public function __construct($status, $message, $previous = null) {
		header('HTTP/1.1 ' . $status);
		header('Content-type: application/text');
		echo $message;
		exit();
	}
}