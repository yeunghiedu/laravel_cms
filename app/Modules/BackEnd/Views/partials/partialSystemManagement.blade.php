@extends('BillingSystem::partials.partialTableTemplate')
@section('link-create-section',URL::route('BillingSystemSystem.create'))
@section('link-delete-section',URL::route('BillingSystemSystem.destroy'))

@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr class="even pointer" data-href="{{URL::route('BillingSystemSystem.info',['systemId' => $item->Id])}}">
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records" value="{{ $item->Id }}">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                    {{$item[$key]}}
                </td>
            @endforeach
        </tr>
    @endfor
    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}">
@endsection