@include('backend.partials.header')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ปฏิทินการจอง
        </h2>
    </x-slot>

    <div class="page">
        <div class="container-fluid page-body-wrapper mt-3">
            <div class="col-10 offset-md-1">

                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                            <a class="nav-link  {{ $type == 'small' ? 'active' : '' }}" href="/schedule?type=small">ห้องประชุมขนาดเล็ก</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ $type == 'medium' ? 'active' : '' }}" href="/schedule?type=medium">ห้องประชุมขนาดกลาง</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link {{ $type == 'large' ? 'active' : '' }}" href="/schedule?type=large">ห้องประชุมขนาดใหญ่</a>
                            </li>
                        </ul>
                        @if($type == 'small')
                            <div class="card-body">
                                <h4 class="card-title">ปฏิทิน</h4>
                                <div id="calendarSmall" class="full-calendar fc fc-unthemed fc-ltr">
                                </div>
                            </div>
                        @elseif ($type == 'medium')
                            <div class="card-body">
                                <h4 class="card-title">ปฏิทิน</h4>
                                <div id="calendarMedium" class="full-calendar fc fc-unthemed fc-ltr">
                                </div>
                            </div>
                        @elseif ($type == 'large')
                            <div class="card-body">
                                <h4 class="card-title">ปฏิทิน</h4>
                                <div id="calendarLarge" class="full-calendar fc fc-unthemed fc-ltr">
                                </div>
                            </div>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>

</x-app-layout>

@include('backend.partials.footer')
