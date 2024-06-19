<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    // private $productService;

    // public function __construct(ProductService $productService) {
    //     $this->productService = $productService;
    // }

    #[Route('/index', name: 'mainpage', methods: ['GET', 'POST'])]
    public function index(Request $request): Response {

        if ($request->isMethod('POST')) 
        {
            $productName = $request->request->get('productName');
            $productId = $request->request->get('productId');
            $price = $request->request->get('price');
            $quantity = $request->request->get('quantity');
            $createdAt = new \DateTimeImmutable('now');

            $product = $this->productService->createProduct($productName, $productId, $price, $quantity, $createdAt);
        }

        return $this->render('index.html.twig', []);
    }
}