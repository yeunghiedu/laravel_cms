@extends('BackEnd::layouts.layout-master')
@section('page-name-section','AccountScreen')
@section('role-section','accountInfo')

@section('title-page-section','Account Info')
@section('breadcrumb-section')
    <a href="{{URL::route('BackEndAccount.index')}}">Account</a> / AccountInfo
@endsection
@section('content-section')
    <div class="col-md-12 col-sm-6 col-xs-12">

        @if(session()->has('response'))
            <?php $response = session()->get('response')?>
            @if(!$response['error'])
            <div class="alert alert-success" role="alert">
                <strong>{{$response['message']}}</strong>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <strong>Update data error!!!!!!!!!!!!</strong>
            </div>
            @endif
        @endif
        <div class="x_content">
            <?php echo View::make('BackEnd::account.action.create-edit-acc',[
                    'isCreate' => false,
                    'accountId' => $account->Id
            ])->render(); ?>
        </div>
    </div>
@endsection

@section('js-section')
@endsection