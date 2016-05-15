<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@if(count($productReviews))
    <div class="row">
        <div class="col-sm-5 col-md-4 col-lg-3">
            <h3 class="text-uppercase">Отзывы ({{ count($productReviews) }})</h3>
            <div class="rating-extended row">
                <div class="col-lg-12">
                    <h1 class="rating-extended__num pull-left">{{ $page->rating }}</h1>
                    <div class="rating product-rating"></div>
                    <div>
                        <span class="icon icon-man"></span>
                        Отзывов: {{ count($productReviews) }}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12">
                    <div class="progress">
                        <span class="rating-extended__label">5 звезд</span>
                        @if($page->ratingInfo[5])
                            <div class="progress-bar progress-bar-five" role="progressbar" aria-valuenow="{{ count($productReviews) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (100 * $page->ratingInfo[5]) / $page->ratingInfo['sum'] }}%">
                                <span class="rating-extended__reviews-count">
                                    {{ $page->ratingInfo[5] }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress">
                        <span class="rating-extended__label">4 звезды</span>
                        @if($page->ratingInfo[4])
                            <div class="progress-bar progress-bar-four" role="progressbar" aria-valuenow="{{ count($productReviews) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (100 * $page->ratingInfo[4]) / $page->ratingInfo['sum'] }}%">
                                <span class="rating-extended__reviews-count">
                                    {{ $page->ratingInfo[4] }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress">
                        <span class="rating-extended__label">3 звезды</span>
                        @if($page->ratingInfo[3])
                            <div class="progress-bar progress-bar-three" role="progressbar" aria-valuenow="{{ count($productReviews) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (100 * $page->ratingInfo[3]) / $page->ratingInfo['sum'] }}%">
                                <span class="rating-extended__reviews-count">
                                    {{ $page->ratingInfo[3] }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress">
                        <span class="rating-extended__label">2 звезды</span>
                        @if($page->ratingInfo[2])
                            <div class="progress-bar progress-bar-two" role="progressbar" aria-valuenow="{{ count($productReviews) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (100 * $page->ratingInfo[2]) / $page->ratingInfo['sum'] }}%">
                                <span class="rating-extended__reviews-count">
                                    {{ $page->ratingInfo[2] }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="progress">
                        <span class="rating-extended__label">1 звезда</span>
                        @if($page->ratingInfo[1])
                            <div class="progress-bar progress-bar-one" role="progressbar" aria-valuenow="{{ count($productReviews) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ (100 * $page->ratingInfo[1]) / $page->ratingInfo['sum'] }}%">
                                <span class="rating-extended__reviews-count">
                                    {{ $page->ratingInfo[1] }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="divider divider--md"></div>
        </div>
        <div class="col-sm-7 col-md-8 col-lg-9">
            <div class="count">
                Показано {{ count($productReviews) }} из {{ count($productReviews) }}
            </div>

            @foreach($productReviews as $review)
                <div class="review">
                    <div class="rating">
                        @include('parts.starRating', ['rating' => $review->rating])
                    </div>
                    {{--<h5 class="review__title">Очень понравился!</h5>--}}
                    <div class="review__content">
                        {{ $review->text }}
                    </div>
                    <div class="review__meta">
                        @if($review->user)
                            {{ \App\Models\User::$roles[$review->user->role] }}
                            @if(\Auth::check())
                                <a href="{{ route('admin.users.show', ['id' => $review->user->id]) }}">
                                    <strong>{{ $review->user->login }}</strong>
                                </a>,
                            @else
                                <strong>{{ $review->user->login }}</strong>,
                            @endif
                        @else
                            <strong>{{ $review->user_name }}</strong>,
                        @endif
                        {{ \App\Helpers\Date::format($review->created_at) }}
                    </div>
                    <div class="review__comments">
                        <a href="#">Комментарии ({{ count($review->publishedChildren) }})</a>
                    </div>
                    <div class="review__helpful">
                        <span class="m-r-10">Этот отзыв был полезен?</span>
                        <a href="#" class="like" data-id="{{ $review->id }}">
                            Да
                            <span class="count">({{ $review->like }})</span>
                        </a>
                        <a href="#" class="dislike" data-id="{{ $review->id }}">
                            Нет
                            <span class="count">({{ $review->dislike }})</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <p>Оставьте первым свой отзыв!</p>
@endif