<?php

namespace App\Controller;

use App\Entity\Marca;
use App\Form\MarcaType;
use App\Repository\MarcaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/marca')]
class MarcaController extends AbstractController
{
    #[Route('/', name: 'marca_index')]
    public function index(MarcaRepository $marcaRepository): Response
    {
        return $this->render('marca/index.html.twig', [
            'marcas' => $marcaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'marca_new')]
    public function new(Request $request, MarcaRepository $marcaRepository): Response
    {
        $marca = new Marca();
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $marcaRepository->save($marca, true);
            return $this->redirectToRoute('marca_index');
        }

        return $this->render('marca/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
