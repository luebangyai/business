@include('backend.partials.header')
<style>
    .leading-5 {
        display: none;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายการจอง
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="row">
                        <button class="col-md-4 grid-margin">
                            <a href="{{ route('backend.record', ['type' => 'small']) }}">
                                <div class="card text-bg-info d-flex align-items-center">
                                    <div class="card-body">
                                        <div class="d-flex flex-row align-items-center">
                                            {{--  <i class="mdi mdi-facebook text-white icon-md"></i>  --}}

                                            {{--  <i class="fas fa-envelope text-white icon-md"></i>  --}}
                                            <img src="/images/category/meeting-small.png" width="35" alt="profile" class="align-items-center">
                                            <div class="ml-3">
                                                <h6 class="text-white" style="font-weight: bold;">ห้องประชุมขนาดเล็ก</h6>
                                                <p class="mt-2 text-white card-text" style="font-weight: bold;">จำนวน {{ number_format($pending) }} รายการ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </button>
                        <button class="col-md-4 grid-margin">
                            <a href="{{ route('backend.record', ['type' => 'medium']) }}">
                                <div class="card bg-success d-flex align-items-center">
                                    <div class="card-body">
                                        <div class="d-flex flex-row align-items-center">
                                            {{--  <i class="mdi mdi-linkedin text-white icon-md"></i>  --}}
                                            {{--  <i class="fas fa-envelope-open text-white icon-md"></i>  --}}
                                            <img src="/images/category/meeting-medium.png" width="35" alt="profile" class="align-items-center">
                                            <div class="ml-3">
                                                <h6 class="text-white" style="font-weight: bold;">ห้องประชุมขนาดกลาง</h6>
                                                <p class="mt-2 text-white card-text" style="font-weight: bold;">จำนวน {{ number_format($success) }} รายการ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </button>
                        <button class="col-md-4 grid-margin">
                            <a href="{{ route('backend.record', ['type' => 'large']) }}">
                                <div class="card bg-danger d-flex align-items-center">
                                    <div class="card-body">
                                        <div class="d-flex flex-row align-items-center">
                                            {{--  <i class="mdi mdi-twitter text-white icon-md"></i>  --}}

                                            {{--  <i class="fas fa-trash-alt text-white icon-md"></i>  --}}
                                            <img src="/images/category/meeting-large.png" width="35" alt="profile" class="align-items-center">

                                            <div class="ml-3">
                                                <h6 class="text-white" style="font-weight: bold;">ห้องประชุมขนาดใหญ่</h6>
                                                <p class="mt-2 text-white card-text" style="font-weight: bold;">จำนวน {{ number_format($reject) }} รายการ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </button>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            {{--  <div class="dataTables_length" id="order-listing_length">
                                <label>Show
                                    <select name="order-listing_length" aria-controls="order-listing" class="custom-select custom-select-sm form-control">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="-1">All</option>
                                    </select> entries
                                </label>
                            </div>  --}}
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="input-group mb-3">
                                <form action="{{ route('backend.record') }}" method="GET" class="w-100">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <div class="input-group input-daterange d-flex align-items-center">
                                                <div class="input-group-addon mx-4 text-dark">วันที่จอง</div>
                                                <input class="form-control" id="st_date" type="date" name="st_date" value="{{ request()->get('st_date') }}" required>
                                                <div class="input-group-addon mx-4 text-dark">ถึง</div>
                                                <input class="form-control" id="ex_date" type="date" name="ex_date" required pattern="[0-9]{4}-[0-9]{2}" value="{{ request()->get('ex_date') }}">
                                            </div>
                                        </div>

                                        <div class="col-8">
                                            <input type="text" class="form-control w-100" name="search" value="{{ request()->get('search') }}" placeholder="ค้นหาข้อมูลที่ต้องการ เช่น ชื่อ นามสกล ...">
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-outline-primary w-100" type="submit" id="button-addon2">ค้นหา</button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="card-title">รายการ</h4>
                        <div class="row">
                          <div class="col-12">

                            <div class="table-responsive">
                              <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ห้องที่ต้องการจอง</th></th>
                                    {{--  <th scope="col">กิจกรรม</th>  --}}
                                    <th scope="col">รายละเอียด</th></th>
                                    <th scope="col">วันเวลาที่จอง</th></th>
                                    <th scope="col">สถานะ</th>
                                    <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $key => $booking)
                                    <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td style="width: 220px;">
                                        <p>ชื่อห้อง: {{ $booking->room_name }}</p>
                                        <p>ขนาด: {{ $booking->type_room }}</p>
                                    </td>

                                    <td style="width: 250px;">
                                        <p>ชื่อ นามสกุล: {{ $booking->firstname }} {{ $booking->lastname }}</p>
                                        <p>เบอร์ติดต่อ: {{ $booking->phone }}</p>
                                        <p>อีเมล: {{ $booking->email }}</p><br>
                                    </td>
                                    <td>
                                        <p>{{ date("d/m/Y H:i", strtotime($booking->booking_datetime)) }}</p>
                                    </td>
                                    <td>
                                        @if($booking->status == 'new')
                                            <label class="badge badge-warning">รออนุมัติ</label>
                                        @elseif($booking->status == 'approve')
                                            <label class="badge badge-success">อนุมัติ</label>
                                        @elseif($booking->status == 'reject')
                                            <label class="badge badge-danger">ไม่อนุมัติ</label>
                                        @endif
                                    </td>
                                    <td style="width: 250px;">
                                      {{--  <div class="modal fade" id="view-{{ $booking->token }}" tabindex="-1" role="dialog" aria-labelledby="viewLabel" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h3 class="modal-title" id="viewLabel">รายละเอียดการจอง</h3>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <label for="">วันเวลาที่จอง</label>
                                              <h4>{{ date("d/m/Y H:i", strtotime($booking->booking_datetime)) }}</h4><br><hr><br>

                                              <p>ชื่อ นามสกุล: {{ $booking->firstname }} {{ $booking->lastname }}</p>
                                              <p>เบอร์ติดต่อ: {{ $booking->phone }}</p>
                                              <p>อีเมล: {{ $booking->email }}</p><br><hr><br>

                                              <div class="row">
                                                <div class="col-6">
                                                    <img src="{{ $booking->image_path }}" class="mr-3 rounded" style="height: 250px; width: 250px;" alt="">
                                                </div>
                                                <div class="col-6">
                                                    <p>ชื่อห้อง: {{ $booking->room_name }}</p>
                                                    <p>ขนาด: {{ $booking->type_room }}</p>
                                                </div>
                                              </div><br><hr><br>
                                              <p>ชื่องานที่จัดแสดง: {{ $booking->meeting_name }}</p>
                                              <p>ลักษณะกิจกรรม: {{ $booking->activities }}</p>
                                              <p>ชื่อหน่วยงาน: {{ $booking->organization_name }}</p><br><hr><br>
                                              <p>เพิ่มเติม : {{ $booking->more_detail }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                @if($booking->status == 'pending')
                                                <button onclick="confirm_url('booking/action/{{ $booking->token }}/approve',  ' Approve')"
                                                    class="btn btn-success text-success"  type="button">
                                                    อนุมัติ
                                                </button>
                                                <button onclick="confirm_url('booking/action/{{ $booking->token }}/reject', ' Reject')"
                                                    class="btn btn-danger text-danger"  type="button">
                                                      ไม่อนุมัติ
                                                </button>
                                                @endif
                                                <button type="button" class="btn btn-light" data-dismiss="modal">ปิด</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>  --}}

                                      <div class="">
                                        <a href="{{ route('booking.edit', ['token' => $booking->token]) }}">
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="fa fa-eye ml-1"></i> รายละเอียด
                                            </button>
                                        </a>

                                        @if(Auth::user()->hasRole('management|superadmin'))
                                            <button onclick="confirm_url('/booking/destroy/{{ $booking->token }}/delete', ' ลบ')"
                                                class="btn btn-outline-danger text-danger ml-2"  type="button">
                                                <i class="fas fa-trash"></i> ลบ
                                            </button>
                                        @endif

                                    </div>
                                    </td>
                                  </tr>
                                  @endforeach

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>

                    <nav>
                      <ul class="pagination d-flex justify-content-center">
                        {{ $bookings->appends(['search' => $search , 'type' => $type ,'st_date' => $st_date, 'ex_date' => $ex_date])->links() }}
                      </ul>
                    </nav>

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

    @if(empty($st_date) && empty($st_date))
    <script>
        var input_st_date =  '{{ date('Y-m-d',strtotime('-7 days')) }}';
        document.getElementById('st_date').valueAsDate = new Date(input_st_date);
        document.getElementById('ex_date').valueAsDate = new Date();
    </script>
    @endif

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
