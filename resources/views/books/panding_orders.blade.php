@extends('admin.admin_dashboard');
@section('admin');


<div class="card card-custom mb-7">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-search text-primary"></i>
            </span>
            <h3 class="card-label">
                {{ __("Books Pending Orders  ") }} <small>Filteration enabled</small>
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
                <th>SL No.</th>
                <th>Accession No</th>
                <th>Book Title</th>
                <th>Book Author</th>
                <th>Buyer's Name</th>
                <th>Buyer's Phone</th>
                <th>Buyer's Address</th>
                {{-- <th>Picture</th> --}}
                <th>Action</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>

            @foreach($pandingorders as $key => $book)
                <tr>
                <td>{{$key+1}}</td>
                   <td>{{ 'Acc - '.$book->book_stock_id }}</td>
                   <td>{{ $book->book_title }}</td>
                   <td>{{ $book->author }}</td>
                   <td>{{ $book->name }}</td>
                   <td>{{ $book->phone }}</td>
                   <td>{{ $book->address }}</td>
                   {{-- <td><img src="{{ asset('upload/book_img/'.$book->photo) }}" style="height: 50px;width:100px;" alt=""></td> --}}
                  
                   <td> 
                    <a href="{{ route('accept.order', $book->book_stock_id) }}" class="btn btn-sm btn-success btn-pill" onClick="return confirm('Are you sure you want to Accep This Order?')" title="Edit details">Accept Order</a>
                    <a href="{{ route('reject.order', $book->book_stock_id) }}" class="btn btn-sm btn-danger btn-pill" onClick="return confirm('Are you sure you want to Reject This Orrder?')" title="Delete">Reject Order</a>
                </td>
                    
                </tr>
            @endforeach

        </tbody>
        </table>

        <!--end: Datatable-->
     

    </div>
  
</div>

@endsection