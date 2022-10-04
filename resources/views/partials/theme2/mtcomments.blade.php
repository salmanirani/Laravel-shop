

@foreach($comments as $comment)
    <div class="review">
        <div class="row no-gutters">
            <div class="col-auto">
                <h4><a href="#">{{$product->user->name}}1</a></h4>
                <div class="ratings-container">
                    <div class="ratings">
                        <div class="ratings-val" style="width: 100%;"></div>
                        <!-- End .ratings-val -->
                    </div><!-- End .ratings -->
                </div><!-- End .rating-container -->
                <span class="review-date">{{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}
                </span>
            </div><!-- End .col -->
            <div class="col-12">

                <div class="review-content">
                    <p>{{$comment->description}}</p>
                </div><!-- End .review-content -->

                <div class="review-action">
                    <a href="#"><i class="icon-thumbs-up"></i>مثبت (2)</a>
                    <a href="#"><i class="icon-thumbs-down"></i>منفی (0)</a>
                </div><!-- End .review-action -->
            </div><!-- End .col-auto -->
        </div><!-- End .row -->
    </div>
{{--            @include('partials.mtcommentsReply',['comments'=>$comment->replies])--}}

{{--    @if(Auth::check())--}}
{{--        <form class="comments__form" method="get" action="{{route('frontend.mtcomments.reply',$product->id)}}">--}}
{{--            @csrf--}}
{{--            <div class="filter__category-search">--}}
{{--                <input type="hidden" name="product_id" class="{{$product->id}}">--}}
{{--                <input type="hidden" name="parent_id" class="{{$comment->id}}">--}}
{{--                <input type="text"  name="description" class="form-control">--}}
{{--                <div class="comments__form-btn">--}}
{{--                    <button type="submit"    class="btn btn-info">پاسخ </button>--}}


{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    @endif--}}

@endforeach
