<?php
namespace App\Controller\Exception;
use Exception;
class JSON extends Exception {
  public function __construct($message, $code = 0, Exception $previous = null) {
    parent::__construct(json_encode($message), $code, $previous);
  }
}
