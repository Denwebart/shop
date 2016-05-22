<?php

namespace App\Exceptions;

use App\Helpers\CurrencyController;
use App\Helpers\Settings;
use App\Http\Requests\Request;
use App\Models\Page;
use App\Models\Setting;
use App\Widgets\Cart\Cart;
use App\Widgets\Menu\Menu;
use App\Widgets\Wishlist\Wishlist;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
		    $page = new Page();
		    $page->title = "Ошибка 404. Страница не найдена.";

		    $course = new CurrencyController();
		    $settings = new Settings();
		    \View::share('siteSettings', $settings->getCategory(Setting::CATEGORY_SITE));
		    \View::share('courseUSD', $course->getCourse());
		    \View::share('menuWidget', new Menu());
		    \View::share('cartWidget', new Cart());
		    \View::share('wishlistWidget', new Wishlist($course, $settings));

		    return \Response::view('errors.404', compact('page'));
	    }

        return parent::render($request, $e);
    }
}
