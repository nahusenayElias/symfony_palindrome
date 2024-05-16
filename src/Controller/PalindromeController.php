<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PalindromeFormType;

class PalindromeController extends AbstractController
{
    #[Route('/', name: 'app_palindrome')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(PalindromeFormType::class);
        $form->handleRequest($request);

        $result = null;

        if($form->isSubmitted() && $form->isValid()) {
            $word = $form->get('word')->getData();
            $result = $this->check_palindrome($word);
        }

        return $this->render('file/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
    public function check_palindrome($string)
    {
        return $string === strrev($string);
    }
}
