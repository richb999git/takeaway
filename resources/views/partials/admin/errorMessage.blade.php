@if (session('errorMessage')) 
    <br>
    <div class="container">
        <div class="card-body bg-danger">
            <span class="text-white">{{ session('errorMessage') }}</span>
        </div>
    </div>
@endif