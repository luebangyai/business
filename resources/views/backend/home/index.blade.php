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
          @if(request()->get('type') == 'download')
          ดาวน์โหลด
          @elseif(request()->get('type') == 'blog')
          บทความ
          @elseif(request()->get('type') == 'slide')
          สไลด์
          @else
          ผลิตภัณฑ์ของเรา
          @endif
        </h2>
    </x-slot>
    <div class="page">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
         

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="row mt-2">
                            <div class="col-9">
                                <h4 class="card-title">
                                  @if(request()->get('type') == 'download')
                                  ดาวน์โหลด
                                  @elseif(request()->get('type') == 'blog')
                                  บทความ
                                  @elseif(request()->get('type') == 'slide')
                                  สไลด์
                                  @else
                                  ผลิตภัณฑ์ของเรา
                                  @endif
                                </h4>
                            </div>
                            <div class="col-3 d-flex justify-content-end">
                                <a href="{{ route('backend.our.product.create', ['type' => request()->get('type')]) }}">
                                    <button class="btn btn-success  mr-3"><i class="fas fa-plus"></i> เพิ่ม
                                      @if(request()->get('type') == 'download')
                                      ดาวน์โหลด
                                      @elseif(request()->get('type') == 'blog')
                                      บทความ
                                      @elseif(request()->get('type') == 'slide')
                                      สไลด์
                                      @else
                                      ผลิตภัณฑ์ของเรา
                                      @endif
                                    </button>
                                </a>

                            </div>
                        </div>
                        <div class="card-body mt-4">

                            <div class="row">
                            <div class="col-12">

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">รูป</th></th>
                                        <th scope="col">ชื่อ</th>
                                        <th scope="col">ลำดับ</th></th>
                                        <th scope="col" style="max-width: 300px;">รายละเอียด</th>
                                        <th scope="col">จัดการ</th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($rooms) && count($rooms) > 0)
                                            @foreach ($rooms as $key => $room)
                                            <tr>
                                                <th scope="row" >{{ $key+1 }}</th>
                                                <td>
                                                    <img src="{{ isset($room) ? $room->cover : '' }}" class="img-fluid img-thumbnail" alt="" style="width: 100px !important;">
                                                </td>
                                                <td>
                                                    <p>{{ $room->name }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $room->sort }}</p>
                                                </td>
                                                <td style="width: 300px;">
                                                    <p>{!! $room->detail !!}</p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('backend.our.product.edit', $room->id . '?type=' . request()->get('type')) }}" class="btn btn-warning font-weight-medium auth-form-btn" type="button">
                                                        <h3 class="text-dark"><i class="fas fa-edit"></i> แก้ไข</h3>
                                                    </a>
                                                    <button onclick="confirm_url('our-product/destroy/{{ $room->id }}',  ' Delete')"
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
