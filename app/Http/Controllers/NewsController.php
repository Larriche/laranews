<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateNewsRequest;

use App\User;
use App\News;
use App\Tag;

use App\Http\Controllers\Controller;
use Auth;
use URL;
use PDF;



class NewsController extends Controller
{
    /**
     * Show the form for creating a new news article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // redirect if no user is logged in
        if(Auth::guest()){
            return redirect('/auth/login');
        }

        $user = Auth::user();

        // get all published and unpublished news articles
        $published = $user->news()->latest('published_at')->published()->get();
        $unpublished =  $user->news()->latest('created_at')->unpublished()->get();

        return view('news.create',compact( 'published' , 'unpublished'));
    }

    /**
     * Store a newly created news article in storage.
     *
     * @param  \Illuminate\Http\Requests\CreateNewsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {

        $news = new News($request->all());

        if($request['publish']){
            $news['status'] = 'PUBLISHED';
            $news['published_at'] = date("Y-m-d");
        }
        else{
            $news['status'] = 'UNPUBLISHED';
        }

        Auth::user()->news()->save($news);

        if(!empty($request['tags'])){
            $tags = explode(',' , $request['tags']);

            foreach($tags as $tagStr){
                $tagStr = strtolower($tagStr);
                
                $tagObj = Tag::where('name' ,'=', $tagStr)->first();
            
                if(!$tagObj){
                    $tag = new Tag();
                    $tag->name = $tagStr;
                    $tag->save();
                }
                else{
                    $tag = $tagObj;
                }

                $news->tags()->save($tag);
            }
        }


        $imageName = $news->id.'.'.'jpg';
        $saveUrl = 'images/newsitems/'.$imageName;
        $news->image_url = $_SERVER['SERVER_NAME'].'/'.$saveUrl;

        $news->save();

        if($request->file('image')){
            $request->file('image')->move(base_path().'/public/images/newsitems',$imageName);
        }

        return redirect('/news/create');
    }

    /**
     * Display the news article in public view mode
     *
     * @param \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        if(is_null($news)){
            abort(404);
        }
        
        // create paragraphs out of news content separated by line feeds
        $news->body = '<p>'.str_replace("\r\n","</p><p>",$news->body).'</p>';

        return view('news.view',compact('news'));   
    }

    /**
     * Display the news article in admin view mode
     *
     * @param \App\News $news
     * @return \Illuminate\Http\Response      
     */
    public function adminView(News $news)
    {
        $user = Auth::user();
        
        // if logged in user is not the author of the article,
        // we view it in public mode
        if($news->writer != $user){
            return redirect('/news/'.$news->id);
        }          

        $published = News::latest('published_at')->published()->get();
        $unpublished = News::latest('created_at')->unpublished()->get();

        return view('news.admin_view' , compact('news' , 'published' , 'unpublished'));
    }

   
    /**
     * Show the form for editing the specified news article.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        if(Auth::guest()){
            return redirect('/auth/login');
        }

        $published = News::latest('published_at')->published()->get();
        $unpublished = News::latest('created_at')->unpublished()->get();

        return view('news.edit' , compact('news' , 'published' , 'unpublished'));
    }

    /**
     * Update the specified news article in storage.
     *
     * @param  \Illuminate\Http\Requests\CreateNewsRequest  $request
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function update(CreateNewsRequest $request, News $news)
    {
        // update news article contents
        $news->update($request->all());

        if($request['publish']){
            $news['status'] = 'PUBLISHED';
            $news['published_at'] = date("Y-m-d");
            $news->save();
        }


        if($request->file('image')){
            // if a new image is uploaded as the featured image,
            // we upload that with the same name as the old
            $imageUrl = $news->id.'.'.'jpg';
            $request->file('image')->move(base_path().'/public/images/newsitems',$imageUrl);
        }
    }

    /**
     * Change the status of the specified news article to unpublished
     *
     * @param  \Illuminate\Http\Requests\CreateNewsRequest  $request
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function makeUnpublished(News $news)
    {
        $news->status = 'UNPUBLISHED';
        $news->save();

        return redirect(url('/news/create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect('/news/create');       
    }

    /**
     *  Loads a PDF viewer containing the requested news item for download
     *  @param int $id the id of the news item
     */
    public function getPDF($id)
    {
        $html = $this::getPDFHtml($id);

        $news = News::find($id);

        $replace = [' ','-' ,'?' , '*'];
        $titleSlug = str_replace($replace, '_', $news->title);

        $pdfSaveName = $titleSlug.'.pdf';

        return \PDF::loadHtml($html)->stream($pdfSaveName);
    }

    /**
     * Loads the contents a pre-created html template file for news articles,
     * makes the necessary editing and returns the new HTML 
     *
     * @param int $id the id of the news item
     * @return string the html for use in rendering PDF
     */
    public function getPDFHtml($id)
    {
        $pdfTemplate = file_get_contents(public_path().'/pdf_template.html');
        
        $news = News::find($id);
        $newsAuthor = $news->writer->name;

        $news->body = '<p>'.str_replace("\r\n","</p><p>",$news->body).'</p>';
        $fullImageUrl = 'http://'.$news->image_url;

        // replacing placeholders in template with actual data
        $pdfTemplate = str_replace("NEWS_TITLE", $news->title, $pdfTemplate);
        $pdfTemplate = str_replace("NEWS_AUTHOR",$newsAuthor,$pdfTemplate);
        $pdfTemplate = str_replace("NEWS_INTRO",$news->intro,$pdfTemplate);
        $pdfTemplate = str_replace("NEWS_IMAGE",$fullImageUrl,$pdfTemplate);
        $pdfTemplate = str_replace("NEWS_BODY",$news->body,$pdfTemplate);

        return $pdfTemplate;
    }    
}
