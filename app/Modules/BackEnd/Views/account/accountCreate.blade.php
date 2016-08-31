@extends('BackEnd::layouts.layout-master')

@section('page-name-section','AccountScreen')

@section('role-section','accountCreate')
@section('breadcrumb-section')
    <a href="{{URL::route('BackEndAccount.index')}}">Account</a> / AccountCreate
@endsection

@section('css-section')
@endsection

@section('title-page-section','Create Account')

@section('content-section')
    <?php echo View::make('BackEnd::account.action.create-edit-acc',[
            'isCreate' => true
    ])->render(); ?>
@endsection

@section('js-section')
@endsection