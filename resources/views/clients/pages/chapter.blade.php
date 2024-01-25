@php
    // dd($chapter->category);    
@endphp

@extends('clients.layouts.index')

@section('breadcrumb')
    
<div class="container">
        

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb my-0 py-2">
              <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ route('danh-muc', [$comic->category->slug]) }}">{{ ucfirst($comic->category->name) }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('truyen', [$comic->slug]) }}">{{ $comic->name }}</a></li>
              <li class="breadcrumb-item"><a>{{ $chapter->title }}</a></li>
            </ol>
          </nav>

</div>

@endsection


@section('content')


<main>
    <div class="chapter-wrapper container my-5">
        <a href="#" class="text-decoration-none">
            <h1 class="text-center text-success">{{ $chapter->comic->name }}</h1>
        </a>
        <a href="#" class="text-decoration-none">
            <p class="text-center text-dark">{{ $chapter->title }}</p>
        </a>
        <hr class="chapter-start container-fluid">
        <div class="chapter-nav text-center">
            <div class="chapter-actions chapter-actions-origin d-flex align-items-center justify-content-center">
                <a class="btn btn-success me-1 chapter-prev {{ $minSlug == $chapter->slug ? 'd-none' : '' }}" 
                href="{{ $backSlug ?? route('chuong', [$backSlug]) }}" title=""> <span>Chương
                    </span>trước</a>
                {{-- <button class="btn btn-success chapter_jump me-1" data-story-id="3" data-slug-chapter="chuong-1"
                    data-slug-story="nang-khong-muon-lam-hoang-hau">
                    <span>
                        <svg style="fill: #fff;" xmlns="http://www.w3.org/2000/svg" height="1em"
                            viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z">
                            </path>
                        </svg>

                    </span>
                </button> --}}

                <div class="dropdown select-chapter me-1 w-50">
                    <a class="btn btn-secondary dropdown-toggle bg-success w-100" role="button"
                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" >
                        Chọn chương
                    </a>

                    <ul class="dropdown-menu select-chapter__list w-100" aria-labelledby="dropdownMenuLink">
                        @forelse ($chapters as $item)
                            <li class="p-2"><a href="{{ route('chuong', [$item->slug]) }}" class="text-{{ $chapter->id == $item->id ? 'success' : 'dark' }} text-decoration-none">{{ $item->title }}</a></li>
                        @empty
                            
                        @endforelse
                    </ul>
                </div>
                <a class="btn btn-success chapter-next  {{ $maxSlug == $chapter->slug ? 'd-none' : '' }}"
                href="{{ $nextSlug ?? route('chuong', [$nextSlug]) }}" title="" ><span>Chương
                    </span>tiếp</a>
            </div>
        </div>
        <hr class="chapter-end container-fluid">

        <div class="chapter-content mb-3">
            <div class="visible-md visible-lg ads-responsive incontent-ad" id=""
                style="">    

                {!! $chapter->content !!}

        </div>

    </div>

    {{-- <div class="chapter-actions chapter-actions-mobile d-flex align-items-center justify-content-center">
        <a class="btn btn-success me-2 chapter-prev"
            href="#" title=""> <span>Chương
            </span>trước</a>
 
        

        <div class="dropup select-chapter me-2 d-none">
            <a class="btn btn-secondary dropdown-toggle" role="button"
                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                Chọn chương
            </a>

            <ul class="dropdown-menu select-chapter__list" aria-labelledby="dropdownMenuLink">

            </ul>
        </div>
        <a class="btn btn-success chapter-next" href="#"
            title=""><span>Chương </span>tiếp  q112</a>
    </div> --}}
</main>





@endsection