@extends('admin.admin_dashboard');
@section('admin');


<div class="card card-custom mb-7">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-search text-primary"></i>
            </span>
            <h3 class="card-label">
                {{ __("Book Stock") }} <small>Filteration enabled</small>
            </h3>
        </div>
        <div class="card-toolbar">
            {{--
            <a
                href="#"
                class="btn btn-icon btn-sm btn-primary mr-1"
                data-card-tool="toggle"
                data-toggle="tooltip"
                data-placement="top"
                title="Toggle Card"
            >
                <i class="ki ki-arrow-down icon-nm"></i>
            </a>
            --}}
            <!--begin::Dropdown-->
           
            <!--end::Dropdown-->
            <!--begin::Button-->
            
            <!--end::Button-->
        </div>
        
    </div>
    <div class="card-body">
        @include('alerts.alerts')
        <!--begin: Datatable-->
        
       
        <table
        class="table table-bordered table-hover table-checkable"
            style="margin-top: 13px !important"
        >
        <thead class="thead-light">
            <tr>
                <th>Acc.No.</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Picture</th>
                <th>Action</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>

            @foreach($viewbookStock as $key => $book)
                <tr>
                <td>{{ ' Acc - '.$book->stock_id}}</td>
                   <td>{{ $book->book_title }}</td>
                   <td>{{ $book->author }}</td>
                   <td>{{ $book->publisher }}</td>
                   <td>{{ $book->year }}</td>
                   <td><img src="{{ asset('upload/book_img/'.$book->photo) }}" style="height: 50px;width:100px;" alt=""></td>
                  
                    <td> 
                        {{-- <a href="{{ route('edit.book', $book->id) }}" class="btn btn-sm btn-success btn-pill" title="Edit details">Edit</a> --}}
                        <a href="{{ route('delete.book_stock', $book->id) }}" class="btn btn-sm btn-danger btn-pill" onClick="return confirm('Are you sure you want to delete this book?')" title="Delete">Delete</a>
                    </td>
                    
                </tr>
            @endforeach

        </tbody>
        </table>

        <!--end: Datatable-->
     

    </div>
  
</div>

@endsection