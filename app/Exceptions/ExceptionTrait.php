<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use App\Traits\ResponseTrait;
use Exception;

/**
 * Class ExceptionTrait
 * @package EQDepot\Exceptions
 */
trait ExceptionTrait {
    use ResponseTrait;
    /**
     * Utility function to check whether array is Associative or Numeric Indexed
     * @param $arr
     * @return bool
     */
    protected function isAssoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
    /**
     * @param Exception $exception
     * @return array
     */
    protected function notFoundExceptionMessage(Exception $exception) {
        /**
         * Inspect your HTTP not found exception and return messages
         */
        return [
            '404 URL requested not found.',
        ];
    }


    protected function validationExceptionMessage(Exception $exception){
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        $messageArray = array();
        $storeExceptionMessages = $exception->errors();
        if($this->isAssoc($storeExceptionMessages)) {
            foreach ($storeExceptionMessages as $key => $storeExceptionMessage) {
                $messageConstruction = implode(" ", $storeExceptionMessage);
                $messageArray[] = $messageConstruction;
            }
        } else {
            $messageArray = implode($storeExceptionMessages);
        }

        return $messageArray;
    }

    /**
     * @param Exception $exception
     * @return array
     */
    protected function ModelNotFoundExceptionMessage(Exception $exception) {
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        return [
            'Sorry! No record found for that entry.',
            'Your ID may be not valid',
            "Your Account may not be active"
        ];
    }

    /**
     * @param Exception $exception
     * @return array
     */
    protected function MethodNotAllowedExceptionMessage(Exception $exception) {
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        return [
            'Sorry! The HTTP Method you requested does not exists.',
            'Please check method that are allowed by system.'
        ];
    }

    /**
     * @param Exception $exception
     * @return array
     */
    protected function QueryExceptionMessage(Exception $exception) {
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        $messageArray = $exception->getMessage();
        return (array)$messageArray;
    }

    /**
     * @param Exception $exception
     * @return array
     */
    protected function PDOExceptionMessage(Exception $exception) {
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        $messageArray = $exception->getMessage();
        return (array)$messageArray;
    }

    /**
     * @param Exception $exception
     * @return array
     */
    protected function ExceptionMessage(Exception $exception) {
        /**
         *  Inspect the ValidationException from the object and return a proper message
         */
        $messageArray = $exception->getMessage();
        return (array)$messageArray;
    }

    /**
     * @param $request
     * @param Exception $exception
     * @return string
     */
    public function apiException($request, Exception $exception) {

        $this->data_set = array();
        /**
         *  RequestParams contains all the parameter of the request
         *  You can send back to the request agent for verification
         */
        $requestParams = $request->all();
        /**
         *  Mapped as ExceptionClass => ['function', response_code].
         *  Exception class should name fully qualified namespace
         *  Always put exception class having higher derivatives
         */
        $exceptionClasses = [
            'Symfony\Component\HttpKernel\Exception\NotFoundHttpException' => ['notFoundExceptionMessage', Response::HTTP_NOT_FOUND],
            'Illuminate\Validation\ValidationException' => ['validationExceptionMessage', Response::HTTP_OK],
            'Illuminate\Database\Eloquent\ModelNotFoundException' => ['ModelNotFoundExceptionMessage', Response::HTTP_FORBIDDEN],
            'Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException' => ['MethodNotAllowedExceptionMessage', Response::HTTP_INTERNAL_SERVER_ERROR],
            'Illuminate\Database\QueryException' => ['QueryExceptionMessage', Response::HTTP_FORBIDDEN],
            'PDOException' => ['PDOExceptionMessage', Response::HTTP_FORBIDDEN],
            'Exception' => ['ExceptionMessage', Response::HTTP_OK]];

        /**
         *  Exception Array declared above mapped with following key-value pair.
         */
        $exceptionArrayMapper = array(
            'responseCode' => 1,
            'functionCode' => 0
        );

        /**
         *  Iterator over all known exception classes.
         */
        foreach($exceptionClasses as $key => $value) {
            if($exception instanceof $key) {
                // you can also send back the request parameter is data fields of EQResponse
                $this->code = $value[$exceptionArrayMapper['responseCode']];
                $this->message = $this->{$value[$exceptionArrayMapper['functionCode']]}($exception);
                break;
            }
        }

        /**
         * HTTP Response Serialized from Response Trait
         */
        return $this->responseSerialize(false);

    }
}