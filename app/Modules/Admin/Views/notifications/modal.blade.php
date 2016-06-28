<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
@if(isset($notification) && is_object($notification))
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-{{ str_replace('bg-', '', \App\Models\Notification::$classes[$notification->type]) }}">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">
                        <i class="{{ \App\Models\Notification::$icons[$notification->type] }} m-r-15"></i>
                        {{ \App\Models\Notification::$notificationsTitle[$notification->type] }}
                    </h3>
                </div>
                <div class="panel-body">
                    <p>{!! $notification->message !!}</p>
                    <span class="time">{{ \App\Helpers\Date::getRelative($notification->created_at) }}</span>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
@endif