@if(session()->has('flash_message'))
    <p class="alert-success"> {{ session('flash_message')}} </p>
@endif