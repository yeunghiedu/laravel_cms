@extends('BackEnd::layouts.layout-master')

@section('page-name-section','AccountScreen')
@section('role-section','accountIndex')

@section('css-section')
@endsection

@section('title-page-section','Account Management')

@section('content-section')
    <div class="x_content" id="table-content">
        
        <?php echo View::make('BackEnd::partials.partialAccountManagement',[
            'repositories' => $accRepo,
            'columnNames' => [
                'Account' => 'Account',
                'Name' => 'Name',
                'Email' => 'Email',
                'Phone' => 'Phone',
                'AccountType' => 'AccountType',
                'AccountStatus' => 'Status',
            ],
            'perPage' => $perPage,
            'path' => URL::route('BackEndAccount.index')
        ])->render(); ?>
    </div>
@endsection

@section('js-section')
@endsection