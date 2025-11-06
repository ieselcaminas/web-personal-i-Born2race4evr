<?php

namespace App\Controller;

use App\Repository\MarcaRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'marca_index')]
    public function index(MarcaRepository $marcaRepository): Response
    {
        return $this->render('marca/index.html.twig', [
            'marcas' => $marcaRepository->findAll(),
        ]);
    }

}
