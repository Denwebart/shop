<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */
?>

@foreach($product->images as $image)
    <div class="file-box">
        {!! Form::file('images['. $image->id .']', ['id' => 'images-'. $image->id, 'class' => 'img-responsive img-thumbnail dropify-more', 'data-default-file' => $image->getImageUrl(), 'data-max-file-size' => '3M', 'data-image-id' => $image->id, 'data-height' => '100']) !!}
    </div>
@endforeach

<div class="file-box new-product-image hidden">
	{!! Form::file('images[new]', ['id' => 'images-new', 'class' => 'img-responsive img-thumbnail dropify-more', 'data-default-file' => false, 'data-max-file-size' => '3M', 'data-image-id' => 0, 'data-height' => '100']) !!}
</div>

<div class="file-box m-l-15">
	<div class="fileupload add-new-plus add-new-product-image">
		<span><i class="zmdi-plus zmdi"></i></span>
	</div>
</div>