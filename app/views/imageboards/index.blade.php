@extends('layouts.default') 

@section('content')
<div id="content">
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
      <ul class="nav navbar-nav">
        <li><a href="{{ route('home') }}"> Upload images..</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
            <li><a href="{{ route('admin.logout') }}">logout </a></li>
          @endif  
          <li class="navbar-brand hidden-xs">We host {{ Image::count() }} Images. </li>
      </ul>
    </div>
  </div>
</nav>

<div id="merdier">
  @include('partial.thecakeisalie')
</div>

@include('partial.modal')

</div>
@stop

@section('js')
{{ HTML::script('assets/js/script.js')}}
{{ HTML::script('assets/js/script_box.js')}}

@stop