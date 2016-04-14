<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Тема</th>
        <th>Текст сообщения</th>
        <th>Дата получения</th>
        <th>Дата прочтения</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($letters as $letter)
            <tr @if(is_null($letter->updated_at)) class="bg-muted" @endif>
                <td>{{ $letter->id }}</td>
                <td>{{ $letter->name }}</td>
                <td>{{ $letter->email }}</td>
                <td>{{ $letter->subject }}</td>
                <td>{{ \App\Helpers\Str::limit($letter->message, 30) }}</td>
                <td>{{ \App\Helpers\Date::format($letter->created_at) }}</td>
                <td>{{ \App\Helpers\Date::format($letter->updated_at) }} @endif</td>
                <td>
                    <a href="{{ route('admin.letters.show', ['id' => $letter->id]) }}" title="Прочесть" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    <a href="#" title="Удалить" data-toggle="tooltip">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>