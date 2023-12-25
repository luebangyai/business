<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type  = isset(request()->type) ? request()->type : '';

        if(!empty($type)){
            $data['rooms'] = Room::where('type', $type)->orderBy('type', 'desc')->get();
        }else{
            $data['rooms'] = Room::orderBy('type', 'desc')->get();
        }

        $data['type'] = $type;
        return view('backend.room.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.room.form');
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
            $path    = $this->upload_image($request, $imageId, 'cover/images/');
            $cover  = $path;
        }

        $room          = new Room;
        $room->name    = $request->name;
        $room->cover   = $cover;
        $room->type    = $request->type;
        $room->detail  = $request->detail;
        $room->save();

        return Redirect::route('backend.room.index')->with('status', 'room-created');
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
        if(!empty($id)){
            $data['room'] = Room::where('id', $id)->first();
            return view('backend.room.form')->with($data);
        }

        return Redirect::route('backend.room.index')->with('status', 'room-edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(isset($request->room_id) && !empty($request->room_id)){

            $room   = Room::where('id', $request->room_id)->first();
            if(isset($request->cover) && $request->hasFile('cover'))
            {
                $imageId = date('d').uniqid().date('h').date('i').date('s');
                $path    = $this->upload_image($request, $imageId, 'cover/images/');
                $room->cover   = $path;
            }
            $room->name    = $request->name;
            $room->type    = $request->type;
            $room->detail  = $request->detail;
            $room->update();
        }

        return Redirect::route('backend.room.index')->with('status', 'room-update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id='')
    {
        if(!empty($id)){
            $room = Room::where('id', $id)->first();
            if (file_exists($room->cover))
            {
                unlink($room->cover);
            }
            $room->delete();
        }
        return Redirect::route('backend.room.index')->with('status', 'room-delete');
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
