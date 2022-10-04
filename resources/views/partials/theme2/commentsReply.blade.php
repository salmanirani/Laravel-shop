@foreach($comments as $comment)
    @if($comment->status != 0)
        <li>
            <div class="comment">
                <figure class="comment-media">
                    <a href="#">
                        <img src="assets/images/blog/comments/2.jpg"
                             alt="User name">
                    </a>
                </figure>

                <div class="comment-body">
                    <a href="#" class="comment-reply">پاسخ</a>
                    <div class="comment-user">
                        <h4><a href="#">کاربر 2</a></h4>
                        <span class="comment-date">9 فروردین 1401 - 2:19
                                                                بعدازظهر</span>
                    </div><!-- End .comment-user -->

                    <div class="comment-content">
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.</p>
                    </div><!-- End .comment-content -->
                </div><!-- End .comment-body -->
            </div><!-- End .comment -->
        </li>

@endif
@endforeach