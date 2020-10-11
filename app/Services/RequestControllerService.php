<?php


namespace App\Services;


use App\Contracts\RequestInterface;
use App\Http\Requests\RequestCreate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RequestControllerService implements RequestInterface
{

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $requests = \App\Models\Request::with('user')->paginate(5);
        return view('dashboard', compact('requests'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function store(RequestCreate $request)
    {
        //check if exist storied data today
        $isCreatedToday = \App\Models\Request::where('user_id', Auth::id())->whereBetween('created_at', array(Carbon::now()->subDays(1    )
            ->toDateTimeString(), Carbon::now()->toDateTimeString()))
            ->exists();
        if ($isCreatedToday)
            return redirect()->back()->with('message','You can send message only one time in day!');

        $data = $request->all();
        $data['user_id'] = Auth::id();
        if ($request->hasFile('file')) {
            $filePath = $request->file('file');
            $fileName = time() . '.' . $filePath->getClientOriginalExtension();

            $path = $request->file('file')->storeAs('files/'.Auth::id(), $fileName, 'public');
            $data['file'] = '/storage/'.$path;
        };
        \App\Models\Request::create($data);
        return redirect()->back()->with('message','Message sent!');
    }

    /**
     * Change request status.
     *
     * @param Request $request
     * @return void
     */
    public function changeRequestStatus(Request $request)
    {
        $req = \App\Models\Request::findOrFail($request->id);
        $req->update(['status' => $request->status]);
    }

}
