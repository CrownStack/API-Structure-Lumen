<?php

namespace App\Traits;

/**
 * Class ResponseTrait
 * @package App\Traits
 */
trait ResponseTrait {

    /**
     * @var
     */
    var $code;
    /**
     * @var
     */
    var $message;
    /**
     * @var
     */
    var $data_set;
    /**
     * @var
     */
    var $responseString;

    protected function checkAssoc(array $arr) {
        if (array() === $arr) {
            return false;
        }
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    protected function transformer() {
        if (is_object($this->data_set) || is_string($this->data_set) || $this->checkAssoc($this->data_set)) {
            return array($this->data_set);
        } else {
            return $this->data_set;
        }
    }

    /**
     * @param $status
     * @return string
     */

    protected function responseSerialize($status=true) {
        $this->responseString['status'] = $status ? config('messages.SUCCESS') : config('messages.FAILURE');
        $this->responseString['data'] = $this->transformer();
        $this->responseString['error'] = (object) array(
            'error_code' => $this->code,
            'error_message' => is_string($this->message) ? array($this->message) : $this->message,
        );
        return $this->responseString;
    }
}