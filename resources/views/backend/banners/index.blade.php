@extends('backend.layouts.master')

@section('content')
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                    <ul class="breadcrumb float-left">
                        <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="">Banner Management</a></li>
                        <li class="breadcrumb-item active">All Banners</li>
                    </ul>

                    <h4 class="float-right">Total Banners : {{\App\Models\Banner::count()}}</h4>
                </div>

            </div>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h2><strong>Banner</strong> List</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="col-lg-12">
                @include('backend.layouts.notification')
            </div>
            <div class="card-body table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Condition</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->description}}</td>
                            <td><img src="{{$item->photo}}" alt="banner image" style="max-height: 90px; max-width: 120px;"></td>
                            <td>
                                @if($item->condition == "banner")
                                <span class="badge badge-success">{{$item->condition}}</span>
                                @else
                                <span class="badge badge-primary">{{$item->condition}}</span>
                                @endif
                            </td>
                            <td><input type="checkbox" name="toogle" value="{{$item->id}}" {{$item->status == 'active' ? 'checked':''}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger"></td>
                            <td>
                                <a href="{{route('banner.edit', $item->id)}}" class="float-left m-2 btn btn-sm btn-outline-warning" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                <form class="float-left" action="{{route('banner.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="" class="dltBtn m-2 btn btn-sm btn-outline-danger" data-toggle="tooltip" data-id="{{$item->id}}" title="delete" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                </form>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    $('input[name = toogle]').change(function() {
        var mode = $(this).prop('checked');
        var id = $(this).val();
        //alert(id);

        $.ajax({
            url: "{{route('banner.status')}}",
            type: "POST",
            data: {
                _token: '{{csrf_token()}}',
                mode: mode,
                id: id,
            },
            success: function(response) {
                //console.log(response.status);

                if (response.status) {
                    alert(response.msg);
                } else {
                    alert('Please try again!')
                }
            }
        })
    });
</script>

<!-- Sweet Alert CDN -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.dltBtn').click(function(e) {
        var form = $(this).closest('form');
        var dataId = $(this).data('id');
        e.preventDefault();

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                    swal("Done! Your file has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your imaginary file is safe!");
                }
            });
    });
</script>
@endsection
