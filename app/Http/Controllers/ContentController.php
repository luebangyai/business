<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type  = isset(request()->type) ? request()->type : '';

        if($type == 'header'){
            $data['content'] = Content::where('type', $type)->first();
        }else{
            // map & listMap
            $data['content'] = Content::where('type', 'map')->first();
            $data['content']['station1'] = Content::where('type', 'listMap')->where('sort', 1)->first();
            $data['content']['station2'] = Content::where('type', 'listMap')->where('sort', 2)->first();
            $data['content']['station3'] = Content::where('type', 'listMap')->where('sort', 3)->first();
            $data['content']['station4'] = Content::where('type', 'listMap')->where('sort', 4)->first();
        }

        $data['type'] = $type;
        return view('backend.content.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type  = isset(request()->type) ? request()->type : '';
        $cover = '';
        if(isset($request->cover) && $request->hasFile('cover'))
        {
            $imageId = date('d').uniqid().date('h').date('i').date('s');
            $path    = $this->upload_image($request, $imageId, 'cover/images/');
            $cover  = $path;
        }

        $room          = new Content;
        $room->name    = $request->name;
        $room->cover   = $cover;
        $room->type    = $type;
        $room->detail  = $request->detail;
        $room->sort    = 0;
        $room->save();

        $data['type'] = $type;
        return Redirect::route('backend.content.index', ['type' => $type])->with($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function map(Request $request)
    {
        $type  = isset(request()->type) ? request()->type : '';

        $station1 = Content::where('type', 'listMap')->where('sort' , 1)->first();
        if(isset($station1)){
            $station1->detail    = $request->station1;
            $station1->save();
        }else{
            $station          = new Content;
            $station->name    = 'รถไฟฟ้า';
            $station->detail  = $request->station1;
            $station->type    = $request->type;
            $station->sort    = 1;
            $station->save();
        }


        $station2 = Content::where('type', 'listMap')->where('sort' , 2)->first();
        if(isset($station2)){
            $station2->detail    = $request->station2;
            $station2->save();
        }else{
            $station          = new Content;
            $station->name    = 'รถประจำทาง';
            $station->detail  = $request->station2;
            $station->type    = $request->type;
            $station->sort    = 2;
            $station->save();
        }


        $station3 = Content::where('type', 'listMap')->where('sort' , 3)->first();
        if(isset($station3)){
            $station3->detail    = $request->station3;
            $station3->save();
        }else{
            $station          = new Content;
            $station->name    = 'Airport Rail Link';
            $station->detail  = $request->station3;
            $station->type    = $request->type;
            $station->sort    = 3;
            $station->save();
        }

        $station4 = Content::where('type', 'listMap')->where('sort' , 4)->first();
        if(isset($station4)){
            $station4->detail    = $request->station4;
            $station4->save();
        }else{
            $station          = new Content;
            $station->name    = 'รถยนต์หรือรถจักรยานยนต์ส่วนตัว';
            $station->detail  = $request->station4;
            $station->type    = $request->type;
            $station->sort    = 4;
            $station->save();
        }

        $data['type'] = $type;
        return Redirect::route('backend.content.index', ['type' => $type])->with($data);
    }

    public function upload_image(Request $request, $imageId , $storage)
    {
        if($request->hasFile('cover'))
        {
            $image = $request->file('cover');
            $extension = $image->getClientOriginalExtension();
            $fileName = $imageId . "." . $extension;

            // $destination = config('app.media.directory') . $storage.date('Y').'/'.date('m').'/';

            $destination = config('app.media.directory') . $storage . date('Y') . '/' . date('m') . '/';
            $directory = config('app.media.directory') . $storage . date('Y') . '/' . date('m') . '/';

            if (!file_exists($destination))
            {
                mkdir($destination, 0777, true);
            }

            $successUploaded = $image->move($destination, $fileName);

            if($successUploaded)
            {
                return  $directory . $fileName;
            }
        }
    }


}
