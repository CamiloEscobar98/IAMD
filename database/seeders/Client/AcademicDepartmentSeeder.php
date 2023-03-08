<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\AcademicDepartmentRepository;

class AcademicDepartmentSeeder extends Seeder
{
    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

    public function __construct(AcademicDepartmentRepository $academicDepartmentRepository)
    {
        $this->academicDepartmentRepository = $academicDepartmentRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING ACADEMIC DEPARTMENTS !! \n \n");

        $randomAcademicDepartments = rand(4, 10);

        $cont = 0;

        do {
            $current = $cont + 1;

            print("Creating Academic Department: $current. \n");
            $academicDepartment = $this->academicDepartmentRepository->createOneFactory();
            print("Academic Department Created. Name: " . $academicDepartment->name .  "\n \n");

            $cont++;
            $randomAcademicDepartments--;
        } while ($randomAcademicDepartments > 0);
    }
}
