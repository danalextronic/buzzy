<div class="external-sign-in">
    <a href="javascript:" style="margin-left:0;" data-link="{{ Request::url() }}" data-name="{{ $post->title }}" data-image="{{ asset('/upload/media/posts/'.$post->thumb.'-b.jpg') }}" data-description="{{ $post->body }}" class="Facebook postToFacebookFeed"></a>

    <a href="https://twitter.com/intent/tweet?url={{ Request::url() }}&text={{ $post->title }}"  class="Twitter popup-action"></a>

    

    <a href="http://reddit.com/submit?url={{ Request::url() }}&title={{ $post->title }}" class="Reddit popup-action"></a>

    <a href="http://pinterest.com/pin/create/link/?url={{ Request::url() }}&media={{ makepreview($post->thumb, 'b', 'posts') }}&description={{ $post->title }}" class="Pinterest popup-action"></a>
</div>