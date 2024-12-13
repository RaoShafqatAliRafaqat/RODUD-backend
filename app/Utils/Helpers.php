<?php

use Illuminate\Support\Facades\Log;

function generateResponse($arr, $success, $message, $errors, $type = 'paginated', $exception=null)
{
    if ($exception!=null){
      $exception_message =  errorLogMessage($exception);
      $message = $exception_message;

    }
    if ($type == 'paginated') {
        if (!isset($arr['data'])) {
            $arr['data'] = [];
        }
        $arr['success'] = $success;
        $arr['message'] = $message;
        $arr['errors'] = $errors;
        return $arr;
    } else {
        $response = [];
        $response['data'] = $arr;
        $response['success'] = $success;
        $response['message'] = $message;
        $response['errors'] = $errors;
        return $response;
    }
}

function errorLogMessage($exception){
    try {
        $errorMsg = 'Error on line '.$exception->getLine().' in '.$exception->getFile()." ".$exception->getMessage();
        Log::error($errorMsg);
        return $errorMsg;
    }
    catch (\Exception $e){
        return $exception;
    }
}