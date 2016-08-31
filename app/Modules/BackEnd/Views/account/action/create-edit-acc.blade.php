<div class="col-md-12 col-sm-12 col-xs-12">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="x_panel">
        <form method="post" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="<?php echo $isCreate? URL::route('BackEndAccount.store'):URL::route('BackEndAccount.update',[$account->Id]);?>">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @if($isCreate)
                        <input type="text" id="acc-Account" name="Account" required="required" class="form-control col-md-7 col-xs-12">
                    @else
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 account-info-name">{{$account->Account}}</label>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Display Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="acc-name" class="form-control col-md-7 col-xs-12" type="text" name="Name" value="<?php echo !$isCreate? $account->Name:''; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" id="acc-Account" name="Password" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo !$isCreate? $account->Password:'';?>">
                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account Type <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="AccountType">
                        @for($i=0; $i < count($accountType); $i ++)
                            <option value="{{$i}}" <?php echo (!$isCreate && $i == $account->AccountType)?'selected="selected"':''; ?>>{{$accountType[$i]}}</option>
                        @endfor
                    </select>

                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Account Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="AccountStatus">
                        @for($i=0; $i < count($accountStatus); $i ++)
                            <option value="{{$i}}" <?php echo (!$isCreate && $i == $account->AccountStatus)?'selected="selected"':''; ?>>{{$accountStatus[$i]}}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="email" id="acc-email" class="form-control" name="Email" data-parsley-trigger="change" required="required" value="<?php echo !$isCreate? $account->Email:''; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="acc-name" class="form-control col-md-7 col-xs-12" type="text" name="Phone" required="required" value="<?php echo !$isCreate? $account->Phone:''; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Address</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="acc-address" class="form-control col-md-7 col-xs-12" type="text" name="Address" value="<?php echo !$isCreate? $account->Address:''; ?>">
                </div>
            </div>

            <div class="ln_solid"></div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a href="{{URL::route('BackEndAccount.index')}}" class="btn btn-primary" id="btn-Cancel">Cancel</a>
                    <button type="submit" class="btn btn-success" id="btn-Save">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>