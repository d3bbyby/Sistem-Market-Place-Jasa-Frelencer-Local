<?php

namespace Tests\Unit;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function test_image_url_falls_back_to_the_legacy_file_path(): void
    {
        Storage::fake('public');

        $portfolio = new Portfolio([
            'image' => ' ',
            'file_path' => 'portfolios/legacy-image.png',
        ]);

        $this->assertSame(
            Storage::disk('public')->url('portfolios/legacy-image.png'),
            $portfolio->imageUrl(),
        );
    }

    public function test_image_url_prefers_the_current_image_path(): void
    {
        Storage::fake('public');

        $portfolio = new Portfolio([
            'image' => 'portfolios/current-image.png',
            'file_path' => 'portfolios/legacy-image.png',
        ]);

        $this->assertSame(
            Storage::disk('public')->url('portfolios/current-image.png'),
            $portfolio->imageUrl(),
        );
    }
}
