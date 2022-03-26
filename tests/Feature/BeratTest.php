<?php

namespace Tests\Feature;

use App\Models\Berat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BeratTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_redirect_slash_to_berat()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('berat.index'));
    }

    public function test_should_return_berat_view()
    {
        $index = $this->get(route('berat.index'));
        $index->assertViewIs('berat');
        $index->assertViewHas('type', 'index');

        $berat = Berat::factory()->createOne();
        $detail = $this->get(route('berat.show', $berat->id));
        $detail->assertViewIs('berat');
        $detail->assertViewHas('type', 'detail');
    }

    public function test_should_return_form_view()
    {
        $index = $this->get(route('berat.create'));
        $index->assertViewIs('form-berat');
        $index->assertViewHas('type', 'create');

        $berat = Berat::factory()->createOne();
        $detail = $this->get(route('berat.edit', $berat->id));
        $detail->assertViewIs('form-berat');
        $detail->assertViewHas('type', 'edit');
    }

    public function test_should_redirect_if_delete_success()
    {
        $berat = Berat::factory()->createOne();
        $resp = $this->delete(route('berat.delete', $berat->id));
        $resp->assertRedirect(route('berat.index'));
    }

    public function test_should_redirect_if_update_success()
    {
        $berat = Berat::factory()->createOne();
        $resp = $this->put(route('berat.update', $berat->id));
        $resp->assertRedirect(route('berat.index'));
    }

    public function test_should_redirect_if_create_success()
    {
        $data = [
            'max_weight' => 20,
            'min_weight' => 19,
            'date' => date('Y-m-d'),
        ];
        $resp = $this->post(route('berat.store'), $data);
        $resp->assertRedirect(route('berat.index'));
    }

    public function test_create_berat_validation_error()
    {
        $resp = $this->post(route('berat.store'), [
            'max_weight' => null,
            'min_weight' => -1,
            'date' => date('d/m/Y'),
        ]);
        $resp->assertSessionHasErrorsIn('max_weight');
        $resp->assertSessionHasErrorsIn('min_weight');
        $resp->assertSessionHasErrorsIn('date');
    }

    public function test_delete_not_found()
    {
        $resp = $this->delete(route('berat.delete', 10000));
        $resp->assertNotFound();
    }

    public function test_edit_not_found()
    {
        $resp = $this->put(route('berat.update', 1000));
        $resp->assertNotFound();
    }

    public function test_detail_not_found()
    {
        $resp = $this->get(route('berat.show', 1000));
        $resp->assertNotFound();
    }
}
