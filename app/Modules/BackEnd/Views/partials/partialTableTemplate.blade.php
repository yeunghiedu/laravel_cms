<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <div class="row">
        <div class="col-sm-6">
            <div class="dataTables_length" id="datatable_length" style="width:auto">
                @if($hasCreate)
                    @if($useModal)
                        <a href="#" class="btn btn-primary" id="btn-create" data-href="@yield('data-href-section')" data-toggle="modal" data-target="#actionModal" data-modal-title="@yield('data-modal-title-section')"><i class="fa fa-edit"></i> Create</a>
                    @else
                        <a href="@yield('link-create-section')" class="btn btn-primary" id="btn-create"><i class="fa fa-edit"></i> Create</a>
                    @endif
                <a href="@yield('link-delete-section')" class="btn btn-danger" id="btn-delete" style="display:none"><i class="fa fa-trash-o"></i> Delete </a>
                @endif
                <label>Show
                    <select name="datatable_length" aria-controls="datatable" class="form-control input-sm select_per_page">
                        @for($i=25; $i <= 100; $i += 25)
                            <option value="{{$i}}"<?php if ($i == $perPage) echo ' selected="selected"'; ?>>{{$i}}</option>
                        @endfor
                    </select>
                    entries</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="datatable-responsive_filter" class="dataTables_filter">
                <div class="input-group">
                    <input type="text" id="search_field" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                <tr class="headings">
                    <th>
                        <input type="checkbox" id="check-all" class="flat">
                    </th>
                    <th>No</th>
                    @foreach(array_keys($columnNames) as $key)
                        <th class="column-title sortable" aria-name="<?php echo strtolower($key)?>">{{$columnNames[$key]}} <i class="fa fa-sort"></i></th>
                    @endforeach

                    <th class="bulk-actions" colspan="11">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                    </th>
                </tr>
                </thead>

                <tbody>
                @section($composerViewName)
                    @for($i = 0; $i < count($dataPaginator); $i++)
                        <?php $item = $dataPaginator[$i];?>
                        <tr class="even pointer">
                            <td class="a-center ">
                                <input type="checkbox" class="flat" name="table_records">
                            </td>

                            <td>{{$startNo + $i + 1}}</td>

                            @foreach(array_keys($columnNames) as $key)
                                <td>{{$item[$key]}}</td>
                            @endforeach
                        </tr>
                    @endfor
                @show

                </tbody>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-5">
            <div class="dataTables_info" id="datatable-responsive_info" role="status" aria-live="polite">Showing {{$startNo + 1}} to {{$startNo + count($dataPaginator)}} of {{$dataPaginator->total()}} entries</div>
        </div>
        <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="datatable-responsive_paginate">
                {!! $dataPaginator->render() !!}
            </div>
        </div>
    </div>
</div>

@if($useModal)
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@yield('modal-title-section')</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
@endif