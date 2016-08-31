@extends('BillingSystem::partials.partialTableTemplate')
@section('link-create-section',URL::route('BillingSystemSysuser.create'))
@section('link-delete-section',URL::route('BillingSystemSysuser.destroy'))

@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr class="even pointer" data-href="{{URL::route('BillingSystemSysuser.info',['sysuserId' => $item->Id])}}">
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records" value="{{ $item->Id }}">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                <?php
                    switch($key){
                        case 'Role':
                            if($item[$key] == 0) {
                                echo 'SystemAdministrator';
                            } elseif($item[$key] == 1) {
                                echo 'Demo User';
                            } else {
                                echo 'Guest';
                            }
                            break;
                        case 'Status':
                            if($item[$key] == 0) {
                                echo 'Normal';
                            } else {
                                echo 'Blocked';
                            }
                            break;
                        default:
                            echo $item[$key];
                    }
                ?>
                </td>
            @endforeach
        </tr>
    @endfor
    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
@endsection