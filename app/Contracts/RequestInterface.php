<?php


namespace App\Contracts;


use App\Http\Requests\RequestCreate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

interface RequestInterface
{

    /**
     * @return mixed
     */
    public function index();

    /**
     * Change request status.
     *
     * @param Request $request
     * @return Response
     */
    public function changeRequestStatus(Request $request);

    /**
     * Store a newly created resource in storage.
     *
     * @param RequestCreate $request
     * @return Response
     */
    public function store(RequestCreate $request);


}
