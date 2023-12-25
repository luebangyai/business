@include('backend.partials.header')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            จัดการ{{ (isset($type) && $type == 'header') ? 'ส่วนแรก' : 'ส่วนการติดต่อ' }}
        </h2>
    </x-slot>

    @if($type == 'header')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        <h4 class="card-title">แก้ไขส่วนแรก</h4>
                        <hr>
                            @if(isset($content))
                                <form action="{{ route('backend.content.update', $content->id) }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @else
                                <form action="{{ route('backend.content.store') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @endif

                            <input type="hidden" value="{{ isset($type) ? $type : '' }}" name="type">
                            <input type="hidden" value="{{ isset($content) ? $content->id : '' }}" name="content_id">

                            <div class="row">
                                <div class="col-4 form-group">
                                    @if(isset($content))
                                        <video class="elementor-video"
                                            width="100%"
                                            src="{{ '/'. $content->cover }}"
                                            autoplay=""
                                            loop=""
                                            controls=""
                                            muted="muted"
                                            playsinline=""
                                            controlslist="nodownload">
                                        </video>

                                    @endif

                                    <div class="form-control mt-3">
                                        <label for="formFile" class="form-label text-danger">อัพโหลด VDO (ไม่เกิน 2 MB)</label></label>
                                        <input class="form-control" type="file" id="formFile" name="cover" fize  @if(!isset($content)) required @endif>
                                    </div>
                                </div>
                                <div class="col-8 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">หัวข้อ</label>
                                        <input type="text" class="form-control" id="name" name="name"  maxlength="150" value="{{ isset($content) ? $content->name : '' }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detail" class="col-form-label text-dark">รายละเอียดแบบย่อ</label>
                                        <textarea class="form-control" name="detail" id="detail" cols="30" rows="8">{{ isset($content) ? $content->detail : '' }}</textarea>
                                    </div>

                                </div>
                            </div>


                            <div class="d-flex justify-content-end">
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
    @else
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        <h4 class="card-title">แก้ไขส่วนการติดต่อ</h4>
                        <hr>
                            @if(isset($content) && isset($content->id))
                                <form action="{{ route('backend.content.update', $content->id) }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @else
                                <form action="{{ route('backend.content.store') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                                @csrf
                            @endif

                            <input type="hidden" value="map" name="type">
                            <input type="hidden" value="{{ isset($content) && isset($content->id) ? $content->id : '' }}" name="content_id">

                            <div class="row">
                                <div class="col-4 form-group">
                                    @if(isset($content) && isset($content->id))
                                        <img src="{{ '/'. $content->cover }}" width="100%" alt="IMAGE">
                                    @endif

                                    <div class="form-control mt-3">
                                        <label for="formFile" class="form-label text-danger">อัพโหลด Image (ไม่เกิน 2 MB)</label></label>
                                        <input class="form-control" type="file" id="formFile" name="cover" fize  @if(!isset($content)) required @endif>
                                    </div>
                                </div>
                                <div class="col-8 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">หัวข้อ</label>
                                        <input type="text" class="form-control" id="name" name="name"  maxlength="150" value="{{ isset($content) && isset($content->id) ? $content->name : '' }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="detail" class="col-form-label text-dark">รายละเอียดแบบย่อ</label>
                                        <textarea class="form-control" name="detail" id="detail" cols="30" rows="8">{{ isset($content) && isset($content->id) ? $content->detail : '' }}</textarea>
                                    </div>

                                </div>
                            </div>


                            <div class="d-flex justify-content-end">
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


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        <h4 class="card-title">ตัวเลือกการเดินทาง 4 เส้นทาง</h4>
                        <hr>
                            <form action="{{ route('backend.content.map') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                            @csrf
                            <input type="hidden" value="listMap" name="type">

                            <div class="row">

                                <div class="col-6 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">รถไฟฟ้า</label>
                                        <textarea class="form-control" name="station1" cols="20" rows="4">{{ isset($content['station1']) ? $content['station1']->detail : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">รถประจำทาง</label>
                                        <textarea class="form-control" name="station2" cols="20" rows="4">{{ isset($content['station2']) ? $content['station2']->detail : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">Airport Rail Link</label>
                                        <textarea class="form-control" name="station3" cols="20" rows="4">{{ isset($content['station3']) ? $content['station3']->detail : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-dark">รถยนต์หรือรถจักรยานยนต์ส่วนตัว</label>
                                        <textarea class="form-control" name="station4" cols="20" rows="4">{{ isset($content['station4']) ? $content['station4']->detail : '' }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-success font-weight-medium auth-form-btn ml-3" type="submit">
                                    <h3><i class="far fa-save"></i> บันทึก</h3>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    @endif

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

@include('backend.partials.footer')
