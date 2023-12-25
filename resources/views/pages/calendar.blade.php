<style>
    .fc-event p {
        color: #000 !important;
    }
</style>
<div class="container-fluid page-body-wrapper">
    <div class="mt-2">
        <div class="card">
            @include('partials.header')
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page">
                        <div class="container-fluid page-body-wrapper mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                            <a class="nav-link  {{ $type == 'small' ? 'active' : '' }}" href="/calendar?type=small">ห้องประชุมขนาดเล็ก</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link {{ $type == 'medium' ? 'active' : '' }}" href="/calendar?type=medium">ห้องประชุมขนาดกลาง</a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link {{ $type == 'large' ? 'active' : '' }}" href="/calendar?type=large">ห้องประชุมขนาดใหญ่</a>
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
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
    </div>
</div>


