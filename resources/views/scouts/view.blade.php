<h1>{{ $scout->first_name }} {{ $scout->last_name }}</h1>
<p>{{ $scout->birth_date->format('M d,Y') }}</p>
<p>{{ $scout->address }}</p>
<p>{{ $scout->city }}, {{$scout->state}} {{$scout->postal_code}}</p>
<p>{{ $scout->phone_number }}</p>
<p>{{ $scout->email }}</p>
@if(!empty($scout->rank))
    <p>Current Rank: {{ $scout->rank->name }}</p>
    <p>Working On: {{$scout->nextRank->name}}</p>
@else
    <p>Working On: Bobcat</p>
@endif