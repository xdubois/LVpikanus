@extends('layouts.default') 

@section('content')
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('thecakeisalie') }}">PIKA IMG BOARD</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ route('thecakeisalierandom') }}"> Random </a></li>
        <li><a href="{{ route('thecakeisalieslideshow') }}" id="trigger-show">Yann TV</a></li>
        <li><a href="{{ route('tags.list') }}" class="tags-list"> Tags </a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" id="search-tag" data-url="{{ route('tags.search') }}" class="form-control" placeholder="Search">
        </div>
      </form> 
      <ul class="nav navbar-nav navbar-right">
            <li class="navbar-brand">We host  Images. </li>
      </ul>
      </div>
  </div>
</nav>




    <a href="{{ route('thecakeisalieslideshow') }}" id="trigger-show">random show() </a>
@stop

@section('js')
<script>
var t = 'http://pikanus.server.dev:8080/images/2014/yxtWa6nL6C3h.jpg';

// $("#trigger-show").click(function(e) {
//   e.preventDefault();
//   getRandom();
//   yann_tv = setInterval(getRandom, 5000);
// });

// function getRandom() {
//     $.ajax({
//             url: $("#trigger-show").attr('href'),
//             type: 'GET',
//             success: function(res) {
//               $.colorbox({
//                 href: res,
//                 onCleanup: function(){
//                   clearTimeout(yann_tv);
//                 }
//               });
//             }
//         });
// }


</script>
@stop