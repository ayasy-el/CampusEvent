<?php

namespace App\Exceptions;

use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // You may add reportable or renderable callbacks here.
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e): JsonResponse|RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof UniqueConstraintViolationException) {
            // Detect specific users email unique constraint
            if (Str::contains($e->getMessage(), 'users_email_unique')) {
                $message = 'Email sudah terdaftar. Silakan gunakan email lain.';

                if ($request->expectsJson() || $request->wantsJson()) {
                    return response()->json([
                        'message' => $message,
                        'errors' => [
                            'email' => [$message],
                        ],
                    ], 422);
                }

                return redirect()->back()
                    ->withInput($request->except(['password']))
                    ->withErrors(['email' => $message]);
            }

            // Detect specific speakers email unique constraint
            if (Str::contains($e->getMessage(), 'speakers_email_unique')) {
                $message = 'Email pembicara sudah terdaftar. Silakan gunakan email lain.';

                if ($request->expectsJson() || $request->wantsJson()) {
                    return response()->json([
                        'message' => $message,
                        'errors' => [
                            'email' => [$message],
                        ],
                    ], 422);
                }

                return redirect()->back()
                    ->withInput($request->except(['password']))
                    ->withErrors(['email' => $message]);
            }
        }

        return parent::render($request, $e);
    }
}
