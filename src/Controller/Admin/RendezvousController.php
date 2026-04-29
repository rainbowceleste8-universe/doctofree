<?php

namespace App\Controller\Admin;

use App\Entity\Rendezvous;
use App\Form\RendezvousType;
use App\Repository\RendezvousRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/rendezvous')]
final class RendezvousController extends AbstractController
{
    #[Route(name: 'app_admin_rendezvous_index', methods: ['GET'])]
    public function index(RendezvousRepository $rendezvousRepository): Response
    {
        return $this->render('admin/rendezvous/index.html.twig', [
            'rendezvouses' => $rendezvousRepository->findAll(),
            'view' => "Liste des rendez-vous"
        ]);
    }


    #[Route('/{id}', name: 'app_admin_rendezvous_show', methods: ['GET'])]
    public function show(Rendezvous $rendezvou): Response
    {
        return $this->render('admin/rendezvous/show.html.twig', [
            'rendezvou' => $rendezvou,
            'view' => $rendezvou->getDateHeure()->format('d/m/Y à H:i') . " - " . $rendezvou->getPatient()
        ]);
    }

}
