<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   
        // dd($exception);
        if (strpos($exception->getMessage(), 'No query results for model [App\Share]') !== false) 
        {
            $splitPath = explode('/', $request->getPathInfo());
            $id = $splitPath[count($splitPath) - 1];
            $member = \App\Member::find($id);

            return redirect()->route('members.show', ['id' => $id])->with([
                'message' => "{$member->full_name} has no shares yet.",
                'styles' => 'alert-danger'
            ]);
        }

        return parent::render($request, $exception);
    }
}
