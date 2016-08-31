@extends('BillingSystem::partials.partialTableTemplate')
@section('link-create-section',URL::route('BillingSystemCharge.create'))
{{-- @section('link-delete-section',URL::route('BillingSystemCharge.destroy')) --}}

@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr>
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records" value="{{ $item->Id }}">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                <?php
                    switch($key){
                        case 'ChargeMode':
                            if($item[$key] == 0) {
                                echo 'Cash';
                            } elseif($item[$key] == 1) {
                                echo 'Charging card';
                            }else{
                                echo 'Other';
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