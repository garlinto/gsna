<?php
/**
 * Custom exception class for GSNA projects
 * Extends PHP's native Exeption class
 *
 * @date	2015-07-17
 */
namespace gsna;

class GSNAException extends \Exception
{
		// custom error codes
		const UNKNOWN_ERROR					= 0;
		const RECORD_NOT_FOUND   	= 1;
		const DB_INSERT_FAILED   	= 2;
		const MQTT_MSG_EMPTY				= 3;
		const MQTT_PUB_FAILED				= 4;
		const MQTT_SUB_FAILED				= 5;
		const UPLOAD_TO_SF_FAILED	= 6;
		
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
    	$str = "\n*** Begin error output ***\n\n";
    	$str .= "GSNAException caught:\n\tFile: '{$this->file}'\n\tLine [{$this->line}]\n\t";
      if (!empty($this->code)) {
      	$str .= "Error Code [{$this->code}]:\n\t";
      }
      $str .= "Message: [{$this->message}]\n\n";
      return $str .= "*** End error output ***\n\n";
    }
}