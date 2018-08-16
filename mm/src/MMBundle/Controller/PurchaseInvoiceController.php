<?php

namespace MMBundle\Controller;

use MMBundle\Entity\PurchaseInvoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MMBundle\Form\PurchaseInvoiceSearchType;
use MMBundle\Form\PurchaseInvoiceFilterType;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use MMBundle\Form\PurchaseInvoiceType;




/**
 * Purchaseinvoice controller.
 *
 * @Route("purchaseinvoice")
 */
class PurchaseInvoiceController extends Controller
{
    /**
     * Lists all PurchaseInvoice entities.
     *
     * @Route("/", name="purchaseinvoice_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_PRACOWNIK')) {
            throw new \LogicException('This code should not be reached!');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new PurchaseInvoiceSearchType());
        $form->handleRequest($request);

        $formfilter = $this->createForm(new PurchaseInvoiceFilterType());
        $formfilter->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $purchaseInvoices = $em->getRepository('MMBundle:PurchaseInvoice')->search($form);

            return $this->render('purchaseinvoice/index.html.twig', array(
                'purchaseInvoices' => $purchaseInvoices,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView(),
            ));


        }





        if ($formfilter->isSubmitted() && $formfilter->isValid()) {
            $purchaseInvoice = $em->getRepository('MMBundle:PurchaseInvoice')->filter($formfilter);


            $paginator = $this->get('knp_paginator');

            $purchaseInvoice = $paginator->paginate(
                $purchaseInvoice, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10
            );


            return $this->render('PurchaseInvoice/index.html.twig', array(
                'purchaseInvoices' => $purchaseInvoice,
                'formfilter' => $formfilter->createView(),
                'form' => $form->createView()
            ));
        }


        $dql   = "SELECT a FROM MMBundle:PurchaseInvoice a";
        $query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');

        $purchaseInvoices = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10
        );

        return $this->render('purchaseinvoice/index.html.twig', array(
            'purchaseInvoices' => $purchaseInvoices,
            'form' => $form->createView(),
            'formfilter' => $formfilter->createView(),
        ));
    }

    /**
     * Creates a new purchaseInvoice entity.
     *
     * @Route("/new", name="purchaseinvoice_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $purchaseInvoice = new Purchaseinvoice();
        $form = $this->createForm('MMBundle\Form\PurchaseInvoiceType', $purchaseInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($purchaseInvoice);
            $em->flush();

            return $this->redirectToRoute('purchaseinvoice_show', array('id' => $purchaseInvoice->getId()));
        }

        return $this->render('purchaseinvoice/new.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a purchaseInvoice entity.
     *
     * @Route("/{id}", name="purchaseinvoice_show")
     * @Method("GET")
     */
    public function showAction(PurchaseInvoice $purchaseInvoice)
    {
        $deleteForm = $this->createDeleteForm($purchaseInvoice);

        return $this->render('purchaseinvoice/show.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing purchaseInvoice entity.
     *
     * @Route("/{id}/edit", name="purchaseinvoice_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $deleteForm = $this->createDeleteForm($purchaseInvoice);
        $editForm = $this->createForm('MMBundle\Form\PurchaseInvoiceType', $purchaseInvoice);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('purchaseinvoice_edit', array('id' => $purchaseInvoice->getId()));
        }

        return $this->render('purchaseinvoice/edit.html.twig', array(
            'purchaseInvoice' => $purchaseInvoice,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a purchaseInvoice entity.
     *
     * @Route("/{id}", name="purchaseinvoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $form = $this->createDeleteForm($purchaseInvoice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($purchaseInvoice);
            $em->flush();
        }

        return $this->redirectToRoute('purchaseinvoice_index');
    }

    /**
     * Creates a form to delete a purchaseInvoice entity.
     *
     * @param PurchaseInvoice $purchaseInvoice The purchaseInvoice entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PurchaseInvoice $purchaseInvoice)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('purchaseinvoice_delete', array('id' => $purchaseInvoice->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
