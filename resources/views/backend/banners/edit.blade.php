@extends('backend.layouts.master')

@section('content')

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"><a href="">Banner Management</a></li>                            
                            <li class="breadcrumb-item active">Edit Banner</li>
                        </ul>
                    </div>            
                    
                </div>
            </div>
            
        </div>

        <div class="card">
            <h5 class="card-header">Add Banner</h5>
                <div class="card-body">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{route('banner.update', $banner->id)}}">
                        @csrf
                        @method('patch')    <!-- OR use: @method('put') in order to update-->
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{$banner->title}}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputDesc" class="col-form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{$banner->description}} </textarea>
                            @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="condition" class="col-form-label">Condition</label>
                            <select name="condition" class="form-control">
                                <option value="">-- Condition --</option>
                                <option value="banner" {{$banner->condition == 'banner' ? 'selected':''}}>Banner</option>
                                <option value="promote" {{$banner->condition == 'promote' ? 'selected':''}}>Promote</option>
                            </select>
                            @error('condition')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-info">
                                    <i class="fas fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$banner->photo}}">
                            </div>
                            <div id="holder" style ="margin-top:15px; max-height:100px;"></div>
                            @error('photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="">-- Status --</option>
                                <option value="active" {{$banner->status == 'active' ? 'selected':''}}>Active</option>
                                <option value="inactive" {{$banner->status == 'inactive' ? 'selected':''}}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
         $('#lfm').filemanager('image');
    </script>
    <script>
        $(document).ready(function() {
        $('#description').summernote();
        });
    </script>
@endsection