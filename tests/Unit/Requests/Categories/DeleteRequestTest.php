<?php

namespace Tests\Unit\Requests\Categories;

use Tests\TestCase;
use Tests\Traits\ValidateFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Requests\Categories\DeleteRequest as CategoryDeleteRequest;

class DeleteRequestTest extends TestCase
{
    use RefreshDatabase, ValidateFormRequest;

    /** @test */
    public function it_pass_for_required_attributes()
    {
        $this->assertValidationPasses(new CategoryDeleteRequest(), $this->getDeleteAttributes());
    }

    /** @test */
    public function it_fails_for_empty_attributes()
    {
        $this->assertValidationFails(new CategoryDeleteRequest(), [], function ($errors) {
            $this->assertCount(2, $errors);
            $this->assertEquals(__('validation.required'), $errors->first('category_id'));
            $this->assertEquals(__('validation.required'), $errors->first('delete_transactions'));
        });
    }

    private function getDeleteAttributes($overrides = [])
    {
        return array_merge([
            'category_id' => '1',
            'delete_transactions' => '1',
        ], $overrides);
    }
}
