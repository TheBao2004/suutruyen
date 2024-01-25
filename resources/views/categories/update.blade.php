@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">

 

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fix Category') }}</div>

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

                    <form action="{{ route('categories.update', [$user->id]) }}" method="post" class="row mx-0">
                        
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label for="" class="mb-2">Name</label>
                            <input type="text" class="form-control" name="name" onkeydown="ChangeToSlug()" id="slug" value="{{ old('name') != null ? old('name') : $user->name }}">
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror

                        <div class="mb-3">
                            <label for="" class="mb-2">Slug</label>
                            <input type="text" class="form-control" name="slug" id="convert_slug" value="{{ old('slug') != null ? old('slug') : $user->slug }}">
                        </div>
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror

                        <div class="mb-3">
                            <label for="" class="mb-2">Active</label>
                            <select name="active" id="" class="form-control">
                                @php
                                    $selected = old('active');
                                    if(empty($selected)) $selected = $user->active;
                                @endphp
                                <option value="1" {{ $selected == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $selected == 0 ? 'selected' : '' }}>No Active</option>
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
