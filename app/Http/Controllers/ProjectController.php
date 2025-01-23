<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\IpaBaja;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Buat query builder
        $projects = Project::query();

        // Cek apakah ada parameter search
        if (request('search')) {
            $projects->where('name', 'like', '%' . request('search') . '%');
        }

        // Load relations untuk ipabaja dan client
        $projects = $projects->with(['ipabaja', 'client'])->paginate(20);

        // Kirim data ke view
        return view('pages.projects.index', compact('projects'));
    }

    public function create()
    {
        $ipaBajas = IpaBaja::all();
        $clients = Client::all();

        return view('pages.projects.create', compact('ipaBajas', 'clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "ipa_baja_id" => "required|exists:ipa_bajas,id",
            "client_id" => "required|exists:clients,id",
            "location" => "required",
            "project_value" => "required|numeric|min:0",
            "status" => "required"
        ], [
            "ipa_baja_id.required" => "IPA Baja Required",
            "ipa_baja_id.exists" => "Selected IPA Baja does not exist",
            "client_id.required" => "Client Required",
            "client_id.exists" => "Selected Client does not exist",
            "location.required" => "Project Location Required",
            "project_value.required" => "Project Value Required",
            "project_value.numeric" => "Project Value must be a number",
            "project_value.min" => "Project Value cannot be negative",
        ]);


        $project = new Project();
        $project->fill($request->all());
        $project->save();

        return redirect('/projects')->with('success', 'Successfully Add Project');
    }

    public function edit(Project $project, $id)
    {
        $project = Project::findOrFail($id);
        $ipaBajas = IpaBaja::all();
        $clients = Client::all();

        return view('pages.projects.edit', compact('project', 'ipaBajas', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            "ipa_baja_id" => "required|exists:ipa_bajas,id",
            "client_id" => "required|exists:clients,id",
            "location" => "required",
            "project_value" => "required|numeric|min:0",
        ], [
            "ipa_baja_id.required" => "IPA Baja Required",
            "ipa_baja_id.exists" => "Selected IPA Baja does not exist",
            "client_id.required" => "Client Required",
            "client_id.exists" => "Selected Client does not exist",
            "location.required" => "Project Location Required",
            "project_value.required" => "Project Value Required",
            "project_value.numeric" => "Project Value must be a number",
            "project_value.min" => "Project Value cannot be negative",
        ]);

        $project->fill($request->all());;
        $project->save();

        return redirect('/projects')->with('success', 'Successfully Edit Project');
    }

    public function delete($id)
    {
        try {
            Project::destroy($id);
            return redirect('/projects')->with('success', 'Successfully Delete Project');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect('/projects')->with('error', 'Cannot delete this project because it is being used in item_exit');
            }
            return redirect('/projects')->with('error', 'An error occurred while deleting the project');
        }
    }
}
