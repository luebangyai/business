<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Content;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type  = isset(request()->type) ? request()->type : request()->segment(1);

        if(!empty($type)){
            $data['rooms'] = Content::where('type', $type)->orderBy('sort', 'asc')->get();
        }else{
            $data['rooms'] = Content::orderBy('sort', 'asc')->get();
        }

        // dd($data['rooms']);

        $data['type'] = $type;
        return view('backend.home.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.home.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cover = '';
        if(isset($request->cover) && $request->hasFile('cover'))
        {
            $imageId = date('d').uniqid().date('h').date('i').date('s');
            $path    = $this->upload_image($request, $imageId, 'cover/images/', 'cover');
            $cover  = $path;
        }
        $detail = $request->detail;
        if(isset($request->detail) && $request->hasFile('detail'))
        {
            $imageId = date('d').uniqid().date('h').date('i').date('s');
            $path    = $this->upload_image($request, $imageId, 'file/images/', 'detail');
            $detail   = $path;
        }

        $room          = new Content;
        $room->name    = $request->name;
        $room->cover   = $cover;
        $room->sort    = $request->sort;
        $room->detail  = $detail;
        $room->type    = $request->type;
        $room->save();

        return Redirect::route('backend.our.product.index', ['type' => $request->type])->with('status', 'room-created');
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
        $type  = isset(request()->type) ? request()->type : "";
        if(!empty($id)){
            $data['room'] = Content::where('id', $id)->first();
            return view('backend.home.form')->with($data);
        }

        return Redirect::route('backend.our.product.index', ['type' => $type])->with('status', 'room-edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(isset($request->room_id) && !empty($request->room_id)){

            $room   = Content::where('id', $request->room_id)->first();
            if(isset($request->cover) && $request->hasFile('cover'))
            {
                $imageId = date('d').uniqid().date('h').date('i').date('s');
                $path    = $this->upload_image($request, $imageId, 'cover/images/', 'cover');
                $room->cover   = $path;
            }
           
            if($room->type == "download"){
                if(isset($request->detail) && $request->hasFile('detail'))
                {
                    $imageId = date('d').uniqid().date('h').date('i').date('s');
                    $path    = $this->upload_image($request, $imageId, 'file/images/', 'detail');
                    $room->detail   = $path;
                }
            }else{
                $room->detail = $request->detail;
            }
            $room->name    = $request->name;
            $room->sort    = $request->sort;
            $room->update();
        }

        return Redirect::route('backend.our.product.index', ['type' => $room->type])->with('status', 'room-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id='')
    {
        if(!empty($id)){
            $room = Content::where('id', $id)->first();
            $type = $room->type;
            if (file_exists($room->cover))
            {
                unlink($room->cover);
            }
            $room->delete();
        }
        return Redirect::route('backend.our.product.index', ['type' => $type])->with('status', 'room-delete');
    }



    public function upload_image(Request $request, $imageId , $storage, $inputName)
    {
        if($request->hasFile($inputName))
        {
            $image = $request->file($inputName);
            $extension = $image->getClientOriginalExtension();
            $extension = preg_replace('/[^A-Za-z0-9-]/', '-', $extension);
	        $extension = preg_replace('/-+/', " ", $extension);
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
