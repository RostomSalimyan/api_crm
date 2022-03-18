<?php

namespace App\Modules\Admin\User\Controllers\Api;

use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Requests\UserRequest;
use App\Modules\Admin\User\Services\UserService;
use App\Services\Response\ResponseServise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{

    private $service;

    /**
     * RoleController constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }



    public function index()
    {
        //
        $this->authorize('view', new User());

        $users = $this->service->getUsers();

        return ResponseServise::sendJsonResponse(true, 200,[],[
           'users' =>  $users->toArray()
        ]);
    }

    /**
     * Create of the resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    public function store(UserRequest $request)
    {
        //
        $user = $this->service->save($request, new User());
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'user' =>  $user->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse|Response
     */
    public function show(User $user)
    {
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'user' =>  $user->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user = $this->service->save($request, $user);
        return ResponseServise::sendJsonResponse(true, 200,[],[
            'user' =>  $user->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
        $user->status = '0';
        $user->update();

        return ResponseServise::sendJsonResponse(true, 200,[],[
            'user' =>  $user->toArray()
        ]);
    }

    public function usersForm() {
        //
        $this->authorize('view', new User());

        $users = $this->service->getUsers(1);

        return ResponseServise::sendJsonResponse(true, 200,[],[
            'users' =>  $users->toArray()
        ]);
    }
}
