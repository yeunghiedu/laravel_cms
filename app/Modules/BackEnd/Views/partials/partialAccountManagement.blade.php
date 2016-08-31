@extends('BackEnd::partials.partialTableTemplate')
@section('link-create-section',URL::route('BackEndAccount.create'))
@section('link-delete-section',URL::route('BackEndAccount.destroy'))


@section($composerViewName)
    @for($i = 0; $i < count($dataPaginator); $i++)
        <?php $item = $dataPaginator[$i];?>
        <tr class="even pointer" data-href="{{URL::route('BackEndAccount.info',['accountId' => $item->Id])}}">
            <td class="a-center ">
                <input type="checkbox" class="flat" name="table_records" value="{{ $item->Id }}">
            </td>

            <td>{{$startNo + $i + 1}}</td>

            @foreach(array_keys($columnNames) as $key)
                <td>
                <?php
                        switch($key){
                            case 'AccountStatus':
                                if($item[$key] == 1) {
                                    echo 'Deactive';
                                } else {
                                    echo 'Active';
                                }
                                break;
                            case 'AccountType':
                                if($item[$key] == 1) {
                                    echo 'Editor';
                                } else {
                                    echo 'Administrator';
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