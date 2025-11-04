<?php

namespace App\Controller;

use App\Entity\Coche;
use App\Form\CocheType;
use App\Repository\CocheRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/coche')]
class CocheController extends AbstractController
{
    #[Route('/', name: 'coche_index')]
    public function index(CocheRepository $cocheRepository): Response
    {
        return $this->render('coche/index.html.twig', [
            'coches' => $cocheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'coche_new')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $coche = new Coche();
        $form = $this->createForm(CocheType::class, $coche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coche = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($coche);
            $entityManager->flush();
            return $this->redirectToRoute('coche_index');
        }

        return $this->render('coche/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
