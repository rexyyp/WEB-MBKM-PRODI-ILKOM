@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa - MBKM System')

@section('role_name', 'Mahasiswa Panel')

@section('sidebar_menu')
    @include('components.sidebar.mahasiswa-sidebar')
@endsection