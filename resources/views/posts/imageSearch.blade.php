@foreach($images as $image)
    <li>
        <a href="#w" onclick="setImg('{{ $image->source }}');">
            <img src="/upload/media/posts/{{ $image->source }}-s.jpg">
        </a>
    </li>
@endforeach