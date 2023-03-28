@extends('layouts.app')

@section('content')
    
            <div class="container">
                @foreach ($comics as $comic)
            <table>
                <tr>
                    <th scope="row"{{ $comic->id }}></th>
                    <td>{{ $comic->title }}</td>
                    <td>{{ $comic->price }}</td>
                    <td>{{ $comic->quantity }}</td>
                    <td>
                        <a href="{{ route("comics.show", $comic->id) }}" class="btn btn-primary">Vedi</a>
                        <a href="{{ route("comics.show", $comic->id) }}" class="btn btn-warning">Aggiorna</a>
                    <form action="{{ route ("comics.destroy", $comic->id) }}" method="POST">
                        @csrf

                        @method("DELETE")
                        <input type="submit" value="Cancella">
                    </form>
                    </td>
                </tr>
                @endforeach
            </table>
            </div>
@endsection