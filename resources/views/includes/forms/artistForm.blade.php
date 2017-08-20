<form class="" action="{{ route('artists.store') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label class="form-control-label" for="artist_name">Name</label>
        <input type="text" class="form-control" id="artist_name" name="artist[name]" value="{{ $artist->name or old('artist.name') }}">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="begin_date">Formed Date</label>
        <input type="date" class="form-control" id="begin_date" placeholder="YYYY-mm-dd" name="artist[begin_date]" value="{{ $artist->begin_date or old('artist.begin_date') }}">
    </div>

    <div class="form-group">
        <label class="form-control-label" for="end_date">Disbanded Date</label>
        <input type="date" class="form-control" id="end_date" placeholder="YYYY-mm-dd" name="artist[end_date]" value="{{ $artist->end_date or old('artist.end_date') }}">

        <div class='input-group date' id='datetimepicker1'>
            <input type='text' class="form-control" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <div class="form-group">
        <label class="form-control-label" for="label_id">Label</label>
        <select class="form-control" id="label_id" name="artist[label_id]">
            @if (isset($artist) && Route::currentRouteName('artists.edit'))
                @foreach($labels as $label)
                    <option value="{{ $artist->label_id }}" "{{ $artist->label_id == $label->id ? selected : '' }}">{{ $label->name }}</option>
                @endforeach
            @elseif (isset($artist) && Route::currentRouteName('artists.show'))
                <option value="{{ $artist->label_id }}" selected>{{ $artist->label->name }}</option>
            @else
                @foreach($labels as $label)
                    <option value="{{ $label->id }}">{{ $label->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <div class="form-group">
        <label class="form-control-label" for="country_code">Country</label>
        <select class="form-control" id="country_code" name="artist[country_code]">
            @foreach($countries as $country)
            <option value="{{ $country->code }}">{{ $country->name }}</option>
            @endforeach

            @if (isset($artist) && Route::currentRouteName('artists.edit'))
                @foreach($countries as $country)
                    <option value="{{ $country->code }}" "{{ $artist->country_code == $country->code ? selected : '' }}">{{ $country->name }}</option>
                @endforeach
            @elseif (isset($artist) && Route::currentRouteName('artists.show'))
                <option value="{{ $country->code }}" selected>{{ $artist->country->name }}</option>
            @else
                @foreach($countries as $country)
                    <option value="{{ $country->code }}">{{ $country->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Artist</button>
</form>
