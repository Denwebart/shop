<?php
/**
 * Class SiteController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Http\Controllers;


use App\Models\Product;

class ProductController extends Controller
{
	/**
	 * Product info
	 * 
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function productOneLevel($categoryOne, Product $product)
	{
		return view('product.productInfo')->with('page', $product);
	}

	public function productTwoLevel($categoryOne, $categoryTwo, Product $product)
	{
		return view('product.productInfo')->with('page', $product);
	}

	public function productThreeLevel($categoryOne, $categoryTwo, $categoryThree, Product $product)
	{
		return view('product.productInfo')->with('page', $product);
	}
}