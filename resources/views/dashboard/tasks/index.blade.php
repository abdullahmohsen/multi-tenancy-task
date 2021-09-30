@extends('dashboard.layouts.master')
@section('css')
  <!-- Internal Data table css -->
  <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{--  <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">--}}
  <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
  <!--- Internal Sweet-Alert css-->
  <link href="{{URL::asset('assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet">
  <!---Internal Owl Carousel css-->
  <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
  <!---Internal  Multislider css-->
  <link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
  <!--- Select2 css -->
  <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
  <style>
    .table-responsive {
      overflow-x: hidden !important;
    }
  </style>
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Tasks</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Show</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
  <!-- row opened -->
  <div class="row row-sm">
    <!--div-->
    <div class="col-xl-12">
      <div class="card mg-b-20">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mg-b-0">Show All Tasks</h4>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @include('partials._session')
            <table id="example" class="table key-buttons text-md-nowrap">
              <thead>
              <tr>
                <th class="border-bottom-0">Task Name</th>
                <th class="border-bottom-0">Assignee</th>
                <th class="border-bottom-0">Due Date</th>
                <th class="border-bottom-0">Priority</th>
                <th class="border-bottom-0">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($tasks as $task)
                <tr>
                  <td>{{ $task->name }}</td>
                  <td>
                    @foreach($task->employees as $employee)
                      <a href="{{ route('employees.index') }}" data-placement="top" data-toggle="tooltip" title="{{ $employee->name }}">
                        <div class="demo-avatar-group avatar-list d-inline-block">
                          <div class="avatar bg-primary rounded-circle">
                            {{ substr($employee->name,0,2) }}
                          </div>
                        </div>
                      </a>
                    @endforeach
                  </td>
                  <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y') }}</td>
                  <td>{{ $task->priority }}</td>
                  <td>
                    <div class="d-flex my-xl-auto right-content">
                      <div class="pr-1 mb-3 mb-xl-0">
                        <a type="button" class="modal-effect btn btn-info btn-icon mr-2" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8" data-placement="top" title="Show"><i class="far fa-eye"></i></a>
                      </div>
                      <div class="pr-1 mb-3 mb-xl-0">
                          <button type="button" class="btn btn-danger btn-icon mr-2 delete" data-id="{{ $task->id }}" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                      </div>
                      <div class="pr-1 mb-3 mb-xl-0">
                          <a type="button" href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-icon mr-2" data-placement="top" data-toggle="tooltip" title="Edit"><i class="fas fa-user-edit"></i></a>
                      </div>
                    </div>
                  </td>
                </tr>
                <!-- Modal effects -->
                <div class="modal" id="modaldemo8">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                      <div class="modal-header">
                        <h6 class="modal-title">{{ $task->name }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <h6>Description</h6>
                        <p>{{ $task->description }}</p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn ripple btn-primary" data-dismiss="modal" type="button">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal effects-->
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--/div-->
  </div>
  <!-- /row -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection
@section('js')
  <!-- Internal Data tables -->
  <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
  <!--Internal  Datatable js -->
  <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
  <!--Internal  Sweet-Alert js-->
  <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
  <script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-alert.js')}}"></script>
  <!-- Sweet-alert js  -->
  <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>
  <!--Internal  Datepicker js -->
  <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
  <!-- Internal Select2 js-->
  <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
  <!-- Internal Modal js-->
  <script src="{{URL::asset('assets/js/modal.js')}}"></script>
  <script>
    $(document).ready(function () {
      $('.delete').click(function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm) {
            let data = {
              "_token": "{{ csrf_token() }}",
              "id": id
            };
            $.ajax({
              type: "POST",
              url: '/dashboard/tasks/delete/'+id,
              data: data,
              success: function (response) {
                swal("Deleted!", response.status, "success"),
                  location.reload();
              }
            });
          }
        });
      });
    });

  </script>
@endsection
