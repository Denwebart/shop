<?php

namespace App\Exceptions;

use App\Helpers\CurrencyController;
use App\Helpers\Errors;
use App\Helpers\Settings;
use App\Models\Page;
use App\Models\Setting;
use App\Modules\Admin\Widgets\Badge;
use App\Widgets\Articles\Articles;
use App\Widgets\Cart\Cart;
use App\Widgets\Menu\Menu;
use App\Widgets\Wishlist\Wishlist;
use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	
	/**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
	    if ($e instanceof TokenMismatchException)
	    {
		    if(!$request->ajax()) {
			    return back();
		    } else {
			    return \Response::json([
				    'success' => 'false',
				    'message' => 'Сессия истекла. Обновите страницу и попробуйте снова.'
			    ]);
		    }
	    }
	
	    if ($e instanceof ModelNotFoundException)
	    {
		    if(!$request->ajax()) {
			    return Errors::error404($request);
		    }
	    }

        return parent::render($request, $e);
    }
}
