@php
       
@endphp

@extends('clients.layouts.index')

@section('breadcrumb')
    
<div class="container">
        

        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb my-0 py-2">
              <li class="breadcrumb-item"><a href="{{ route('trang-chu') }}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{ route('the-loai', [$comic->kind->slug]) }}">{{ ucfirst($comic->kind->name) }}</a></li>
              <li class="breadcrumb-item"><a href="{{ route('danh-muc', [$comic->category->slug]) }}">{{ ucfirst($comic->category->name) }}</a></li>
              <li class="breadcrumb-item"><a>{{ $comic->name }}</a></li>
            </ol>
          </nav>

</div>

@endsection

@section('content')
 
<main>

    <input type="hidden" id="story_slug" value="nang-khong-muon-lam-hoang-hau">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="head-title-global d-flex justify-content-between mb-4">
                    <div class="col-12 col-md-12 col-lg-4 head-title-global__left d-flex">
                        <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                            <span class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                title="Thông tin truyện">Thông
                                tin truyện</span>
                        </h2>
                    </div>
                </div>

                <div class="story-detail">
                    <div class="story-detail__top d-flex align-items-start">
                        <div class="row align-items-start">
                            <div class="col-12 col-md-12 col-lg-3 story-detail__top--image">
                                <div class="book-3d">
                                    <img src="{{ asset("upload/image/".$comic->image) }}"
                                        alt="Nàng Không Muốn Làm Hoàng Hậu" class="img-fluid w-100" width="200"
                                        height="300" loading="lazy">
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-9">
                                <h3 class="text-center story-name">{{ $comic->name }}</h3>
                                <div class="rate-story mb-2">

                                    {{-- <div class="rate-story__holder" data-score="7.0">

                                        <img alt="1" src="./assets/images/star-on.png">

                                        <img alt="2" src="./assets/images/star-on.png">

                                        <img alt="3" src="./assets/images/star-on.png">

                                        <img alt="4" src="./assets/images/star-on.png">

                                        <img alt="5" src="./assets/images/star-on.png">

                                        <img alt="6" src="./assets/images/star-on.png">

                                        <img alt="7" src="./assets/images/star-half.png">

                                        <img alt="8" src="./assets/images/star-off.png">

                                        <img alt="9" src="./assets/images/star-off.png">

                                        <img alt="10" src="./assets/images/star-off.png">

                                    </div> --}}

                                    <em class="rate-story__text"></em>
                                    {{-- <div class="rate-story__value" itemprop="aggregateRating" itemscope=""
                                        itemtype="https://schema.org/AggregateRating">
                                        <em>Đánh giá:
                                            <strong>
                                                <span itemprop="ratingValue">7.0</span>
                                            </strong>
                                            /
                                            <span class="" itemprop="bestRating">10</span>
                                            từ
                                            <strong>
                                                <span itemprop="ratingCount">415</span>
                                                lượt
                                            </strong>
                                        </em>
                                    </div> --}}
                                </div>

                                <div class="story-detail__top--desc px-3" style="max-height: 285px;">
                                    {!! $comic->description !!}
                                </div>

                                <div class="info-more">
                                    <div class="info-more--more active" id="info_more">
                                        <span class="me-1 text-dark">Xem thêm</span>
                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.70749 7.70718L13.7059 1.71002C14.336 1.08008 13.8899 0.00283241 12.9989 0.00283241L1.002 0.00283241C0.111048 0.00283241 -0.335095 1.08008 0.294974 1.71002L6.29343 7.70718C6.68394 8.09761 7.31699 8.09761 7.70749 7.70718Z"
                                                fill="#2C2C37"></path>
                                        </svg>
                                    </div>

                                    <a class="info-more--collapse text-decoration-none"
                                        href="#">
                                        <span class="me-1 text-dark">Thu gọn</span>
                                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.70749 0.292817L13.7059 6.28998C14.336 6.91992 13.8899 7.99717 12.9989 7.99717L1.002 7.99717C0.111048 7.99717 -0.335095 6.91992 0.294974 6.28998L6.29343 0.292817C6.68394 -0.097606 7.31699 -0.0976055 7.70749 0.292817Z"
                                                fill="#2C2C37"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="fb-share-button" 
                    data-href="{{ \URL::current() }}" 
                    data-layout="" data-size=""><a target="_blank" 
                    href="{{ \URL::current() }}&amp;src=sdkpreparse" 
                    class="fb-xfbml-parse-ignore">Chia sẻ</a></div>


                    <h5>Từ khóa:</h5>
                    <br>

                    <div class="tagcloud05">
                        <ul>
                            @foreach ($keywords as $k)
                            <li><a href="{{ route('keywords', [\Str::slug($k)]) }}"><span>{{ $k }}</span></a></li>
                            @endforeach
                        </ul>
                    </div>

                    <hr>
                    <div class="story-detail__bottom mb-3">
                        <div class="row">
                            <div class="col-12 col-md-12 story-detail__bottom--info">
                                <p class="mb-1">
                                    <strong>Tác giả:</strong>
                                    <a href="#"
                                        class="text-decoration-none text-dark hover-title">{{ $comic->author }}</a>
                                </p>
                                <div class="d-flex align-items-center mb-1 flex-wrap">
                                    <strong class="me-1">Thể loại:</strong>
                                    @foreach ($comic->kinds as $item)
                                    <span class="badge mx-1 d-inline-block text-bg-danger">
                                        <a href="" class=" text-light">{{ $item->name }}</a>
                                    </span>
                                    @endforeach
                                </div>

                                <div class="d-flex align-items-center mb-1 flex-wrap">
                                    <strong class="me-1">Danh mục:</strong>
                                            @foreach ($comic->categories as $item)
                                                <span class="badge mx-1 d-inline-block text-bg-warning">
                                                    <a href="{{ route('danh-muc', [$item->slug]) }}" class=" text-dark">{{ $item->name }}</a>
                                                </span>
                                            @endforeach
                                </div>

                                <p class="mb-1">
                                    <strong>Trạng thái:</strong>
                                    @if ($comic->full == 1)
                                        <span class="text-info">Hoàn thành</span>
                                    @else
                                        <span class="text-warning">Đang cập nhập ...</span>
                                    @endif
                                </p>

                                
                                <p class="mb-1">
                                    <strong>Ngày đăng:</strong>
                                    <span class="">{{ $comic->created_at->diffForHumans() }}</span>
                                </p>

                                <p class="mb-1">
                                    <strong>Lượt xem:</strong>
                                    <span class="">{{ $comic->view }}</span>
                                </p> 
                            </div>

                        </div>
                    </div>

                    <div class="story-detail__list-chapter">
                        <div class="head-title-global d-flex justify-content-between mb-4">
                            <div class="col-6 col-md-12 col-lg-4 head-title-global__left d-flex">
                                <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                    <span href="#"
                                        class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                        title="Truyện hot">Danh sách chương</span>
                                </h2>
                            </div>
                        </div>

                        <div class="story-detail__list-chapter--list">
                            <div class="row">
                                <div class="col-12">
                                    <ul>
                                        @forelse ($chapters as $chapter)
                                        <li>
                                            <a href="{{ route('chuong', [$chapter->slug]) }}"
                                                class="text-decoration-none text-dark hover-title">
                                                {{ $chapter->title }}
                                            </a>
                                        </li>
                                        @empty
                                            <li class="text-danger">Đang cập nhập chương ...</li>
                                        @endforelse
                                    </ul>
                                    <div>
                                        {{-- {{$chapters->onEachSile(1)->links('pagination::bootstrap-4')}} --}}
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>


                    {{-- <div class="pagination" style="justify-content: center;">
                        <ul>
                            <li class="pagination__item  page-current">
                                <a class="page-link story-ajax-paginate"
                                    data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=1"
                                    style="cursor: pointer;">1</a>
                            </li>
                            <li class="pagination__item ">
                                <a class="page-link story-ajax-paginate"
                                    data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=2"
                                    style="cursor: pointer;">2</a>
                            </li>

                            <div class="dropup-center dropup choose-paginate me-1">
                                <button class="btn btn-success dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Chọn trang
                                </button>
                                <div class="dropdown-menu">
                                    <input type="number" class="form-control input-paginate me-1" value="">
                                    <button class="btn btn-success btn-go-paginate">
                                        Đi
                                    </button>
                                </div>
                            </div>

                            <li class="pagination__arrow pagination__item">
                                <a data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=2"
                                    style="cursor: pointer;"
                                    class="text-decoration-none w-100 h-100 d-flex justify-content-center align-items-center story-ajax-paginate">
                                    &gt;&gt;
                                </a>
                            </li>
                        </ul>

                    </div> --}}

                    {{-- @php
                    
                       $chapters->withPath('home');

                    @endphp --}}

                    <div class="fb-comments" 
                    data-href="{{ \URL::current() }}" 
                    data-width="100%" data-numposts="10">
                    </div>
                    
                </div>



                {{-- Comic same category  --}}  
                <h4 class="border-bottom mb-3"> Truyện cùng danh mục </h4>
                <div class="list-story-in-category section-stories-hot__list">

                    @forelse ($comicBlCate as $item)
                        
                        <div class="story-item">
                            <a href="{{ route('truyen', [$item->slug]) }}" class="d-block text-decoration-none">
                                <div class="story-item__image">
                                    <img src="{{ asset("upload/image/".$item->image) }}" alt="Tự Cẩm" class="img-fluid" width="150"
                                        height="230" loading="lazy">
                                </div>
                                <h3 class="story-item__name text-one-row story-name">{{ $item->name }}</h3>

                                {{-- <div class="list-badge">
                                    <span class="story-item__badge badge text-bg-success">Full</span>

                                    <span
                                        class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>

                                    <span
                                        class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>

                                </div> --}}
                            </a>
                        </div>

                    @empty
                    @endforelse

                </div>

                @empty($comicBlCate)
                <h6 class="text-center text-danger">Không có truyện cùng thể loại</h6>
                @endempty

                
            </div>

            <div class="col-12 col-md-5 col-lg-4 sticky-md-top">

                <div class="row top-ratings">
                    <div class="col-12 top-ratings__tab mb-2">
                        <div class="list-group d-flex flex-row" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="top-day-list"
                                data-bs-toggle="list"
                                href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-day" role="tab"
                                aria-controls="top-day" aria-selected="true">Lượt Xem</a>
                            <a class="list-group-item list-group-item-action" id="top-month-list"
                                data-bs-toggle="list"
                                href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-month"
                                role="tab" aria-controls="top-month" aria-selected="false" tabindex="-1">Truyện mới</a>
                            <a class="list-group-item list-group-item-action" id="top-all-time-list"
                                data-bs-toggle="list"
                                href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-all-time"
                                role="tab" aria-controls="top-all-time" aria-selected="false" tabindex="-1">Nổi Bật
                                </a>
                        </div>
                    </div>
                    <div class="col-12 top-ratings__content">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="top-day" role="tabpanel"
                                aria-labelledby="top-day-list">
                                <ul>
                                    @foreach ($comicView as $key => $item)
                                        
                                    <li>
                                        <div class="rating-item d-flex align-items-center">
                                            <div class="rating-item__number bg-danger rounded-circle">
                                                <span class="text-light">{{ $key +1 }}</span>
                                            </div>
                                            <div class="rating-item__story">
                                                <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                    class="text-decoration-none hover-title rating-item__story--name text-one-row">{{ $item->name }}</a>
                                                <div class="d-flex flex-wrap rating-item__story--categories">
                                                    
                                                    @php
                                                        $comicCate = App\Models\Comic::comicCate($item->id);
                                                    @endphp
                                                    @foreach ($comicCate as $cate)
                                                        
                                                    <a href="{{ route('danh-muc', [$cate->slug]) }}"
                                                    class="text-dark">
                                                    {{ $cate->name." ," }}
                                                </a>
                                    
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                    
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="top-month" role="tabpanel"
                                aria-labelledby="top-month-list">
                                <ul>
                                   
                                    @foreach ($comicNew as $key => $item)
                                        
                                    <li>
                                        <div class="rating-item d-flex align-items-center">
                                            <div class="rating-item__number bg-danger rounded-circle">
                                                <span class="text-light">{{ $key +1 }}</span>
                                            </div>
                                            <div class="rating-item__story">
                                                <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                    class="text-decoration-none hover-title rating-item__story--name text-one-row">{{ $item->name }}</a>
                                                <div class="d-flex flex-wrap rating-item__story--categories">
                                                    
                                                    @php
                                                        $comicCate = App\Models\Comic::comicCate($item->id);
                                                    @endphp
                                                    @foreach ($comicCate as $cate)
                                                        
                                                    <a href="{{ route('danh-muc', [$cate->slug]) }}"
                                                        class="text-dark">
                                                        {{ $cate->name." ," }}
                                                    </a>
                                    
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="tab-pane fade" id="top-all-time" role="tabpanel"
                                aria-labelledby="top-all-time-list">
                               
                                @foreach ($comicOutstanding as $key => $item)
                                        
                                <li>
                                    <div class="rating-item d-flex align-items-center">
                                        <div class="rating-item__number bg-danger rounded-circle">
                                            <span class="text-light">{{ $key + 1 }}</span>
                                        </div>
                                        <div class="rating-item__story">
                                            <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                class="text-decoration-none hover-title rating-item__story--name text-one-row">{{ $item->name }}</a>
                                            <div class="d-flex flex-wrap rating-item__story--categories">
                                                
                                                @php
                                                    $comicCate = App\Models\Comic::comicCate($item->id);
                                                @endphp
                                                @foreach ($comicCate as $cate)
                                                    
                                                {{-- <span class="badge text-bg-danger"> --}}
                                                    <a href="{{ route('danh-muc', [$cate->slug]) }}"
                                                        class="text-dark">
                                                        {{ $cate->name." ," }}
                                                    </a>
                                                {{-- </span> --}}
                                
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-list-category bg-light p-2 rounded card-custom">
                    <div class="head-title-global mb-2">
                        <div class="col-12 col-md-12 head-title-global__left">
                            <h2 class="mb-0 border-bottom border-secondary pb-1">
                                <span href="#" class="d-block text-decoration-none text-dark fs-4"
                                    title="Truyện đang đọc">Thể loại truyện</span>
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Horizontal under breakpoint -->
                        <ul class="list-category">
                            @foreach ($kinds as $item)
                            <li class="">
                                <a href="{{ route('the-loai', [$item->slug]) }}"
                                    class="text-decoration-none text-dark hover-title">{{ $item->name }}</a>
                            </li>
                            @endforeach
                       
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</main>

@endsection