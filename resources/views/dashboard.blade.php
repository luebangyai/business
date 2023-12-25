{{--  <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">  --}}
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Favicons -->
<link href="/favicon/apple-icon.png" rel="icon">
<link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- base:css -->
<link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="/plugins/font-awesome/css/all.min.css">

<!-- inject:css -->
<link rel="stylesheet" href="/css/horizontal-layout-light/style.css">
<link rel="stylesheet" href="/vendors/fullcalendar/fullcalendar.min.css">
<!-- endinject -->
<link rel="shortcut icon" href="/favicon/apple-icon.png" />


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Record Booking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="card-body">
                        <h4 class="card-title">Data table</h4>
                        <div class="row">
                          <div class="col-12">

                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                  </tr>
                                </tbody>
                              </table>

                          </div>
                        </div>
                      </div>



                    </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="/vendors/js/vendor.bundle.base.js"></script>
<script src="/js/off-canvas.js"></script>
<script src="/js/hoverable-collapse.js"></script>
<script src="/js/template.js"></script>
<script src="/js/settings.js"></script>
<script src="/js/todolist.js"></script>
<script src="/js/tabs.js"></script>
