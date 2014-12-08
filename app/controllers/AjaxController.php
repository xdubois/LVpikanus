<?php

class AjaxController extends BaseController {

  private $images_page = 20;

  public function __construct() {
    // Apply the ajax filter
    $this->beforeFilter('ajax-request');
  }

  public function storeCommentTags() {

    $max_comment_length = 400;
    $max_name_length = 30;

    $name = e(Input::get('name') == "" ? 'Gros PD' : Input::get('name'));
    $content = e(Input::get('comment'));
    $id = Input::get('id');
    $tags = Input::get('tag');


    if(! empty($content)) {
      $content = strlen($content > $max_comment_length ) ?  substr($content, 0, 300) : $content;

      $now = new DateTime(null, new DateTimeZone('Europe/Zurich'));

      $comment= new Comment();
      $comment->auteur = $name;
      $comment->com = $content;
      $comment->date = $now->getTimestamp();
      $comment->ip = Request::getClientIp();
      $comment->idxImage = Input::get('id');
      $comment->save();
    }

    if(! empty($tags)) {
      $tags = preg_split('/[,]/', $tags);
      $array_id = array();
        foreach($tags as $tag) {
          if(is_numeric($tag)) { //if numeric we get the id
            $current_tag = Tag::find($tag);
            try {
              $current_tag->tags()->attach(Input::get('id'));
            }
            catch(\Exception $e) {}
          }
          else {
            $tag = $this->string2url($tag); //translate to the shitty slug i do
            $exist = Tag::where('nom', $tag)->first(); //check if the tag already exist
            if($exist == null ) {
              $new = new Tag();
              $new->nom = $tag;
              $new->save();
              try {
                $new->tags()->attach(Input::get('id'));
              }
              catch(\Exception $e) {}

            }
            else {
              try {
               $exist->tags()->attach(Input::get('id'));
              }
              catch(\Exception $e) {}
            }

          }

        }

        return Response::json('success', 200);
    }
    
    return Response::json('error', 400);
  }

  //Get tags by term
  public function  getTags() {
    $term = Input::get('term');
    $res = Tag::where('nom', 'LIKE', '%'. $term .'%')->select('nom AS value', 'idtag AS id')->get();

    return Response::json($res->toArray());
  }

  public function getImageByTerm() {

    $tag = $this->string2url(Input::get('term'));
    if($tag != "") {
      $images = Image::whereHas('tags', function($q) use ($tag) {
                $q->where('nom', 'LIKE',  $tag .'%');

            })->orderBy('date', 'DESC')->get();

    }
    else {
      $images = Image::orderBy('date', 'DESC')->paginate($this->images_page);
    }
    
    return View::make('partial.thecakeisalie', compact('images'));

  }

  public function getTagList() {
    $tags = DB::table('imagehastag')
                ->join('tag', 'tag.idtag', '=', 'imagehastag.idxtag')
                     ->select(DB::raw('count(idxTag) as total, idxImage, nom'))
                     ->groupBy('idxtag')
                     ->orderBy('total', 'DESC')
                     ->get();
    return View::make('partial.tags', compact('tags'));
  }

  public function randomImage() {
    $tag = Input::get('tag');
    if($tag != null) {
      $image = Image::whereHas('tags', function($q) use ($tag) {
                $q->where('nom',  $tag);
            })->orderBy(DB::raw('RAND()'))->first();
    }
    else {
      $image = Image::orderBy(DB::raw('RAND()'))->first();
      
    }

    return $image != null ? $image->image_path() : null;
  }

  private function string2url($chaine) {

      $chaine = mb_strtolower($chaine, 'UTF-8');
     $chaine = str_replace(
      array(
          'à', 'â', 'ä', 'á', 'ã', 'å',
          'î', 'ï', 'ì', 'í', 
          'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
          'ù', 'û', 'ü', 'ú', 
          'é', 'è', 'ê', 'ë', 
          'ç', 'ÿ', 'ñ', 
      ),
      array(
          'a', 'a', 'a', 'a', 'a', 'a', 
          'i', 'i', 'i', 'i', 
          'o', 'o', 'o', 'o', 'o', 'o', 
          'u', 'u', 'u', 'u', 
          'e', 'e', 'e', 'e', 
          'c', 'y', 'n', 
      ),
      $chaine);


      $chaine = preg_replace('#([^.a-z0-9]+)#i', '-', $chaine);
      $chaine = preg_replace('#-{2,}#','-',$chaine);
      $chaine = preg_replace('#-$#','',$chaine);
      $chaine = preg_replace('#^-#','',$chaine);
      return utf8_encode($chaine);
    }

}