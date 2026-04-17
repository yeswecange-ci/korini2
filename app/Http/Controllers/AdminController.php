<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $leads = $query->orderByDesc('created_at')->paginate(25)->withQueryString();

        $stats = [
            'total'        => Lead::count(),
            'today'        => Lead::whereDate('created_at', today())->count(),
            'this_week'    => Lead::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month'   => Lead::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'actif'        => Lead::where('status', 'actif')->count(),
            'desabonne'    => Lead::where('status', 'desabonne')->count(),
        ];

        $sources = Lead::select('source')->distinct()->pluck('source');

        return view('admin.dashboard', compact('leads', 'stats', 'sources'));
    }

    public function export(Request $request)
    {
        $query = Lead::query();

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $leads = $query->orderByDesc('created_at')->get();

        $csv = "ID,Email,Source,Statut,IP,Date d'inscription\n";
        foreach ($leads as $lead) {
            $csv .= implode(',', [
                $lead->id,
                $lead->email,
                $lead->source,
                $lead->status,
                $lead->ip_address ?? '',
                $lead->created_at->format('d/m/Y H:i'),
            ]) . "\n";
        }

        $filename = 'leads_' . now()->format('Y-m-d_His') . '.csv';

        return Response::make($csv, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate(['status' => 'required|in:actif,desabonne']);
        $lead->update(['status' => $request->status]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
