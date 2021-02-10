@extends('backend.layouts.master')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"><a href="index.html">Banner Management</a></li>                            
                            <li class="breadcrumb-item active">Add Banner</li>
                        </ul>
                    </div>            
                    
                </div>
            </div>
            
        </div>

        <div class="card">
            <h5 class="card-header">Add Banner</h5>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{old('description')}} </textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </form>
                </div>
        </div>

    </div>

@endsection