<?php
/**
 * Class ProductsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $products = $this->getProducts();

        return view('admin::products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $product = new Product();

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::products.create', compact('product', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $product = new Product();
	    $data = $request->except('image');
	    $data = array_merge($data, $product->setData($data));

	    $validator = \Validator::make($data, Product::rules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.products.create', ['back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация о товаре не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $product->fill($data);
		    $product->save();

		    $product->setImage($request);
		    $product->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Товар создан!');
		    } else {
			    return redirect(route('admin.products.edit', ['id' => $product->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Товар создан!');
		    }
	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('просмотр продукта с id ' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $product = Product::findOrFail($id);

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::products.edit', compact('product', 'backUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $product = Product::findOrFail($id);
	    $data = $request->except('image');
	    $data = array_merge($data, $product->setData($data));

	    $validator = \Validator::make($data, Product::rules($product->id));

	    if ($validator->fails())
	    {
		    return redirect(route('admin.products.edit', ['id' => $product->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация о товаре не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $product->fill($data);
		    $product->setImage($request);
		    $product->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Информация о товаре сохранена!');
		    } else {
			    return redirect(route('admin.products.edit', ['id' => $product->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Информация о товаре сохранена!');
		    }
	    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    if(\Request::ajax()) {

		    if(Product::destroy($id)){
			
			    $products = $this->getProducts();

			    return \Response::json([
				    'success' => true,
				    'message' => 'Товар успешно удалён.',
				    'itemsCount' => view('parts.count')->with('models', $products)->render(),
				    'itemsPagination' => view('parts.pagination')->with('models', $products)->render(),
				    'itemsTable' => view('admin::products.table')->with('products', $products)->render(),
			    ]);
		    } else {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Произошла ошибка, товар не удалён.'
			    ]);
		    }
	    }
    }

	/**
	 * Get list of products
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getProducts()
	{
		return Product::select(['id', 'vendor_code', 'category_id', 'is_published', 'title', 'price', 'image', 'image_alt', 'published_at'])
			->with('category', 'images')
			->orderBy('created_at', 'DESC')
			->paginate(10);
	}
}
