@extends('layouts.application')
@section('title', 'Upload File')
@section('content')
    <form action="{{ route('files.upload.post') }}" class="dropzone needsclick dz-clickable" id="demo-upload">
        @csrf
        <div class="dz-message needsclick">
            <button type="button" class="dz-button">Drop files here or click to upload.</button>
            <br>
        </div>
    </form>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/plugins/dropzonejs/basic.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/dropzonejs/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/dropzonejs/min/basic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/dropzonejs/min/dropzone.min.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('plugins/dropzonejs/dropzone.js') }}"></script>
    <script src="{{ asset('plugins/dropzonejs/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('plugins/dropzonejs/min/dropzone-amd-module.min.js') }}"></script>
    <script src="{{ asset('plugins/dropzonejs/dropzone-amd-module.js') }}"></script>
@endsection
