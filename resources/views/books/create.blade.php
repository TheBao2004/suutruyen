@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Book') }}</div>


                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                    {{-- report failed --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ 'Check Your Form' }}
                    </div>
                    @endif

                    <form action="{{ route('books.store') }}" method="post" class="row mx-0" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="mb-3">Name</label>
                            <input type="text" name="name" id="slug" onkeydown="ChangeToSlug()" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label for="" class="mb-3">Slug</label>
                            <input type="text" name="slug" id="convert_slug" value="{{ old('slug') }}" class="form-control">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Keyword</label>
                            <input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control">
                            @error('keyword')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Summary</label>
                            <textarea name="summary" id="" cols="30" rows="5" class="form-control">{{ old('summary') }}</textarea>
                            @error('summary')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Content</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control ckediter">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>


                        {{-- <div class="mb-3">
                            <label for="" class="mb-3">Category</label>
                            <select name="cate_id" id="" class="form-control">
                                <option value="">Choose category</option>
                                @foreach ($categories as $item)
                                    <option {{ old('cate_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('cate_id')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="" class="mb-3">Active</label>
                            <select name="active" id="" class="form-control">
                                <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>No Active</option>
                            </select>
                            @error('active')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
