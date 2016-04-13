<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 * 
 * App\Models\Order
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $coupon_id
 * @property float $total_price
 * @property boolean $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $paid_at
 * @property string $closed_at
 * @property boolean $payment_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCouponId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaidAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereClosedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaymentType($value)
 * @mixin \Eloquent
 */

namespace App\Models;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';

	/**
	 * Статус заказа (значение поля status)
	 */
	const STATUS_NONE       = 0;
	const STATUS_IN_PROCESS = 1;
	const STATUS_CANCELED   = 2;
	const STATUS_CLOSED     = 3;

	public static $statuses = [
		self::STATUS_NONE       => '-',
		self::STATUS_IN_PROCESS => 'В процессе',
		self::STATUS_CANCELED   => 'Отменен',
		self::STATUS_CLOSED     => 'Завершен',
	];

	public static $statusesClass = [
		self::STATUS_NONE       => '',
		self::STATUS_IN_PROCESS => 'info',
		self::STATUS_CANCELED   => 'danger',
		self::STATUS_CLOSED     => 'success',
	];

	/**
	 * Способ оплаты (значение поля payment_type)
	 */
	const PAYMENT_TYPE_1 = 1;
	const PAYMENT_TYPE_2 = 2;
	const PAYMENT_TYPE_3 = 3;

	public static $paymentTypes = [
		self::PAYMENT_TYPE_1 => 'Способ 1',
		self::PAYMENT_TYPE_2 => 'Способ 2',
		self::PAYMENT_TYPE_3 => 'Способ 3',
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'customer_id',
		'coupon_id',
		'total_price',
		'status',
		'paid_at',
		'closed_at',
		'payment_type',
	];

	/**
	 * Покупатель
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function customer()
	{
		return $this->belongsTo('App\Models\Customer', 'customer_id');
	}

	/**
	 * Менеджер, оформивший заказ
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	/**
	 * Товары (OrderProduct)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function orderProducts()
	{
		return $this->hasMany('App\Models\OrderProduct', 'order_id');
	}

	/**
	 * Товары (Product)
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function products()
	{
		return $this->belongsToMany('App\Models\Product', 'orders_products');
	}

	public function groupedProducts()
	{
		return $this->belongsToMany('App\Models\Product', 'orders_products')
			->select(\DB::raw('*, count(*) as quantity, products.id as id'))
			->groupBy('orders_products.product_id', 'orders_products.order_id');
	}
	
	/**
	 * @return mixed
	 */
	public function getTotalPrice()
	{
		return Str::priceFormat($this->total_price);
	}
}