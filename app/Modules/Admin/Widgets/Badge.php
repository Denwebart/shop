<?php
/**
 * Class Badge
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Modules\Admin\Widgets;


use App\Models\Letter;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\RequestedCall;
use App\Models\Review;

/**
 * Class Badge
 * @package App\Modules\Admin\Widgets
 *
 * @property integer $countNewOrders
 * @property integer $countNewLetters
 * @property integer $countNewCalls
 * @property integer $countNewReviews
 * @property integer $countNewProductReviews
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
class Badge
{
	public $countNewOrders;
	public $countNewLetters;
	public $countNewCalls;
	public $countNewReviews;
	public $countNewProductReviews;

	public function __construct()
	{
		$this->countNewOrders = count($this->getNewOrders());
		$this->countNewLetters = count($this->getNewLetters());
		$this->countNewCalls = count($this->getNewCalls());
		$this->countNewReviews = count($this->getNewReviews());
		$this->countNewProductReviews = count($this->getNewProductReviews());
	}

	protected function getNewOrders()
	{
		return Order::whereStatus(Order::STATUS_NONE)->get();
	}

	protected function getNewLetters()
	{
		return Letter::whereNull('updated_at')->get();
	}

	protected function getNewCalls()
	{
		return RequestedCall::whereStatus(RequestedCall::STATUS_NONE)->get();
	}

	protected function getNewReviews()
	{
		return Review::whereNull('updated_at')->get();
	}

	protected function getNewProductReviews()
	{
		return ProductReview::whereNull('updated_at')->get();
	}
}