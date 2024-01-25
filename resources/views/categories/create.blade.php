@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">

 

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Category') }}</div>

                <div class="card-body">
                    {{-- report failed --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ 'Check Your Form' }}
                    </div>
                    @endif
                    {{-- report success --}}
                    @if (session('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="post" class="row mx-0">
                        
                        @csrf

                        <div class="mb-3">
                            <label for="" class="mb-2">Name</label>
                            <input type="text" class="form-control" onkeydown="ChangeToSlug()" name="name" id="slug" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror


                        <div class="mb-3">
                            <label for="" class="mb-2">Slug</label>
                            <input type="text" class="form-control" id="convert_slug" name="slug" value="{{ old('slug') }}">
                        </div>
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror

                        <div class="mb-3">
                            <label for="" class="mb-2">Active</label>
                            <select name="active" id="" class="form-control">
                                <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>No Active</option>
                            </select>
                        </div>
                        @error('active')
                        <span class="text-danger">{{ $message }}</span>    
                        @enderror

                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary">
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
