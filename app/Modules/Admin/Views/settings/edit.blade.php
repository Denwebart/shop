<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

$title = 'Редактирование настройки "' . $setting->title . '"';
View::share('title', $title);
?>

@extends('admin::layouts.main')

@section('content')

    <div class="row">
        <div class="col-sm-8">
            <ul class="breadcrumb">
                <li><a href="{{ route('admin.index') }}">Главная</a></li>
                <li><a href="{{ route('admin.settings.index') }}">Настройки</a></li>
                <li>{{ $title }}</li>
            </ul>
        </div>
        <div class="col-sm-4">
            <div class="button pull-right">
                <button type="button" class="btn btn-success w-md waves-effect waves-light">
                    <i class="fa fa-arrow-left"></i>
                    Сохранить и выйти
                </button>
                <button type="button" class="btn btn-success w-md waves-effect waves-light">
                    <i class="fa fa-check"></i>
                    Сохранить
                </button>
                <button type="button" class="btn btn-primary w-md waves-effect waves-light">
                    <i class="fa fa-close"></i>
                    Отмена
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="alias">Значение</label>
                            <div class="col-md-10">
                                <input name="value" id="value" type="text" class="form-control" value="">
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="switchery-demo m-b-5">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
                                    <input name="is_published" id="is_published" type="checkbox" checked data-plugin="switchery" data-color="#3bafda" data-size="small"/>
                                    <label class="control-label m-l-5" for="is_published">
                                        Включена
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection

@push('styles')
    <link href="{{ asset('backend/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('backend/plugins/switchery/switchery.min.js') }}"></script>
@endpush