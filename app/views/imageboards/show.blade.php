@extends('layouts.default')	

@section('content')

  <div id="topwrapper">
   <div class="container">
      <div class="row-fluid" style="margin-top:12px">
         <div class="span12 text-center" id="headerimage">
            {{ $image->image_tag() }}

          <p class="align-center">
            <a href="http://www.pikanus.net">hosted by pikanus.net</a>
         </p>
         <p class="align-center">
              <a href="https://twitter.com/share" class="twitter-share-button" data-text="C'est vraiment drôle" data-via="pikanus" data-size="large" data-hashtags="lol">Tweet</a>
            </p>

         </div>
      </div>
   </div>
</div>



@stop

@section('js')
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

@stop