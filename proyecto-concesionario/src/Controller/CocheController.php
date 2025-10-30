<?php

namespace App\Controller;

use App\Entity\Coche;
use App\Form\CocheType;
use App\Repository\CocheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request, CocheRepository $cocheRepository): Response
    {
        $coche = new Coche();
        $form = $this->createForm(CocheType::class, $coche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocheRepository->save($coche, true);
            return $this->redirectToRoute('coche_index');
        }

        return $this->render('coche/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
