@foreach($comments as $comment)
    @if($comment->status != 0)
    <ul class="children">
        <li class="comments__list-item comments__list-item--reply">
            <div class="comments__list-header">

                <span class="des-font">{{$post->user->name}}</span>
            </div>
            <p class="des-font">
               {{$comment->description}}
            </p>
            <div class="comments__list-footer">

                <span class="comments__list-date">
                                           {{\Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('Y-n-j')}}
                                        </span>
            </div>
        </li>
    </ul>

@endif
@endforeach