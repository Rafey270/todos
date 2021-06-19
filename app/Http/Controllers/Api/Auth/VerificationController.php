<?php
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiHelper;
use App\Models\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    use VerifiesEmails;
    use ApiHelper;
    /**
     * Show the email verification notice.
     *
     */
    public function show()
    {
        //
    }
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $userID = $request['id'];
        $user = User::findOrFail($userID);
        $date = date("Y-m-d g:i:s");
        $user->email_verified_at = $date; // to enable the "email_verified_at field of that user be a current time stamp by mimicing the must verify email feature
        $user->save();
        toastr()->success('Email Verified Successfully');
        return redirect('login');//$this->success(200, null,'Email Verified Successfully');
    }
    /**
     * Resend the email verification notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user->hasVerifiedEmail())
        {
            return $this->error(422, null,'Email Already Verified');
        }
        $user->sendEmailVerificationNotification();
        return $this->success(200, null,'Email Resent Successfully');
    }
}
