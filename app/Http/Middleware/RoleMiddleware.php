<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Exception;
use Illuminate\Auth\AuthenticationException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  array ...$roles
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::guest()) {
            throw new AuthenticationException();
        }

        if (is_array($roles) && sizeof($roles) > 1) {

            if (!$this->userHasAnyRole($roles)) {
                return $this->returnResponseWithErrorMessage($request);
            }

        } elseif (is_array($roles) && $role = $roles[0]) {

            try {
                $this->validateUserHasRole($role);
            } catch (Exception $exception) {
                return $this->returnResponseWithErrorMessage($request, $exception->getMessage());
            }

        }

        return $next($request);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $message
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function returnResponseWithErrorMessage($request, $message = null)
    {
        // Use default error message if one is not passed explicitly
        if (empty($message)) {
            $message = __('middleware.roles.errors.general');
        }

        if ($request->ajax()) {
            return response()->json(['error' => $message]);
        }

        flash()->warning($message)->important();
        return redirect()->back();
    }


    /**
     * @param  array $roles
     * @return bool
     */
    protected function userHasAnyRole($roles)
    {
        foreach ($roles as $role) {
            try {
                return $this->validateUserHasRole($role);
            } catch (Exception $exception) {
                // Do nothing...
            }
        }

        return false;
    }

    /**
     * @param  string $role
     * @return bool
     * @throws Exception
     */
    protected function validateUserHasRole($role)
    {
        if ($role === 'super_admin') {
            if (Auth::user()->is_super_admin) {
                return true;
            }
            throw new Exception(__('middleware.roles.errors.super_admin'));
        }

        if ($role === 'admin') {
            if (Auth::user()->is_admin) {
                return true;
            }
            throw new Exception(__('middleware.roles.errors.admin'));
        }

        if ($role === 'mod') {
            if (Auth::user()->is_mod) {
                return true;
            }
            throw new Exception(__('middleware.roles.errors.mod'));
        }

        if ($role === 'disqualified') {
            if (Auth::user()->userSetting->is_disqualified_from_prediction_league) {
                return true;
            }
            throw new Exception(__('middleware.roles.errors.disqualified'));
        }

        if ($role === 'not_disqualified') {
            if (!Auth::user()->userSetting->is_disqualified_from_prediction_league) {
                return true;
            }
            throw new Exception(__('middleware.roles.errors.not_disqualified'));
        }

        return false;

    }
}
