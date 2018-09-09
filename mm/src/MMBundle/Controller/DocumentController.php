<?php

namespace MMBundle\Controller;

use MMBundle\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MMBundle\Form\DocumentFilterType;
use MMBundle\Form\DocumentSearchType;
use MMBundle\Form\DocumentType;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;

/**
 * Document controller.
 *
 * @Route("document")
 */
class DocumentController extends Controller
{
    /**
     * Lists all document entities.
     *
     * @Route("/", name="document_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_PRACOWNIK')) {
            throw new \LogicException('This code should not be reached!');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new DocumentSearchType());
        $form->handleRequest($request);
        $formfilter = $this->createForm(new DocumentFilterType());
        $formfilter->handleRequest($request);
        if($form->isSubmitted()) {
            $documents = $em->getRepository('MMBundle:Document')->search($form);
            return $this->render('document/index.html.twig', array(
                'document' => $documents,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView(),
            ));
        }
        if ($formfilter->isSubmitted() && $formfilter->isValid()) {
            $document = $em->getRepository('MMBundle:Document')->filter($formfilter);
            $paginator = $this->get('knp_paginator');
            $document = $paginator->paginate(
                $document, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10
            );
            return $this->render('document/index.html.twig', array(
                'document' => $document,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView()
            ));
        }

        $dql   = "SELECT a FROM MMBundle:Document a";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');

        $documents = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

            return $this->render('document/index.html.twig', array(
            'document' => $documents,
            'form' => $form->createView(),
            'formfilter' => $formfilter->createView(),
        ));







    }

    /**
     * Creates a new document entity.
     *
     * @Route("/new", name="document_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $document = new Document();
        $form = $this->createForm('MMBundle\Form\DocumentType', $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('document_show', array('id' => $document->getId()));
        }

        return $this->render('document/new.html.twig', array(
            'document' => $document,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a document entity.
     *
     * @Route("/{id}", name="document_show")
     * @Method("GET")
     */
    public function showAction(Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);

        return $this->render('document/show.html.twig', array(
            'document' => $document,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing document entity.
     *
     * @Route("/{id}/edit", name="document_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Document $document)
    {
        $deleteForm = $this->createDeleteForm($document);
        $editForm = $this->createForm('MMBundle\Form\DocumentType', $document);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('document_edit', array('id' => $document->getId()));
        }

        return $this->render('document/edit.html.twig', array(
            'document' => $document,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a document entity.
     *
     * @Route("/{id}", name="document_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Document $document)
    {
        $form = $this->createDeleteForm($document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($document);
            $em->flush();
        }

        return $this->redirectToRoute('document_index');
    }

    /**
     * Creates a form to delete a document entity.
     *
     * @param Document $document The document entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Document $document)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('document_delete', array('id' => $document->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
