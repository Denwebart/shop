<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Просмотр информации о заказе №"' . $order->id . '"';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-12 hidden-xs">
            <ul class="breadcrumb m-b-10">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.orders.index') }}">Заказы</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        {{--<div class="col-sm-6 col-md-6 col-xs-12">--}}
            {{--<div class="button pull-right">--}}
                {{--<button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save-exit">--}}
                    {{--<i class="fa fa-arrow-left"></i>--}}
                    {{--<span>Сохранить и выйти</span>--}}
                {{--</button>--}}
                {{--<button type="button" class="btn btn-success btn-bordred waves-effect waves-light m-b-10 button-save">--}}
                    {{--<i class="fa fa-check"></i>--}}
                    {{--<span class="hidden-sm">Сохранить</span>--}}
                {{--</button>--}}
                {{--<a href="{{ URL::previous() }}" class="btn btn-primary btn-bordred waves-effect waves-light m-b-10 button-cancel">--}}
                    {{--<i class="fa fa-close"></i>--}}
                    {{--<span class="hidden-md hidden-sm">Отмена</span>--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h3 class="logo">Adminto</h3>
                        </div>
                        <div class="pull-right">
                            <h4>Invoice # <br>
                                <strong>2016-04-23654789</strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pull-left m-t-30">
                                <address>
                                    <strong>Twitter, Inc.</strong><br>
                                    795 Folsom Ave, Suite 600<br>
                                    San Francisco, CA 94107<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Order Date: </strong> Jan 17, 2016</p>
                                <p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">Pending</span></p>
                                <p class="m-t-10"><strong>Order ID: </strong> #123456</p>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="m-h-50"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table m-t-30">
                                    <thead>
                                    <tr><th>#</th>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Unit Cost</th>
                                        <th>Total</th>
                                    </tr></thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>LCD</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>1</td>
                                        <td>$380</td>
                                        <td>$380</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Mobile</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>5</td>
                                        <td>$50</td>
                                        <td>$250</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>LED</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>2</td>
                                        <td>$500</td>
                                        <td>$1000</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>LCD</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>3</td>
                                        <td>$300</td>
                                        <td>$900</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Mobile</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>5</td>
                                        <td>$80</td>
                                        <td>$400</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="clearfix m-t-40">
                                <h5 class="small text-inverse font-600">PAYMENT TERMS AND POLICIES</h5>

                                <small>
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                            <p class="text-right"><b>Sub-total:</b> 2930.00</p>
                            <p class="text-right">Discout: 12.9%</p>
                            <p class="text-right">VAT: 12.9%</p>
                            <hr>
                            <h3 class="text-right">USD 2930.00</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- end row -->

@endsection