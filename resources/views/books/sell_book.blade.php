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
                Sell Book
            </h3>
        </div>
    </div>
    @include('alerts.alerts')

        <form action="{{ url('sell') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Select User</label>
                            <select name="user_id" id="user_id" required="required" class="form-control form-control-solid">
                                <option>Select User</option>
                                @foreach($getusers as $key => $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                  
                            </select>
                            <span class="form-text text-muted"
                                >Please select User.</span
                            >
                        </div>
                        <!--end::Input-->
                    </div>
                   
                    <div class="col-xl-6">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Select Book</label>
                            <select name="Book_id" id="Book_id" required="required" class="form-control form-control-solid">
                                <option>Select Book</option>
                                @foreach($getbooks as $key => $book)
                                <option value="{{ $book->stock_id }}">{{ 'Acc :'.$book->stock_id . ' : ' .$book->book_title }}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-muted"
                                >Please select Book.</span
                            >
                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Description:</label><span class="text-danger"></span>
                            <textarea name="descriotion" id="descriotion" cols="4" rows="4" class="form-control form-control-solid"></textarea>
                            <span class="form-text text-muted">Please enter Description</span>
                        </div>
                    </div>
                  
                </div>
                
            
                <div class="row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-pill add_student">Sell Book</button>
                        <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Back</button>
                    </div>
                </div>     
            </div>
        </form>

    </div>
    

@endsection