@include('backend.partials.header')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายการจอง
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        <h4 class="card-title">รายละเอียดการแก้ไขการจอง</h4>
                        <hr>


                        <form action="{{ route('booking.update') }}" method="POST" class="pt-3" >
                            @csrf

                            <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                            <div class="form-group">
                                <label for="roomName" class="col-form-label text-dark">ห้องที่ต้องการจอง</label>
                                <input type="text" name="roomName" class="form-control" id="roomName" placeholder="" maxlength="150" style="background-color: #f0f0f0;" value="{{ $booking->room_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nameMeeting" class="col-form-label text-dark">ชื่องานที่จัดแสดง (ถ้ามี)</label>
                                <input type="text" class="form-control" id="nameMeeting" name="nameMeeting" placeholder="ชื่องานที่จัดแสดง" maxlength="150" value="{{ $booking->meeting_name }}">
                            </div>
                            <div class="form-group">
                                <label for="typeMission" class="col-form-label text-dark">ลักษณะกิจกรรม (ถ้ามี)</label>
                                <input type="text" class="form-control" id="typeMission" name="typeMission" placeholder="ลักษณะกิจกรรม" maxlength="150" value="{{ $booking->activities }}">
                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="firstname" class="col-form-label text-dark">ชื่อ<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" required maxlength="150" value="{{ $booking->firstname }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="lastname" class="col-form-label text-dark">นามสกุล<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" required maxlength="150" value="{{ $booking->lastname }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="organization" class="col-form-label text-dark">ชื่อหน่วยงาน <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="organization" name="organization" placeholder="ชื่อหน่วยงาน" required maxlength="150" value="{{ $booking->organization_name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label text-dark">เบอร์ติดต่อ (โทรศัพท์/line) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="เบอร์ติดต่อ" required maxlength="10" minlength="9" value="{{ $booking->phone }}">
                            </div>
                            <div class="form-group">
                              <label for="email" class="col-form-label text-dark">อีเมล <span class="text-danger">*</span></label>
                              <input type="email" class="form-control" id="email" name="email" placeholder="อีเมล" required maxlength="100" value="{{ $booking->email }}">
                            </div>

                            <div class="form-group">
                                <label for="datepicker" class=" col-form-label text-dark">เลือกวันที่จอง <span class="text-danger">*</span></label>
                                <div id="datepicker" class="input-group date datepicker">
                                    <input id="date" type="date" class="form-control" name="date"
                                    value="{{ date('Y-m-d', strtotime($booking->booking_datetime)) }}" required>
                                    {{--  <span class="input-group-addon input-group-append border-left">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </span>  --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nameMeeting" class="col-form-label text-dark">เวลาที่จอง <span class="text-danger">*</span></label>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <div class="input-group" data-target="#timepicker" data-toggle="datetimepicker">
                                        <input id="time" type="time" class="form-control datetimepicker-input" data-target="#timepicker" name="time"
                                        value="{{ date('H:i', strtotime($booking->booking_datetime)) }}" required>
                                        {{--  <div class="input-group-addon input-group-append">
                                            <i class="far fa-clock input-group-text"></i>
                                        </div>  --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail" class="col-form-label text-dark">รายละเอียดเพิ่มเติม (ถ้ามี)</label>
                                <textarea class="form-control" name="detail" id="detail" cols="30" rows="8">{{ $booking->more_detail }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('backend.record') }}" class="btn btn-warning font-weight-medium auth-form-btn" type="button">
                                    <h3 class="text-dark"><i class="fas fa-undo"></i> ยกเลิก</h3>
                                </a>
                                <button class="btn btn-success font-weight-medium auth-form-btn ml-3" type="submit">
                                    <h3><i class="far fa-save"></i> บันทึก</h3>
                                </button>
                                @if($booking->status == 'new')
                                <button onclick="confirm_url('booking/action/{{ $booking->token }}/approve',  ' Approve')"
                                    class="btn btn-success ml-3 text-dark font-weight-medium auth-form-btn"  type="button">
                                    <i class="fas fa-check"></i> อนุมัติ
                                </button>

                                <button onclick="confirm_url('booking/action/{{ $booking->token }}/reject', ' Reject')"
                                    class="btn btn-danger ml-3 text-dark font-weight-medium auth-form-btn"  type="button">
                                    <i class="fas fa-times"></i> ไม่อนุมัติ
                                </button>
                                @endif
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal hide fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="circle-loader"></div>
                    <h2 class="text-center mt-4">กำลังโหลด...</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirm_url(url, type='confirm') {
            swal({
                title: "คุณแน่ใจไหม?",
                text: "คุณแน่ใจไหมว่าต้องการดำเนินการ " + type,
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                cancelButtonText: "ไม่ใช่",
                confirmButtonText: "ใช่",
                confirmButtonClass: 'btn-success',
            },
            function() {
                $('#myModal').modal({backdrop: 'static', keyboard: false})
                window.location = url;
            });
        }
    </script>
</x-app-layout>

@include('backend.partials.footer')
