@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Comic') }}</div>


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

                    <form action="{{ route('chapters.store') }}" method="post" class="row mx-0">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="mb-3">Tilte</label>
                            <input type="text" name="title" id="slug" onkeydown="ChangeToSlug()" value="{{ old('title') }}" class="form-control">
                            @error('title')
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
                            <label for="" class="mb-3">Sumary</label>
                            <textarea name="sumary" id="" cols="30" rows="3" class="form-control">{{ old('sumary') }}</textarea>
                            @error('sumary')
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
                            <label for="" class="mb-3">Comic</label>
                            <select name="comic_id" id="" class="form-control">
                                <option value="">Choose comic</option>
                                @foreach ($comics as $item)
                                    <option {{ old('comic_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('comic_id')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

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
