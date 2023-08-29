@extends('admin.admin_dashboard');
@section('admin');


<div class="card card-custom mb-7">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon-search text-primary"></i>
            </span>
            <h3 class="card-label">
                {{ __("Manage Books") }} <small>Filteration enabled</small>
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
            <a
                href="{{ url('add_book') }}"
                class="btn btn-primary font-weight-bolder"
            >
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="24px"
                        height="24px"
                        viewBox="0 0 24 24"
                        version="1.1"
                    >
                        <g
                            stroke="none"
                            stroke-width="1"
                            fill="none"
                            fill-rule="evenodd"
                        >
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000"
                                opacity="0.3"
                            />
                        </g>
                    </svg>
                    <!--end::Svg Icon--> </span
                >Add New Book</a
            >
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
                <th>Sr.No.</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Publisher</th>
                {{-- <th>Quantity</th> --}}
                {{-- <th>Year</th>
                <th>Picture</th> --}}
                <th>Action</th>
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
            
            <?php $key = 1; ?>
            @foreach($bookStocks as $key => $stock)

                <tr>
                <td>{{$key}}</td>
                   <td>{{ $stock[0]->book_title }}</td>
                   <td>{{ $stock[0]->author }}</td>
                   <td>{{ $stock[0]->publisher }}</td>
                   {{-- <td>{{ $stock[0]->count }}</td> --}}
                    <td> 
                        <a href="{{ route('view.stock', $stock[0]->book_id) }}" class="btn btn-sm btn-success btn-pill" title="Edit details">View</a>
                    </td>
                    
                </tr>
            <?php $key += 1; ?>

            @endforeach

        </tbody>
        </table>

        <!--end: Datatable-->
     

    </div>
  
</div>

@endsection