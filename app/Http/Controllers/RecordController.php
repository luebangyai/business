<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

use App\Mail\BookingMail;

class RecordController extends Controller
{
    public function record(Request $request) : View {

        $type  = isset($request->type) ? $request->type : '';
        $search  = isset($request->search) ? $request->search : '';

        $start = ' 00:00:00';
        $end = ' 23:59:59';
        $st_date  = isset($request->st_date) ? $request->st_date : '';
        $ex_date  = isset($request->ex_date) ? $request->ex_date : '';

        $data['pending'] = Booking::where('type_room', 'small')->count();
        $data['success'] = Booking::where('type_room', 'medium')->count();
        $data['reject'] = Booking::where('type_room', 'large')->count();

        if (!empty($search)){
            if(!empty($type)){
                $data['bookings'] = Booking::orderBy('status', 'asc')->where('type_room', $type)
                ->orWhere('meeting_name', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('meeting_name', 'like', '%' . $search . '%')
                ->orWhere('activities', 'like', '%' . $search . '%')
                ->orWhere('organization_name', 'like', '%' . $search . '%')
                ->paginate(20);
            }else{
                $data['bookings'] = Booking::orderBy('status', 'asc')
                ->where('meeting_name', 'like', '%' . $search . '%')
                ->orWhere('firstname', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('meeting_name', 'like', '%' . $search . '%')
                ->orWhere('activities', 'like', '%' . $search . '%')
                ->orWhere('organization_name', 'like', '%' . $search . '%')
                ->paginate(20);
            }

        }elseif(!empty($st_date) && !empty($ex_date)){
            if(!empty($type)){
                $data['bookings'] = Booking::orderBy('status', 'asc')->where('type_room', $type)
                ->whereBetween('booking_datetime', [$st_date. $start, $ex_date. $end])
                ->paginate(20);
            }else{
                $data['bookings'] = Booking::orderBy('status', 'asc')
                ->whereBetween('booking_datetime', [$st_date. $start, $ex_date. $end])
                ->paginate(20);
            }
        }else{
            if(!empty($type)){
                $data['bookings'] = Booking::where('type_room', $type)->orderBy('status', 'asc')->paginate(20);
            }else{
                $data['bookings'] = Booking::orderBy('status', 'asc')->paginate(20);
            }
        }
        $data['search'] = $search;
        $data['type'] = $type;
        $data['st_date'] = $st_date;
        $data['ex_date'] = $ex_date;

        return view('backend.booking')->with($data);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $token  = isset($request->token) ? $request->token : '';
        $data['booking'] = Booking::where('token', $request->token)->first();
        return view('backend.form')->with($data);
    }

    /**
     * Update the user's profile information.
     */
    public function action($token="", $status="")
    {

        if(!empty($token) && !empty($status)){
            $booking = Booking::where('token', $token)->where('status', 'new')->first();
            $booking->status = $status;
            $booking->update();
        }

        $this->mail('ระบบแจ้งเตือน ระบบจองห้องประชุม(TIJ)', $status, $booking->email, $token);
        return redirect()->back()->with('sweet-thankyou', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        if(!empty($request->booking_id) && !empty($request->firstname) && !empty($request->lastname)){
            $booking = Booking::where('id', $request->booking_id)->first();
            $booking->meeting_name      = $request->nameMeeting;
            $booking->activities        = $request->typeMission;
            $booking->firstname         = $request->firstname;
            $booking->lastname          = $request->lastname;
            $booking->organization_name = $request->organization;
            $booking->phone             = $request->phone;
            $booking->email             = $request->email;
            $booking->booking_datetime  = $request->date .' '. $request->time.':00';
            $booking->more_detail       = $request->detail;
            $booking->update();
        }
        return redirect()->back()->with('sweet-thankyou', 'บันทึกข้อมูลสำเร็จ');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(string $token='', $status)
    {
        if(!empty($token && !empty($status))){
            $check = Booking::where('token', $token)->count();
            if($check > 0 && $status == 'delete'){
                $room = Booking::where('token', $token)->first();
                $room->delete();

                return redirect()->back()->with('sweet-thankyou', 'บันทึกข้อมูลสำเร็จ');
            }else{
                return redirect()->back()->with('sweet-thankyou', 'บันทึกข้อมูลไม่สำเร็จ');
            }
        }
        return redirect()->back()->with('sweet-thankyou', 'บันทึกข้อมูลไม่สำเร็จ');
    }


    public function mail($title, $body, $to, $token) {
        $mailBooking = [
            'title' => $title,
            'body' => $body,
        ];

        Mail::to($to)->send(new BookingMail($mailBooking, $token));
        // dd('Email send successflly.');
    }
}
