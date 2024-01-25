
@php

@endphp

@extends('layouts.app')

@section('content')
<div class="container">

  @include('layouts.menu')


    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Fix Comic') }}</div>


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

                    <form action="{{ route('comics.update', [$comic->id]) }}" method="post" class="row mx-0" enctype="multipart/form-data">
                        
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label for="" class="mb-3">Author</label>
                            <input type="text" name="author" class="form-control" value="{{ old('author') == null ? $comic->author : old('author') }}">
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>


                        
                        <div class="mb-3">
                            <label for="" class="mb-3">Name</label>
                            <input type="text" name="name" id="slug" onkeydown="ChangeToSlug()" value="{{ old('name') == null ? $comic->name : old('name') }}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label for="" class="mb-3">Slug</label>
                            <input type="text" name="slug" id="convert_slug" value="{{ old('slug') == null ? $comic->slug : old('slug') }}" class="form-control">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Keyword</label>
                            <input type="text" name="keyword" value="{{ old('keyword') == null ? $comic->keyword : old('keyword') }}" class="form-control">
                            @error('keyword')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description') == null  ? $comic->description : old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3 col-9">
                            <label for="" class="mb-3">Image</label>
                            <input type="file" name="image" id="" class="form-control">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>

                        <div class="mb-3 col-3">
                            <img src="{{ asset('upload/image').'/'.$comic->image }}" alt="Error" width="100%">
                        </div>


                        {{-- <div class="mb-3">
                            <label for="" class="mb-3">Category</label>
                            <select name="cate_id" id="" class="form-control">
                                <option value="">Choose category</option>
                                @php
                                    $selected = old('cate_id');   
                                    if(empty($selected)) $selected = $comic->cate_id;
                                @endphp
                                @foreach ($categories as $item)
                                    <option {{ $selected == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('cate_id')
                            <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div> --}}


                        <div class="mb-3">
                            <label for="" class="mb-3 d-block">Categories</label>
                            @php
                                    $cateed = old('categories');
                                    if(empty($cateed)) $cateed = $arrCate;
                            @endphp
                            @foreach ($categories as $item)
                                <input type="checkbox" 
                                @php
                                    if(in_array($item->id, $cateed)) echo 'checked'; 
                                @endphp name="categories[]" id="{{ $item->id }}" value="{{ $item->id }}"> <label for="">{{ $item->name }}</label> <br>
                             @endforeach
                             @error('categories')
                             <span class="text-danger">{{ $message }}</span>   
                             @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3 d-block">Kind Of</label>
                            @php
                                $kinded = old('categories');
                                if(empty($kinded)) $kinded = $arrKind;
                            @endphp
                            @foreach ($kinds as $item)
                                <input type="checkbox" 
                                @php
                                if(in_array($item->id, $kinded)) echo 'checked'; 
                                @endphp 
                                name="kinds[]" id="{{ $item->id }}" value="{{ $item->id }}"> <label for="">{{ $item->name }}</label> <br>
                             @endforeach
                             @error('kinds')
                             <span class="text-danger">{{ $message }}</span>   
                             @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="mb-3">Active</label>
                            <select name="active" id="" class="form-control">
                                @php
                                $active = old('active');   
                                if(empty($active)) $active = $comic->active;
                                @endphp
                                <option value="1" {{ $active == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $active == 0 ? 'selected' : '' }}>No Active</option>
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
