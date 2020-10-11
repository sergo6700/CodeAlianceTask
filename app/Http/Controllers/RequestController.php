<?php

namespace App\Http\Controllers;

use App\Contracts\RequestInterface;
use App\Http\Requests\RequestCreate;
use App\Services\RequestControllerService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestController extends Controller
{

    private $requestRepo;

    /**
     * RequestController constructor.
     * @param RequestInterface $requestRepo
     */
    public function __construct(
        RequestInterface $requestRepo
    )
    {
        $this->requestRepo = $requestRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return $this->requestRepo->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestCreate $request
     * @return Response
     */
    public function store(RequestCreate $request)
    {
        return $this->requestRepo->store($request);
    }

    /**
     * Change request status.
     *
     * @param Request $request
     * @return Response
     */
    public function changeRequestStatus(Request $request)
    {
        return $this->requestRepo->changeRequestStatus($request);
    }
}
