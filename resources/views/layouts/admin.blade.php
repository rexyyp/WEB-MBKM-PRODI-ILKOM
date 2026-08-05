@extends('layouts.app')

@section('title', 'Dashboard Admin - MBKM System')

@section('role_name', 'Admin Panel')

@section('sidebar_menu')
    @include('components.sidebar.admin-sidebar')
@endsection
