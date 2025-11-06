<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use App\Repository\MarcaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/marca')]
class MarcaController extends AbstractController
{
    #[Route('/new', name: 'marca_new')]
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $marca = new Marca();
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marca = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($marca);
            $entityManager->flush();
            return $this->redirectToRoute('coche_index');
        }

        return $this->render('marca/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
