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
    #[Route('/', name: 'marca_index')]
    public function index(MarcaRepository $marcaRepository): Response
    {
        return $this->render('marca/index.html.twig', [
            'marcas' => $marcaRepository->findAll(),
        ]);
    }

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

    #[Route('/{id}/edit', name: 'marca_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Marca $marca, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(MarcaType::class, $marca);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();

            $this->addFlash('success', 'Marca actualizada correctamente.');

            return $this->redirectToRoute('marca_index');
        }

        return $this->render('marca/edit.html.twig', [
            'form' => $form->createView(),
            'marca' => $marca,
        ]);
    }

    #[Route('/{id}', name: 'marca_delete', methods: ['POST'])]
    public function delete(Request $request, Marca $marca, ManagerRegistry $doctrine): Response
    {
        if ($this->isCsrfTokenValid('delete' . $marca->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            try {
                $entityManager->remove($marca);
                $entityManager->flush();
                $this->addFlash('success', 'Marca eliminada correctamente.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error al eliminar la marca.');
            }
        }

        return $this->redirectToRoute('marca_index');
    }

}
