@extends('dashboard.layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!-- Internal Fancy uploader css -->
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<!-- Internal Sumoselect css -->
<link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect.css')}}">
<style>

</style>
@endsection
@section('page-header')
  <!-- breadcrumb -->
  <div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      <div class="d-flex">
        <h4 class="content-title mb-0 my-auto">Employees</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Edit / {{ $employee->name }}</span>
      </div>
    </div>
  </div>
  <!-- breadcrumb -->
@endsection
@section('content')
  <!-- row -->
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="card">
        <div class="card-body">
          @include('partials._session')
          <form action="{{ route('employees.update', $employee->id) }}" method="post" data-parsley-validate="">
            @csrf
            <div class="row row-xs">
              <div class="col-md-12 mg-t-10">
                <div class="form-group">
                  <label class="form-label">Name: <span class="tx-danger">*</span></label>
                  <input class="form-control @error('name') is-invalid fparsley-error parsley-error @enderror" name="name" placeholder="Enter employee name" required type="text" value="{{ $employee->name }}">
                  @error('name')
                    <span class="invalid-feedback text-danger" role="alert">
                      <p>{{ $message }}</p>
                    </span>
                  @enderror
                </div><!-- main-form-group -->
              </div>
              <div class="col-md-12 mg-t-10">
                <div class="form-group">
                  <label class="form-label">Email: <span class="tx-danger">*</span></label>
                  <input class="form-control @error('email') is-invalid fparsley-error parsley-error @enderror" name="email" placeholder="Enter employee email" required type="text" value="{{ $employee->email }}">
                  @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                      <p>{{ $message }}</p>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-12 mg-t-20">
                <div class="parsley-select" id="slWrapper">
                  <label class="form-label">Department: <span class="tx-danger">*</span></label>
                  <select class="form-control select2" name="department_id" data-parsley-class-handler="#slWrapper" data-parsley-errors-container="#slErrorContainer" required="">
                    <option value=""></option>
                    @foreach($departments as $department)
                      <option {{ $employee->department_id === $department->id ? 'selected' : '' }} value="{{ $department->id }}">
                        {{ $department->name }}
                      </option>
                    @endforeach
                  </select>
                  <div id="slErrorContainer"></div>
                  @error('department')
                    <span class="invalid-feedback text-danger" role="alert">
                      <p>{{ $message }}</p>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-main-primary pd-x-20 mg-t-20" type="submit">Update </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- /row -->
  </div>
  <!-- Container closed -->
  </div>
  <!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  Form-elements js-->
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<!--Internal Sumoselect js-->
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
@endsection
