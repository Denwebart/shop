<?php
/**
 * Class WishlistController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class WishlistController extends Controller
{
	public function index(Request $request)
	{
		$wishlist = new Wishlist();
		$products = $wishlist->getWishlist();

		$page = \Request::get('page', 1);
		$onPage = 10;
		$offSet = ($page * $onPage) - $onPage;

		$itemsForCurrentPage = array_slice($products, $offSet, $onPage, true);

		$products = new LengthAwarePaginator($itemsForCurrentPage, count($products), $onPage, $page);
		$products->setPath($request->url());

		$page = new Page();
		$page->title = 'Список желаний';

		return view('widget.wishlist::index', compact('page', 'products'));
	}
}