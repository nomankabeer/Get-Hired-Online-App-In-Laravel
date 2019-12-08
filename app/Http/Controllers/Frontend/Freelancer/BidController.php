<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Http\Controllers\Frontend\Freelancer;
use Illuminate\Http\Request;
use App\Repositories\Frontend\Freelancer\BidRepository;
use App\Http\Controllers\Controller;
class BidController extends Controller
{
    protected $bidRepository = null;
    public function __construct(BidRepository $bidRepository){
        $this->bidRepository = $bidRepository;
    }
}
