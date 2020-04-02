<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BlogPost;
class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = BlogPost::all();

        return view('blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        return view('blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $blogPost = new BlogPost();

       $blogPost->title = $request->input('title');
       $blogPost->details = $request->input('blogDetails');
       $blogPost->user_id = 1;
       $blogPost->category_id=$request->input('category');

    //    return $blog;
       if($blogPost->save()){
           $photo = $request->file('featuredPhoto');
           if($photo!=null){
               $ext = $photo->getClientOriginalExtension();
                $fileName = time().rand(10000,50000).'.'.$ext;

                if($photo->move(public_path('/images'),$fileName)){
                    $blogPost = BlogPost::find($blogPost->id);
                    $blogPost->featured_image_url = url('/images').'/'.$fileName;
                    $blogPost->save();
                }
                

           }
            return redirect()->back()->with('success','Blog created successfully!');
       }
       return redirect()->back()->with('err','Blog cannot be created!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = BlogPost::find($id);
        $categories = Category::all();
        return view('blog.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::find($id);

        $blogPost->title = $request->input('title');
        $blogPost->details = $request->input('blogDetails');
        $blogPost->user_id = 1;
        $blogPost->category_id=$request->input('category');
 
     //    return $blog;
        if($blogPost->save()){
            $photo = $request->file('featuredPhoto');
            if($photo!=null){
                $ext = $photo->getClientOriginalExtension();
                 $fileName = time().rand(10000,50000).'.'.$ext;
 
                 if($photo->move(public_path('/images'),$fileName)){
                     $blogPost = BlogPost::find($blogPost->id);
                     $blogPost->featured_image_url = url('/images').'/'.$fileName;
                     $blogPost->save();
                 }
                 
 
            }
             return redirect()->back()->with('success','Blog Updated successfully!');
        }
        return redirect()->back()->with('err','Blog cannot be Updated!');
 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(BlogPost::destroy($id)){
            return redirect()->back()->with('success','Blog deleted successfully!');
        }
        return redirect()->back()->with('err','Blog cannot be deleted');
        
    }
}
