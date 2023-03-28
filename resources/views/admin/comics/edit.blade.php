@extends('layouts.layout')
@section('pageTitle') Laravel Comics @endsection

@section('content')

<main class="bg-dark p-3">
    <a href="{{ route('admin.comics.show', $comic->id) }}" class="btn btn-primary mb-3">
        torna indietro
    </a>

    <div class="container bg-white p-3">
        <h1 class="text-center">Modifica Comic</h1>

        <form action="{{ route('comics.update', $comic->id) }}" method="POST">
            @csrf

            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label @error('name') text-danger @enderror">titolo</label>
                <input type="text" name="name" class="form-control @error('name') border border-danger @enderror" id="name" value="{{ $comic->name }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label @error('image') text-danger @enderror">Immagine</label>
                <input type="text" name="image" class="form-control @error('image') border border-danger @enderror" id="image" value="{{ $comic->image }}">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label @error('quantity') text-danger @enderror">Data vendita</label>
                <input type="date" name="quantity" class="form-control @error('quantity') border border-danger @enderror" id="quantity" value="{{ $comic->quantity }}">
            </div>

            <div class="mb-3">
                <label for="price" class="form-label @error('price') text-danger @enderror">prezzo</label>
                <input type="text" name="price" class="form-control @error('price') border border-danger @enderror" id="price" value="{{ $comic->price }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label @error('description') text-danger @enderror">Descrizione</label>
                <textarea class="form-control @error('description') border border-danger @enderror" name="description" id="description" rows="3">{{ $comic->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">SALVA MODIFICHE</button>
        </form>
    </div>
</main>

@endsection