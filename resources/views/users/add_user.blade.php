@extends('admin.admin_dashboard');
@section('admin');

<!--begin::Card-->
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-edit-1 text-primary"></i>
            </span>
            <h3 class="card-label">
                Add User
            </h3>
        </div>
    </div>
    @include('alerts.alerts')

        <form action="{{ url('save_user') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Name:</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="name" required="required" placeholder="Enter Name"
                            value="{{ old('name') }}">
                            <span class="form-text text-muted">Please enter name</span>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email:</label><span class="text-danger">*</span>
                            <input type="email" class="form-control" name="email" required="required" placeholder="Enter Email"
                            value="{{ old('email') }}">
                            <span class="form-text text-muted">Please enter Email</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Password:</label><span class="text-danger">*</span>
                            <input type="password" class="form-control" name="password" required="required" placeholder="Enter Book Password"
                            value="{{ old('password') }}">
                            <span class="form-text text-muted">Please enter password</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone </label>
                            <input type="text" name="phone" class="form-control form-control-solid" placeholder="Enter Phone"
                                value="{{ old('phone') }}"
                            />
                            <span class="form-text text-muted"
                                >Please enter Phone.</span
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address </label>
                            <input type="text" name="address" class="form-control form-control-solid" placeholder="Enter Address"
                                value="{{ old('address') }}"
                            />
                            <span class="form-text text-muted"
                                >Please enter address.</span
                            >
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Picture</label>
                            <div></div>
                            <div class="custom-file">
                                <input
                                    type="file"
                                    class="custom-file-input form-control-solid"
                                    name="photo"
                                    id="photo"
                                />
                                <label class="custom-file-label" for="photo"
                                    >Choose Picture</label
                                >
                            </div>
                            <span class="form-text text-muted"
                                >Please browse book picture.</span
                            >
                        </div>
                        <!--end::Input-->
                    </div>

                   
                   
                    
                </div>

                <div class="row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-pill add_student">Save</button>
                        <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Back</button>
                    </div>
                </div>     
            </div>
        </form>

    </div>
    

@endsection