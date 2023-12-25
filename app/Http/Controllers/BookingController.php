<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\Booking;
use App\Mail\BookingMail;
use App\Models\Content;
use App\Models\Room;

class BookingController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['content']['header'] = Content::where('type', 'header')->first();
        $data['content']['map'] = Content::where('type', 'map')->first();
        $data['content']['station1'] = Content::select('detail')->where('type', 'listMap')->where('sort', 1)->first();
        $data['content']['station2'] = Content::select('detail')->where('type', 'listMap')->where('sort', 2)->first();
        $data['content']['station3'] = Content::select('detail')->where('type', 'listMap')->where('sort', 3)->first();
        $data['content']['station4'] = Content::select('detail')->where('type', 'listMap')->where('sort', 4)->first();

        $data['rooms']['small'] = Room::where('type', 'small')->orderBy('name', 'asc')->get();
        $data['rooms']['medium'] = Room::where('type', 'medium')->orderBy('name', 'asc')->get();
        $data['rooms']['large'] = Room::where('type', 'large')->orderBy('name', 'asc')->get();

        return view('booking')->with($data);
    }


    /**
     * Display the user's profile form.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            ['roomName' => 'required'],
            ['roomName.required' => 'โปรดระบุ ห้องประชุม']
        );

        // checkText is null CheckBot
        if(empty($request->checkText)){
            try {
                $booking                    = new Booking;
                $token                      = $this->genToken($booking);
                $booking->token             = $token;
                $booking->room_name         = $request->roomName;
                $booking->image_path        = $request->imagePath;
                $booking->meeting_name      = $request->nameMeeting;
                $booking->activities        = $request->typeMission;
                $booking->firstname         = $request->firstname;
                $booking->lastname          = $request->lastname;
                $booking->organization_name = $request->organization;
                $booking->phone             = $request->phone;
                $booking->email             = $request->email;
                $booking->type_room         = $request->type;
                $booking->booking_datetime  = $request->date .' '. $request->time.':00';
                $booking->more_detail       = $request->detail;
                $booking->status            = 'new';
                $booking->save();

                try {
                    $this->mail('ระบบแจ้งเตือน ระบบจองห้องประชุม(TIJ)', 'แจ้งเตือนการจอง', $request->email, $token);
                } catch (\Throwable $e) {
                    return Redirect::route('booking')->with('status', 'booking-error');
                }

                return Redirect::route('booking.tacking', ['token' => $token])->with('status', 'booking-success');

            } catch (\Throwable $e) {

                return Redirect::route('booking')->with('status', 'booking-error');
            }
        }else{
            return abort(404);
        }
    }

     /**
     * Display the user's profile form.
     */
    public function tacking(Request $request)
    {
        $token = $request->token;
        if(!empty($token)){
            $count = Booking::where('token', $token)->count();
            if($count > 0){
                $data['booking'] = Booking::where('token', $token)->first();
                return view('tacking')->with($data);
            }
        }

        return abort(404);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function genToken($table, $prefix='', $id=0) {
        if(!$id)
        {
            $date_start = date('Y-m-1');
            $date_end = date('Y-m-d', strtotime('+1 day'));
            $order = $table::whereBetween('created_at', [$date_start, $date_end])->orderBy('created_at','desc')->count();

            if($order)
            {
                $id = $order;
            }
        }

        $year = (date('Y'));
        $month = date('m');
        $day = date('d');

        $hour = date('H');
        $min = date('i');
        $second = date('s');

        $number = str_pad($id + 1, 3, 0, STR_PAD_LEFT);
        $invoice_id = strtoupper(Str::random(2)) . $min .  strtoupper(Str::random(3)) . $second . $number;

        return $invoice_id;
    }


    public function mail($title, $body, $to, $token) {
        $mailBooking = [
            'title' => $title,
            'body' => $body
        ];

        Mail::to($to)->send(new BookingMail($mailBooking, $token));
        // dd('Email send successflly.');
    }
}
