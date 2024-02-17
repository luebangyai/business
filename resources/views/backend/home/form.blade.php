@include('backend.partials.header')
@php
if(request()->get('type') == 'download'){
  $type = "ดาวน์โหลด";
}elseif(request()->get('type') == 'blog'){
  $type = "บทความ";
}elseif(request()->get('type') == 'slide'){
  $type = "สไลด์";
}else{
  $type = "ผลิตภัณฑ์ของเรา";
}
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            จัดการ{{ $type }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="card-title">{{ isset($room) ? ' แก้ไข' . $type : ' เพิ่ม' . $type }}</h4>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        
                    
                            @if(isset($room))
                                <form action="{{ route('backend.our.product.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @else
                                <form action="{{ route('backend.our.product.store') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @endif

                            <input type="hidden" value="{{ isset($room) ? $room->id : '' }}" name="room_id">
                            <input type="hidden" value="{{ !empty(request()->get('type')) ? request()->get('type') : 'our-product' }}" name="type">
                            <div class="row">
                                <div class="col-5 form-group mt-3 mb-3">
                                  <div class="d-flex justify-content-center">
                                    @if(isset($room))
                                      <img src="{{ '/'. $room->cover }}" width="100%" alt="IMAGE">
                                    @else
                                      <div class="d-flex justify-content-center" style="background-color: #f3f4f6; height: 171px !important; width: 100%;">
                                        <p class="mt-5">No IMAGES</p>
                                      </div>
                                    @endif
                                  </div>

                                    <br>
                                    <hr>
                                    <div class="form-control">
                                      <label for="formFile" class="form-label">อัพโหลดรูป</label></label>
                                      <input class="form-control" type="file" id="formFile" name="cover"  @if(!isset($room)) required @endif>
                                    </div>
                                </div>
                                <div class="col-7 form-group mt-3">
                                   
                         
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">
                                          @php
                                          if(request()->get('type') == 'download'){
                                            $type = "ชื่อดาวน์โหลด";
                                          }elseif(request()->get('type') == 'blog'){
                                            $type = "ชื่อบทความ";
                                          }elseif(request()->get('type') == 'slide'){
                                            $type = "ชื่อสไลด์";
                                          }else{
                                            $type = "ชื่อผลิตภัณฑ์ของเรา";
                                          }
                                          @endphp
                                          {{ $type }}
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"  maxlength="150" value="{{ isset($room) ? $room->name : '' }}" required>
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="name" class="col-form-label text-dark">เรียงตำแหน่ง</label>
                                        <select class="form-select form-control text-dark" name="sort" required>
                                            @for ($i=1; $i<= 20; $i++)
                                              @if(isset($room) && $room->sort == $i)  
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                              @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                              @endif
                                            @endfor
                                          </select>
                                    </div>
                                    @if(request()->get('type') != 'download')
                                    <div class="form-group mt-2">
                                      <label for="name" class="col-form-label text-dark">
                                        @php
                                        if(request()->get('type') == 'download'){
                                          $type = "รายละเอียดลิงค์สำหรับดาวน์โหลด";
                                        }elseif(request()->get('type') == 'blog'){
                                          $type = "รายละเอียดบทความ";
                                        }elseif(request()->get('type') == 'slide'){
                                          $type = "รายละเอียดสไลด์";
                                        }else{
                                          $type = "รายละเอียดผลิตภัณฑ์";
                                        }
                                        @endphp
                                        {{ $type }}
                                      </label>
                                      <textarea id="detail" name="detail" cols="30" rows="5" class="form-control {{ request()->get('type') == 'blog' ? 'summernote' : '' }}">{{ isset($room) ? $room->detail : '' }}</textarea>
                                    </div>
                                    @else
                                    <div class="form-group mt-3">
                                      <label for="name" class="col-form-label text-dark">Path File</label>
                                      <div class="form-control">
                                        <p>{{ isset($room) ? $room->detail : '' }}</p>
                                        <br>
                                        <hr>
                                        <br>
                                        <label for="formFile" class="form-label">อัพโหลด File PDF</label></label>
                                        <input class="form-control" type="file" id="formFile" name="detail">
                                      </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('backend.our.product.index') }}" class="btn btn-warning font-weight-medium auth-form-btn" type="button">
                                    <h3 class="text-dark"><i class="fas fa-times"></i> ยกเลิก</h3>
                                </a>
                                <button class="btn btn-success font-weight-medium auth-form-btn ml-3" type="submit">
                                    <h3 class="text-dark"><i class="far fa-save"></i> บันทึก</h3>
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
        $('.summernote').summernote({
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
