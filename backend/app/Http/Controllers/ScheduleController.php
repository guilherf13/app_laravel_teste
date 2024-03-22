<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use Illuminate\Http\Request;
use App\Models\TableSchedule;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TableSchedules = TableSchedule::all();
        return response()->json($TableSchedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:100|unique:table_schedule,email',
                'date_of_birth' => 'required|date',
                'cpf' => 'required|string|size:11',
                'phone' => 'required|string|size:11',
            ], [
                'name.required' => 'O campo nome é obrigatório.',
                'name.string' => 'O campo nome deve ser uma string.',
                'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            
                'email.required' => 'O campo email é obrigatório.',
                'email.string' => 'O campo email deve ser uma string.',
                'email.email' => 'O campo email deve ser um endereço de email válido.',
                'email.max' => 'O campo email não pode ter mais de :max caracteres.',
                'email.unique' => 'O campo email ja esta em uso.',
            
                'date_of_birth.required' => 'O campo data de nascimento é obrigatório.',
                'date_of_birth.date' => 'O campo data de nascimento deve ser uma data válida.',
            
                'cpf.required' => 'O campo CPF é obrigatório.',
                'cpf.string' => 'O campo CPF deve ser uma string.',
                'cpf.size' => 'O campo CPF deve ter exatamente :size caracteres.',
            
                'phone.required' => 'O campo telefone é obrigatório.',
                'phone.string' => 'O campo telefone deve ser uma string.',
                'phone.size' => 'O campo telefone deve ter exatamente :size caracteres.',
            ]);
    
            if ($validator->fails()) {
                return $this->returnJsonFormat(['errors' => $validator->errors()], 422);
            }
    
            $TableSchedule = TableSchedule::create($request->all());
            return response()->json($TableSchedule, 201); 
        } catch (\Exception $e) {
            return $this->returnJsonFormat(['errors' => $e->getMessage()], 422);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tableSchedule = TableSchedule::find($id);
        if (!$tableSchedule) {
            return response()->json(['message' => 'TableSchedule not found'], 404);
        }
        return response()->json($tableSchedule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:100',
            'date_of_birth' => 'required|date',
            'cpf' => 'required|string|size:11',
            'phone' => 'required|string|size:11',
        ]);

        $tableSchedule = TableSchedule::find($id);
        if (!$tableSchedule) {
            return response()->json(['message' => 'Agenda não encontrada'], 404);
        }

        $tableSchedule->update($request->all());
        return response()->json($tableSchedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tableSchedule = TableSchedule::find($id);
        if (!$tableSchedule) {
            return response()->json(['message' => 'TableSchedule not found'], 404);
        }

        $tableSchedule->delete();
        return response()->json(['message' => 'TableSchedule deleted'], 200);
    }

    public function report()
    {
        $schedules = TableSchedule::select('name')->paginate(10);
        return response()->json($schedules);
    }
}
