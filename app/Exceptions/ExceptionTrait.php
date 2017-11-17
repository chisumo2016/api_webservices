<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

trait  ExceptionTrait
{
    public  function  apiException($request, $e)
    {
        if($this->isModel($e)){
            return $this->ModelResponse($e);
        }

        if ($this->isHttp($e)) {

            return $this->HttResponse($e);
        }

        return parent::render($request, $e);
    }


    public function  isModel($e)
    {
       return $e instanceof  ModelNotFoundException ;
    }

    public  function  isHttp($e)
    {
        return $e instanceof  ModelNotFoundException ;
    }



    public  function  ModelResponse($e)
    {
         return response()->json([
            'errors'=> 'Product Model Not found'
        ], Response::HTTP_NOT_FOUND);
    }


    public  function  HttResponse($e)
    {
         return  response()->json([
             'errors'=> 'Incorrect route'
         ], Response::HTTP_NOT_FOUND);
    }


}