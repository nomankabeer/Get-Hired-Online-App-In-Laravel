<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Repositories\Frontend\Freelancer;
use App\Bids;
use App\Job;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
class BidRepository extends BaseRepository
{
    protected $redirect = null;

}