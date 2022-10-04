@foreach($post->comments as $comment)
@if($comment->status == 1)
    <li>
        <div class="comment">
            <figure class="comment-media">
                <a href="#">
                    <img src="assets/images/blog/comments/1.jpg" alt="User name">
                </a>
            </figure>

            <div class="comment-body">
{{--                <a href="#" class="comment-reply">پاسخ</a>--}}
                <div class="comment-user">
                    <h4><a href="#">کاربر 1</a></h4>
                    <span class="comment-date"> {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('Y-n-j')}}</span>
                </div> <!-- End .comment-user -->

                <div class="comment-content">
                    <p>
                        {{$comment->description}}
                    </p>
                </div><!-- End .comment-content -->
            </div><!-- End .comment-body -->
        </div><!-- End .comment -->

        <ul>
            @include('partials.commentsReply',['comments'=>$comment->replies])

        </ul>
    </li>
    @endif
@endforeach