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
                Add Book
            </h3>
        </div>
    </div>
    @include('alerts.alerts')

        <form action="{{ url('save_book') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Book Title:</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="book_title" required="required" placeholder="Enter book Title"
                            value="{{ old('book_title') }}">
                            <span class="form-text text-muted">Please enter book title</span>
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Author:</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="author" required="required" placeholder="Enter Book Author"
                            value="{{ old('author') }}">
                            <span class="form-text text-muted">Please enter book author</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Publisher:</label><span class="text-danger">*</span>
                            <input type="text" class="form-control" name="publisher" required="required" placeholder="Enter Book publisher"
                            value="{{ old('publisher') }}">
                            <span class="form-text text-muted">Please enter publisher</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Place Of Publish </label>
                            <input type="text" name="Place_of_publisher" class="form-control form-control-solid" placeholder="Enter Place Of Publish"
                                value="{{ old('Place_of_publisher') }}"
                            />
                            <span class="form-text text-muted"
                                >Please enter place of publish.</span
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Year </label>
                            <input type="text" name="year" class="form-control form-control-solid" placeholder="Enter Year"
                                value="{{ old('year') }}"
                            />
                            <span class="form-text text-muted"
                                >Please enter Year.</span
                            >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Quantity </label>
                            <input type="number" name="quantity" class="form-control form-control-solid" placeholder="Enter Quantity"
                                value="{{ old('quantity') }}"
                            />
                            <span class="form-text text-muted"
                                >Please enter Quantity.</span
                            >
                        </div>
                    </div>
                   
                    
                </div>

                <div class="row">
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