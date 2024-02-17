<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Booking;

class ContactUsController extends Controller
{
    public function index(){
        return view('contactus');
    }

    public function calendar() {
        $data['type'] = request()->get('type') ? request()->get('type') : 'small';
        return view('backend.calendar')->with($data);
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    public function get_calendar() {

        $bookings = '';
        $type = request()->get('type');
        if(!empty($type)){
            $st_date = date('Y-m-d 00:00:00', strtotime( '-1 year'));
            $ex_date  = date('Y-m-d 23:59:59');

            $bookings = Booking::where('type_room', $type)
            ->where('status', 'approve')
            ->whereBetween('booking_datetime', [$st_date, $ex_date])
            ->orderBy('booking_datetime', 'asc')
            ->get();

            $arr = [];
            foreach ($bookings as $key => $item){
                $arr[$key]['title'] = !empty($item->meeting_name) ? $item->meeting_name : '' ;
                $arr[$key]['start'] = !empty($item->booking_datetime) ? date('Y-m-d', strtotime($item->booking_datetime)) : '';
            }

            $jdata = $arr;
        }
        return response()->json($jdata, 200);
    }
}
