
<img ng-src={{{ asset($image->src) }}} 
	@if($product->video != '' && $image->src == $product->video->thumbnail->src)
		ng-click="clickSideVideo('{{{ asset($product->video->thumbnail->src) }}}');
				focusSideImage({{{ $key }}})"
	@else
		ng-click="clickSideImage('{{{ asset($image->src) }}}');
				focusSideImage({{{ $key }}})"
		ng-mouseover="mouseoverSideImage('{{{ asset($image->src) }}}')"
		ng-mouseleave="mouseleaveSideImage()"
	@endif																							
	ng-class="thumbnailClass[{{{ $key }}}]"
	class="img-responsive img-thumbnail"
	style="cursor: pointer;"
	onclick="tracker.imageClick({{ $image->id }})">
