<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopupWalletRequest;
use App\Http\Requests\StoreWithdrawWalletRequest;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectApplicant;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $categories = Category::all();
        $projects = Project::orderByDesc('id')->get();
        return view('dashboard.index', compact('categories','projects'));
    }
    public function proposals()
    {
        return view('dashboard.proposals');
    }

    public function proposal_details(Project $project, ProjectApplicant $projectApplicant)
    {
        if ($projectApplicant->freelancer_id != auth()->id()) {
            abort(403, 'Anda bukan freelancer yang mengajukan proposal ini');
        }
        return view('dashboard.proposal_details', compact('projectApplicant', 'project'));
    }
    public function wallet()
    {
        $user = Auth::user();

        $wallet_transactions = WalletTransaction::where('user_id', $user->id)
            ->orderByDesc('id')
            ->paginate(3);

        return view('dashboard.wallet', compact('wallet_transactions'));
    }

    public function withdraw_wallet()
    {
        return view('dashboard.withdraw_wallet');
    }

    public function topup_wallet()
    {
        return view('dashboard.topup_wallet');
    }

    public function withdraw_wallet_store(StoreWithdrawWalletRequest $request)
    {
        $user = Auth::user();

        if ($user->wallet->balance < 100000) {
            return redirect()->back()->withErrors('amount', 'Balance anda saat ini tidak cukup');
        }

        DB::transaction(function () use ($request, $user) {
            $validated = $request->validated();
            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['type'] = 'Withdraw';
            $validated['amount'] = $user->wallet->balance;
            $validated['is_paid'] = false;
            $validated['user_id'] = $user->id;

            $newWithdrawalWallet = WalletTransaction::create($validated);

            $user->wallet->update([
                'balance' => 0
            ]);
        });
        return redirect()->route('dashboard.wallet');
    }

    public function topup_wallet_store(StoreTopupWalletRequest $request)
    {
        $user = Auth::user();

        DB::transaction(function () use ($request, $user) {
            $validated = $request->validated();
            if ($request->hasFile('proof')) {
                $proofPath = $request->file('proof')->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['type'] = 'Topup';
            $validated['is_paid'] = false;
            $validated['user_id'] = $user->id;

            $newTopupWallet = WalletTransaction::create($validated);
        });
        return redirect()->route('dashboard.wallet');
    }
}
