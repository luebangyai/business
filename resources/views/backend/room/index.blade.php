@include('backend.partials.header')
<style>
    .card .card-body {
        padding: 1rem 1rem;
    }
    .border {
        border: 2px solid #423898 !important;
    }

    .table td img, .jsgrid .jsgrid-table td img {
        width: unset !important;
        height: unset !important;
        border-radius: unset !important;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            จัดการห้องประชุม
        </h2>
    </x-slot>
    <div class="page">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="row">
                        <a href="{{ route('backend.room.index', ['type' => 'small']) }}"  type="button" class="col-4 grid-margin stretch-card">

                                <div class="card text-center rounded-4" id="card1">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="/images/category/meeting-small.png" width="55" alt="profile" class="align-items-center">
                                        </div>
                                        <h1 class="font-weight-bold pb-2 pt-4">ห้องประชุมขนาดเล็ก</h1>
                                    </div>
                                </div>

                        </a>

                        <a href="{{ route('backend.room.index', ['type' => 'medium']) }}"  type="button"  class="col-4 grid-margin stretch-card">

                                <div class="card text-center rounded-4" id="card2">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="/images/category/meeting-medium.png" width="55" alt="profile" class="align-items-center">
                                        </div>
                                        <h1 class="font-weight-bold pb-2 pt-4">ห้องประชุมขนาดกลาง</h1>

                                    </div>
                                </div>

                        </a>
                        <a href="{{ route('backend.room.index', ['type' => 'large']) }}"  type="button" class="col-sm-4 grid-margin stretch-card">

                                <div class="card text-center rounded-4" id="card3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                            <img src="/images/category/meeting-large.png" width="55" alt="profile" class="align-items-center">
                                        </div>
                                        <h1 class="font-weight-bold pb-2 pt-4">ห้องประชุมขนาดใหญ่</h1>

                                    </div>
                                </div>

                        </a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="row mt-1">
                            <div class="col-10">
                                <h4 class="card-title">รายชื่อห้อง</h4>
                            </div>
                            <div class="col-2 d-flex justify-content-end">
                                <a href="{{ route('backend.room.create') }}">
                                    <button class="btn btn-success  mr-3"><i class="fas fa-plus"></i> เพิ่มห้อง</button>
                                </a>

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
                                        <th scope="col">รูป</th></th>
                                        <th scope="col">ชื่อห้อง</th>
                                        <th scope="col">ประเภท</th></th>
                                        <th scope="col" style="max-width: 300px;">รายละเอียด</th>
                                        <th scope="col">จัดการ</th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($rooms) && count($rooms) > 0)
                                            @foreach ($rooms as $key => $room)
                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td>
                                                    <img src="{{ isset($room) ? $room->cover : '' }}" alt="">
                                                </td>
                                                <td>
                                                    <p>{{ $room->name }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $room->type }}</p>
                                                </td>
                                                <td style="max-width: 300px;">
                                                    <p>{!! $room->detail !!}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('backend.room.edit', $room->id) }}" class="btn btn-warning font-weight-medium auth-form-btn" type="button">
                                                        <h3 class="text-dark"><i class="fas fa-edit"></i> แก้ไข</h3>
                                                    </a>
                                                    <button onclick="confirm_url('room/destroy/{{ $room->id }}',  ' Delete')"
                                                        class="btn btn-danger ml-3 text-dark font-weight-medium auth-form-btn"  type="button">
                                                        <i class="fas fa-trash"></i> ลบ
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                    </table>
                                </div>

                            </div>
                            </div>
                        </div>



                        </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>

@include('backend.partials.footer')

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
