@if(count(Auth::user()->notifications))
    @foreach(Auth::user()->notifications as $notification)
        <li class="notification list-group-item" data-id="{{ $notification->id }}" data-toggle="modal" data-target="#notification-modal"><!-- active -->
            <a href="#" class="user-list-item">
                <div class="icon {{ \App\Models\Notification::$classes[$notification->type] }}">
                    <i class="{{ \App\Models\Notification::$icons[$notification->type] }}"></i>
                </div>
                <div class="user-desc">
                    <span class="name">
                        {{ \App\Models\Notification::$notificationsTitle[$notification->type] }}
                    </span>
                    <div class="desc">
                        {!! \App\Helpers\Str::withoutLinks($notification->message) !!}
                    </div>
                    <span class="time">{!! \App\Helpers\Date::getRelative($notification->created_at) !!}</span>
                </div>
            </a>
        </li>
    @endforeach
@else
    <p class="text-center text-muted m-t-20">Новых уведомлений нет</p>
@endif