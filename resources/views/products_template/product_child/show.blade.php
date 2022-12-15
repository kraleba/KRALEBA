@extends('layouts.app')

@section('content')
    <p>Product Name: {{ $template_parent->product_name }}</p>
    {{-- <p>Code: {{$template_parent-> }}</p>                                          //????????? --}}
    {{-- <p>#Colors: {{$template_parent-> }}</p> --}}
    {{-- <p>This Product: {{$template_parent-> }}</p> --}}
    <p>Type: {{ $template_parent->type }}</p>
    {{-- <p>Tailaring: {{$template_parent-> }}</p> --}}
    <h4 class="filter-selection">Marketing</h4>
    <p>Category: {{ $template_parent->category }}</p>
    <p>Theme: {{ $template_parent->theme }}</p>
    <p>Styles: {{ $template_parent->styles }}</p>
    <p>Occasion: {{ $template_parent->occasion }}</p>
    <p>Seasonality: {{ $template_parent->seasonality }}</p>
    <p>Author: {{ $template_parent->author }}</p>
    <p>Collection: {{ $template_parent->collection }}</p>
    <h4 class="filter-selection">Model</h4>
    <p>Cuffs: {{ $template_parent->cuffs }}</p>
    <p>Slits: {{ $template_parent->slits }}</p>
    <p>Sleeves: {{ $template_parent->sleeves }}</p>
    <p>Pockets: {{ $template_parent->pockets }}</p>
    <p>Stitching: {{ $template_parent->stitching }}</p>
    <p>Seams Colour: {{ $template_parent->seams_colour }}</p>
    <p>Buttons: {{ $template_parent->buttons }}</p>
    <p>Interlining: {{ $template_parent->interlining }}</p>
    <h4 class="filter-selection">Fabric</h4>
    {{-- <p>Product Name: {{ $template_parent->product_name }}</p>               ////in poaza apare de 2 ori --}}
    {{-- <p>Custom Code: {{$template_parent->custom_code}}</p> --}}
    {{-- <p>Composition: {{$template_parent->}}</p> --}}
    {{-- <p>Matirial: {{$template_parent->}}</p> --}}
    {{-- <p>Structure: {{$template_parent->}}</p> --}}
    {{-- <p>Design: {{$template_parent->}}</p> --}}
    {{-- <p>Weawing: {{$template_parent->}}</p> --}}
    {{-- <p>Color: {{$template_parent->}}</p> --}}
    {{-- <p>Finishing: {{$template_parent->}}</p> --}}
    {{-- <p>Percelved Weight: {{$template_parent->}}</p> --}}
    {{-- <p>Softness: {{$template_parent->}}</p> --}}
    {{-- <p>Look: {{$template_parent->}}</p> --}}
    {{-- <p>Grounds: {{$template_parent->}}</p> --}}
    {{-- <p>Weight in g/m2: {{$template_parent->}}</p> --}}
    {{-- <p>Widh: {{$template_parent->}}</p> --}}
    {{-- <p>Warp Th per cm: {{$template_parent->}}</p> --}}
    {{-- <p>Warp Th Yarn Ne: {{$template_parent->}}</p> --}}
    {{-- <p>Weft P per cm: {{$template_parent->}}</p> --}}
    {{-- <p>Origin: {{$template_parent->}}</p> --}}
    {{-- <p>Date: {{$template_parent->}}</p> --}}
    {{-- <p>Rating: {{$template_parent->}}</p> --}}
    {{-- <p>Description: {{$template_parent->}}</p> --}}

    @foreach ($template_child as $child)
        <div class="container">
            <img src="{{ asset('images.templates/' . $child->template_photo1) }}" />
        </div>

        <div class="container">
            <img src="{{ asset('images.templates/' . $child->template_photo2) }}" />
        </div>

        <div class="container">
            <img src="{{ asset('images.templates/' . $child->template_photo3) }}" />
        </div>
    @endforeach

@endsection

<style>
    .container {
        width: 200px;
        height: 200px;
    }

    /* Resize images */
    .container img {
        width: 200xp;
        height: 200px;
    }
</style>