@extends('clients.layouts.index')


@section('breadcrumb')
    
<div class="container">
        

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb my-0 py-2">
              <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Sách</a></li>
            </ol>
          </nav>

</div>

@endsection

@section('content')

<main>
    <div class="section-stories-hot mb-3">
        <div class="container">
            {{-- <div class="row">
                <div class="head-title-global d-flex justify-content-between mb-2">
                    <div class="col-6 col-md-4 col-lg-4 head-title-global__left d-flex align-items-center">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <a href="#" class="d-block text-decoration-none text-dark fs-4 story-name"
                                title="Truyện Hot">Truyện Hot</a>
                        </h2>
                        <i class="fa-solid fa-fire-flame-curved"></i>
                    </div>

                    <div class="col-4 col-md-3 col-lg-2">
                        <select class="form-select select-stories-hot" aria-label="Truyen hot">
                            <option selected="">Danh mục</option>
                        </select>
                    </div>
                </div>
            </div> --}}

            <div class="row">
                <div class="col-12">
                    <div class="section-stories-hot__list">

                        @forelse ($books as $book)
                            

                        <div class="story-item row mx-0 bg-light">
                            <div class="col-12 p-0">
                            <a href="{{ route('truyen', [$book->slug]) }}" class="d-block text-decoration-none">
                                <div class="story-item__image">
                                    <img src="{{ asset("upload/image/".$book->image) }}" alt="Tự Cẩm" class="img-fluid" width="150"
                                        height="230" loading="lazy">
                                </div>
                                <h3 class="story-item__name text-one-row story-name">
                                    {{ $book->name }}
                                </h3>

                      

                                {{-- <div class="list-badge">
                                    <span class="story-item__badge badge text-bg-success">Full</span>

                                    <span class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>

                                    <span class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                </div> --}}
								
                            </a>
                            </div>
                            <div class="col-12 p-0">
                                <!-- Button trigger modal -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $book->id }}" class="btn btn-outline-dark w-100 read_book" id="{{ $book->id }}" token="{{ @csrf_token() }}" style="border-radius: 0">Đọc ngay</a>
                            </div>

                            <div class="col-12">
  
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal_{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                             
                                </div>
                                </div>
                            </div>

                            </div>


                        </div>


                        @empty
                            
                        <h1 class="text-center my-5">Không có sách</h1>

                        @endforelse
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>






@endsection