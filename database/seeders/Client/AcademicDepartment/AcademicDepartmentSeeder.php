<?php

namespace Database\Seeders\Client\AcademicDepartment;

use Illuminate\Database\Seeder;

use App\Repositories\Client\AcademicDepartmentRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class AcademicDepartmentSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

    public function __construct(AcademicDepartmentRepository $academicDepartmentRepository)
    {
        $this->academicDepartmentRepository = $academicDepartmentRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!isProductionEnv()) {
            $academicDepartmentNum = (int)$this->command->ask("¿Cuántas Departamentos Académicos desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 Departamentos Académicos.", 10);
            $academicDepartmentNum = !is_numeric($academicDepartmentNum) || $academicDepartmentNum <= 0 ? 10 : $academicDepartmentNum;
            $academicDepartments = \App\Models\Client\AcademicDepartment::factory()->count($academicDepartmentNum)->make();

            $this->command->getOutput()->progressStart(count($academicDepartments));

            foreach ($academicDepartments as $academicDepartment) {
                $this->info("\n-Creando Departamento Académico: '{$academicDepartment->name}'\n");
                $academicDepartment->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
