@foreach($comments as $comment)

    <li class="comments__list-item has-childe">
        <div class="comments__list-header">

            <span class="comments__list-name">{{$product->user->name}}</span>
        </div>
        <p class="comments__list-text">
            {{$comment->description}}
        </p>
        <div class="comments__list-footer">
{{--            <div class="comments__list-reply">--}}
{{--                <a href="#" title="" class="reply">--}}
{{--                    <i class="icon-reply"></i>--}}
{{--                </a>--}}
{{--                <span class="title">ارسال پاسخ</span>--}}
{{--            </div>--}}
            <span class="comments__list-date">
                                           {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}
                                        </span>
        </div>
            @include('partials.mtcommentsReply',['comments'=>$comment->replies])
{{--{{$comment->replies}}--}}
    </li>
    @if(Auth::check())
{{--        {!! Form::open((['method'=>'GET','route'=>['frontend.mtcomments.reply',$product->id],'class'=>'comments__form'])) !!}--}}
{{--    <div class="filter__category-search">--}}
{{--        {!! Form::hidden('product_id',$product->id) !!}--}}
{{--        {!! Form::hidden('parent_id',$comment->id) !!}--}}

{{--        {!! Form::text('description',null,['class'=>'form-control']) !!}--}}
{{--        <div class="comments__form-btn">--}}
{{--            {!! Form::button('ثبت پاسخ <i class="icon-arrow-left"></i> ', ['class' => 'btn btn-block btn-success btn-sm', 'type' => 'submit']) !!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    {!! Form::close() !!}--}}
        @endif

@endforeach
