<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach ($banner->items as $key => $item)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" @if($key == 0) class="active" @endif></li>
        @endforeach
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach ($banner->items as $key => $item)
            @if ($item->image)
                <div class="item @if($key == 0) active @endif"
                    @if ($item->url)
                        onclick="window.location.href='{{ $item->url }}'"
                    @endif
                >
                    <img src="{{ $item->image }}" alt="">
                    <div class="carousel-caption">
                        <h3>{{ $item->title }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @endif
      @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

@push('scripts')
    <script>
        $(function() {
            $('.carousel').carousel()
        })
    </script>
@endpush
