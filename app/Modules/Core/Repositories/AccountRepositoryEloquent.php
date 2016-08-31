<?php

namespace App\Modules\Core\Repositories;

use App\Modules\Core\Utils\UtilHelper;
use App\Modules\DataModel\Models\Account;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Modules\Core\Validators\AccountValidator;

/**
 * Class AccountRepositoryEloquent
 * @package namespace App\Modules\Core\BS\Repositories;
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    protected $fieldSearchable = ['Account','Name','Email','Phone'];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Account::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AccountValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}