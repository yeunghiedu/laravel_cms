@extends('BillingSystem::partials.partialTableTemplate')
@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr>
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