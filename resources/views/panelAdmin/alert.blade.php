@if ($errors->any())
    <div class="row row-no-margin custom-alert">
        <div class="alert-top text-center alert-garmez1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong class="tik-icon">{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="row row-no-margin custom-alert">
        <div class="alert-top text-center alert-sabz1 alert-no-border">
            <ul>
                <li><strong class="tik-icon">{{ session('success') }}</strong></li>
            </ul>
        </div>
    </div>
@endif
