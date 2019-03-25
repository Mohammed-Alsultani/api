<?php
namespace App\Exceptions;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;


trait ExceptionTrait 
{
    public function apiException($request,$e)
    {
        if($this->isModel($e))
            {
                return response()->json(
                    ['errors' => 'Product Model Not Found'],
                    Response::HTTP_NOT_FOUND);
            }

            if($this->isHttp($e))
            {
                return response()->json(
                    ['errors' => 'Incorrect Route'],
                    Response::HTTP_NOT_FOUND);
            }
            return parent::render($request, $e);

    }


    public function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    public function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }
}