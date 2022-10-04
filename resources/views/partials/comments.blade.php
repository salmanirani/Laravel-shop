@foreach($post->comments as $comment)
@if($comment->status == 1)
    <li class="comments__list-item has-childe">
        <div class="comments__list-header">

{{--            <span class="des-font"> کاربر شماره   {{$post->user->id}}  </span>--}}
        </div>
        <p class="des-font">
            {{$comment->description}}
        </p>
        <div class="comments__list-footer">

            <span class="comments__list-date">
                                           {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('Y-n-j')}}
                                        </span>
        </div>
            @include('partials.commentsReply',['comments'=>$comment->replies])
    </li>
{{--    {!! Form::open((['method'=>'GET','route'=>['frontend.comments.reply',$post->id],'class'=>'comments__form'])) !!}--}}
{{--    <div class="filter__category-search">--}}
{{--        {!! Form::hidden('post_id',$post->id) !!}--}}
{{--        {!! Form::hidden('parent_id',$comment->id) !!}--}}

{{--        {!! Form::text('description',null,['class'=>'form-control']) !!}--}}
{{--            {!! Form::button('ثبت پاسخ  ', ['class' => 'menu-font', 'type' => 'submit']) !!}--}}

{{--    </div>--}}
{{--    {!! Form::close() !!}--}}
<hr/>
    @endif
@endforeach