<div id="footer" class="footer border-top pt-2">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5">
                    <strong>Suu Truyện</strong> - <a title="Đọc truyện online" class="text-dark text-decoration-none"
                        href="#">Đọc truyện</a> online một cách nhanh nhất. Hỗ trợ mọi thiết bị như
                    di
                    động và máy tính bảng.
                </div>
                <ul class="col-12 col-md-7 list-unstyled d-flex flex-wrap list-tag">
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                    <li class="me-1">
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="đam mỹ hài">đam mỹ
                                hài</a></span>
                    </li>
                    <li>
                        <span class="badge text-bg-light"><a class="text-dark text-decoration-none"
                                href="#" title="truyện xuyên nhanh">truyện
                                xuyên
                                nhanh</a></span>
                    </li>
                </ul>

                <div class="col-12"> <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
                    {{-- <img
                            alt="Creative Commons License" style="border-width:0;margin-bottom: 10px"
                            src="./assets/images/88x31.png"></a> --}}
                            <br>
                    <p>Website hoạt động dưới Giấy phép truy cập mở <a rel="license"
                            class="text-decoration-none text-dark hover-title"
                            href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0
                            International License</a></p>
                </div>
            </div>
        </div>
    </div>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" 
    src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0&appId=7130739950357678" 
    nonce="5H895pVe">
    </script>

    {{-- <script src="{{ asset('client/js') }}/jquery.min.js">
    </script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('client/js') }}/popper.min.js">
    </script>

    <script src="{{ asset('client/js') }}/bootstrap.min.js">
    </script>



   <script src="{{ asset('client/js') }}/app.js">
    </script> 

    <script src="{{ asset('client/js') }}/myjs.js">
    </script>
    {{-- <script src="{{ asset('client/js') }}/common.js"></script> --}}



    {{-- search high leven --}}
    <script type="text/javascript">

        

        $(document).ready(function(){

        // search high leave
        $("#keyword").keyup(function(){

            let keyword = $(this).val();

            if(keyword != ''){

                let token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{ route('search-ajax') }}",
                    method: "POST",
                    data: {keyword:keyword, _token:token},
                    success: function(resource){
                        $('#search_ajax').fadeIn();
                        $('#search_ajax').html(resource);
                    }
                });

            }else{
                $('#search_ajax').fadeOut();
                // $('#search_ajax').hide();
            }

        });

        $(document).on('click', '.result-ajax', function(){
                $('#keyword').val( $(this).text() );
                $('#search_ajax').fadeOut();
        }); 
        // search high leave


        // Read Book Now


        $('.read_book').click( function(){

            let bookId = $(this).attr('id');
            let bookToken = $(this).attr('token');

            $.ajax({
                url: "{{ route('read_now') }}",
                method: "POST",
                data: {book_id:bookId, _token:bookToken},
                success: function(resource){
                    $('.modal-content').html(resource);
                }
            });

        });



        });






    
    </script>



    <div id="loadingPage" class="loading-full">
        <div class="loading-full_icon">
            <div class="spinner-grow"><span class="visually-hidden">Loading...</span></div>
        </div>
    </div>



</body>

</html>