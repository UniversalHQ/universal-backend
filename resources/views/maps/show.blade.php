@extends('base')

@section('content')
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
            <td>{{$map->deleted_at}}</td>
            <td>{{$map->created_at}}</td>
            <td>{{$map->updated_at}}</td>
        </tr>
        @endforeach
                </tbody>
            </table>
    </div>
@endsection
