<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Models;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $coupon_id
 * @property float $total_price
 * @property boolean $status
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $paid_at
 * @property string $closed_at
 * @property boolean $payment_type
 * @property string $payment_status
 * @property integer $delivery_type
 * @property string $address
 * @property string $comment
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\User $user
 * @property-read \App\Models\DeliveryType $deliveryType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orderProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $groupedOrderProducts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $groupedProducts
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCouponId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaidAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereClosedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaymentType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order wherePaymentStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereDeliveryType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Order whereComment($value)
 * @mixin \Eloquent
 */
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
		self::STATUS_NONE       => 'Не обработан',
		self::STATUS_IN_PROCESS => 'В процессе',
		self::STATUS_CANCELED   => 'Отменен',
		self::STATUS_CLOSED     => 'Завершен',
	];

	public static $statusesClass = [
		self::STATUS_NONE       => 'default',
		self::STATUS_IN_PROCESS => 'info',
		self::STATUS_CANCELED   => 'danger',
		self::STATUS_CLOSED     => 'success',
	];

	/**
	 * Статус оплаты (значение поля payment_status)
	 */
	const PAYMENT_STATUS_NONE = 0;
	const PAYMENT_STATUS_IN_PROCESS = 1;
	const PAYMENT_STATUS_PAID = 2;

	public static $paymentStatuses = [
		self::PAYMENT_STATUS_NONE       => 'Не оплачено',
		self::PAYMENT_STATUS_IN_PROCESS => 'В процессе',
		self::PAYMENT_STATUS_PAID       => 'Оплачено',
	];

	public static $paymentStatusesClass = [
		self::PAYMENT_STATUS_NONE       => 'default',
		self::PAYMENT_STATUS_IN_PROCESS => 'info',
		self::PAYMENT_STATUS_PAID       => 'success',
	];

	/**
	 * Способ оплаты (значение поля payment_type)
	 */
	const PAYMENT_TYPE_CASH = 0;
	const PAYMENT_TYPE_CARD = 1;

	public static $paymentTypes = [
		self::PAYMENT_TYPE_CASH => 'Наличными',
		self::PAYMENT_TYPE_CARD => 'Онлайн',
	];
	
	public static $paymentTypesDescription = [
		self::PAYMENT_TYPE_CASH => 'Наличными.',
		self::PAYMENT_TYPE_CARD => 'Картой VISA, MasterCard, Maestro.',
	];
	
	public static $paymentTypesImage = [
		self::PAYMENT_TYPE_CASH => 'images/payment/cash.png',
		self::PAYMENT_TYPE_CARD => 'images/payment/credit-card.svg',
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
		'delivery_type',
		'address',
		'comment',
	];

	public static function boot()
	{
		parent::boot();
		
		static::saving(function($order) {
			\Cache::forget('leadersOfSells');
		});
		
		static::deleting(function($order) {
			\Cache::forget('leadersOfSells');
		});
	}
	
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
	 * Способ доставки
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function deliveryType()
	{
		return $this->belongsTo('App\Models\DeliveryType', 'delivery_type');
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

	public function groupedOrderProducts()
	{
		return $this->hasMany('App\Models\OrderProduct', 'order_id')
			->select(\DB::raw('*, count(*) as quantity, SUM(price) as total_price, orders_products.id as id'))
			->groupBy('orders_products.product_id', 'orders_products.order_id');
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

	/**
	 * @return mixed
	 */
	public function getAddress()
	{
		return $this->address;
	}
}