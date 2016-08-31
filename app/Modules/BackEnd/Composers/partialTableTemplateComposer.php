<?php

namespace App\Modules\BackEnd\Composers;


use App\Modules\Core\Repositories\AccountRepository;
use App\Modules\Core\Constant;
use Illuminate\Support\Facades\URL;

class partialTableTemplateComposer
{
    public function compose($view){
        // get params value
        $viewdata= $view->getData();

        $repository = null;
        if(isset($viewdata['repositories']) || isset($viewdata['columnNames'])){

            $repository = $viewdata['repositories'];

            $columnNames = $viewdata['columnNames'];

            $perPage = isset($viewdata['perPage'])? $viewdata['perPage'] : Constant::PER_PAGE_DEFAULT;

            $method = isset($viewdata['method'])? $viewdata['method'] : 'paginate';

            $hasCreate = isset($viewdata['hasCreate'])?$viewdata['hasCreate']:true;

            $useModal = isset($viewdata['useModal'])?$viewdata['useModal']:false;

            $composerViewName = isset($viewdata['composerViewName'])?$viewdata['composerViewName']:'tableTemplate';

            if($method != 'paginate'){
                $dataPaginator = $repository->{$method['name']}($method['condition'], $perPage);
            } else {
                $dataPaginator = $repository->paginate($perPage);
            }

            if(isset($viewdata['path'])) {
                $dataPaginator->setPath($viewdata['path']);
            }

            $startNo = ($dataPaginator->currentPage() - 1) * $perPage;
            $view->with([
                'columnNames' => $columnNames,
                'dataPaginator' => $dataPaginator,
                'startNo' => $startNo,
                'perPage' => $perPage,
                'hasCreate' => $hasCreate,
                'useModal' => $useModal,
                'composerViewName' => $composerViewName
            ]);
        } else {
            echo 'Missing repository or columnNames param';
        }
    }
}