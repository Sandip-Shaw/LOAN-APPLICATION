@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <div>
            <p>{{ Session::get('success') }}</p>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" role="alert">
        <div>
            <p>{{ Session::get('error') }}</p>
        </div>
    </div>
@endif

<script type="text/javascript">
	
 setTimeout(function() {
        $('.alert').remove();
    }, 8000);
</script>