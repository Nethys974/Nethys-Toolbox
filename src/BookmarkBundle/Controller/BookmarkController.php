<?php

namespace BookmarkBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BookmarkBundle\Entity\Bookmark;
use BookmarkBundle\Form\BookmarkType;

class BookmarkController extends Controller
{
    public function indexAction()
    {
        $bookmarks = $this->getDoctrine()->getRepository('BookmarkBundle:Bookmark')->findAll();
        
        return $this->render('BookmarkBundle:Bookmark:index.html.twig', array(
            "bookmarks" => $bookmarks
        ));
    }
    
    public function addAction(Request $request)
    {
        // Génération du formulaire à partir d'une instance vide
        $bookmark = new Bookmark();
        $form = $this->get('form.factory')->create(new BookmarkType(), $bookmark);
        
        // Association du formulaire au contexte de la requête
        $form->handleRequest($request);
        
        // Validation
        if ($form->isValid()) {
            $bookmark->setCreatedBy($this->getUser());
            
            // Persistance
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookmark);
            $em->flush();

            // Notification
            $request->getSession()->getFlashBag()->add('success', 'Favori ajouté !');
            
            // Redirection
            return $this->redirect($this->generateUrl('bookmark_homepage'));
        }
        
        return $this->render('BookmarkBundle:Bookmark:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function editAction($id, Request $request)
    {
        // Génération du formulaire à partir d'une instance existante
        $bookmark = $this->getDoctrine()->getRepository('BookmarkBundle:Bookmark')->find($id);
        $form = $this->get('form.factory')->create(new BookmarkType(), $bookmark);
        
        // Association du formulaire au contexte de la requête
        $form->handleRequest($request);
        
        // Validation
        if ($form->isValid()) {
            $bookmark->setUpdatedBy($this->getUser());
            
            // Persistance
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // Notification
            $request->getSession()->getFlashBag()->add('success', 'Favori mis à jour !');
            
            // Redirection
            return $this->redirect($this->generateUrl('bookmark_homepage'));
        }
        
        return $this->render('BookmarkBundle:Bookmark:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function deleteAction($id, Request $request)
    {
        $bookmark = $this->getDoctrine()->getRepository('BookmarkBundle:Bookmark')->find($id);
        $title = $bookmark->getTitle();
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($bookmark);
        $em->flush();

        // Notification
        $request->getSession()->getFlashBag()->add('error', 'Favori "'.$title.'" supprimé !');

        // Redirection
        return $this->redirect($this->generateUrl('bookmark_homepage'));
    }
    
    public function showAction($id, Request $request)
    {
        $bookmark = $this->getDoctrine()->getRepository('BookmarkBundle:Bookmark')->find($id);

        return $this->render('BookmarkBundle:Bookmark:show.html.twig', array(
            'entity' => $bookmark
        ));
    }
}
