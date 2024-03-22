<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\TableSchedule;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa a criação de um registro de schedule.
     *
     * @return void
     */
    public function testCreateSchedule()
    {
        $response = $this->postJson('/api/schedules', [
            'name' => 'Exemplo de Nome',
            'email' => 'exemplo@email.com',
            'date_of_birth' => '1990-01-01',
            'cpf' => '12345678900',
            'phone' => '11122334455'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'name', 'email', 'date_of_birth', 'cpf', 'phone']);
    }

    /**
     * Testa a listagem de todos os registros de schedules.
     *
     * @return void
     */
    public function testListSchedules()
    {
        TableSchedule::factory()->count(3)->create();

        $response = $this->getJson('/api/schedules');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /**
     * Testa a exibição de um registro específico de schedule.
     *
     * @return void
     */
    public function testShowSchedule()
    {
        $schedule = TableSchedule::factory()->create();

        $response = $this->getJson("/api/schedules/{$schedule->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $schedule->id,
                'name' => $schedule->name,
                'email' => $schedule->email,
                'date_of_birth' => $schedule->date_of_birth,
                'cpf' => $schedule->cpf,
                'phone' => $schedule->phone
            ]);
    }

    /**
     * Testa a atualização de um registro de schedule.
     *
     * @return void
     */
    public function testUpdateSchedule()
    {
        $schedule = TableSchedule::factory()->create();

        $response = $this->putJson("/api/schedules/{$schedule->id}", [
            'name' => 'Nome Atualizado',
            'email' => 'emailatualizado@email.com',
            'date_of_birth' => '1990-01-01',
            'cpf' => '98765432100',
            'phone' => '99988776655'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $schedule->id,
                'name' => 'Nome Atualizado',
                'email' => 'emailatualizado@email.com',
                'date_of_birth' => '1990-01-01',
                'cpf' => '98765432100',
                'phone' => '99988776655'
            ]);
    }

    /**
     * Testa a exclusão de um registro de schedule.
     *
     * @return void
     */
    public function testDeleteSchedule()
    {
        $schedule = TableSchedule::factory()->create();

        $response = $this->deleteJson("/api/schedules/{$schedule->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'TableSchedule deleted']);
    }
}
