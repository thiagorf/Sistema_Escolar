@foreach ($content->comments as $comment)
                <p>{{$comment->user->name}}: {{$comment->comment}}</p>
@endforeach