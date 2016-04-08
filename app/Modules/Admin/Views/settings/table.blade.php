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
        <th>Категория</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Значение</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($settings as $setting)
            <tr @if(!$setting->is_active) class="not-published" @endif>
                <td>{{ $setting->id }}</td>
                <td>{{ \App\Models\Setting::$categories[$setting->category] }}</td>
                <td>{{ $setting->title }}</td>
                <td>{{ $setting->description }}</td>
                <td>
                    {{ $setting->value }}
                </td>
                <td>
                    <a href="{{ route('admin.settings.edit', ['id' => $setting->id]) }}" title="Редактировать" data-toggle="tooltip" class="m-r-15">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>