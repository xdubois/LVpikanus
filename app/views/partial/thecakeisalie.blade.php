@if($images->count() > 0)
  @foreach ($images as $image)
    <div class="row">
      <div class="col-md-11 lolmargin"> 
               <a href="{{ $image->image_path() }}"  title="{{ $image->nom }}" class="box" rel="gal1">
                <img src="{{ $image->image_min_path() }}" alt="anus.jpg" class="pull-left padded" />
              </a>
             @if(Auth::check())
                <a href="{{ route('image.remove', $image->idimage) }}"> remove </a>
             @endif
            <div class="pika-menu">
                  <a class="taglnk btn btn-default btn-xs image-id"  data-toggle="modal" href="#form-box" id="{{ $image->idimage }}">Comment / Tag</a>
                </div>

                <div clas="pika-tag">
              @foreach ($image->tags as $tag)
                <a href="{{ route('thecakeisalie', $tag->nom) }}" class="label label-info"> {{ $tag->nom }} </a> &nbsp;
              @endforeach
                </div>

            <div class="pika-comment">
              @foreach ($image->comments as $comment)
              <p><strong>  {{ $comment->auteur }} </strong> <br />
                {{ $comment->com }}
              </p>
    
              @endforeach
              </div>
      </div>
    </div>
  @endforeach
    <div class="row">
      <div class="col-md-11 lolmargin">
        @if(method_exists($images, 'links'))
         {{ $images->links() }}
        @endif
      </div>
    </div>
@else
  <div class="container">

      <div class="lol-racist">
        <h1>Y'a pas de negro ici</h1>
      </div>
  </div>
@endif

