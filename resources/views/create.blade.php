@extends('layouts.app')

@section('content')

<h4 class="d-flex justify-content-center">Giulia, a cosa stai pensando?</h4>

<div class="">
    <form action="{{ route("update") }}" method="POST">
        @csrf
        @method('POST')
        <input type="text" name="title" value="">
        <input type="text" name="author" value="">
        <h4 class="mt-2">Seleziona Categoria</h4>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="categories"
                                        value="{{ $category['id'] }}" id="categories1">
                                    <label class="form-check-label" for="categories1">
                                        {{ $category['title'] }}
                                    </label>
                                </div>
                            @endforeach
        <input type="text" name="tag" value="">
        <input type="text" name="description" value="">
        <button type="submit">Pubblica</button>
    </form>
</div>


@endsection
