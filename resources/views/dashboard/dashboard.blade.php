@extends('layouts.main')
@section('content')
    hallo bro {{ Auth::user()->name }}
@endsection