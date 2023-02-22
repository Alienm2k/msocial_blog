<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
       $posts = Post::orderByDesc('created_at')->paginate(10);
       return PostResource::collection($posts);
    }
   public function create(Request $request){
        $request->validate(
            [
                'title' => 'required|string',
                'description' => 'required|string',
                'category_id' => 'required',
            ],
            [
                'category_id.required' => 'The Category field is required',
            ]
            );
            DB::beginTransaction();
           try{
            $file_name = null;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $file_name = uniqid().'-'.date('Y-m-d-H-i-s').'.'.$file->getClientOriginalExtension();
                Storage::put('media/'.$file_name, file_get_contents($file));
            }


            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->category_id = $request->category_id;

            $post->save();

            $media = new Media();
            $media->file_name  = $file_name;
            $media->file_type = 'image';
            $media->model_id = $post->id;
            $media->model_type = Post::class;
            $media->save();

            DB::commit();
            return ResponseHelper::success([], 'Successfully Uploaded!');

           }catch(Exception $e){
            DB::rollback();
            return ResponseHelper::fail($e->getMessage());
           }
   }
}
