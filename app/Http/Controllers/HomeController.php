<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Career;
use App\Models\Line;
use App\Models\Role;
use App\Models\Student;
use App\Models\Document;
use App\Models\Investigation;
use App\Models\Undergraduate;
use App\Models\Announcement;
use App\Models\Headquarter;
use App\Models\Faculty;
use App\Models\Laboratory;
use App\Models\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function admin()
    {
        $title               = 'Panel de Control';
        $investigation_count = Investigation::all()->count();
        $undergraduate_count = Undergraduate::all()->count();
        $document_count      = Document::all()->count();
        $user_count          = User::all()->count();
        $headquarter_count   = Headquarter::count();
        $faculty_count       = Faculty::count();
        $career_count        = Career::count();
        $laboratory_count    = Laboratory::count();
        $announcement_count  = Announcement::count();
        $role_count          = Role::count();
        $ibars  = DB::table('investigations')
                    ->select('careers.name','lines.career_id', DB::raw('count(lines.id) as y'))
                    ->join('lines', 'investigations.line_id', '=', 'lines.id')
                    ->join('careers','lines.career_id','=','careers.id')
                    ->groupBy('lines.career_id')
                    ->get();

        $tbars  = DB::table('undergraduates')
                    ->select('careers.name', DB::raw('count(lines.id) as y'))
                    ->join('lines', 'undergraduates.line_id', '=', 'lines.id')
                    ->join('careers','lines.career_id','=','careers.id')
                    ->groupBy('lines.career_id')
                    ->get();

        $today      = date('Y-m-d');
        $iObservate = Investigation::where('status',2)->count();
        $tObservate = Undergraduate::where('status',2)->count();
        $iAbandoned = Investigation::where('status',3)->count();
        $tAbandoned = Undergraduate::where('status',3)->count();
        $newUser    = User::where('created_at', 'LIKE', $today."%")->count();
        $newT       = Undergraduate::where('created_at', 'LIKE', $today."%")->count();
        $newI       = Investigation::where('created_at', 'LIKE', $today."%")->count();
        return response()->json(
            compact(
                'title',
                'investigation_count',
                'undergraduate_count',
                'document_count',
                'user_count',
                'headquarter_count',
                'faculty_count',
                'career_count',
                'laboratory_count',
                'announcement_count',
                'role_count',
                'ibars',
                'tbars',
                'iObservate',
                'tObservate',
                'iAbandoned',
                'tAbandoned',
                'newUser',
                'newI',
                'newT',
            ),200);
    }

    public function config(Request $request)
    {
        if($request->ajax())
        {
            $exist = Config::where('user_id',auth()->user()->id)->first();
            if(empty($exist->id))
            {
                $config = new Config;
                $config->user_id = auth()->user()->id;
                // $config->theme   = $request->style;
                $config->filter  = $request->filter;
                $config->notify  = $request->notify;
                $config->save();
                session([
                    // 'style'  => $request->style,
                    'notify' => $request->notify,
                    'filter' => $request->filter
                ]);
            }
            else
            {
                session([
                    // 'style'  => $request->style,
                    'notify' => $request->notify,
                    'filter' => $request->filter
                    ]);
                $exist->update([
                    // 'theme'  => $request->style,
                    'notify' => $request->notify,
                    'filter' => $request->filter
                ]);
            }
        }
    }
}
