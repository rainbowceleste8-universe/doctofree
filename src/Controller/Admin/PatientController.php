<?php

namespace App\Controller\Admin;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use App\Repository\RendezvousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/patient')]
final class PatientController extends AbstractController
{
    #[Route(name: 'app_admin_patient_index', methods: ['GET'])]
    public function index(PatientRepository $patientRepository): Response
    {
        return $this->render('admin/patient/index.html.twig', [
            'patients' => $patientRepository->findAll(),
            'view' => "Liste des patients"
        ]);
    }

    #[Route('/{id}', name: 'app_admin_patient_show', methods: ['GET'])]
    public function show(Patient $patient, RendezvousRepository $rdvRepo): Response
    {
        return $this->render('admin/patient/show.html.twig', [
            'patient' => $patient,
            'listeRdvDuPatient' => $rdvRepo->findByPatientOrderedByDate($patient),
            'view' => $patient
        ]);
    }

}
