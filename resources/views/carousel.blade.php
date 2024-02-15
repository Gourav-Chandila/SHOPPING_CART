<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner bg-dark">
        @foreach ($carouselImages as $index => $image)
            <div class="carousel-item carousel-item-css  {{ $index == 0 ? 'active' : '' }}">
                <img class="d-block w-100" src="{{ asset($image) }}" alt="Slide {{ $index + 1 }}">
            </div>
        @endforeach
        
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
