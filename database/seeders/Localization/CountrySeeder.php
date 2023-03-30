<?php

namespace Database\Seeders\Localization;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\CountryRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class CountrySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->getOutput()->progressStart(1);
        $this->countryRepository->create(['name' => 'Colombia']);
        $this->info("\n-Creando Pais: 'Colombia'\n");
        $this->command->getOutput()->progressAdvance();
        $this->command->getOutput()->progressFinish();
    }
}
