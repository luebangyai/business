<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Booking;

class HistoryController extends Controller
{
    public function history(Request $request) {
        $search  = isset($request->search) ? $request->search : '';

        $data['small'] = Booking::where('type_room', 'small')->count();
        $data['medium'] = Booking::where('type_room', 'medium')->count();
        $data['large'] = Booking::where('type_room', 'large')->count();

        if (!empty($search)){
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
        }else{
            $data['bookings'] = Booking::orderBy('status', 'asc')->paginate(20);
        }
        $data['search'] = $search;

        return view('backend.history')->with($data);
    }

    public function get_data(){

        $bookings = '';
        $user     = request()->user();
        $st_date  = date('Y-m-d 00:00:00');
        $ex_date  = date('Y-m-d 23:59:59');

        if(request()->get('st_date') && request()->get('ex_date')){
            $st_date = date('Y-m-d 00:00:00', strtotime(request()->get('st_date')));
            $ex_date = date('Y-m-d 23:59:59', strtotime(request()->get('ex_date')));
        }
        $bookings = Booking::whereBetween('booking_datetime', [$st_date, $ex_date])->orderBy('booking_datetime', 'asc')->get();

        $arr = [];
        foreach ($bookings as $key => $item){
            $arr[$key]['#'] = $key+1 ;
            $arr[$key]['ชื่อห้องประชุม'] = !empty($item->room_name) ? $item->room_name : '' ;
            $arr[$key]['ขนาดห้องประชุม'] = !empty($item->type_room) ? $item->type_room : '' ;
            $arr[$key]['ชื่อหน่วยงาน']= !empty($item->organization_name) ? $item->organization_name : '' ;
            $arr[$key]['ชื่องานที่จัดแสดง'] = !empty($item->meeting_name) ? $item->meeting_name : '' ;
            $arr[$key]['ลักษณะกิจกรรม'] = !empty($item->activities) ? $item->activities : '' ;
            $arr[$key]['ชื่อ'] = !empty($item->firstname) ? $item->firstname : '' ;
            $arr[$key]['นามสกุล'] = !empty($item->lastname) ? $item->lastname : '' ;
            $arr[$key]['อีเมล / เบอร์ติดต่อ']= (!empty($item->email) ? $item->email : '') ." / ". (!empty($item->phone) ? $item->phone : '') ;
            $arr[$key]['รายละเอียดเพิ่มเติม'] = !empty($item->more_detail) ? $item->more_detail : '' ;
            $arr[$key]['วันเวลาที่จอง'] = !empty($item->booking_datetime) ? date('d-m-Y H:i:s', strtotime($item->booking_datetime)) : '';
            if($item->status == 'approve'){
                $arr[$key]['สถานะ']= 'อนุมัติ';
            }elseif($item->status == 'new'){
                $arr[$key]['สถานะ']= 'รออนุมัติ';
            }else{
                $arr[$key]['สถานะ']= 'ไม่อนุมัติ';
            }
        }
        $jdata = $arr;

        return response()->json($jdata, 200);

    }
}
