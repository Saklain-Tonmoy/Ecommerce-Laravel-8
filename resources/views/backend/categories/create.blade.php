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
                            <li class="breadcrumb-item"><a href="">Category Management</a></li>                            
                            <li class="breadcrumb-item active">Add Category</li>
                        </ul>
                    </div>            
                    
                </div>
            </div>
            
        </div>

        <div class="card">
            <h5 class="card-header">Add Category</h5>
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

                    <form method="POST" action="{{route('category.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" >{{old('summary')}} </textarea>
                            @error('summary')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="is_parent" class="col-form-label">Is Parent : <span class="text-danger">*</span></label>
                            <input type="checkbox" id="is_parent" name="is_parent" value="1" checked> Yes
                            @error('is_parent')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group d-none" id="parent_cat_div">
                            <label for="parent_id" class="col-form-label">Parent Category <span class="text-danger">*</span></label>
                            <select name="parent_id" class="form-control">
                                <option value="">-- Parent Category --</option>
                                @foreach($parent_category as $item)
                                    <option value="{{$item->id}}" {{old('parent_id') == $item->id ? 'selected' : ''}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                            @error('status')
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
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}">
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
                                <option value="active" {{old('status') == 'active' ? 'selected':''}}>Active</option>
                                <option value="inactive" {{old('status') == 'inactive' ? 'selected':''}}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
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
        $('#summary').summernote();
        });
    </script>
    <script>
        $('#is_parent').change(function (e) {
            e.preventDefault();
            var is_checked = $('#is_parent').prop('checked');
            //alert(is_checked);

            if(is_checked) {
                $('#parent_cat_div').addClass('d-none');
                $('#parent_cat_div').val('');
            }
            else {
                $('#parent_cat_div').removeClass('d-none');
            }
        })
    </script>
@endsection