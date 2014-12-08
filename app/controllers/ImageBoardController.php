<?php

class ImageBoardController extends BaseController {


    private $images_page = 20;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($tag = null) {
     
        if($tag == null) {
            $images = Image::orderBy('date', 'DESC')->paginate($this->images_page);
        }
        else {
            $images = Image::whereHas('tags', function($q) use ($tag) {
                $q->where('nom', $tag);

            })->orderBy('date', 'DESC')->paginate($this->images_page);
        }


        return View::make('imageboards.index', compact('images'));
    }

    public function random() {
        $images = Image::orderBy(DB::raw('RAND()'))->take($this->images_page)->get();
        return View::make('imageboards.index', compact('images'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug) {
        if(!empty($slug)) {

            $image = Image::where('nom', $slug)->first();
            if($image != null) { 
                return View::make('imageboards.show', compact('image'));
            }
            
        }
        return App::abort(404);
    }

    public function remove($image_id) {
      if(!Auth::check()) {
        return Redirect::route('home');
      }

      $image = Image::findOrFail($image_id);
      if(File::exists($image->folder().$image->nom)) {
        File::delete($image->folder().$image->nom);
      }
      if(File::exists($image->folder(). 'min/min_' .$image->nom)) {
        File::delete($image->folder(). 'min/min_' .$image->nom);
      }
      $image->tags()->detach();
      $image->delete();
     

      return Redirect::back();
    }


}
