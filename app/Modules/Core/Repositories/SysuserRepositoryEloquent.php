<?php

namespace App\Modules\Core\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Modules\Core\Repositories\SysuserRepository;
use App\Modules\DataModel\Models\Sysuser;
use App\Modules\Core\Validators\SysuserValidator;

/**
 * Class SysuserRepositoryEloquent
 * @package namespace App\Modules\Core\Repositories;
 */
class SysuserRepositoryEloquent extends BaseRepository implements SysuserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Sysuser::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SysuserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
