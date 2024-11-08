<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AdditionalService;
use App\Models\AreaZone;
use App\Models\Booking;
use App\Models\BookingDeposit;
use App\Models\BookingServices;
use App\Models\CarAvailability;
use App\Models\Cars;
use App\Models\Charge;
use App\Models\DeliveryPickupCharge;
use App\Models\Deposit;
use App\Models\Driver;
use App\Models\ManageBooking;
use App\Models\Promotion;
use App\Models\RentalRates;
use App\Models\SecurityDeposits;
use App\Models\Service;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {


        return view('admin.dashboard');
    }
}
