<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Create a new Category Object
        $category = new Category();
        // Create the associated Form
        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()) {
            // Deal with the submitted data
            // For example : persiste & flush the entity
            $entityManager->persist($category);
            $entityManager->flush();            
    
            // Redirect to categories list
            return $this->redirectToRoute('category_index');
            // And redirect to a route that display the result
        }
        // Render the form

        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    // #[Route('/{id}', name: 'show')]
    // public function show(string $id, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    // {
    //     $category = $categoryRepository->findOneBy(['id' => $id]);

    //     if (!$category) {
    //         throw $this->createNotFoundException(
    //             "Aucune catégorie avec l'ID ".$id
    //         );
    //     }

    //     $programs = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3, 0);

    //     if (!$programs) {
    //         throw $this->createNotFoundException(
    //             'No program found in this category.'
    //         );
    //     }

    //     return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $programs]);
    // }

    #[Route('/{category}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(Category $category): Response
    {
        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : '.$id.' found in category\'s table.'
            );
        }

        return $this->render('category/show.html.twig', ['category' => $category]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        // if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        // }

        return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
    }

}
