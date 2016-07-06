<?php
/**
 * Class WishlistController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Wishlist;

use App\Http\Controllers\Controller;
use App\Widgets\Viewed\Viewed;
use Illuminate\Http\Request;
use App\Models\Page;

class WishlistController extends Controller
{
	public function index(Request $request)
	{
		$wishlist = new Wishlist();
		$products = $wishlist->getWishlist(null, $request);

		$page = new Page();
		$page->title = 'Список желаний';
		$page->meta_title = 'Список желаний мета-тайтл';

		$viewed = new Viewed();

		return view('widget.wishlist::index', compact('page', 'products', 'viewed'));
	}
}