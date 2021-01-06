@extends('base')

@section('content')
    <div>
        <h1> War {{ $war->war_number }}</h1>
        <div>Started at: {{ $war->started_at }}</div>
        <div>Ended at: {{ $war->ended_at }}</div>
    </div>

    <div>
        <h1> Maps </h1>
        <table>
            <thead>
                <th>id</th>
                <th>name</th>
                <th>totalEnlistments</th>
                <th>colonialCasualties</th>
                <th>wardenCasualties</th>
                <th>dayOfWar</th>
                <th>version</th>
                <th>deleted_at</th>
                <th>created_at</th>
                <th>updated_at</th>
            </thead>
            <tbody>
            @foreach($maps as $map)
                <tr>
                    <td>{{$map->id}}</td>
                    <td>{{$map->name}}</td>
                    <td>{{$map->totalEnlistments}}</td>
                    <td>{{$map->colonialCasualties}}</td>
                    <td>{{$map->wardenCasualties}}</td>
                    <td>{{$map->dayOfWar}}</td>
                    <td>{{$map->version}}</td>
                    <td>{{$map->warReport->deleted_at}}</td>
                    <td>{{$map->created_at}}</td>
                    <td>{{$map->warReport->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>
        @foreach($maps as $map)
            <p>Map: {{ $map->name }}</p>
            <table>
                <tbody>
                @foreach($mapObjects as $mapObject)
                    @if($mapObject->map->id == $map->id)
                        <tr>
                            <td>{{$mapObject->text}}</td>
                            <td>{{$mapObject->object_type}}</td>
                            <td>{{$mapObject->team_id}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
@endsection