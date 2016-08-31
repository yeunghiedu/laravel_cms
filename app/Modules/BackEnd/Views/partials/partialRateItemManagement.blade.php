@extends('BillingSystem::partials.partialTableTemplate')
@section('link-create-section',URL::route('BillingSystemRate.create'))
@section('link-delete-section',URL::route('BillingSystemRate.destroy'))

@section('data-modal-title-section', 'Create Rate Item')

@section('data-href-section',URL::route('BillingSystemAjax.loadModalRateitem',['rateId' => $dataPaginator[0]->RateId]))

@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr class="even pointer" data-href="{{URL::route('BillingSystemAjax.loadModalRateitem',['rateItemId' => $item->Id,'isCreate' => false])}}" data-toggle="modal" data-modal-title="Update Rate Item" data-target="#actionModal">
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                    {{$item[$key]}}
                </td>
            @endforeach
        </tr>
    @endfor
@endsection