<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>
<!-- sample modal content -->
<div id="notification-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    @include('admin::notifications.modal')
</div><!-- /.modal -->


<div class="side-bar right-bar">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="zmdi zmdi-close-circle-o"></i>
    </a>
    <h4 class="notifications-header">
        Уведомления
        @if(count(\Auth::user()->notifications))
            <span class="count">({{ count(\Auth::user()->notifications )}})</span>
        @endif
    </h4>
    <div class="notification-list nicescroll">
        <ul id="notifications-container" class="list-group list-no-border user-list">
            @include('admin::notifications.list')
        </ul>
    </div>

</div>

@push('scripts')

<script type="text/javascript">
    !function ($) {
        "use strict";

        $('#notifications-container').on('click', '.notification', function (e) {
            var item = $(this),
                notificationId = item.data('id');

            $.ajax({
                url: "{{ route('admin.notifications.view') }}",
                dataType: "json",
                type: "POST",
                data: {id: notificationId},
                async: true,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(response) {
                    if(response.success){
                        $('#notifications-container').html(response.notificationListHtml);
                        $('#notification-modal').html(response.notificationModalHtml);
                        if(!response.notificationsCount) {
                            $('.notification-box').find('.noti-dot').hide();
                            $('.notifications-header').find('.count').hide();
                        } else {
                            $('.notifications-header').find('.count').text('(' + response.notificationsCount + ')');
                        }
                        Custombox.open({
                            target: "#notification-modal",
                        });
                    }
                }
            });
        });
    }(window.jQuery);
</script>
@endpush