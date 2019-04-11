<div class="container">
    @if ($errors->any())
        <br>
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                @foreach ($errors->all() as $error) 
                    <p class="card-text">{{ $error }}</p>     
                @endforeach
            </div>
        </div>
    @endif
</div>