<?php namespace App\Modules\BackEnd\Controllers;

use App\Modules\Core\Repositories\AccountRepository;
use App\Modules\Core\Constant;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\URL;

class AjaxController extends Controller {

	protected $accRepo;

	public function __construct(
		AccountRepository $accRepo
	){
		$this->accRepo = $accRepo;
	}

	public function loadAccountTableByPerpage(Request $request){
		if($request->ajax()) {
			$perPage = $request->input('perPage',Constant::PER_PAGE_DEFAULT);
			$orderby 	= $request->input('orderBy','');
			$sortby 	= $request->input('sortedBy','');
			$search 	= $request->input('search','');

			$columnNames = ['Account' => 'Account', 'Name' => 'Name', 'Email' => 'Email', 'Phone' => 'Phone', 'AccountType' => 'AccountType', 'AccountStatus' => 'Status'];

			$searchFields = array();
				foreach ($columnNames as $k => $n) {
					$searchFields[] = $k.':like';
				}
			if(!empty($searchFields)) $request->merge(array('searchFields'=>$searchFields));

			$returnHTML = view('BackEnd::partials.partialAccountManagement', [
				'repositories' => $this->accRepo,
				'columnNames' => $columnNames,
				'perPage' => $perPage,
				'path' => URL::route('BackEndAccount.index')
			])->render();

			return response()->json(array('success' => true, 'html' => $returnHTML, 'orderby'=>$orderby,'sortby'=>$sortby,'search'=>$search));
		}

		return response()->json(array('success' => false, 'html' => 'Not ajax request'));
	}
}