@include('backend.partials.header')
<style>
    .card .card-body {
        padding: 1rem 1rem;
    }
    .border {
        border: 2px solid #423898 !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ประวัติการจอง
        </h2>
    </x-slot>
    <div class="page">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                        <button class="col-sm-4 grid-margin stretch-card" type="button" >
                            <div class="card text-center rounded-4" id="card1">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="/images/category/meeting-small.png" width="55" alt="profile" class="align-items-center">
                                    </div>
                                    <h1 class="font-weight-bold mb-4 pb-2 pt-4">ห้องประชุมขนาดเล็ก</h1>
                                    <h2 class="font-weight-bold display-3 mt-4 mb-4">{{ number_format($small) }}</h2>
                                </div>
                            </div>
                        </button>
                        <button class="col-sm-4 grid-margin stretch-card" type="button" >
                            <div class="card text-center rounded-4" id="card2">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="/images/category/meeting-medium.png" width="55" alt="profile" class="align-items-center">
                                    </div>
                                    <h1 class="font-weight-bold mb-4 pb-2 pt-4">ห้องประชุมขนาดกลาง</h1>
                                    <h2 class="font-weight-bold display-3 mt-4 mb-4">{{ number_format($medium) }}</h2>
                                </div>
                            </div>
                        </button>
                        <button class="col-sm-4 grid-margin stretch-card" type="button" >
                            <div class="card text-center rounded-4" id="card3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <img src="/images/category/meeting-large.png" width="55" alt="profile" class="align-items-center">
                                    </div>
                                    <h1 class="font-weight-bold mb-4 pb-2 pt-4">ห้องประชุมขนาดใหญ่</h1>
                                    <h2 class="font-weight-bold display-3 mt-4 mb-4">{{ number_format($large) }}</h2>
                                </div>
                            </div>
                        </button>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="row mt-1">
                            <div class="col-5">
                                <h4 class="card-title">รายการ</h4>
                            </div>
                            <div class="col-5">

                                <div class="input-group input-daterange d-flex align-items-center">

                                    <div class="input-group-addon mx-4">ตั้งแต่วันที่</div>


                                    {{--  <input type="datetime" class="form-control" value="2012-04-05">  --}}
                                    <input class="form-control" id="st_date" type="date" name="st_date"
                                        value="" required>
                                    <div class="input-group-addon mx-4">ถึง</div>
                                    {{--  <input type="date" class="form-control" id="date" value="">  --}}

                                    <input class="form-control" id="ex_date" type="date" name="ex_date" required
                                    pattern="[0-9]{4}-[0-9]{2}" value="">
                                </div>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a id="DLtoExcel" onClick="clickdataorders();">
                                    <button class="btn btn-outline-success w-100">
                                        <i class="fas fa-file-excel"></i> Export Excel
                                    </button>
                                </a>
                            </div>

                            <div id="dvjson"></div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-12 col-md-6 mb-3">

                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group mb-3">
                                    <form action="{{ route('backend.history') }}" method="GET" class="w-100">
                                        @csrf
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" class="form-control w-100" name="search" value="{{ request()->get('search') }}" placeholder="ค้นหาข้อมูลที่ต้องการ เช่น ชื่อ นามสกล ...">
                                            </div>
                                            <div class="col-2">
                                                <button class="btn btn-outline-primary w-100" type="submit" id="button-addon2">ค้นหา</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class="row">
                            <div class="col-12">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ห้องที่ต้องการจอง</th></th>
                                        <th scope="col">กิจกรรม</th>
                                        <th scope="col">รายละเอียด</th></th>
                                        <th scope="col" style="max-width: 200px;">รายละเอียดเพิ่มเติม</th>
                                        <th scope="col">วันเวลาที่จอง</th></th>
                                        <th scope="col">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $key => $booking)
                                        <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>
                                            <p>ชื่อห้อง: {{ $booking->room_name }}</p>
                                            <p>ขนาด: {{ $booking->type_room }}</p>
                                        </td>
                                        <td>
                                          <p>ชื่องานที่จัดแสดง: {{ $booking->meeting_name }}</p>
                                          <p>ลักษณะกิจกรรม: {{ $booking->activities }}</p>
                                          <p>ชื่อหน่วยงาน: {{ $booking->organization_name }}</p>
                                        </td>
                                        <td>
                                            <p>ชื่อ นามสกุล: {{ $booking->firstname }} {{ $booking->lastname }}</p>
                                            <p>เบอร์ติดต่อ: {{ $booking->phone }}</p>
                                            <p>อีเมล: {{ $booking->email }}</p>
                                        </td>
                                        <td style="max-width: 200px;">
                                            {{ $booking->more_detail }}
                                        </td>
                                        <td>
                                            <p>{{ date("d/m/Y H:i", strtotime($booking->booking_datetime)) }}</p>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <label class="badge badge-warning">รออนุมัติ</label>
                                            @elseif($booking->status == 'approve')
                                                <label class="badge badge-success">อนุมัติ</label>
                                            @elseif($booking->status == 'reject')
                                                <label class="badge badge-danger">ไม่อนุมัติ</label>
                                            @endif
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
                            {{ $bookings->appends(['search' => $search ])->links() }}
                            </ul>
                        </nav>

                        </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@include('backend.partials.footer')

