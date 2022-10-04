@foreach($comments as $comment)
    @if($comment->status ==1)
    <ul class="children">
        <li class="comments__list-item comments__list-item--reply">
            <div class="comments__list-header">

                <span class="comments__list-name">{{$product->user->name}}</span>
            </div>
            <p class="comments__list-text">
               {{$comment->description}}
            </p>
            <div class="comments__list-footer">

                <span class="comments__list-date">
                                           {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->formatDifference(\Hekmatinasser\Verta\Verta::today('Asia/Tehran'))}}
                                        </span>
            </div>
        </li>
    </ul>
{{--    {!! Form::open((['method'=>'GET','route'=>['frontend.comments.reply',$post->id],'class'=>'comments__form'])) !!}--}}
{{--    <div class="filter__category-search">--}}
{{--        {!! Form::hidden('post_id',$post->id) !!}--}}
{{--        {!! Form::hidden('parent_id',$comment->id) !!}--}}

{{--        {!! Form::text('description',null,['class'=>'form-control']) !!}--}}
{{--        <div class="comments__form-btn">--}}
{{--            {!! Form::button('ثبت پاسخ <i class="icon-arrow-left"></i> ', ['class' => 'btn btn-block btn-success btn-sm', 'type' => 'submit']) !!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    {!! Form::close() !!}--}}
@endif
@endforeach
