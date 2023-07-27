@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Create post
                    <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('posts.index') }}">Posts</a>
                </span>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'posts.store', 'method'=>'POST','files'=>'true') ) !!}
                    <div class="form-group">
                        <strong>Event Name:</strong>
                        {!! Form::text('event_name', null, array('placeholder' => 'Event Name','class' => 'form-control')) !!}
                    </div>
                    <label class="mb-3 top-label">
                        <input name="logo_path"
                               class="form-control
                                 @if ($errors->has('logo_path')) border-danger @endif"
                               type="file" accept=".png, .jpg, .jpeg" required="" >

                        @if ($errors->has('logo'))
                            <div id="logo_path-error" class="error">{{ $errors->first('logo_path') }}
                            </div>
                        @endif
                        <span>Logo</span>
                    </label>
                    <div class="form-group">
                        <strong>The Guests:</strong>
                        {!! Form::text('the_guests', null, array('placeholder' => 'The Guests','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Club Name:</strong>
                        {!! Form::text('club_name', null, array('placeholder' => 'Club Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Club Location:</strong>
                        {!! Form::text('club_location', null, array('placeholder' => 'Club Location','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <strong>Data Time:</strong>
                        {!! Form::dateTime('datetime', null, array('placeholder' => 'dataTime','class' => 'form-control')) !!}
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <strong>Club Location:</strong>--}}
{{--                        {!! Form::text('club_location', null, array('placeholder' => 'Club Location','class' => 'form-control')) !!}--}}
{{--                    </div>--}}
                    <div class="form-group">
                        <strong>Zones:</strong>
                        <div class="row" id="zones-container">
                            <div class="col">
                                <input type="text" name="zones[0][name]" class="form-control" placeholder="Zone Name" required>
                            </div>
                            <div class="col">
                                <input type="number" name="zones[0][price]" class="form-control" placeholder="Zone Price" required min="0">
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-zone">Add Zone</button>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        const zonesContainer = document.getElementById('zones-container');
        const addZoneButton = document.getElementById('add-zone');
        let   zoneCounter = 1;

        addZoneButton.addEventListener('click', () => {
            const newZone = `
            <div class="row mt-2">
                <div class="col">
                    <input type="text" name="zones[${zoneCounter}][name]" class="form-control" placeholder="Zone Name" required>
                </div>
                <div class="col">
                    <input type="number" name="zones[${zoneCounter}][price]" class="form-control" placeholder="Zone Price" required min="0">
                </div>
            </div>
        `;
            zonesContainer.insertAdjacentHTML('beforeend', newZone);
            zoneCounter++;
        });
    </script>

@endsection
