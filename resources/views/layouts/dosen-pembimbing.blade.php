@extends('layouts.app')

@section('title', 'Dashboard Dosen Pembimbing - MBKM System')

@section('role_name', 'Dosen Pembimbing Panel')

@section('sidebar_menu')
    @include('components.sidebar.dosen-pembimbing-sidebar')
@endsection