<?php

namespace App\Controller\Admin;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use App\Repository\CabinetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/cabinet')]
final class CabinetController extends AbstractController
{
    #[Route(name: 'app_admin_cabinet_index', methods: ['GET'])]
    public function index(CabinetRepository $cabinetRepository): Response
    {
        return $this->render('admin/cabinet/index.html.twig', [
            'cabinets' => $cabinetRepository->findAll(),
            'view' => 'Liste des cabinets'
        ]);
    }


    #[Route('/{id}', name: 'app_admin_cabinet_show', methods: ['GET'])]
    public function show(Cabinet $cabinet): Response
    {
        return $this->render('admin/cabinet/show.html.twig', [
            'cabinet' => $cabinet,
            'view' => $cabinet->getNom()
        ]);
    }

}
