<div class="row">
  <div class="col-md-12  lolmargin">
      <div class="content">
        <ul class="list-inline">
          @foreach($tags as $tag)
          	@if($tag->total >= 5)
            	<li> <strong>({{ $tag->total }})</strong><a href="{{ route('thecakeisalie', $tag->nom )}}"> {{ $tag->nom }} </a> </li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
</div>