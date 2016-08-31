@extends('BillingSystem::partials.partialTableTemplate')
@section('link-create-section',URL::route('BillingSystemRate.create'))
@section('link-delete-section',URL::route('BillingSystemRate.destroy'))

@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr class="even pointer" data-href="{{URL::route('BillingSystemRate.info',['rateId' => $item->Id])}}">
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                <?php
                        switch($key){
                            case 'AgentId':
                                echo $repositories['accRepo']->find($item[$key])->Account;
                                break;
                            default:
                                echo $item[$key];
                        }
                ?>
                </td>
            @endforeach
        </tr>
    @endfor
@endsection