<script src="js/excelexportjs.js" type="text/javascript"></script>
<script src="plugins/jquery-loading-overlay/loadingoverlay.js"></script>

<script>
      var input_st_date =  '{{ date('Y-m-d',strtotime('-1 months')) }}';
      document.getElementById('st_date').valueAsDate = new Date(input_st_date);
      document.getElementById('ex_date').valueAsDate = new Date();

    function card1(){
        $('#card1').addClass('border');
        $('#card2').removeClass('border');
        $('#card3').removeClass('border');
    }

    function card2(){
        $('#card1').removeClass('border');
        $('#card2').addClass('border');
        $('#card3').removeClass('border');
    }

    function card3(){
        $('#card1').removeClass('border');
        $('#card2').removeClass('border');
        $('#card3').addClass('border');
    }


    function clickdataorders() {

        var start_date = $("#st_date").val();
        var end_date = $("#ex_date").val();

        if (start_date != '' && end_date != '') {


            $('.page').LoadingOverlay("show");
            $('.site-menubar').LoadingOverlay("show");

            $.ajax({
                type: "POST",
                url: "/history/excel-json",
                data: {
                    st_date: start_date,
                    ex_date: end_date,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(result) {

                    $('.page').LoadingOverlay("hide", true);
                    $('.site-menubar').LoadingOverlay("hide", true);

                    var data = result;

                    if(data.length > 0 )
                    {
                        let uri = $("#dvjson").excelexportjs({
                            containerid: "dvjson"
                            , datatype: 'json'
                            , dataset: data
                            , worksheetName: "BookingReport"
                            , columns: getColumns(data)
                            , fileName: 'BookingReport-' + start_date + '-' +end_date + '.xls'

                        });
                    }
                    else
                    {
                        swal({
                            type: "warning",
                            title: "แจ้งเตือน",
                            text: "ไม่พบข้อมูลรายงานในวันที่ท่านระบุ",
                            confirmButtonClass: "btn-warning",
                        });
                    }
                },
                error: function(xhr) {
                    swal({
                        type: "danger",
                        title: "แจ้งเตือน",
                        text: "เกิดข้อผิดพลาดระหว่างทำงาน กรุณาปิดหน้าต่างแล้วเริ่มต้นใหม่",
                        confirmButtonClass: "btn-danger",
                    });
                }
            });

        } else {

            $('.page').LoadingOverlay("hide", true);
            $('.site-menubar').LoadingOverlay("hide", true);

            toastr.warning('กรุณากรอกข้อมูลวันที่!');

        }
    }
</script>
