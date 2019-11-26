@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session('success'))
    <div class="alert alert-success">
        <ul>
            @foreach (session('success') as $success)
                <li>{{ $success }}</li>
            @endforeach
        </ul>
    </div>
@endif