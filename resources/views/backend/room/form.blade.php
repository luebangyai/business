@include('backend.partials.header')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            จัดการห้องประชุม
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($room) ? ' แก้ไขห้องประชุม' : ' เพิ่มห้องประชุม' }}</h4>
                        <hr>
                            @if(isset($room))
                                <form action="{{ route('backend.room.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @else
                                <form action="{{ route('backend.room.store') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @endif

                            <input type="hidden" value="{{ isset($room) ? $room->id : '' }}" name="room_id">
                            <div class="row">
                                <div class="col-4 form-group mt-3">
                                    @if(isset($room))
                                        <img src="{{ '/'. $room->cover }}" width="100%" alt="IMAGE">
                                    @endif
                                </div>
                                <div class="col-8 form-group mt-3">
                                    <div class="form-control">
                                        <label for="formFile" class="form-label">อัพโหลดรูป</label></label>
                                        <input class="form-control" type="file" id="formFile" name="cover"  @if(!isset($room)) required @endif>
                                    </div>
                                    <br>
                                    <hr>
                                    <br>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">ชื่อห้องประชุม</label>
                                        <input type="text" class="form-control" id="name" name="name"  maxlength="150" value="{{ isset($room) ? $room->name : '' }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">เลือกประเภทห้อง</label>
                                        <select class="form-select form-control text-dark" name="type" required>
                                            <option value="small">ขนาดเล็ก</option>
                                            <option value="medium">ขนาดกลาง</option>
                                            <option value="large">ขนาดใหญ่</option>
                                          </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="detail" class="col-form-label text-dark">รายละเอียด (ถ้ามี)</label>
                                <textarea class="form-control" name="detail" id="summernote" cols="30" rows="8">{{ isset($room) ? $room->detail : '' }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('backend.room.index') }}" class="btn btn-warning font-weight-medium auth-form-btn" type="button">
                                    <h3 class="text-dark"><i class="fas fa-undo"></i> ยกเลิก</h3>
                                </a>
                                <button class="btn btn-success font-weight-medium auth-form-btn ml-3" type="submit">
                                    <h3><i class="far fa-save"></i> บันทึก</h3>
                                </button>
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
</x-app-layout>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            height: 300
          });
      });
</script>

@include('backend.partials.footer')
